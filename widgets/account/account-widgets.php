<?php
defined('ABSPATH') || exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;

/**
 * 1. Account Dashboard Widget
 */
class Next_Extra_Account_Dashboard extends Widget_Base {
    public function get_name() { return 'next-extra-account-dashboard'; }
    public function get_title() { return esc_html__('Account Dashboard', 'next-extra'); }
    public function get_icon() { return 'eicon-dashboard'; }
    public function get_categories() { return ['next-extra', 'next-extra-my-account', 'shopengine-my_account', 'general']; } public function show_in_panel() { return true; }
    public function get_keywords() { return ['account', 'dashboard', 'my account', 'next extra', 'shopengine', 'woocommerce']; }

    protected function register_controls() {
        $this->start_controls_section('section_style', [
            'label' => esc_html__('Dashboard Style', 'next-extra'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);
        $this->add_control('text_color', [
            'label'     => esc_html__('Text Color', 'next-extra'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#334155',
            'selectors' => ['{{WRAPPER}} .next-extra-account-content' => 'color: {{VALUE}};'],
        ]);
        $this->add_control('link_color', [
            'label'     => esc_html__('Link Color', 'next-extra'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#2563eb',
            'selectors' => ['{{WRAPPER}} .next-extra-account-content a' => 'color: {{VALUE}}; font-weight: 600;'],
        ]);
        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name'     => 'typography',
            'selector' => '{{WRAPPER}} .next-extra-account-content',
        ]);
        $this->end_controls_section();
    }

    protected function render() {
        if (!function_exists('woocommerce_account_content')) {
            echo '<div class="next-extra-alert">' . esc_html__('WooCommerce is required.', 'next-extra') . '</div>';
            return;
        }
        $current_user = wp_get_current_user();
        ?>
        <div class="next-extra-account-widget next-extra-account-dashboard-wrap">
            <div class="next-extra-account-content">
                <?php
                if (is_user_logged_in()) {
                    do_action('woocommerce_account_dashboard');
                } else {
                    echo '<p>' . sprintf(
                        esc_html__('Hello, guest! Please %s to view your account dashboard.', 'next-extra'),
                        '<a href="' . esc_url(wc_get_page_permalink('myaccount')) . '">' . esc_html__('sign in', 'next-extra') . '</a>'
                    ) . '</p>';
                }
                ?>
            </div>
        </div>
        <?php
    }
}

/**
 * 2. Account Address Widget
 */
class Next_Extra_Account_Address extends Widget_Base {
    public function get_name() { return 'next-extra-account-address'; }
    public function get_title() { return esc_html__('Account Address', 'next-extra'); }
    public function get_icon() { return 'eicon-map-pin'; }
    public function get_categories() { return ['next-extra', 'next-extra-my-account', 'shopengine-my_account', 'general']; } public function show_in_panel() { return true; }
    public function get_keywords() { return ['account', 'address', 'shipping', 'billing', 'next extra', 'shopengine', 'woocommerce']; }

    protected function register_controls() {
        $this->start_controls_section('section_style', [
            'label' => esc_html__('Address Style', 'next-extra'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);
        $this->add_control('card_bg', [
            'label'     => esc_html__('Card Background', 'next-extra'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#ffffff',
            'selectors' => ['{{WRAPPER}} .woocommerce-Address' => 'background-color: {{VALUE}}; padding: 18px; border-radius: 8px; border: 1px solid #e2e8f0;'],
        ]);
        $this->add_control('title_color', [
            'label'     => esc_html__('Heading Color', 'next-extra'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#0f172a',
            'selectors' => ['{{WRAPPER}} .woocommerce-Address-title h3' => 'color: {{VALUE}};'],
        ]);
        $this->end_controls_section();
    }

    protected function render() {
        if (!function_exists('woocommerce_account_addresses')) {
            echo '<div class="next-extra-alert">' . esc_html__('WooCommerce is required.', 'next-extra') . '</div>';
            return;
        }
        ?>
        <div class="next-extra-account-widget next-extra-account-address-wrap">
            <div class="next-extra-account-content">
                <?php woocommerce_account_addresses(); ?>
            </div>
        </div>
        <?php
    }
}

/**
 * 3. Account Details Widget
 */
class Next_Extra_Account_Details extends Widget_Base {
    public function get_name() { return 'next-extra-account-details'; }
    public function get_title() { return esc_html__('Account Details', 'next-extra'); }
    public function get_icon() { return 'eicon-user-circle-o'; }
    public function get_categories() { return ['next-extra', 'next-extra-my-account', 'shopengine-my_account', 'general']; } public function show_in_panel() { return true; }
    public function get_keywords() { return ['account', 'details', 'profile', 'edit account', 'next extra', 'shopengine', 'woocommerce']; }

    protected function register_controls() {
        $this->start_controls_section('section_style', [
            'label' => esc_html__('Form Style', 'next-extra'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);
        $this->add_control('label_color', [
            'label'     => esc_html__('Label Color', 'next-extra'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#334155',
            'selectors' => ['{{WRAPPER}} label' => 'color: {{VALUE}}; font-weight: 600;'],
        ]);
        $this->add_control('btn_bg', [
            'label'     => esc_html__('Save Button Background', 'next-extra'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#2563eb',
            'selectors' => ['{{WRAPPER}} button[type="submit"]' => 'background-color: {{VALUE}} !important; color: #fff; border-radius: 6px; padding: 10px 20px;'],
        ]);
        $this->end_controls_section();
    }

    protected function render() {
        if (!function_exists('woocommerce_account_edit_account')) {
            echo '<div class="next-extra-alert">' . esc_html__('WooCommerce is required.', 'next-extra') . '</div>';
            return;
        }
        ?>
        <div class="next-extra-account-widget next-extra-account-details-wrap">
            <div class="next-extra-account-content">
                <?php woocommerce_account_edit_account(); ?>
            </div>
        </div>
        <?php
    }
}

/**
 * 4. Account Downloads Widget
 */
class Next_Extra_Account_Downloads extends Widget_Base {
    public function get_name() { return 'next-extra-account-downloads'; }
    public function get_title() { return esc_html__('Account Downloads', 'next-extra'); }
    public function get_icon() { return 'eicon-file-download'; }
    public function get_categories() { return ['next-extra', 'next-extra-my-account', 'shopengine-my_account', 'general']; } public function show_in_panel() { return true; }
    public function get_keywords() { return ['account', 'downloads', 'files', 'next extra', 'shopengine', 'woocommerce']; }

    protected function register_controls() {
        $this->start_controls_section('section_style', [
            'label' => esc_html__('Table Style', 'next-extra'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);
        $this->add_control('table_header_bg', [
            'label'     => esc_html__('Header Background', 'next-extra'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#f8fafc',
            'selectors' => ['{{WRAPPER}} thead th' => 'background-color: {{VALUE}}; color: #0f172a;'],
        ]);
        $this->end_controls_section();
    }

    protected function render() {
        if (!function_exists('woocommerce_account_downloads')) {
            echo '<div class="next-extra-alert">' . esc_html__('WooCommerce is required.', 'next-extra') . '</div>';
            return;
        }
        ?>
        <div class="next-extra-account-widget next-extra-account-downloads-wrap">
            <div class="next-extra-account-content">
                <?php woocommerce_account_downloads(); ?>
            </div>
        </div>
        <?php
    }
}

/**
 * 5. Account Form - Login Widget
 */
class Next_Extra_Account_Form_Login extends Widget_Base {
    public function get_name() { return 'next-extra-account-form-login'; }
    public function get_title() { return esc_html__('Account Form - Login', 'next-extra'); }
    public function get_icon() { return 'eicon-lock-user'; }
    public function get_categories() { return ['next-extra', 'next-extra-my-account', 'shopengine-my_account', 'general']; } public function show_in_panel() { return true; }
    public function get_keywords() { return ['login', 'account login', 'form', 'sign in', 'next extra', 'shopengine', 'woocommerce']; }

    protected function register_controls() {
        $this->start_controls_section('section_style', [
            'label' => esc_html__('Login Form Style', 'next-extra'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);
        $this->add_control('btn_bg', [
            'label'     => esc_html__('Submit Button Background', 'next-extra'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#2563eb',
            'selectors' => ['{{WRAPPER}} button[name="login"]' => 'background-color: {{VALUE}} !important; color: #fff; border-radius: 6px; padding: 10px 24px;'],
        ]);
        $this->end_controls_section();
    }

    protected function render() {
        if (!function_exists('woocommerce_login_form')) {
            echo '<div class="next-extra-alert">' . esc_html__('WooCommerce is required.', 'next-extra') . '</div>';
            return;
        }
        ?>
        <div class="next-extra-account-widget next-extra-account-login-wrap">
            <div class="next-extra-account-content">
                <?php if (is_user_logged_in()) : ?>
                    <p><?php esc_html_e('You are currently logged in.', 'next-extra'); ?> <a href="<?php echo esc_url(wc_logout_url()); ?>"><?php esc_html_e('Log out?', 'next-extra'); ?></a></p>
                <?php else : ?>
                    <form class="woocommerce-form woocommerce-form-login login" method="post">
                        <?php do_action('woocommerce_login_form_start'); ?>
                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                            <label for="username"><?php esc_html_e('Username or email address', 'next-extra'); ?>&nbsp;<span class="required">*</span></label>
                            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" />
                        </p>
                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                            <label for="password"><?php esc_html_e('Password', 'next-extra'); ?>&nbsp;<span class="required">*</span></label>
                            <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
                        </p>
                        <?php do_action('woocommerce_login_form'); ?>
                        <p class="form-row">
                            <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
                                <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e('Remember me', 'next-extra'); ?></span>
                            </label>
                            <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
                            <button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="<?php esc_attr_e('Log in', 'next-extra'); ?>"><?php esc_html_e('Log in', 'next-extra'); ?></button>
                        </p>
                        <p class="woocommerce-LostPassword lost_password">
                            <a href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php esc_html_e('Lost your password?', 'next-extra'); ?></a>
                        </p>
                        <?php do_action('woocommerce_login_form_end'); ?>
                    </form>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }
}

/**
 * 6. Account Form - Register Widget
 */
class Next_Extra_Account_Form_Register extends Widget_Base {
    public function get_name() { return 'next-extra-account-form-register'; }
    public function get_title() { return esc_html__('Account Form - Register', 'next-extra'); }
    public function get_icon() { return 'eicon-pencil'; }
    public function get_categories() { return ['next-extra', 'next-extra-my-account', 'shopengine-my_account', 'general']; } public function show_in_panel() { return true; }
    public function get_keywords() { return ['register', 'account register', 'sign up', 'next extra', 'shopengine', 'woocommerce']; }

    protected function register_controls() {
        $this->start_controls_section('section_style', [
            'label' => esc_html__('Register Form Style', 'next-extra'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);
        $this->add_control('btn_bg', [
            'label'     => esc_html__('Register Button Background', 'next-extra'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#2563eb',
            'selectors' => ['{{WRAPPER}} button[name="register"]' => 'background-color: {{VALUE}} !important; color: #fff; border-radius: 6px; padding: 10px 24px;'],
        ]);
        $this->end_controls_section();
    }

    protected function render() {
        if (!function_exists('wc_get_page_permalink')) {
            echo '<div class="next-extra-alert">' . esc_html__('WooCommerce is required.', 'next-extra') . '</div>';
            return;
        }
        ?>
        <div class="next-extra-account-widget next-extra-account-register-wrap">
            <div class="next-extra-account-content">
                <?php if (is_user_logged_in()) : ?>
                    <p><?php esc_html_e('You are already registered and logged in.', 'next-extra'); ?></p>
                <?php elseif ('yes' === get_option('woocommerce_enable_myaccount_registration')) : ?>
                    <form method="post" class="woocommerce-form woocommerce-form-register register">
                        <?php do_action('woocommerce_register_form_start'); ?>
                        <?php if ('no' === get_option('woocommerce_registration_generate_username')) : ?>
                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                <label for="reg_username"><?php esc_html_e('Username', 'next-extra'); ?>&nbsp;<span class="required">*</span></label>
                                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" />
                            </p>
                        <?php endif; ?>
                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                            <label for="reg_email"><?php esc_html_e('Email address', 'next-extra'); ?>&nbsp;<span class="required">*</span></label>
                            <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" />
                        </p>
                        <?php if ('no' === get_option('woocommerce_registration_generate_password')) : ?>
                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                <label for="reg_password"><?php esc_html_e('Password', 'next-extra'); ?>&nbsp;<span class="required">*</span></label>
                                <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
                            </p>
                        <?php else : ?>
                            <p><?php esc_html_e('A password will be sent to your email address.', 'next-extra'); ?></p>
                        <?php endif; ?>
                        <?php do_action('woocommerce_register_form'); ?>
                        <p class="woocommerce-form-row form-row">
                            <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
                            <button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="<?php esc_attr_e('Register', 'next-extra'); ?>"><?php esc_html_e('Register', 'next-extra'); ?></button>
                        </p>
                        <?php do_action('woocommerce_register_form_end'); ?>
                    </form>
                <?php else : ?>
                    <p><?php esc_html_e('User registration is currently disabled on this store.', 'next-extra'); ?></p>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }
}

/**
 * 7. Account Logout Widget
 */
class Next_Extra_Account_Logout extends Widget_Base {
    public function get_name() { return 'next-extra-account-logout'; }
    public function get_title() { return esc_html__('Account Logout', 'next-extra'); }
    public function get_icon() { return 'eicon-sign-out'; }
    public function get_categories() { return ['next-extra', 'next-extra-my-account', 'shopengine-my_account', 'general']; } public function show_in_panel() { return true; }
    public function get_keywords() { return ['logout', 'sign out', 'exit', 'account', 'next extra', 'shopengine', 'woocommerce']; }

    protected function register_controls() {
        $this->start_controls_section('section_content', [
            'label' => esc_html__('Logout Button', 'next-extra'),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);
        $this->add_control('logout_text', [
            'label'   => esc_html__('Button Label', 'next-extra'),
            'type'    => Controls_Manager::TEXT,
            'default' => esc_html__('Log out', 'next-extra'),
        ]);
        $this->add_control('btn_bg', [
            'label'     => esc_html__('Button Background', 'next-extra'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#dc2626',
            'selectors' => ['{{WRAPPER}} .next-extra-logout-btn' => 'background-color: {{VALUE}}; color: #fff; padding: 10px 20px; border-radius: 6px; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; font-weight: 600;'],
        ]);
        $this->end_controls_section();
    }

    protected function render() {
        if (!function_exists('wc_logout_url')) {
            return;
        }
        $settings = $this->get_settings_for_display();
        $label = !empty($settings['logout_text']) ? $settings['logout_text'] : esc_html__('Log out', 'next-extra');
        ?>
        <div class="next-extra-account-widget next-extra-account-logout-wrap">
            <a href="<?php echo esc_url(wc_logout_url()); ?>" class="next-extra-logout-btn">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                <span><?php echo esc_html($label); ?></span>
            </a>
        </div>
        <?php
    }
}

/**
 * 8. Account Navigation Widget
 */
class Next_Extra_Account_Navigation extends Widget_Base {
    public function get_name() { return 'next-extra-account-navigation'; }
    public function get_title() { return esc_html__('Account Navigation', 'next-extra'); }
    public function get_icon() { return 'eicon-nav-menu'; }
    public function get_categories() { return ['next-extra', 'next-extra-my-account', 'shopengine-my_account', 'general']; } public function show_in_panel() { return true; }
    public function get_keywords() { return ['navigation', 'menu', 'account tabs', 'sidebar', 'next extra', 'shopengine', 'woocommerce']; }

    protected function register_controls() {
        $this->start_controls_section('section_style', [
            'label' => esc_html__('Navigation Style', 'next-extra'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);
        $this->add_control('nav_item_color', [
            'label'     => esc_html__('Item Color', 'next-extra'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#334155',
            'selectors' => ['{{WRAPPER}} .woocommerce-MyAccount-navigation-link a' => 'color: {{VALUE}}; padding: 10px 16px; display: block; border-radius: 6px; text-decoration: none; font-weight: 500; transition: all 0.2s;'],
        ]);
        $this->add_control('nav_item_active_bg', [
            'label'     => esc_html__('Active Item Background', 'next-extra'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#2563eb',
            'selectors' => [
                '{{WRAPPER}} .woocommerce-MyAccount-navigation-link.is-active a' => 'background-color: {{VALUE}} !important; color: #ffffff !important;',
                '{{WRAPPER}} .woocommerce-MyAccount-navigation-link a:hover' => 'background-color: #f1f5f9;',
            ],
        ]);
        $this->end_controls_section();
    }

    protected function render() {
        if (!function_exists('woocommerce_account_navigation')) {
            echo '<div class="next-extra-alert">' . esc_html__('WooCommerce is required.', 'next-extra') . '</div>';
            return;
        }
        ?>
        <div class="next-extra-account-widget next-extra-account-navigation-wrap">
            <?php woocommerce_account_navigation(); ?>
        </div>
        <?php
    }
}

/**
 * 9. Account Order - Details Widget
 */
class Next_Extra_Account_Order_Details extends Widget_Base {
    public function get_name() { return 'next-extra-account-order-details'; }
    public function get_title() { return esc_html__('Account Order - Details', 'next-extra'); }
    public function get_icon() { return 'eicon-product-info'; }
    public function get_categories() { return ['next-extra', 'next-extra-my-account', 'shopengine-my_account', 'general']; } public function show_in_panel() { return true; }
    public function get_keywords() { return ['order details', 'receipt', 'account', 'invoice', 'next extra', 'shopengine', 'woocommerce']; }

    protected function register_controls() {
        $this->start_controls_section('section_style', [
            'label' => esc_html__('Order Details Style', 'next-extra'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);
        $this->add_control('heading_color', [
            'label'     => esc_html__('Heading Color', 'next-extra'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#0f172a',
            'selectors' => ['{{WRAPPER}} h2' => 'color: {{VALUE}}; font-size: 20px; font-weight: 700;'],
        ]);
        $this->end_controls_section();
    }

    protected function render() {
        if (!function_exists('woocommerce_order_details_table')) {
            echo '<div class="next-extra-alert">' . esc_html__('WooCommerce is required.', 'next-extra') . '</div>';
            return;
        }
        global $wp;
        $order_id = isset($wp->query_vars['view-order']) ? intval($wp->query_vars['view-order']) : 0;
        ?>
        <div class="next-extra-account-widget next-extra-account-order-details-wrap">
            <div class="next-extra-account-content">
                <?php
                if ($order_id > 0) {
                    woocommerce_order_details_table($order_id);
                } else {
                    echo '<p>' . esc_html__('Select an order from your orders list to view its complete receipt and fulfillment details.', 'next-extra') . '</p>';
                }
                ?>
            </div>
        </div>
        <?php
    }
}

/**
 * 10. Account Orders Widget
 */
class Next_Extra_Account_Orders extends Widget_Base {
    public function get_name() { return 'next-extra-account-orders'; }
    public function get_title() { return esc_html__('Account Orders', 'next-extra'); }
    public function get_icon() { return 'eicon-cart'; }
    public function get_categories() { return ['next-extra', 'next-extra-my-account', 'shopengine-my_account', 'general']; } public function show_in_panel() { return true; }
    public function get_keywords() { return ['orders', 'purchase history', 'account', 'next extra', 'shopengine', 'woocommerce']; }

    protected function register_controls() {
        $this->start_controls_section('section_style', [
            'label' => esc_html__('Orders Table Style', 'next-extra'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);
        $this->add_control('header_bg', [
            'label'     => esc_html__('Header Background', 'next-extra'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#f8fafc',
            'selectors' => ['{{WRAPPER}} thead th' => 'background-color: {{VALUE}}; color: #0f172a; padding: 12px;'],
        ]);
        $this->end_controls_section();
    }

    protected function render() {
        if (!function_exists('woocommerce_account_orders')) {
            echo '<div class="next-extra-alert">' . esc_html__('WooCommerce is required.', 'next-extra') . '</div>';
            return;
        }
        $current_page = empty($current_page) ? 1 : absint($current_page);
        ?>
        <div class="next-extra-account-widget next-extra-account-orders-wrap">
            <div class="next-extra-account-content">
                <?php woocommerce_account_orders($current_page); ?>
            </div>
        </div>
        <?php
    }
}

/**
 * 11. Account Wishlist Widget
 */
class Next_Extra_Account_Wishlist extends Widget_Base {
    public function get_name() { return 'next-extra-account-wishlist'; }
    public function get_title() { return esc_html__('Account Wishlist', 'next-extra'); }
    public function get_icon() { return 'eicon-heart'; }
    public function get_categories() { return ['next-extra', 'next-extra-my-account', 'shopengine-my_account', 'general']; } public function show_in_panel() { return true; }
    public function get_keywords() { return ['wishlist', 'favorite', 'saved products', 'account', 'next extra', 'shopengine', 'woocommerce']; }

    protected function register_controls() {
        $this->start_controls_section('section_style', [
            'label' => esc_html__('Wishlist Style', 'next-extra'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);
        $this->add_control('title_color', [
            'label'     => esc_html__('Title Color', 'next-extra'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#0f172a',
            'selectors' => ['{{WRAPPER}} h3' => 'color: {{VALUE}};'],
        ]);
        $this->end_controls_section();
    }

    protected function render() {
        ?>
        <div class="next-extra-account-widget next-extra-account-wishlist-wrap">
            <div class="next-extra-account-content">
                <h3><?php esc_html_e('My Wishlist', 'next-extra'); ?></h3>
                <?php
                // Check if YITH Wishlist, TI Wishlist or ShopEngine wishlist exists
                if (shortcode_exists('yith_wcwl_wishlist')) {
                    echo do_shortcode('[yith_wcwl_wishlist]');
                } elseif (shortcode_exists('ti_wishlists')) {
                    echo do_shortcode('[ti_wishlists]');
                } else {
                    echo '<p class="next-extra-wishlist-msg">' . esc_html__('Your saved favorite items and collections will be displayed here.', 'next-extra') . '</p>';
                }
                ?>
            </div>
        </div>
        <?php
    }
}

/**
 * 12. Account Payment Methods Widget
 */
class Next_Extra_Account_Payment_Methods extends Widget_Base {
    public function get_name() { return 'next-extra-account-payment-methods'; }
    public function get_title() { return esc_html__('Account Payment Methods', 'next-extra'); }
    public function get_icon() { return 'eicon-credit-card'; }
    public function get_categories() { return ['next-extra', 'next-extra-my-account', 'shopengine-my_account', 'general']; } public function show_in_panel() { return true; }
    public function get_keywords() { return ['payment methods', 'cards', 'billing', 'account', 'next extra', 'shopengine', 'woocommerce']; }

    protected function register_controls() {
        $this->start_controls_section('section_style', [
            'label' => esc_html__('Payment Methods Style', 'next-extra'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);
        $this->add_control('card_bg', [
            'label'     => esc_html__('Card Background', 'next-extra'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#ffffff',
            'selectors' => ['{{WRAPPER}} .woocommerce-PaymentMethods' => 'background-color: {{VALUE}}; padding: 18px; border-radius: 8px; border: 1px solid #e2e8f0;'],
        ]);
        $this->end_controls_section();
    }

    protected function render() {
        if (!function_exists('woocommerce_account_payment_methods')) {
            echo '<div class="next-extra-alert">' . esc_html__('WooCommerce is required.', 'next-extra') . '</div>';
            return;
        }
        ?>
        <div class="next-extra-account-widget next-extra-account-payment-methods-wrap">
            <div class="next-extra-account-content">
                <?php woocommerce_account_payment_methods(); ?>
            </div>
        </div>
        <?php
    }
}
