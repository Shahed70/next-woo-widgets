<?php
defined('ABSPATH') || exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;

class Next_Extra_Best_Selling_Product extends Widget_Base {

    public function get_name() {
        return 'next-extra-best-selling-product';
    }

    public function get_title() {
        return esc_html__('Best Selling Product', 'next-extra');
    }

    public function get_icon() {
        return 'eicon-star-o';
    }

    public function get_categories() {
        return ['next-extra-general'];
    }

    public function get_keywords() {
        return ['best selling', 'top selling', 'popular', 'products', 'next extra', 'general', 'shopengine', 'woocommerce'];
    }

    protected function register_controls() {

        // ==========================================
        // CONTENT TAB: Query & Layout
        // ==========================================
        $this->start_controls_section(
            'section_query_settings',
            [
                'label' => esc_html__('Products & Layout', 'next-extra'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'layout_style',
            [
                'label'   => esc_html__('Layout View', 'next-extra'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => [
                    'grid' => esc_html__('Grid', 'next-extra'),
                    'list' => esc_html__('Compact List', 'next-extra'),
                ],
            ]
        );

        $this->add_control(
            'products_per_page',
            [
                'label'   => esc_html__('Number of Products', 'next-extra'),
                'type'    => Controls_Manager::NUMBER,
                'default' => 4,
                'min'     => 1,
                'max'     => 30,
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
                'condition'      => [
                    'layout_style' => 'grid',
                ],
            ]
        );

        $this->add_control(
            'show_sales_count',
            [
                'label'        => esc_html__('Show Units Sold Count', 'next-extra'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'next-extra'),
                'label_off'    => esc_html__('No', 'next-extra'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'show_best_seller_badge',
            [
                'label'        => esc_html__('Show Best Seller Ribbon/Badge', 'next-extra'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'next-extra'),
                'label_off'    => esc_html__('No', 'next-extra'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'badge_text',
            [
                'label'     => esc_html__('Badge Text', 'next-extra'),
                'type'      => Controls_Manager::TEXT,
                'default'   => esc_html__('BEST SELLER', 'next-extra'),
                'condition' => [
                    'show_best_seller_badge' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        // ==========================================
        // STYLE TAB: Card Container
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
                'selector' => '{{WRAPPER}} .next-extra-bestseller-card',
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
                    '{{WRAPPER}} .next-extra-bestseller-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'card_border',
                'label'    => esc_html__('Border', 'next-extra'),
                'selector' => '{{WRAPPER}} .next-extra-bestseller-card',
            ]
        );

        $this->add_responsive_control(
            'card_radius',
            [
                'label'      => esc_html__('Border Radius', 'next-extra'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .next-extra-bestseller-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'card_shadow',
                'label'    => esc_html__('Box Shadow', 'next-extra'),
                'selector' => '{{WRAPPER}} .next-extra-bestseller-card',
            ]
        );

        $this->end_controls_section();

        // ==========================================
        // STYLE TAB: Badge & Button
        // ==========================================
        $this->start_controls_section(
            'section_style_elements',
            [
                'label' => esc_html__('Badge & Button', 'next-extra'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'badge_bg_color',
            [
                'label'     => esc_html__('Badge Background', 'next-extra'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#f59e0b',
                'selectors' => [
                    '{{WRAPPER}} .next-extra-badge.bestseller' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_bg_color',
            [
                'label'     => esc_html__('Button Background', 'next-extra'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#2563eb',
                'selectors' => [
                    '{{WRAPPER}} .next-extra-add-to-cart .button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_hover_bg',
            [
                'label'     => esc_html__('Button Hover Background', 'next-extra'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#1d4ed8',
                'selectors' => [
                    '{{WRAPPER}} .next-extra-add-to-cart .button:hover' => 'background-color: {{VALUE}};',
                ],
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

        $query_args = [
            'status'   => 'publish',
            'limit'    => !empty($settings['products_per_page']) ? intval($settings['products_per_page']) : 4,
            'meta_key' => 'total_sales',
            'orderby'  => 'meta_value_num',
            'order'    => 'DESC',
        ];

        $products = wc_get_products($query_args);

        if (empty($products)) {
            // fallback if no products have sales yet
            unset($query_args['meta_key']);
            $query_args['orderby'] = 'date';
            $products = wc_get_products($query_args);
        }

        $layout_type  = !empty($settings['layout_style']) ? $settings['layout_style'] : 'grid';
        $cols_desktop = !empty($settings['columns']) ? $settings['columns'] : '4';
        $cols_tablet  = !empty($settings['columns_tablet']) ? $settings['columns_tablet'] : '2';
        $cols_mobile  = !empty($settings['columns_mobile']) ? $settings['columns_mobile'] : '1';
        $grid_classes = "next-extra-bestseller-container layout-{$layout_type} cols-d-{$cols_desktop} cols-t-{$cols_tablet} cols-m-{$cols_mobile}";
        ?>
        <div class="next-extra-widget-bestseller">
            <div class="<?php echo esc_attr($grid_classes); ?>">
                <?php foreach ($products as $index => $product) : 
                    $pid         = $product->get_id();
                    $title       = $product->get_name();
                    $permalink   = $product->get_permalink();
                    $image_html  = $product->get_image('woocommerce_thumbnail');
                    $rating      = $product->get_average_rating();
                    $rating_cnt  = $product->get_rating_count();
                    $total_sales = (int) get_post_meta($pid, 'total_sales', true);
                    $rank        = $index + 1;
                    ?>
                    <div class="next-extra-bestseller-card">
                        <div class="next-extra-thumb-wrapper">
                            <span class="next-extra-rank-tag">#<?php echo esc_html($rank); ?></span>
                            <a href="<?php echo esc_url($permalink); ?>" class="next-extra-thumb-link">
                                <?php echo wp_kses_post($image_html); ?>
                            </a>
                            <?php if ($settings['show_best_seller_badge'] === 'yes' && !empty($settings['badge_text'])) : ?>
                                <span class="next-extra-badge bestseller"><?php echo esc_html($settings['badge_text']); ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="next-extra-card-body">
                            <h4 class="next-extra-product-title">
                                <a href="<?php echo esc_url($permalink); ?>"><?php echo esc_html($title); ?></a>
                            </h4>

                            <?php if ($rating > 0) : ?>
                                <div class="next-extra-rating">
                                    <?php echo wc_get_rating_html($rating, $rating_cnt); ?>
                                </div>
                            <?php endif; ?>

                            <div class="next-extra-product-price">
                                <?php echo wp_kses_post($product->get_price_html()); ?>
                            </div>

                            <?php if ($settings['show_sales_count'] === 'yes') : ?>
                                <div class="next-extra-sales-count">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                                    <span><?php printf(esc_html__('%d+ units purchased', 'next-extra'), max(5, $total_sales)); ?></span>
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
