<?php
defined('ABSPATH') || exit;

class Next_Extra_Admin {

    private static $instance = null;

    public static function instance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct() {
        add_action('admin_menu', [$this, 'admin_menu']);
        add_action('admin_init', [$this, 'register_settings']);
        add_action('admin_enqueue_scripts', [$this, 'admin_scripts']);
    }

    public function admin_menu() {
        add_menu_page(
            esc_html__('Next Extra', 'next-extra'),
            esc_html__('Next Extra', 'next-extra'),
            'manage_options',
            'next-extra-settings',
            [$this, 'settings_page'],
            'dashicons-superhero',
            59
        );
    }

    public function register_settings() {
        register_setting('next_extra_settings_group', 'next_extra_widgets', [
            'type'              => 'array',
            'sanitize_callback' => function ($input) {
                if (!is_array($input)) {
                    return [];
                }
                $sanitized = [];
                foreach ($input as $k => $v) {
                    $sanitized[sanitize_key($k)] = ($v === 'on') ? 'on' : 'off';
                }
                return $sanitized;
            },
            'default'           => [],
        ]);
    }

    public function admin_scripts($hook) {
        if ($hook !== 'toplevel_page_next-extra-settings') {
            return;
        }

        wp_enqueue_style(
            'next-extra-admin',
            NEXT_EXTRA_URL . 'assets/css/admin.css',
            [],
            NEXT_EXTRA_VERSION
        );
    }

