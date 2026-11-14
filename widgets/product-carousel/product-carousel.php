<?php
defined('ABSPATH') || exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;

class Next_Extra_Product_Carousel extends Widget_Base {

    public function get_name() {
        return 'next-extra-product-carousel';
    }

    public function get_title() {
        return esc_html__('Product Carousel', 'next-extra');
    }

    public function get_icon() {
        return 'eicon-slides';
    }

    public function get_categories() {
        return ['next-extra', 'next-extra-general', 'shopengine-general', 'general'];
    }

    public function show_in_panel() {
        return true;
    }

    public function get_keywords() {
        return ['carousel', 'slider', 'products', 'product carousel', 'next extra', 'general', 'shopengine', 'woocommerce'];
    }

    public function get_script_depends() {
        return ['swiper', 'elementor-frontend', 'next-extra-frontend'];
    }

    public function get_style_depends() {
        return ['swiper', 'next-extra-frontend'];
    }

    protected function register_controls() {

        // ==========================================
        // CONTENT TAB: Query Settings
        // ==========================================
        $this->start_controls_section(
            'section_query_settings',
            [
                'label' => esc_html__('Product Query', 'next-extra'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'product_source',
            [
                'label'   => esc_html__('Filter By', 'next-extra'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'recent',
                'options' => [
                    'recent'       => esc_html__('Recent Products', 'next-extra'),
                    'featured'     => esc_html__('Featured Products', 'next-extra'),
                    'sale'         => esc_html__('On Sale Products', 'next-extra'),
                    'best_selling' => esc_html__('Best Selling Products', 'next-extra'),
                    'top_rated'    => esc_html__('Top Rated Products', 'next-extra'),
                ],
            ]
        );

        $this->add_control(
            'products_per_page',
            [
                'label'   => esc_html__('Products Limit', 'next-extra'),
                'type'    => Controls_Manager::NUMBER,
                'default' => 8,
                'min'     => 1,
                'max'     => 50,
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label'   => esc_html__('Order By', 'next-extra'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'date'          => esc_html__('Date', 'next-extra'),
                    'title'         => esc_html__('Title', 'next-extra'),
                    'price'         => esc_html__('Price', 'next-extra'),
                    'rand'          => esc_html__('Random', 'next-extra'),
                    'comment_count' => esc_html__('Review Count', 'next-extra'),
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label'   => esc_html__('Order', 'next-extra'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'ASC'  => esc_html__('ASC', 'next-extra'),
                    'DESC' => esc_html__('DESC', 'next-extra'),
                ],
            ]
        );

        $this->end_controls_section();

        // ==========================================
        // CONTENT TAB: Carousel Settings
        // ==========================================
        $this->start_controls_section(
            'section_carousel_settings',
            [
                'label' => esc_html__('Carousel Options', 'next-extra'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'slides_to_show',
            [
                'label'          => esc_html__('Columns / Slides to Show', 'next-extra'),
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
                    '6' => '6',
                ],
            ]
        );

        $this->add_responsive_control(
            'slide_gap',
            [
                'label'   => esc_html__('Space Between Items (px)', 'next-extra'),
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
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label'        => esc_html__('Autoplay', 'next-extra'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'next-extra'),
                'label_off'    => esc_html__('No', 'next-extra'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label'     => esc_html__('Autoplay Delay (ms)', 'next-extra'),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 3500,
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'loop',
            [
                'label'        => esc_html__('Infinite Loop', 'next-extra'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'next-extra'),
                'label_off'    => esc_html__('No', 'next-extra'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'show_arrows',
            [
                'label'        => esc_html__('Navigation Arrows', 'next-extra'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'next-extra'),
                'label_off'    => esc_html__('No', 'next-extra'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'show_dots',
            [
                'label'        => esc_html__('Pagination Dots', 'next-extra'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'next-extra'),
                'label_off'    => esc_html__('No', 'next-extra'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->end_controls_section();

        // ==========================================
        // CONTENT TAB: Elements Visibility
        // ==========================================
        $this->start_controls_section(
            'section_visibility_settings',
            [
                'label' => esc_html__('Card Elements Visibility', 'next-extra'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_badge',
            [
                'label'        => esc_html__('Sale / Featured Badge', 'next-extra'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'next-extra'),
                'label_off'    => esc_html__('No', 'next-extra'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'show_category',
            [
                'label'        => esc_html__('Category', 'next-extra'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'next-extra'),
                'label_off'    => esc_html__('No', 'next-extra'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'show_rating',
            [
                'label'        => esc_html__('Star Rating', 'next-extra'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'next-extra'),
                'label_off'    => esc_html__('No', 'next-extra'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'show_price',
            [
                'label'        => esc_html__('Price', 'next-extra'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'next-extra'),
                'label_off'    => esc_html__('No', 'next-extra'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'show_add_to_cart',
            [
                'label'        => esc_html__('Add to Cart Button', 'next-extra'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'next-extra'),
                'label_off'    => esc_html__('No', 'next-extra'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->end_controls_section();

        // ==========================================
        // STYLE TAB: Product Card
        // ==========================================
        $this->start_controls_section(
            'section_style_product_card',
            [
                'label' => esc_html__('Product Card', 'next-extra'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'card_bg',
                'label'    => esc_html__('Card Background', 'next-extra'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .next-extra-product-card',
            ]
        );

        $this->add_responsive_control(
            'card_padding',
            [
                'label'      => esc_html__('Padding', 'next-extra'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'default'    => [
                    'top'    => '16',
                    'right'  => '16',
                    'bottom' => '16',
                    'left'   => '16',
                    'unit'   => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .next-extra-product-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'card_border',
                'label'    => esc_html__('Border', 'next-extra'),
                'selector' => '{{WRAPPER}} .next-extra-product-card',
            ]
        );

        $this->add_responsive_control(
            'card_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'next-extra'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .next-extra-product-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'card_box_shadow',
                'label'    => esc_html__('Box Shadow', 'next-extra'),
                'selector' => '{{WRAPPER}} .next-extra-product-card',
            ]
        );

        $this->end_controls_section();

        // ==========================================
        // STYLE TAB: Title & Typography
        // ==========================================
        $this->start_controls_section(
            'section_style_typography',
            [
                'label' => esc_html__('Title & Typography', 'next-extra'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'product_title_color',
            [
                'label'     => esc_html__('Title Color', 'next-extra'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#1f2937',
                'selectors' => [
                    '{{WRAPPER}} .next-extra-product-title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'product_title_hover_color',
            [
                'label'     => esc_html__('Title Hover Color', 'next-extra'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#2563eb',
                'selectors' => [
                    '{{WRAPPER}} .next-extra-product-title a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'product_title_typography',
                'label'    => esc_html__('Title Typography', 'next-extra'),
                'selector' => '{{WRAPPER}} .next-extra-product-title',
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label'     => esc_html__('Price Color', 'next-extra'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#0f172a',
                'selectors' => [
                    '{{WRAPPER}} .next-extra-product-price' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // ==========================================
        // STYLE TAB: Add to Cart Button
        // ==========================================
        $this->start_controls_section(
            'section_style_button',
            [
                'label' => esc_html__('Add to Cart Button', 'next-extra'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'btn_bg_color',
            [
                'label'     => esc_html__('Background', 'next-extra'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#2563eb',
                'selectors' => [
                    '{{WRAPPER}} .next-extra-add-to-cart .button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_text_color',
            [
                'label'     => esc_html__('Text Color', 'next-extra'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .next-extra-add-to-cart .button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_hover_bg',
            [
                'label'     => esc_html__('Hover Background', 'next-extra'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#1d4ed8',
                'selectors' => [
                    '{{WRAPPER}} .next-extra-add-to-cart .button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // ==========================================
        // STYLE TAB: Carousel Arrows & Dots
        // ==========================================
        $this->start_controls_section(
            'section_style_nav',
            [
                'label' => esc_html__('Navigation & Dots', 'next-extra'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'arrow_bg_color',
            [
                'label'     => esc_html__('Arrow Background', 'next-extra'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .next-extra-nav-arrow' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_color',
            [
                'label'     => esc_html__('Arrow Icon Color', 'next-extra'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#1f2937',
                'selectors' => [
                    '{{WRAPPER}} .next-extra-nav-arrow' => 'color: {{VALUE}}; fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'dot_active_color',
            [
                'label'     => esc_html__('Active Dot Color', 'next-extra'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#2563eb',
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet-active' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        if (!function_exists('wc_get_products')) {
            echo '<div class="next-extra-alert">' . esc_html__('WooCommerce is required to display products.', 'next-extra') . '</div>';
            return;
        }

        $settings = $this->get_settings_for_display();

        // Query args
        $query_args = [
            'status' => 'publish',
            'limit'  => !empty($settings['products_per_page']) ? intval($settings['products_per_page']) : 8,
            'order'  => !empty($settings['order']) ? $settings['order'] : 'DESC',
        ];

        // Ordering
        switch ($settings['order_by']) {
            case 'title':
                $query_args['orderby'] = 'title';
                break;
            case 'price':
                $query_args['orderby'] = 'meta_value_num';
                $query_args['meta_key'] = '_price';
                break;
            case 'rand':
                $query_args['orderby'] = 'rand';
                break;
            case 'comment_count':
                $query_args['orderby'] = 'comment_count';
                break;
            default:
                $query_args['orderby'] = 'date';
                break;
        }

        // Product source
        switch ($settings['product_source']) {
            case 'featured':
                $query_args['featured'] = true;
                break;
            case 'sale':
                $query_args['include'] = wc_get_product_ids_on_sale();
                break;
            case 'best_selling':
                $query_args['meta_key'] = 'total_sales';
                $query_args['orderby']  = 'meta_value_num';
                break;
            case 'top_rated':
                $query_args['meta_key'] = '_wc_average_rating';
                $query_args['orderby']  = 'meta_value_num';
                break;
        }

        $products = wc_get_products($query_args);

        if (empty($products)) {
            echo '<div class="next-extra-empty-msg">' . esc_html__('No products found matching your criteria.', 'next-extra') . '</div>';
            return;
        }

        // Slider config json
        $slider_config = [
            'slidesPerView'  => !empty($settings['slides_to_show']) ? intval($settings['slides_to_show']) : 4,
            'spaceBetween'   => !empty($settings['slide_gap']['size']) ? intval($settings['slide_gap']['size']) : 20,
            'loop'           => $settings['loop'] === 'yes',
            'autoplay'       => $settings['autoplay'] === 'yes' ? ['delay' => intval($settings['autoplay_speed']), 'disableOnInteraction' => false] : false,
            'breakpoints'    => [
                320 => [
                    'slidesPerView' => !empty($settings['slides_to_show_mobile']) ? intval($settings['slides_to_show_mobile']) : 1,
                    'spaceBetween'  => 10,
                ],
                768 => [
                    'slidesPerView' => !empty($settings['slides_to_show_tablet']) ? intval($settings['slides_to_show_tablet']) : 2,
                    'spaceBetween'  => 15,
                ],
                1024 => [
                    'slidesPerView' => !empty($settings['slides_to_show']) ? intval($settings['slides_to_show']) : 4,
                    'spaceBetween'  => !empty($settings['slide_gap']['size']) ? intval($settings['slide_gap']['size']) : 20,
                ],
            ],
        ];

        $unique_id = 'next-extra-carousel-' . $this->get_id();
        ?>
        <div class="next-extra-widget-product-carousel" id="<?php echo esc_attr($unique_id); ?>">
            <div class="swiper next-extra-swiper" data-swiper-config="<?php echo esc_attr(wp_json_encode($slider_config)); ?>">
                <div class="swiper-wrapper">
                    <?php foreach ($products as $product) : 
                        $pid         = $product->get_id();
                        $title       = $product->get_name();
                        $permalink   = $product->get_permalink();
                        $image_html  = $product->get_image('woocommerce_thumbnail');
                        $is_on_sale  = $product->is_on_sale();
                        $is_featured = $product->is_featured();
                        $rating      = $product->get_average_rating();
                        $rating_cnt  = $product->get_rating_count();
                        ?>
                        <div class="swiper-slide">
                            <div class="next-extra-product-card">
                                
                                <div class="next-extra-thumb-wrapper">
                                    <a href="<?php echo esc_url($permalink); ?>" class="next-extra-thumb-link">
                                        <?php echo wp_kses_post($image_html); ?>
                                    </a>

                                    <?php if ($settings['show_badge'] === 'yes') : ?>
                                        <div class="next-extra-badges">
                                            <?php if ($is_on_sale) : ?>
                                                <span class="next-extra-badge sale"><?php esc_html_e('Sale!', 'next-extra'); ?></span>
                                            <?php elseif ($is_featured) : ?>
                                                <span class="next-extra-badge featured"><?php esc_html_e('Hot', 'next-extra'); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="next-extra-card-body">
                                    <?php if ($settings['show_category'] === 'yes') : 
                                        $cats = wc_get_product_category_list($pid, ', ');
                                        if ($cats) : ?>
                                            <div class="next-extra-product-cats"><?php echo wp_kses_post($cats); ?></div>
                                        <?php endif; 
                                    endif; ?>

                                    <h4 class="next-extra-product-title">
                                        <a href="<?php echo esc_url($permalink); ?>"><?php echo esc_html($title); ?></a>
                                    </h4>

                                    <?php if ($settings['show_rating'] === 'yes' && $rating > 0) : ?>
                                        <div class="next-extra-rating">
                                            <?php echo wc_get_rating_html($rating, $rating_cnt); ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($settings['show_price'] === 'yes') : ?>
                                        <div class="next-extra-product-price">
                                            <?php echo wp_kses_post($product->get_price_html()); ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($settings['show_add_to_cart'] === 'yes') : ?>
                                        <div class="next-extra-add-to-cart">
                                            <?php woocommerce_template_loop_add_to_cart(); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php if ($settings['show_arrows'] === 'yes') : ?>
                    <div class="next-extra-nav-arrow next-extra-swiper-prev" aria-label="<?php esc_attr_e('Previous', 'next-extra'); ?>">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg>
                    </div>
                    <div class="next-extra-nav-arrow next-extra-swiper-next" aria-label="<?php esc_attr_e('Next', 'next-extra'); ?>">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
                    </div>
                <?php endif; ?>

                <?php if ($settings['show_dots'] === 'yes') : ?>
                    <div class="swiper-pagination next-extra-swiper-dots"></div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }
}
