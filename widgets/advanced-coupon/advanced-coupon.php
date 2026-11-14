<?php
defined('ABSPATH') || exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;

class Next_Extra_Advanced_Coupon extends Widget_Base {

    public function get_name() {
        return 'next-extra-advanced-coupon';
    }

    public function get_title() {
        return esc_html__('Advanced Coupon', 'next-extra');
    }

    public function get_icon() {
        return 'eicon-tags';
    }

    public function get_categories() {
        return ['next-extra', 'next-extra-general', 'shopengine-general', 'general'];
    }

    public function show_in_panel() {
        return true;
    }

    public function get_keywords() {
        return ['coupon', 'advanced coupon', 'discount', 'voucher', 'next extra', 'general', 'shopengine', 'woocommerce'];
    }

    protected function register_controls() {

        // ==========================================
        // CONTENT TAB: Coupon Details
        // ==========================================
        $this->start_controls_section(
            'section_coupon_content',
            [
                'label' => esc_html__('Coupon Details', 'next-extra'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'coupon_layout',
            [
                'label'   => esc_html__('Layout', 'next-extra'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'layout-1',
                'options' => [
                    'layout-1' => esc_html__('Standard Voucher (Card)', 'next-extra'),
                    'layout-2' => esc_html__('Ticket / Perforated', 'next-extra'),
                    'layout-3' => esc_html__('Banner / Strip', 'next-extra'),
                ],
            ]
        );

        $this->add_control(
            'coupon_title',
            [
                'label'       => esc_html__('Title', 'next-extra'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Special Discount!', 'next-extra'),
                'placeholder' => esc_html__('Enter title', 'next-extra'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'coupon_discount_text',
            [
                'label'       => esc_html__('Discount Badge / Value', 'next-extra'),
                'type'        => Controls_Manager::TEXT,
                'default'     => '30% OFF',
                'placeholder' => esc_html__('e.g. 20% OFF or $15 OFF', 'next-extra'),
            ]
        );

        $this->add_control(
            'coupon_description',
            [
                'label'       => esc_html__('Description', 'next-extra'),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => esc_html__('Use this coupon code on checkout to claim an exclusive limited-time discount on your entire order.', 'next-extra'),
                'rows'        => 3,
            ]
        );

        $this->add_control(
            'coupon_code',
            [
                'label'       => esc_html__('Coupon Code', 'next-extra'),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'NEXTDEV30',
                'placeholder' => esc_html__('Enter coupon code', 'next-extra'),
            ]
        );

        $this->add_control(
            'show_copy_button',
            [
                'label'        => esc_html__('Show Copy Button', 'next-extra'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'next-extra'),
                'label_off'    => esc_html__('No', 'next-extra'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'copy_button_text',
            [
                'label'     => esc_html__('Button Text', 'next-extra'),
                'type'      => Controls_Manager::TEXT,
                'default'   => esc_html__('Copy Code', 'next-extra'),
                'condition' => [
                    'show_copy_button' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'enable_direct_apply',
            [
                'label'        => esc_html__('Apply Directly to Cart on Click', 'next-extra'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'next-extra'),
                'label_off'    => esc_html__('No', 'next-extra'),
                'return_value' => 'yes',
                'default'      => 'yes',
                'description'  => esc_html__('Automatically submits coupon via AJAX to WooCommerce cart when copied.', 'next-extra'),
            ]
        );

        $this->end_controls_section();

        // ==========================================
        // CONTENT TAB: Countdown & Urgency
        // ==========================================
        $this->start_controls_section(
            'section_countdown_settings',
            [
                'label' => esc_html__('Countdown & Urgency', 'next-extra'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'enable_countdown',
            [
                'label'        => esc_html__('Enable Countdown Timer', 'next-extra'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'next-extra'),
                'label_off'    => esc_html__('No', 'next-extra'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'countdown_end_date',
            [
                'label'       => esc_html__('End Date / Expiration', 'next-extra'),
                'type'        => Controls_Manager::DATE_TIME,
                'default'     => date('Y-m-d H:i', strtotime('+7 days')),
                'description' => esc_html__('Date and time when the coupon expires.', 'next-extra'),
                'condition'   => [
                    'enable_countdown' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'countdown_labels',
            [
                'label'        => esc_html__('Show Time Labels', 'next-extra'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'next-extra'),
                'label_off'    => esc_html__('No', 'next-extra'),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'    => [
                    'enable_countdown' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        // ==========================================
        // CONTENT TAB: Regional & Extra Restrictions
        // ==========================================
        $this->start_controls_section(
            'section_restrictions',
            [
                'label' => esc_html__('Regional Restrictions & Info', 'next-extra'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_region_notice',
            [
                'label'        => esc_html__('Show Location/Condition Notice', 'next-extra'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'next-extra'),
                'label_off'    => esc_html__('No', 'next-extra'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'region_notice_text',
            [
                'label'       => esc_html__('Restriction Note', 'next-extra'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('* Valid for selected states & regions only.', 'next-extra'),
                'label_block' => true,
                'condition'   => [
                    'show_region_notice' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        // ==========================================
        // STYLE TAB: Card Container
        // ==========================================
        $this->start_controls_section(
            'section_style_container',
            [
                'label' => esc_html__('Coupon Container', 'next-extra'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'container_bg',
                'label'    => esc_html__('Background', 'next-extra'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .next-extra-coupon-card',
            ]
        );

        $this->add_responsive_control(
            'container_padding',
            [
                'label'      => esc_html__('Padding', 'next-extra'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .next-extra-coupon-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'container_border',
                'label'    => esc_html__('Border', 'next-extra'),
                'selector' => '{{WRAPPER}} .next-extra-coupon-card',
            ]
        );

        $this->add_responsive_control(
            'container_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'next-extra'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .next-extra-coupon-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'container_box_shadow',
                'label'    => esc_html__('Box Shadow', 'next-extra'),
                'selector' => '{{WRAPPER}} .next-extra-coupon-card',
            ]
        );

        $this->end_controls_section();

        // ==========================================
        // STYLE TAB: Title & Badge
        // ==========================================
        $this->start_controls_section(
            'section_style_header',
            [
                'label' => esc_html__('Title & Discount Badge', 'next-extra'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Title Color', 'next-extra'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#1f2937',
                'selectors' => [
                    '{{WRAPPER}} .next-extra-coupon-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'label'    => esc_html__('Title Typography', 'next-extra'),
                'selector' => '{{WRAPPER}} .next-extra-coupon-title',
            ]
        );

        $this->add_control(
            'badge_heading',
            [
                'label'     => esc_html__('Discount Badge', 'next-extra'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'badge_color',
            [
                'label'     => esc_html__('Badge Text Color', 'next-extra'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .next-extra-coupon-badge' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'badge_bg_color',
            [
                'label'     => esc_html__('Badge Background', 'next-extra'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#e11d48',
                'selectors' => [
                    '{{WRAPPER}} .next-extra-coupon-badge' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'badge_typography',
                'label'    => esc_html__('Badge Typography', 'next-extra'),
                'selector' => '{{WRAPPER}} .next-extra-coupon-badge',
            ]
        );

        $this->end_controls_section();

        // ==========================================
        // STYLE TAB: Coupon Code & Copy Button
        // ==========================================
        $this->start_controls_section(
            'section_style_code_box',
            [
                'label' => esc_html__('Coupon Code & Button', 'next-extra'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'code_color',
            [
                'label'     => esc_html__('Code Text Color', 'next-extra'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#0f172a',
                'selectors' => [
                    '{{WRAPPER}} .next-extra-code-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'code_bg_color',
            [
                'label'     => esc_html__('Code Box Background', 'next-extra'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#f1f5f9',
                'selectors' => [
                    '{{WRAPPER}} .next-extra-coupon-code-box' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label'     => esc_html__('Button Background', 'next-extra'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#2563eb',
                'selectors' => [
                    '{{WRAPPER}} .next-extra-copy-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label'     => esc_html__('Button Text Color', 'next-extra'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .next-extra-copy-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg',
            [
                'label'     => esc_html__('Button Hover Background', 'next-extra'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#1d4ed8',
                'selectors' => [
                    '{{WRAPPER}} .next-extra-copy-btn:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // ==========================================
        // STYLE TAB: Countdown Timer
        // ==========================================
        $this->start_controls_section(
            'section_style_countdown',
            [
                'label'     => esc_html__('Countdown Timer', 'next-extra'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_countdown' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'timer_item_bg',
            [
                'label'     => esc_html__('Timer Block Background', 'next-extra'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#f8fafc',
                'selectors' => [
                    '{{WRAPPER}} .next-extra-timer-item' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'timer_digits_color',
            [
                'label'     => esc_html__('Digits Color', 'next-extra'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#0f172a',
                'selectors' => [
                    '{{WRAPPER}} .next-extra-timer-number' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'timer_label_color',
            [
                'label'     => esc_html__('Labels Color', 'next-extra'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#64748b',
                'selectors' => [
                    '{{WRAPPER}} .next-extra-timer-label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $coupon_code         = !empty($settings['coupon_code']) ? esc_attr($settings['coupon_code']) : '';
        $layout_class        = 'next-extra-layout-' . esc_attr($settings['coupon_layout']);
        $enable_countdown    = !empty($settings['enable_countdown']) && $settings['enable_countdown'] === 'yes';
        $countdown_date      = !empty($settings['countdown_end_date']) ? esc_attr($settings['countdown_end_date']) : '';
        $direct_apply        = !empty($settings['enable_direct_apply']) && $settings['enable_direct_apply'] === 'yes' ? 'yes' : 'no';

        ?>
        <div class="next-extra-widget-advanced-coupon <?php echo esc_attr($layout_class); ?>">
            <div class="next-extra-coupon-card" data-coupon="<?php echo esc_attr($coupon_code); ?>" data-auto-apply="<?php echo esc_attr($direct_apply); ?>">
                
                <div class="next-extra-coupon-header">
                    <?php if (!empty($settings['coupon_discount_text'])) : ?>
                        <span class="next-extra-coupon-badge"><?php echo esc_html($settings['coupon_discount_text']); ?></span>
                    <?php endif; ?>

                    <?php if (!empty($settings['coupon_title'])) : ?>
                        <h4 class="next-extra-coupon-title"><?php echo esc_html($settings['coupon_title']); ?></h4>
                    <?php endif; ?>
                </div>

                <?php if (!empty($settings['coupon_description'])) : ?>
                    <p class="next-extra-coupon-desc"><?php echo esc_html($settings['coupon_description']); ?></p>
                <?php endif; ?>

                <?php if ($enable_countdown && !empty($countdown_date)) : ?>
                    <div class="next-extra-coupon-timer" data-endtime="<?php echo esc_attr($countdown_date); ?>">
                        <div class="next-extra-timer-item">
                            <span class="next-extra-timer-number days">00</span>
                            <?php if ($settings['countdown_labels'] === 'yes') : ?><span class="next-extra-timer-label"><?php esc_html_e('Days', 'next-extra'); ?></span><?php endif; ?>
                        </div>
                        <span class="next-extra-timer-separator">:</span>
                        <div class="next-extra-timer-item">
                            <span class="next-extra-timer-number hours">00</span>
                            <?php if ($settings['countdown_labels'] === 'yes') : ?><span class="next-extra-timer-label"><?php esc_html_e('Hours', 'next-extra'); ?></span><?php endif; ?>
                        </div>
                        <span class="next-extra-timer-separator">:</span>
                        <div class="next-extra-timer-item">
                            <span class="next-extra-timer-number minutes">00</span>
                            <?php if ($settings['countdown_labels'] === 'yes') : ?><span class="next-extra-timer-label"><?php esc_html_e('Mins', 'next-extra'); ?></span><?php endif; ?>
                        </div>
                        <span class="next-extra-timer-separator">:</span>
                        <div class="next-extra-timer-item">
                            <span class="next-extra-timer-number seconds">00</span>
                            <?php if ($settings['countdown_labels'] === 'yes') : ?><span class="next-extra-timer-label"><?php esc_html_e('Secs', 'next-extra'); ?></span><?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="next-extra-coupon-code-box">
                    <span class="next-extra-code-text"><?php echo esc_html($coupon_code); ?></span>
                    <?php if (!empty($settings['show_copy_button']) && $settings['show_copy_button'] === 'yes') : ?>
                        <button type="button" class="next-extra-copy-btn" data-code="<?php echo esc_attr($coupon_code); ?>">
                            <span class="btn-text"><?php echo esc_html($settings['copy_button_text']); ?></span>
                        </button>
                    <?php endif; ?>
                </div>

                <div class="next-extra-coupon-feedback" style="display:none;"></div>

                <?php if (!empty($settings['show_region_notice']) && $settings['show_region_notice'] === 'yes' && !empty($settings['region_notice_text'])) : ?>
                    <div class="next-extra-coupon-restrictions">
                        <span><?php echo esc_html($settings['region_notice_text']); ?></span>
                    </div>
                <?php endif; ?>

            </div>
        </div>
        <?php
    }
}