    public function settings_page() {
        $saved = get_option('next_extra_widgets', [
            'advanced_coupon'         => 'on',
            'product_carousel'        => 'on',
            'flash_sale_products'     => 'on',
            'best_selling_product'    => 'on',
            'product_filters'         => 'on',
            'account_dashboard'       => 'on',
            'account_address'         => 'on',
            'account_details'         => 'on',
            'account_downloads'       => 'on',
            'account_form_login'      => 'on',
            'account_form_register'   => 'on',
            'account_logout'          => 'on',
            'account_navigation'      => 'on',
            'account_order_details'   => 'on',
            'account_orders'          => 'on',
            'account_wishlist'        => 'on',
            'account_payment_methods' => 'on',
        ]);
        ?>
        <div class="wrap next-extra-admin-wrap">
            <div class="next-extra-header">
                <h1><?php esc_html_e('Next Extra - Widgets Manager', 'next-extra'); ?></h1>
                <p><?php esc_html_e('Enable or disable widgets provided by Next Extra.', 'next-extra'); ?></p>
            </div>

            <form method="post" action="options.php">
                <?php settings_fields('next_extra_settings_group'); ?>
                
                <div class="next-extra-section-card">
                    <div class="section-title">
                        <h2><?php esc_html_e('General', 'next-extra'); ?></h2>
                        <span class="badge"><?php esc_html_e('Active Section', 'next-extra'); ?></span>
                    </div>

                    <div class="widgets-grid">
                        <div class="widget-item-card">
                            <div class="widget-info">
                                <h3><?php esc_html_e('Advanced Coupon', 'next-extra'); ?></h3>
                                <p><?php esc_html_e('Displays promotional coupons with copy code, countdown urgency, and regional targeting.', 'next-extra'); ?></p>
                            </div>
                            <div class="widget-switch">
                                <label class="switch">
                                    <input type="checkbox" name="next_extra_widgets[advanced_coupon]" value="on" <?php checked(!empty($saved['advanced_coupon']) && $saved['advanced_coupon'] === 'on'); ?>>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>

                        <div class="widget-item-card">
                            <div class="widget-info">
                                <h3><?php esc_html_e('Product Carousel', 'next-extra'); ?></h3>
                                <p><?php esc_html_e('Interactive swiper slider carousel for WooCommerce products with multi-column layout.', 'next-extra'); ?></p>
                            </div>
                            <div class="widget-switch">
                                <label class="switch">
                                    <input type="checkbox" name="next_extra_widgets[product_carousel]" value="on" <?php checked(!empty($saved['product_carousel']) && $saved['product_carousel'] === 'on'); ?>>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>

                        <div class="widget-item-card">
                            <div class="widget-info">
                                <h3><?php esc_html_e('Flash Sale Products', 'next-extra'); ?></h3>
                                <p><?php esc_html_e('Urgency-driven discounted products grid with live countdown timer and stock claim bar.', 'next-extra'); ?></p>
                            </div>
                            <div class="widget-switch">
                                <label class="switch">
                                    <input type="checkbox" name="next_extra_widgets[flash_sale_products]" value="on" <?php checked(!empty($saved['flash_sale_products']) && $saved['flash_sale_products'] === 'on'); ?>>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>

                        <div class="widget-item-card">
                            <div class="widget-info">
                                <h3><?php esc_html_e('Best Selling Product', 'next-extra'); ?></h3>
                                <p><?php esc_html_e('Showcase top-selling popular products with ranking ribbon badges and sales count.', 'next-extra'); ?></p>
                            </div>
                            <div class="widget-switch">
                                <label class="switch">
                                    <input type="checkbox" name="next_extra_widgets[best_selling_product]" value="on" <?php checked(!empty($saved['best_selling_product']) && $saved['best_selling_product'] === 'on'); ?>>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="next-extra-section-card">
                    <div class="section-title">
                        <h2><?php esc_html_e('Archive', 'next-extra'); ?></h2>
                        <span class="badge"><?php esc_html_e('Archive Section', 'next-extra'); ?></span>
                    </div>

                    <div class="widgets-grid">
                        <div class="widget-item-card">
                            <div class="widget-info">
                                <h3><?php esc_html_e('Product Filters', 'next-extra'); ?></h3>
                                <p><?php esc_html_e('Comprehensive faceted filters (Price range, Categories, Ratings, Stock status) for shop and archive templates.', 'next-extra'); ?></p>
                            </div>
                            <div class="widget-switch">
                                <label class="switch">
                                    <input type="checkbox" name="next_extra_widgets[product_filters]" value="on" <?php checked(!empty($saved['product_filters']) && $saved['product_filters'] === 'on'); ?>>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="next-extra-section-card">
                    <div class="section-title">
                        <h2><?php esc_html_e('My Account', 'next-extra'); ?></h2>
                        <span class="badge"><?php esc_html_e('My Account Section', 'next-extra'); ?></span>
                    </div>

                    <div class="widgets-grid">
                        <?php
                        $my_account_widgets = [
                            'account_dashboard'       => ['Account Dashboard', 'Customer greeting and overview screen.'],
                            'account_address'         => ['Account Address', 'Billing and shipping address management.'],
                            'account_details'         => ['Account Details', 'Edit profile name, email, and password form.'],
                            'account_downloads'       => ['Account Downloads', 'List of downloadable digital products.'],
                            'account_form_login'      => ['Account Form - Login', 'Standalone login form with remember me.'],
                            'account_form_register'   => ['Account Form - Register', 'User registration and signup form.'],
                            'account_logout'          => ['Account Logout', 'Direct logout trigger button.'],
                            'account_navigation'      => ['Account Navigation', 'My Account tabs and menu navigation bar.'],
                            'account_order_details'   => ['Account Order - Details', 'Full order receipt and item breakdown.'],
                            'account_orders'          => ['Account Orders', 'Customer order history table.'],
                            'account_wishlist'        => ['Account Wishlist', 'Customer saved products and wishlist items.'],
                            'account_payment_methods' => ['Account Payment Methods', 'Saved credit cards and payment gateways.'],
                        ];

                        foreach ($my_account_widgets as $key => $info) : ?>
                            <div class="widget-item-card">
                                <div class="widget-info">
                                    <h3><?php echo esc_html($info[0]); ?></h3>
                                    <p><?php echo esc_html($info[1]); ?></p>
                                </div>
                                <div class="widget-switch">
                                    <label class="switch">
                                        <input type="checkbox" name="next_extra_widgets[<?php echo esc_attr($key); ?>]" value="on" <?php checked(!empty($saved[$key]) && $saved[$key] === 'on'); ?>>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <?php submit_button(esc_html__('Save Changes', 'next-extra')); ?>
            </form>
        </div>
        <?php
    }
}
