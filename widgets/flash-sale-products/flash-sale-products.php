<?php
defined('ABSPATH') || exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;

class Next_Extra_Flash_Sale_Products extends Widget_Base {

    public function get_name() {
        return 'next-extra-flash-sale-products';
    }

    public function get_title() {
        return esc_html__('Flash Sale Products', 'next-extra');
    }

    public function get_icon() {
        return 'eicon-clock-o';
    }

    public function get_categories() {
        return ['next-extra', 'next-extra-general', 'shopengine-general', 'general'];
    }

    public function show_in_panel() {
        return true;
    }

    public function get_keywords() {
        return ['flash sale', 'sale', 'deal', 'discount', 'countdown', 'next extra', 'general', 'shopengine', 'woocommerce'];
    }

    protected function register_controls() {

        // ==========================================
        // CONTENT TAB: Campaign & Query
        // ==========================================
        $this->start_controls_section(
            'section_campaign_settings',
            [
                'label' => esc_html__('Campaign & Countdown', 'next-extra'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'campaign_title',
            [
                'label'       => esc_html__('Campaign Title', 'next-extra'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('⚡ Flash Deals - Limited Time Offer!', 'next-extra'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'show_countdown',
            [
                'label'        => esc_html__('Show Header Countdown Timer', 'next-extra'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'next-extra'),
                'label_off'    => esc_html__('No', 'next-extra'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'flash_end_date',
            [
                'label'       => esc_html__('Sale End Date/Time', 'next-extra'),
                'type'        => Controls_Manager::DATE_TIME,
                'default'     => date('Y-m-d H:i', strtotime('+3 days')),
                'condition'   => [
                    'show_countdown' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'flash_badge_text',
            [
                'label'   => esc_html__('Badge Text', 'next-extra'),
                'type'    => Controls_Manager::TEXT,
                'default' => esc_html__('FLASH SALE', 'next-extra'),
            ]
        );

        $this->end_controls_section();

        // ==========================================
        // CONTENT TAB: Product Query & Layout
        // ==========================================
        $this->start_controls_section(
            'section_layout_settings',
            [
                'label' => esc_html__('Layout & Products', 'next-extra'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'products_per_page',
            [
                'label'   => esc_html__('Number of Products', 'next-extra'),
                'type'    => Controls_Manager::NUMBER,
                'default' => 4,
                'min'     => 1,
                'max'     => 50,
            ]
        );

        $this->add_responsive_control(
            'columns',
            [
                'label'          => esc_html__('Columns', 'next-extra'),
                'type'           => Controls_Manager::SELECT,
                'default'        => '4',
                'tablet_default' => '2',
                'mobile_default' => '1',
                'options'        => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                ],
            ]
        );

        $this->add_responsive_control(
            'column_gap',
            [
                'label'   => esc_html__('Grid Gap (px)', 'next-extra'),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 20,
                ],
                'range'   => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 50,
                        'step' => 2,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .next-extra-flash-grid' => 'grid-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'show_rating',
            [
                'label'        => esc_html__('Show Ratings', 'next-extra'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'next-extra'),
                'label_off'    => esc_html__('No', 'next-extra'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'show_progress_bar',
            [
                'label'        => esc_html__('Show Stock Progress Bar', 'next-extra'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'next-extra'),
                'label_off'    => esc_html__('No', 'next-extra'),
                'return_value' => 'yes',
                'default'      => 'yes',
                'description'  => esc_html__('Display quantity sold vs available stock indicator for flash sales.', 'next-extra'),
            ]
        );

        $this->end_controls_section();

        // ==========================================
        // STYLE TAB: Campaign Header
        // ==========================================
        $this->start_controls_section(
            'section_style_header',
            [
                'label' => esc_html__('Campaign Header & Timer', 'next-extra'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'header_title_color',
            [
                'label'     => esc_html__('Title Color', 'next-extra'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#0f172a',
                'selectors' => [
                    '{{WRAPPER}} .next-extra-flash-header h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'header_title_typography',
                'label'    => esc_html__('Title Typography', 'next-extra'),
                'selector' => '{{WRAPPER}} .next-extra-flash-header h3',
            ]
        );

        $this->add_control(
            'timer_bg_color',
            [
                'label'     => esc_html__('Timer Item Background', 'next-extra'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#e11d48',
                'selectors' => [
                    '{{WRAPPER}} .next-extra-flash-timer .timer-box' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'timer_digit_color',
            [
                'label'     => esc_html__('Timer Digits Color', 'next-extra'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .next-extra-flash-timer .timer-box' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // ==========================================
        // STYLE TAB: Product Card
        // ==========================================
        $this->start_controls_section(
            'section_style_card',
            [
                'label' => esc_html__('Product Card', 'next-extra'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'card_bg',
                'label'    => esc_html__('Background', 'next-extra'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .next-extra-flash-card',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'card_border',
                'label'    => esc_html__('Border', 'next-extra'),
                'selector' => '{{WRAPPER}} .next-extra-flash-card',
            ]
        );

        $this->add_responsive_control(
            'card_radius',
            [
                'label'      => esc_html__('Border Radius', 'next-extra'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .next-extra-flash-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'card_shadow',
                'label'    => esc_html__('Box Shadow', 'next-extra'),
                'selector' => '{{WRAPPER}} .next-extra-flash-card',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        if (!function_exists('wc_get_products')) {
            echo '<div class="next-extra-alert">' . esc_html__('WooCommerce is required.', 'next-extra') . '</div>';
            return;
        }

        $settings = $this->get_settings_for_display();

        // Query sale products or general products
        $on_sale_ids = wc_get_product_ids_on_sale();
        $query_args  = [
            'status'  => 'publish',
            'limit'   => !empty($settings['products_per_page']) ? intval($settings['products_per_page']) : 4,
            'orderby' => 'date',
            'order'   => 'DESC',
        ];

        if (!empty($on_sale_ids)) {
            $query_args['include'] = $on_sale_ids;
        }

        $products = wc_get_products($query_args);

        if (empty($products)) {
            // fallback to recent products if no sale products exist yet
            unset($query_args['include']);
            $products = wc_get_products($query_args);
        }

        $cols_desktop = !empty($settings['columns']) ? $settings['columns'] : '4';
        $cols_tablet  = !empty($settings['columns_tablet']) ? $settings['columns_tablet'] : '2';
        $cols_mobile  = !empty($settings['columns_mobile']) ? $settings['columns_mobile'] : '1';
        $grid_classes = "next-extra-flash-grid cols-d-{$cols_desktop} cols-t-{$cols_tablet} cols-m-{$cols_mobile}";
        ?>
        <div class="next-extra-widget-flash-sale">
            
            <?php if (!empty($settings['campaign_title']) || ($settings['show_countdown'] === 'yes')) : ?>
                <div class="next-extra-flash-header">
                    <?php if (!empty($settings['campaign_title'])) : ?>
                        <h3 class="next-extra-flash-title"><?php echo esc_html($settings['campaign_title']); ?></h3>
                    <?php endif; ?>

                    <?php if ($settings['show_countdown'] === 'yes' && !empty($settings['flash_end_date'])) : ?>
                        <div class="next-extra-flash-timer next-extra-coupon-timer" data-endtime="<?php echo esc_attr($settings['flash_end_date']); ?>">
                            <div class="timer-box"><span class="days">00</span><small>D</small></div>
                            <span class="timer-sep">:</span>
                            <div class="timer-box"><span class="hours">00</span><small>H</small></div>
                            <span class="timer-sep">:</span>
                            <div class="timer-box"><span class="minutes">00</span><small>M</small></div>
                            <span class="timer-sep">:</span>
                            <div class="timer-box"><span class="seconds">00</span><small>S</small></div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="<?php echo esc_attr($grid_classes); ?>">
                <?php foreach ($products as $product) : 
                    $pid        = $product->get_id();
                    $title      = $product->get_name();
                    $permalink  = $product->get_permalink();
                    $image_html = $product->get_image('woocommerce_thumbnail');
                    $rating     = $product->get_average_rating();
                    $rating_cnt = $product->get_rating_count();
                    $total_sales = (int) get_post_meta($pid, 'total_sales', true);
                    $stock_qty   = $product->get_stock_quantity();
                    $stock_total = $stock_qty ? ($total_sales + $stock_qty) : max(10, $total_sales + 10);
                    $percentage  = $stock_total > 0 ? min(100, round(($total_sales / $stock_total) * 100)) : 45;
                    if ($percentage <= 0) $percentage = 35; // Default aesthetic fill
                    ?>
                    <div class="next-extra-flash-card">
                        <div class="next-extra-thumb-wrapper">
                            <a href="<?php echo esc_url($permalink); ?>" class="next-extra-thumb-link">
                                <?php echo wp_kses_post($image_html); ?>
                            </a>
                            <?php if (!empty($settings['flash_badge_text'])) : ?>
                                <span class="next-extra-badge sale"><?php echo esc_html($settings['flash_badge_text']); ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="next-extra-card-body">
                            <h4 class="next-extra-product-title">
                                <a href="<?php echo esc_url($permalink); ?>"><?php echo esc_html($title); ?></a>
                            </h4>

                            <?php if ($settings['show_rating'] === 'yes' && $rating > 0) : ?>
                                <div class="next-extra-rating">
                                    <?php echo wc_get_rating_html($rating, $rating_cnt); ?>
                                </div>
                            <?php endif; ?>

                            <div class="next-extra-product-price">
                                <?php echo wp_kses_post($product->get_price_html()); ?>
                            </div>

                            <?php if ($settings['show_progress_bar'] === 'yes') : ?>
                                <div class="next-extra-stock-progress">
                                    <div class="progress-bar-wrap">
                                        <div class="progress-bar-fill" style="width: <?php echo esc_attr($percentage); ?>%;"></div>
                                    </div>
                                    <div class="progress-labels">
                                        <span><?php printf(esc_html__('Sold: %d', 'next-extra'), max(1, $total_sales)); ?></span>
                                        <span><?php printf(esc_html__('%d%% Claimed', 'next-extra'), $percentage); ?></span>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="next-extra-add-to-cart">
                                <?php woocommerce_template_loop_add_to_cart(); ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
        <?php
    }
}
