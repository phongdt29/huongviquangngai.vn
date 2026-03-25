<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PenciReviewElementor extends \Elementor\Widget_Base {

	public function get_name() {
		return 'penci-review';
	}

	public function get_title() {
		if ( function_exists( 'penci_get_theme_name' ) ) {
			return penci_get_theme_name( 'Penci' ) . ' ' . esc_html__( ' Review', 'penci-recipe' );
		} else {
			return esc_html__( 'Penci Review', 'penci-recipe' );
		}
	}

	public function get_icon() {
		return 'eicon-menu-card';
	}

	public function get_script_depends() {
		return [ 'jquery-recipe-print', 'penci_rateyo', 'jquery-penci-review' ];
	}

	public function get_categories() {
		return [ 'penci-elements' ];
	}

	public function get_keywords() {
		return array( 'penci', 'review' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_data', array(
				'label' => esc_html__( 'Review Data', 'penci-recipe' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'penci_review_title', array(
				'label' => esc_html__( 'Review Title', 'penci-review' ),
				'type'  => Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'penci_review_address', array(
				'label' => esc_html__( 'Adress', 'penci-review' ),
				'type'  => Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'penci_review_phone', array(
				'label' => esc_html__( 'Phone', 'penci-review' ),
				'type'  => Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'penci_review_website', array(
				'label' => esc_html__( 'Website', 'penci-review' ),
				'type'  => Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'penci_review_price', array(
				'label' => esc_html__( 'Product Price', 'penci-review' ),
				'type'  => Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'penci_review_linkbuy', array(
				'label' => esc_html__( 'Product Link', 'penci-review' ),
				'type'  => Controls_Manager::URL,
			)
		);

		$this->add_control(
			'penci_review_textbuy', array(
				'label'   => esc_html__( 'Buy Now Text', 'penci-review' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( "Buy Now", 'penci-review' ),
			)
		);

		$this->add_control(
			'hide_img', array(
				'label' => esc_html__( 'Hide Image', 'penci-review' ),
				'type'  => Controls_Manager::SWITCHER,
			)
		);

		$this->add_control(
			'penci_review_custom_image', array(
				'label' => esc_html__( 'Custom Image', 'penci-review' ),
				'type'  => Controls_Manager::MEDIA,
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name'    => 'penci_review_img_size',
				'default' => 'large',
			]
		);

		$this->add_control(
			'penci_review_des', array(
				'label' => esc_html__( 'Description', 'penci-review' ),
				'type'  => Controls_Manager::WYSIWYG,
			)
		);

		$this->add_control(
			'penci_review_hide_average', array(
				'label' => esc_html__( 'Hide Average', 'penci-review' ),
				'type'  => Controls_Manager::SWITCHER,
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_review_points', array(
				'label' => esc_html__( 'Review Points', 'penci-recipe' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'review_star_class', array(
				'label'   => esc_html__( 'Review Style', 'penci-review' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'normal-rating',
				'options' => [
					'normal-rating' => __( 'Normal Rating', 'penci-review' ),
					'star-rating'   => __( 'Star Rating', 'penci-review' ),
				]
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'review_title', array(
				'label' => esc_html__( 'Title', 'penci-review' ),
				'type'  => Controls_Manager::TEXT,
			)
		);

		$repeater->add_control(
			'review_point', array(
				'label' => esc_html__( 'Point', 'penci-review' ),
				'type'  => Controls_Manager::NUMBER,
			)
		);

		$this->add_control(
			'penci_review_items',
			[
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'review_title' => esc_html__( 'Review 1', 'soledad' ),
						'review_point' => 7,
					],
					[
						'review_title' => esc_html__( 'Review 2', 'soledad' ),
						'review_point' => 9,
					],
					[
						'review_title' => esc_html__( 'Review 3', 'soledad' ),
						'review_point' => 4,
					],
				],
				'title_field' => '{{{ review_title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_review_content', array(
				'label' => esc_html__( 'Review Content', 'penci-recipe' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'penci_review_good', array(
				'label' => esc_html__( 'The Goods:', 'penci-review' ),
				'description' => esc_html__( 'Each point on a line', 'penci-review' ),
				'type'  => Controls_Manager::TEXTAREA,
			)
		);

		$this->add_control(
			'penci_review_bad', array(
				'label' => esc_html__( 'The Bads:', 'penci-review' ),
				'description' => esc_html__( 'Each point on a line', 'penci-review' ),
				'type'  => Controls_Manager::TEXTAREA,
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_schema_settings', array(
				'label' => esc_html__( 'Review Schema', 'penci-recipe' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_schema_markup', array(
				'label' => esc_html__( 'Show Schema', 'penci-review' ),
				'type'  => Controls_Manager::SWITCHER,
			)
		);

		$schema_lists = Penci_Review_Schema_Markup::get_list_schema();

		$this->add_control(
			'penci_review_schema_markup', array(
				'label'   => esc_html__( 'Reviewed Item Schema', 'penci-review' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => $schema_lists,
			)
		);

		$this->end_controls_section();

		foreach ( $schema_lists as $schema_type => $schema_name ) {
			$schema_fields = Penci_Review_Schema_Markup::get_schema_types( $schema_type );
			if ( ! empty( $schema_fields ) ) {

				$this->start_controls_section(
					'penci_review_schema_heading' . $schema_type, array(
						'label'     => $schema_name . ' Schema Options',
						'condition' => [ 'penci_review_schema_markup' => $schema_type ],
						'tab'       => Controls_Manager::TAB_CONTENT,
					)
				);

				foreach ( $schema_fields as $id => $field ) {
					$this->add_control(
						'penci_schema_' . $schema_type . '_' . $field['name'], array(
							'label'   => $field['label'],
							'default' => $field['default'],
							'options' => isset( $field['options'] ) ? $field['options'] : [],
							'type'    => $this->get_field_type( $field['type'] ),
						)
					);
				}

				$this->end_controls_section();
			}
		}

		$this->start_controls_section(
			'section_review_style', array(
				'label' => esc_html__( 'Review Style', 'penci-recipe' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'penci_review_boxheading', array(
				'label' => esc_html__( 'General', 'penci-review' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'penci_review_bdcolor', array(
				'label'     => esc_html__( 'Border Color', 'penci-review' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ '.wrapper-penci-review' => 'border-color:{{VALUE}}' ],
			)
		);

		$this->add_control(
			'penci_review_bgcolor', array(
				'label'     => esc_html__( 'Background Color', 'penci-review' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ '.wrapper-penci-review' => 'background-color:{{VALUE}}' ],
			)
		);

		$this->add_responsive_control(
			'penci_review_padding', array(
				'label'      => esc_html__( 'Padding', 'penci-review' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'selectors'  => [ '.wrapper-penci-review' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}' ],
			)
		);

		$this->add_responsive_control(
			'penci_review_bgradius', array(
				'label'      => esc_html__( 'Border Radius', 'penci-review' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'selectors'  => [ '.wrapper-penci-review' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}' ],
			)
		);

		$this->add_control(
			'penci_review_title_typo_heading', array(
				'label' => esc_html__( 'Title', 'penci-review' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), array(
				'name'     => 'penci_review_title_typo',
				'label'    => __( 'Review Title', 'soledad' ),
				'selector' => '{{WRAPPER}} .penci-review-container.penci-review-count h4',
			)
		);

		$this->add_control(
			'penci_review_title_color', array(
				'label'     => esc_html__( 'Color', 'penci-review' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ '{{WRAPPER}} .penci-review-container.penci-review-count h4' => 'color:{{VALUE}}' ],
			)
		);

		// desc
		$this->add_control(
			'penci_review_desc_typo_heading', array(
				'label' => esc_html__( 'Description Text', 'penci-review' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), array(
				'name'     => 'penci_review_desc_typo',
				'label'    => __( 'Description Typo', 'soledad' ),
				'selector' => '{{WRAPPER}} .penci-review-desc p',
			)
		);

		$this->add_control(
			'penci_review_desc_color', array(
				'label'     => esc_html__( 'Color', 'penci-review' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ '{{WRAPPER}} .penci-review-desc p' => 'color:{{VALUE}}' ],
			)
		);

		// review points
		$this->add_control(
			'penci_review_points_typo_heading', array(
				'label' => esc_html__( 'Review Items', 'penci-review' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), array(
				'name'     => 'penci_review_point_typo',
				'label'    => __( 'Description Typo', 'soledad' ),
				'selector' => '{{WRAPPER}} .penci-review-text',
			)
		);

		$this->add_control(
			'penci_review_point_color', array(
				'label'     => esc_html__( 'Color', 'penci-review' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ '{{WRAPPER}} .penci-review-text' => 'color:{{VALUE}}' ],
			)
		);

		// review progress
		$this->add_control(
			'penci_review_progress_heading', array(
				'label' => esc_html__( 'Review Progress', 'penci-review' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'penci_review_process_main_color', array(
				'label'     => esc_html__( 'Main Background Color', 'penci-review' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ '{{WRAPPER}} .penci-review-process' => 'background-color:{{VALUE}}' ],
			)
		);

		$this->add_control(
			'penci_review_process_run_color', array(
				'label'     => esc_html__( 'Running Background Color', 'penci-review' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ '{{WRAPPER}} .penci-review .penci-review-process span' => 'background-color:{{VALUE}}' ],
			)
		);

		// good/bad
		$this->add_control(
			'penci_review_goodbad_typo_heading', array(
				'label' => esc_html__( 'Good Content', 'penci-review' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), array(
				'name'     => 'penci_review_good_typo',
				'label'    => __( 'Good/Bad Heading', 'soledad' ),
				'selector' => '{{WRAPPER}} .penci-review-stuff .penci-review-good h5',
			)
		);

		$this->add_control(
			'penci_review_good_color', array(
				'label'     => esc_html__( 'Color', 'penci-review' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ '{{WRAPPER}} .penci-review-stuff .penci-review-good h5' => 'color:{{VALUE}}' ],
			)
		);

		$this->add_control(
			'penci_review_good_icolor', array(
				'label'     => esc_html__( 'Good Icon Color', 'penci-review' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ '{{WRAPPER}} .penci-review .penci-review-good ul li:before' => 'color:{{VALUE}}' ],
			)
		);

		$this->add_control(
			'penci_review_bad_icolor', array(
				'label'     => esc_html__( 'Bad Icon Color', 'penci-review' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ '{{WRAPPER}} .penci-review .penci-review-bad ul li:before' => 'color:{{VALUE}}' ],
			)
		);

		$this->add_control(
			'penci_review_total_bgcolor', array(
				'label'     => esc_html__( 'Total Background Color', 'penci-review' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ '{{WRAPPER}} .penci-review .penci-review-score-total' => 'background-color:{{VALUE}}' ],
			)
		);

		$this->add_control(
			'penci_review_average_total_color', array(
				'label'     => esc_html__( 'Avg Total Color', 'penci-review' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ '{{WRAPPER}} .penci-review-score-num' => 'color:{{VALUE}}' ],
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), array(
				'name'     => 'penci_review_average_text_typo',
				'label'    => __( 'Avg Text Typo', 'soledad' ),
				'selector' => '{{WRAPPER}} .penci-review-score-total span',
			)
		);

		$this->add_control(
			'penci_review_average_text_color', array(
				'label'     => esc_html__( 'Avg Text Color', 'penci-review' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ '{{WRAPPER}} .penci-review-score-total span' => 'color:{{VALUE}}' ],
			)
		);

		$this->add_control(
			'penci_review_star_bgclb', array(
				'label'     => esc_html__( 'Background Color for Stars', 'penci-review' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ '{{WRAPPER}} .penci-review-score-total .total-stars,{{WRAPPER}} .penci-review-number.star-rating .penci-review-process::before' => 'color:{{VALUE}}' ],
			)
		);

		$this->add_control(
			'penci_review_star_clb', array(
				'label'     => esc_html__( 'Color for Stars', 'penci-review' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ '{{WRAPPER}} .penci-review-score-num .current-stars,{{WRAPPER}} .penci-review-number.star-rating .penci-review-process span:before' => 'color:{{VALUE}}' ],
			)
		);

		$this->end_controls_section();
	}

	public static function get_field_type( $field ) {
		$type = [
			'text'     => Controls_Manager::TEXT,
			'select'   => Controls_Manager::SELECT,
			'date'     => Controls_Manager::DATE_TIME,
			'number'   => Controls_Manager::NUMBER,
			'textarea' => Controls_Manager::TEXTAREA,
			'image'    => Controls_Manager::MEDIA,
		];

		return isset( $type[ $field ] ) ? $type[ $field ] : $type;
	}

	protected function render() {
		$settings           = $this->get_settings_for_display();
		$img_size_pre       = 'large';
		$review_id          = get_the_ID();
		$review_ct_image    = isset( $settings['penci_review_custom_image']['id'] ) ? $settings['penci_review_custom_image']['id'] : get_post_thumbnail_id();
		$review_title       = $settings['penci_review_title'] ? $settings['penci_review_title'] : get_the_title();
		$review_price       = $settings['penci_review_price'];
		$review_website     = $settings['penci_review_website'];
		$review_address     = $settings['penci_review_address'];
		$review_phone       = $settings['penci_review_phone'];
		$review_linkbuy     = $settings['penci_review_linkbuy'];
		$review_textbuy     = $settings['penci_review_textbuy'];
		$schema_markup_type = $settings['penci_review_schema_markup'];
		$review_des         = $settings['penci_review_des'];
		$review_star_class  = $settings['review_star_class'];
		$review_good        = $settings['penci_review_good'];
		$review_bad         = $settings['penci_review_bad'];
		$penci_review_json_attr = [];

		$review_good_array = '';
		$review_bad_array  = '';
		if ( $review_good ):
			$review_good_array = preg_split( '/\r\n|[\r\n]/', $review_good );
		endif;
		if ( $review_bad ):
			$review_bad_array = preg_split( '/\r\n|[\r\n]/', $review_bad );
		endif;
		$schema_type     = $settings['penci_review_schema_markup'];
		$schema_type_ft  = 'penci_schema_' . $schema_type . '_';
		$schema_type_val = array_filter( $settings, function ( $key ) use ( $schema_type_ft ) {
			return strpos( $key, $schema_type_ft ) === 0;
		}, ARRAY_FILTER_USE_KEY );

		$schema_type_val = array_combine(
			array_map( function ( $key ) use ( $schema_type_ft ) {
				return str_replace( $schema_type_ft, '', $key );
			}, array_keys( $schema_type_val ) ),
			$schema_type_val
		);

		if ( $review_ct_image ) {
			$penci_review_json_attr['penci_review_ct_image'] = $review_ct_image;
		}
		?>
        <aside class="wrapper-penci-review el">
            <div class="penci-review">
                <div class="penci-review-container penci-review-count">
					<?php
					$img_size = get_theme_mod( 'penci_review_img_size', 'thumbnail' );
					if ( $img_size_pre ) {
						$img_size = $img_size_pre;
					}

					$url_review_ct_image = wp_get_attachment_image_url( $review_ct_image, $img_size );
					if ( ! $url_review_ct_image && has_post_thumbnail( $review_id ) ) {
						$url_review_ct_image = get_the_post_thumbnail_url( $review_id, $img_size );
					}

					if ( $url_review_ct_image && ! $settings['hide_img'] ): ?>
                        <div class="penci-review-thumb">
                            <img src="<?php echo $url_review_ct_image; ?>"
                                 alt="<?php echo esc_attr( $review_title ); ?>"/>
                        </div>
					<?php endif; ?>
					<?php if ( $review_title ) : ?>
                        <h4 class="penci-review-title">
                            <a href="<?php the_permalink(); ?>">
                                <span><?php echo $review_title; ?></span>
                            </a>
                        </h4>
					<?php endif; ?>
                    <div class="penci-review-metas">
						<?php
						if ( $review_price ) {
							$price_text = penci_review_tran_setting( 'penci_review_price_text' );
							echo '<div class="penci-review-meta penci-review-price"><i>' . $price_text . '</i> ' . $review_price . '</div>';
						}
						if ( $review_phone ) {
							echo '<div class="penci-review-meta penci-review-phone"><i class="fa fa-phone"></i><a href="tel:' . $review_phone . '">' . $review_phone . '</a></div>';
						}
						if ( $review_address ) {
							echo '<div class="penci-review-meta penci-review-address"><i class="fa fa-map-marker"></i>' . $review_address . '</div>';
						}
						if ( $review_website ) {
							echo '<div class="penci-review-meta penci-review-website"><i class="fa fa-globe"></i><a href="' . esc_url( $review_website ) . '" target="_blank">' . $review_website . '</a></div>';
						}
						if ( $review_textbuy ) {
							$prefix = $suffix = 'div';

							if ( isset( $review_linkbuy['url'] ) ) {
								$prefix = 'a href="' . esc_url( $review_linkbuy['url'] ) . '" ';
								$suffix = 'a';
							}
							echo '<div class="penci-review-btnbuyw"><' . $prefix . ' class="penci-review-btnbuy button" target="_blank">' . $review_textbuy . '</' . $suffix . '></div>';
						}
						?>
                    </div>
					<?php if ( $settings['show_schema_markup'] ): ?>
                        <div class="penci-review-schemas">
							<?php
							$schema_fields = Penci_Review_Schema_Markup::get_schema_types( $schema_markup_type );
							if ( $schema_fields ) {
								foreach ( $schema_fields as $schema_field ) {
									if ( isset( $schema_type_val[ $schema_field['name'] ] ) && $schema_type_val[ $schema_field['name'] ] ) {
										echo '<div class="penci-review-schema"><strong>' . $schema_field['label'] . ' : </strong>' . $schema_type_val[ $schema_field['name'] ] . '</div>';
									}
								}
							}
							?>
                        </div>
					<?php endif; ?>
					<?php if ( $review_des ) : ?>
                        <div class="penci-review-desc"><p><?php echo $review_des; ?></p></div>
					<?php endif; ?>
                    <span class="penci-review-hauthor"
                          style="display: none !important;"><span><?php bloginfo( 'name' ); ?></span></span>
                    <ul class="penci-review-number <?php echo $review_star_class; ?>">
						<?php
						$penci_review_items = $settings['penci_review_items'];
						if ( ! empty( $penci_review_items ) ) {
							$total_score   = 0;
							$total_num     = 0;
							$total_average = 0;
							foreach ( $penci_review_items as $review_id => $review_data ) {
								$review_point = isset( $review_data['review_point'] ) ? $review_data['review_point'] : 0;
								$total_score  = $total_score + $review_point;
								$total_num    = $total_num + 1;
								?>
                                <li>
                                    <div class="penci-review-text">
                                        <div class="penci-review-point"><?php echo $review_data['review_title']; ?></div>
                                        <div class="penci-review-score"><?php echo $review_point; ?></div>
                                    </div>
                                    <div class="penci-review-process">
                                <span class="penci-process-run"
                                      data-width="<?php echo number_format( $review_point, 1, '.', '' ); ?>"></span>
                                    </div>
                                </li>
							<?php }
							if ( $total_score && $total_num ) {
								$total_average = $total_score / $total_num;
							}
						} ?>
                    </ul>
                </div>
                <div class="penci-review-container penci-review-point">
                    <div class="penci-review-row<?php if ( 'star-rating' == $review_star_class ): echo ' star-row-enable'; endif; ?>">
						<?php if ( $review_good_array || $review_bad_array ) : ?>
                            <div class="penci-review-stuff">
                                <div class="penci-review-row<?php if ( ! $review_good_array || ! $review_bad_array ) : echo ' full-w'; endif; ?>">
									<?php if ( $review_good_array ) : ?>
                                        <div class="penci-review-good">
                                            <h5 class="penci-review-title"><?php if ( get_theme_mod( 'penci_review_good_text' ) ) {
													echo do_shortcode( get_theme_mod( 'penci_review_good_text' ) );
												} else {
													esc_html_e( 'The Goods', 'soledad' );
												} ?></h5>
                                            <ul>
												<?php foreach ( $review_good_array as $good ) : ?>
													<?php if ( $good ) : ?>
                                                        <li><?php echo $good; ?></li>
													<?php endif; ?>
												<?php endforeach; ?>
                                            </ul>
                                        </div>
									<?php endif; ?>
									<?php if ( $review_bad_array ) : ?>
                                        <div class="penci-review-good penci-review-bad">
                                            <h5 class="penci-review-title"><?php if ( get_theme_mod( 'penci_review_bad_text' ) ) {
													echo do_shortcode( get_theme_mod( 'penci_review_bad_text' ) );
												} else {
													esc_html_e( 'The Bads', 'soledad' );
												} ?></h5>
                                            <ul>
												<?php foreach ( $review_bad_array as $bad ) : ?>
													<?php if ( $bad ) : ?>
                                                        <li><?php echo $bad; ?></li>
													<?php endif; ?>
												<?php endforeach; ?>
                                            </ul>
                                        </div>
									<?php endif; ?>
                                </div>
                            </div>
						<?php endif; ?>
                        <div class="penci-review-average<?php if ( ! $review_good_array && ! $review_bad_array ) : echo ' full-w'; endif; ?>">
                            <div class="penci-review-score-total<?php if ( $settings['penci_review_hide_average'] ): echo ' only-score'; endif; ?>">
                                <div class="penci-review-score-num<?php if ( 'star-rating' == $review_star_class ): echo ' star-num-enable'; endif; ?>">
									<?php
									$avg_text = esc_html__( 'Average Score', 'soledad' );
									if ( 'star-rating' == $review_star_class ) {
										$avg_text = esc_html__( 'Average Star', 'soledad' );
										?>
                                        <div class="pc-review-stars">
                                            <div class="total-stars">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="current-stars"
                                                 style="width:<?php echo $total_average * 10; ?>%">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
										<?php
									} else {
										echo number_format( $total_average, 1, '.', '' );
									}
									?>
                                </div>
								<?php if ( ! $settings[ 'penci_review_hide_average' ] ): ?>
                                    <span><?php if ( get_theme_mod( 'penci_review_average_text' ) ) {
											echo do_shortcode( get_theme_mod( 'penci_review_average_text' ) );
										} else {
											echo $avg_text;
										} ?></span>
								<?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
		<?php
		if ( $settings['show_schema_markup'] ) {
			Penci_Review_Schema_Markup::output_schema( array(
				'penci_review'    => $penci_review_json_attr,
				'schema_type'     => $schema_markup_type,
				'schema_type_val' => $schema_type_val,
				'ratingValue'     => $total_average,
				'post_id'         => get_the_ID(),
			) );
		}
	}
}
