<?php
/**
 * Plugin Name: Next Extra
 * Plugin URI: https://nextdevs.com/
 * Description: Extra premium widgets for Elementor & WooCommerce including Advanced Coupon and Product Carousel under the General category.
 * Version: 1.0.0
 * Author: NextDevs
 * Author URI: https://nextdevs.com/
 * Text Domain: next-extra
 * Domain Path: /languages
 * Requires at least: 5.6
 * Requires PHP: 7.4
 */

defined('ABSPATH') || exit;

define('NEXT_EXTRA_VERSION', '1.0.0');
define('NEXT_EXTRA_FILE', __FILE__);
define('NEXT_EXTRA_PATH', plugin_dir_path(__FILE__));
define('NEXT_EXTRA_URL', plugin_dir_url(__FILE__));

final class Next_Extra {

    private static $instance = null;

    public static function instance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct() {
        add_action('plugins_loaded', [$this, 'init']);
    }

    public function init() {
        // Check for WooCommerce and Elementor
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', [$this, 'admin_notice_missing_elementor']);
            return;
        }

        // Register Elementor widget category
        add_action('elementor/elements/categories_registered', [$this, 'add_category']);

        // Register Elementor widgets
        add_action('elementor/widgets/register', [$this, 'register_widgets']);

        // Register Frontend Scripts & Styles
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);

        // AJAX endpoints for coupon application and filtering
        add_action('wp_ajax_next_extra_apply_coupon', [$this, 'ajax_apply_coupon']);
        add_action('wp_ajax_nopriv_next_extra_apply_coupon', [$this, 'ajax_apply_coupon']);

        // Settings / Admin if needed
        require_once NEXT_EXTRA_PATH . 'admin/settings.php';
        Next_Extra_Admin::instance();
    }

    public function admin_notice_missing_elementor() {
        if (isset($_GET['activate'])) unset($_GET['activate']);
        $message = sprintf(
            esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'next-extra'),
            '<strong>' . esc_html__('Next Extra', 'next-extra') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'next-extra') . '</strong>'
        );
        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    public function add_category($elements_manager) {
        $elements_manager->add_category(
            'next-extra-general',
            [
                'title' => esc_html__('General', 'next-extra'),
                'icon'  => 'fa fa-plug',
            ]
        );

        $elements_manager->add_category(
            'next-extra-archive',
            [
                'title' => esc_html__('Archive', 'next-extra'),
                'icon'  => 'fa fa-folder-open',
            ]
        );

        $elements_manager->add_category(
            'next-extra-my-account',
            [
                'title' => esc_html__('My Account', 'next-extra'),
                'icon'  => 'fa fa-user-circle',
            ]
        );
    }

    public function register_widgets($widgets_manager) {
        // Advanced Coupon widget
        require_once NEXT_EXTRA_PATH . 'widgets/advanced-coupon/advanced-coupon.php';
        $widgets_manager->register(new \Next_Extra_Advanced_Coupon());

        // Product Carousel widget
        require_once NEXT_EXTRA_PATH . 'widgets/product-carousel/product-carousel.php';
        $widgets_manager->register(new \Next_Extra_Product_Carousel());

        // Flash Sale Products widget
        require_once NEXT_EXTRA_PATH . 'widgets/flash-sale-products/flash-sale-products.php';
        $widgets_manager->register(new \Next_Extra_Flash_Sale_Products());

        // Best Selling Product widget
        require_once NEXT_EXTRA_PATH . 'widgets/best-selling-product/best-selling-product.php';
        $widgets_manager->register(new \Next_Extra_Best_Selling_Product());

        // Product Filters widget (Archive)
        require_once NEXT_EXTRA_PATH . 'widgets/product-filters/product-filters.php';
        $widgets_manager->register(new \Next_Extra_Product_Filters());

        // My Account Widgets (12 widgets)
        require_once NEXT_EXTRA_PATH . 'widgets/account/account-widgets.php';
        $widgets_manager->register(new \Next_Extra_Account_Dashboard());
        $widgets_manager->register(new \Next_Extra_Account_Address());
        $widgets_manager->register(new \Next_Extra_Account_Details());
        $widgets_manager->register(new \Next_Extra_Account_Downloads());
        $widgets_manager->register(new \Next_Extra_Account_Form_Login());
        $widgets_manager->register(new \Next_Extra_Account_Form_Register());
        $widgets_manager->register(new \Next_Extra_Account_Logout());
        $widgets_manager->register(new \Next_Extra_Account_Navigation());
        $widgets_manager->register(new \Next_Extra_Account_Order_Details());
        $widgets_manager->register(new \Next_Extra_Account_Orders());
        $widgets_manager->register(new \Next_Extra_Account_Wishlist());
        $widgets_manager->register(new \Next_Extra_Account_Payment_Methods());
    }

    public function enqueue_scripts() {
        wp_register_style(
            'next-extra-frontend',
            NEXT_EXTRA_URL . 'assets/css/frontend.css',
            [],
            NEXT_EXTRA_VERSION
        );

        wp_register_script(
            'next-extra-frontend',
            NEXT_EXTRA_URL . 'assets/js/frontend.js',
            ['jquery', 'elementor-frontend'],
            NEXT_EXTRA_VERSION,
            true
        );

        wp_localize_script('next-extra-frontend', 'nextExtraVars', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce'    => wp_create_nonce('next_extra_nonce'),
            'i18n'     => [
                'copied'       => esc_html__('Copied!', 'next-extra'),
                'copy_failed'  => esc_html__('Copy failed', 'next-extra'),
                'applying'     => esc_html__('Applying...', 'next-extra'),
            ]
        ]);

        wp_enqueue_style('next-extra-frontend');
        wp_enqueue_script('next-extra-frontend');
    }

    public function ajax_apply_coupon() {
        check_ajax_referer('next_extra_nonce', 'security');

        if (!function_exists('WC')) {
            wp_send_json_error(['message' => esc_html__('WooCommerce is not active.', 'next-extra')]);
        }

        $coupon_code = isset($_POST['coupon_code']) ? sanitize_text_field(wp_unslash($_POST['coupon_code'])) : '';

        if (empty($coupon_code)) {
            wp_send_json_error(['message' => esc_html__('Please enter a coupon code.', 'next-extra')]);
        }

        if (!WC()->cart) {
            wc_load_cart();
        }

        if (WC()->cart->has_discount($coupon_code)) {
            wp_send_json_error(['message' => esc_html__('Coupon code already applied!', 'next-extra')]);
        }

        $applied = WC()->cart->apply_coupon($coupon_code);

        if ($applied) {
            wc_clear_notices();
            wp_send_json_success([
                'message' => esc_html__('Coupon applied successfully!', 'next-extra'),
                'cart_total' => WC()->cart->get_total(),
            ]);
        } else {
            $notices = wc_get_notices('error');
            wc_clear_notices();
            $msg = !empty($notices) ? wp_strip_all_tags($notices[0]['notice']) : esc_html__('Invalid or expired coupon.', 'next-extra');
            wp_send_json_error(['message' => $msg]);
        }
    }
}

function next_extra() {
    return Next_Extra::instance();
}

next_extra();
