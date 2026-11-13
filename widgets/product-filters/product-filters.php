<?php
defined('ABSPATH') || exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;

class Next_Extra_Product_Filters extends Widget_Base {

    public function get_name() {
        return 'next-extra-product-filters';
    }

    public function get_title() {
        return esc_html__('Product Filters', 'next-extra');
    }

    public function get_icon() {
        return 'eicon-filter';
    }

    public function get_categories() {
        return ['next-extra-archive'];
    }

    public function get_keywords() {
        return ['filter', 'product filters', 'price filter', 'category filter', 'rating filter', 'archive', 'shop', 'shopengine', 'woocommerce'];
    }

    protected function register_controls() {

        // ==========================================
        // CONTENT TAB: Filter Sections
        // ==========================================
        $this->start_controls_section(
            'section_filter_items',
            [
                'label' => esc_html__('Filter Modules', 'next-extra'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'enable_price_filter',
            [
                'label'        => esc_html__('Price Range Filter', 'next-extra'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'next-extra'),
                'label_off'    => esc_html__('No', 'next-extra'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'price_filter_title',
            [
                'label'     => esc_html__('Price Filter Title', 'next-extra'),
                'type'      => Controls_Manager::TEXT,
                'default'   => esc_html__('Filter by Price', 'next-extra'),
                'condition' => [
                    'enable_price_filter' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'enable_category_filter',
            [
                'label'        => esc_html__('Category Filter', 'next-extra'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'next-extra'),
                'label_off'    => esc_html__('No', 'next-extra'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'category_filter_title',
            [
                'label'     => esc_html__('Category Filter Title', 'next-extra'),
                'type'      => Controls_Manager::TEXT,
                'default'   => esc_html__('Product Categories', 'next-extra'),
                'condition' => [
                    'enable_category_filter' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_category_count',
            [
                'label'        => esc_html__('Show Category Products Count', 'next-extra'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'next-extra'),
                'label_off'    => esc_html__('No', 'next-extra'),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'    => [
                    'enable_category_filter' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'enable_rating_filter',
            [
                'label'        => esc_html__('Rating Filter', 'next-extra'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'next-extra'),
                'label_off'    => esc_html__('No', 'next-extra'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'rating_filter_title',
            [
                'label'     => esc_html__('Rating Filter Title', 'next-extra'),
                'type'      => Controls_Manager::TEXT,
                'default'   => esc_html__('Average Rating', 'next-extra'),
                'condition' => [
                    'enable_rating_filter' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'enable_stock_filter',
            [
                'label'        => esc_html__('In Stock Filter', 'next-extra'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'next-extra'),
                'label_off'    => esc_html__('No', 'next-extra'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'stock_filter_title',
            [
                'label'     => esc_html__('Stock Filter Title', 'next-extra'),
                'type'      => Controls_Manager::TEXT,
                'default'   => esc_html__('Availability', 'next-extra'),
                'condition' => [
                    'enable_stock_filter' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'enable_clear_button',
            [
                'label'        => esc_html__('Show Clear All Button', 'next-extra'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'next-extra'),
                'label_off'    => esc_html__('No', 'next-extra'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->end_controls_section();

        // ==========================================
        // STYLE TAB: Filter Container
        // ==========================================
        $this->start_controls_section(
            'section_style_container',
            [
                'label' => esc_html__('Filter Panel Container', 'next-extra'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'panel_bg',
                'label'    => esc_html__('Background', 'next-extra'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .next-extra-filters-panel',
            ]
        );

        $this->add_responsive_control(
            'panel_padding',
            [
                'label'      => esc_html__('Padding', 'next-extra'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'default'    => [
                    'top'    => '20',
                    'right'  => '20',
                    'bottom' => '20',
                    'left'   => '20',
                    'unit'   => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .next-extra-filters-panel' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'panel_border',
                'label'    => esc_html__('Border', 'next-extra'),
                'selector' => '{{WRAPPER}} .next-extra-filters-panel',
            ]
        );

        $this->add_responsive_control(
            'panel_radius',
            [
                'label'      => esc_html__('Border Radius', 'next-extra'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .next-extra-filters-panel' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'panel_shadow',
                'label'    => esc_html__('Box Shadow', 'next-extra'),
                'selector' => '{{WRAPPER}} .next-extra-filters-panel',
            ]
        );

        $this->end_controls_section();

        // ==========================================
        // STYLE TAB: Filter Titles
        // ==========================================
        $this->start_controls_section(
            'section_style_titles',
            [
                'label' => esc_html__('Section Titles', 'next-extra'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Title Color', 'next-extra'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#0f172a',
                'selectors' => [
                    '{{WRAPPER}} .next-extra-filter-heading' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'label'    => esc_html__('Title Typography', 'next-extra'),
                'selector' => '{{WRAPPER}} .next-extra-filter-heading',
            ]
        );

        $this->add_control(
            'accent_color',
            [
                'label'     => esc_html__('Accent / Active Color', 'next-extra'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#2563eb',
                'selectors' => [
                    '{{WRAPPER}} .next-extra-filter-item input:checked + label' => 'color: {{VALUE}}; font-weight: 700;',
                    '{{WRAPPER}} .next-extra-price-submit' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .next-extra-filter-item input:checked' => 'accent-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        if (!function_exists('WC')) {
            echo '<div class="next-extra-alert">' . esc_html__('WooCommerce is required for product filters.', 'next-extra') . '</div>';
            return;
        }

        $settings = $this->get_settings_for_display();

        // Current applied values from URL
        $current_min_price = isset($_GET['min_price']) ? floatval($_GET['min_price']) : '';
        $current_max_price = isset($_GET['max_price']) ? floatval($_GET['max_price']) : '';
        $current_cats      = isset($_GET['product_cat']) ? explode(',', sanitize_text_field($_GET['product_cat'])) : [];
        $current_rating    = isset($_GET['rating_filter']) ? sanitize_text_field($_GET['rating_filter']) : '';
        $current_stock     = isset($_GET['stock_status']) ? sanitize_text_field($_GET['stock_status']) : '';

        // Global min/max prices
        global $wpdb;
        $prices = $wpdb->get_row("
            SELECT min( CAST( price_meta.meta_value AS DECIMAL(10,2) ) ) as min_price,
                   max( CAST( price_meta.meta_value AS DECIMAL(10,2) ) ) as max_price
            FROM {$wpdb->posts}
            LEFT JOIN {$wpdb->postmeta} as price_meta ON {$wpdb->posts}.ID = price_meta.post_id
            WHERE {$wpdb->posts}.post_type = 'product'
            AND {$wpdb->posts}.post_status = 'publish'
            AND price_meta.meta_key = '_price'
        ");

        $min_range = $prices && $prices->min_price ? floor($prices->min_price) : 0;
        $max_range = $prices && $prices->max_price ? ceil($prices->max_price) : 500;

        $form_action = get_permalink(wc_get_page_id('shop'));
        if (is_product_category() || is_product_tag() || is_shop()) {
            $form_action = '';
        }
        ?>
        <div class="next-extra-widget-product-filters">
            <form method="get" action="<?php echo esc_url($form_action); ?>" class="next-extra-filters-panel">
                
                <?php
                // Preserve existing query params except our filters
                if (!empty($_GET) && is_array($_GET)) {
                    foreach ($_GET as $key => $val) {
                        $sanitized_key = sanitize_key($key);
                        if (!in_array($sanitized_key, ['min_price', 'max_price', 'product_cat', 'rating_filter', 'stock_status', 'paged'], true)) {
                            if (is_scalar($val)) {
                                echo '<input type="hidden" name="' . esc_attr($sanitized_key) . '" value="' . esc_attr(sanitize_text_field(wp_unslash($val))) . '">';
                            }
                        }
                    }
                }
                ?>

                <!-- 1. Price Filter -->
                <?php if ($settings['enable_price_filter'] === 'yes') : ?>
                    <div class="next-extra-filter-group next-extra-filter-price">
                        <h4 class="next-extra-filter-heading"><?php echo esc_html($settings['price_filter_title']); ?></h4>
                        <div class="next-extra-price-inputs">
                            <div class="price-field">
                                <span><?php echo get_woocommerce_currency_symbol(); ?></span>
                                <input type="number" name="min_price" placeholder="<?php echo esc_attr($min_range); ?>" value="<?php echo esc_attr($current_min_price); ?>" min="<?php echo esc_attr($min_range); ?>" max="<?php echo esc_attr($max_range); ?>">
                            </div>
                            <span class="price-sep">-</span>
                            <div class="price-field">
                                <span><?php echo get_woocommerce_currency_symbol(); ?></span>
                                <input type="number" name="max_price" placeholder="<?php echo esc_attr($max_range); ?>" value="<?php echo esc_attr($current_max_price); ?>" min="<?php echo esc_attr($min_range); ?>" max="<?php echo esc_attr($max_range); ?>">
                            </div>
                            <button type="submit" class="next-extra-price-submit">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </button>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- 2. Categories Filter -->
                <?php if ($settings['enable_category_filter'] === 'yes') : 
                    $categories = get_terms([
                        'taxonomy'   => 'product_cat',
                        'hide_empty' => true,
                    ]);
                    if (!empty($categories) && !is_wp_error($categories)) : ?>
                        <div class="next-extra-filter-group next-extra-filter-categories">
                            <h4 class="next-extra-filter-heading"><?php echo esc_html($settings['category_filter_title']); ?></h4>
                            <div class="next-extra-filter-list">
                                <?php foreach ($categories as $cat) : 
                                    $is_checked = in_array($cat->slug, $current_cats);
                                    ?>
                                    <div class="next-extra-filter-item">
                                        <input type="checkbox" id="cat-<?php echo esc_attr($cat->term_id); ?>" name="product_cat" value="<?php echo esc_attr($cat->slug); ?>" <?php checked($is_checked); ?> onchange="this.form.submit()">
                                        <label for="cat-<?php echo esc_attr($cat->term_id); ?>">
                                            <?php echo esc_html($cat->name); ?>
                                            <?php if ($settings['show_category_count'] === 'yes') : ?>
                                                <span class="count">(<?php echo esc_html($cat->count); ?>)</span>
                                            <?php endif; ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; 
                endif; ?>

                <!-- 3. Rating Filter -->
                <?php if ($settings['enable_rating_filter'] === 'yes') : ?>
                    <div class="next-extra-filter-group next-extra-filter-ratings">
                        <h4 class="next-extra-filter-heading"><?php echo esc_html($settings['rating_filter_title']); ?></h4>
                        <div class="next-extra-filter-list">
                            <?php for ($r = 5; $r >= 3; $r--) : 
                                $is_checked = ($current_rating == $r);
                                ?>
                                <div class="next-extra-filter-item">
                                    <input type="radio" id="rating-<?php echo esc_attr($r); ?>" name="rating_filter" value="<?php echo esc_attr($r); ?>" <?php checked($is_checked); ?> onchange="this.form.submit()">
                                    <label for="rating-<?php echo esc_attr($r); ?>" class="rating-label">
                                        <span class="stars"><?php echo str_repeat('★', $r) . str_repeat('☆', 5 - $r); ?></span>
                                        <span class="rating-text"><?php printf(esc_html__('%d Stars & Up', 'next-extra'), $r); ?></span>
                                    </label>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- 4. Stock Availability Filter -->
                <?php if ($settings['enable_stock_filter'] === 'yes') : ?>
                    <div class="next-extra-filter-group next-extra-filter-stock">
                        <h4 class="next-extra-filter-heading"><?php echo esc_html($settings['stock_filter_title']); ?></h4>
                        <div class="next-extra-filter-list">
                            <div class="next-extra-filter-item">
                                <input type="checkbox" id="stock-instock" name="stock_status" value="instock" <?php checked($current_stock === 'instock'); ?> onchange="this.form.submit()">
                                <label for="stock-instock"><?php esc_html_e('In Stock only', 'next-extra'); ?></label>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- 5. Clear All Filters -->
                <?php if ($settings['enable_clear_button'] === 'yes' && (!empty($current_min_price) || !empty($current_max_price) || !empty($current_cats) || !empty($current_rating) || !empty($current_stock))) : ?>
                    <div class="next-extra-clear-wrap">
                        <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="next-extra-clear-btn">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            <span><?php esc_html_e('Clear All Filters', 'next-extra'); ?></span>
                        </a>
                    </div>
                <?php endif; ?>

            </form>
        </div>
        <?php
    }
}
