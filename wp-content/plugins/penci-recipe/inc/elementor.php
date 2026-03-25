<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PenciRecipeElementor extends \Elementor\Widget_Base {

	public function get_name() {
		return 'penci-recipe';
	}

	public function get_title() {
		if ( function_exists( 'penci_get_theme_name' ) ) {
			return penci_get_theme_name( 'Penci' ) . ' ' . esc_html__( ' Recipe', 'penci-recipe' );
		} else {
			return esc_html__( 'Penci Recipe', 'penci-recipe' );
		}
	}

	public function get_icon() {
		return 'eicon-menu-card';
	}

	public function get_script_depends() {
		return [ 'jquery-recipe-print', 'penci_rateyo' ];
	}

	public function get_categories() {
		return [ 'penci-elements' ];
	}

	public function get_keywords() {
		return array( 'penci', 'recipe' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_data', array(
				'label' => esc_html__( 'Recipe Data', 'penci-recipe' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'data_source', array(
				'label'   => esc_html__( 'Data Source', 'penci-recipe' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'meta',
				'options' => [
					'meta'      => __( 'Post Meta', 'penci-recipe' ),
					'elementor' => __( 'Elementor', 'penci-recipe' ),
				],
			)
		);
		$this->add_control(
			'penci_recipe_style', array(
				'label'   => esc_html__( 'Recipe Style', 'penci-recipe' ),
				'type'    => Controls_Manager::SELECT,
				'default' => get_theme_mod( 'penci_recipe_style', 'style-1' ),
				'options' => [
					'style-1' => __( 'Style 1', 'penci-recipe' ),
					'style-2' => __( 'Style 2', 'penci-recipe' ),
					'style-3' => __( 'Style 3', 'penci-recipe' ),
					'style-4' => __( 'Style 4', 'penci-recipe' ),
				],
			)
		);
		$this->add_control(
			'penci_recipe_custom_featured_image', array(
				'label'     => esc_html__( 'Custom Featured Image', 'penci-recipe' ),
				'type'      => Controls_Manager::MEDIA,
				'condition' => [ 'data_source' => 'elementor' ]
			)
		);
		$this->add_control(
			'penci_recipe_featured_image', array(
				'label' => esc_html__( 'Hide Featured Image on Recipe Card', 'penci-recipe' ),
				'type'  => Controls_Manager::SWITCHER,
			)
		);
		$this->add_control(
			'penci_recipe_ratio_fimage', array(
				'label'      => esc_html__( 'Custom Ratio Width/Height of Recipe Image', 'penci-recipe' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [
					'unit' => 'px',
				],
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'condition'  => [ 'penci_recipe_style' => [ 'style-2','style-3' ] ],
				'selectors'  => [ '{{WRAPPER}} .precipe-style-2 .penci-recipe-thumb,{{WRAPPER}} .precipe-style-3 .penci-recipe-thumb' => 'padding-bottom: {{SIZE}}{{UNIT}}' ]
			)
		);
		$this->add_control(
			'penci_recipe_title_overlay', array(
				'label'     => esc_html__( 'Display Recipe Card Title Overlay on Featured Image', 'penci-recipe' ),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => [ 'penci_recipe_style' => [ 'style-1', 'style-2' ] ]
			)
		);
		$this->add_control(
			'penci_recipe_print', array(
				'label' => esc_html__( 'Show "Print Recipe" button at the top of post', 'penci-recipe' ),
				'type'  => Controls_Manager::SWITCHER,
			)
		);
		$this->add_control(
			'penci_recipe_pinterest', array(
				'label'   => esc_html__( 'Show Pin Button', 'penci-recipe' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => true,
			)
		);
		$this->add_control(
			'penci_recipe_hide_image_print', array(
				'label' => esc_html__( 'Hide Images on Recipe Igredients & Instructions When Users Print Recipe', 'penci-recipe' ),
				'type'  => Controls_Manager::SWITCHER,
			)
		);
		$this->add_control(
			'penci_recipe_nutrition', array(
				'label' => esc_html__( 'Show Nutrition Facts', 'penci-recipe' ),
				'type'  => Controls_Manager::SWITCHER,
			)
		);
		$this->add_control(
			'penci_hide_recipe_calories', array(
				'label' => esc_html__( 'Hide Calories', 'penci-recipe' ),
				'type'  => Controls_Manager::SWITCHER,
			)
		);
		$this->add_control(
			'option_penci_recipe_fat', array(
				'label' => esc_html__( 'Hide Fat', 'penci-recipe' ),
				'type'  => Controls_Manager::SWITCHER,
			)
		);
		$this->add_control(
			'penci_recipe_rating', array(
				'label' => esc_html__( 'Hide Rating', 'penci-recipe' ),
				'type'  => Controls_Manager::SWITCHER,
			)
		);
		$this->add_control(
			'penci_recipe_make_trecipe', array(
				'label' => esc_html__( 'Show "Did You Make This Recipe?" Section At The Bottom', 'penci-recipe' ),
				'type'  => Controls_Manager::SWITCHER,
			)
		);
		$this->add_control(
			'penci_recipe_did_you_make', array(
				'label' => esc_html__( 'Heading Title', 'penci-recipe' ),
				'type'  => Controls_Manager::TEXT,
				'condition'  => ['penci_recipe_make_trecipe'=> 'yes'],
			)
		);
		$this->add_control(
			'penci_recipe_descmake_recipe', array(
				'label' => esc_html__( 'Descriptions Text', 'penci-recipe' ),
				'type'  => Controls_Manager::TEXTAREA,
				'condition'  => ['penci_recipe_make_trecipe'=> 'yes'],
			)
		);
		$this->add_control(
			'penci_recipe_remove_nutrition', array(
				'label'       => esc_html__( 'Completely Remove Nutrition Facts on Google Search Results', 'penci-recipe' ),
				'description' => __( 'If you remove Nutrition Facts - you can get warning missing it for all your recipe cards in google search console. And we do not recommend you do that', 'penci-recipe' ),
				'type'        => Controls_Manager::SWITCHER,
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_general', array(
				'label' => esc_html__( 'Recipe Content', 'penci-recipe' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'penci_recipe_title', array(
				'label'       => esc_html__( 'Recipe Title', 'penci-recipe' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => get_post_meta( get_the_ID(), 'penci_recipe_title', true ),
				'label_block' => true,
			)
		);
		$this->add_control(
			'penci_recipe_servings', array(
				'label'   => esc_html__( 'Servings for:', 'penci-recipe' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => get_post_meta( get_the_ID(), 'penci_recipe_servings', true ),
			)
		);
		$this->add_control(
			'penci_recipe_preptime', array(
				'label'   => esc_html__( 'Prep Time:', 'penci-recipe' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '1 Hour',
				'default' => get_post_meta( get_the_ID(), 'penci_recipe_preptime', true ),
			)
		);
		$this->add_control(
			'penci_recipe_preptime_format', array(
				'label'       => esc_html__( 'Prep Time Structured Data Format:', 'penci-recipe' ),
				'description' => __( 'This is Structured Data time format for Prep Time, Google and other the search engines will read it. Example: If the Prep Time is: 2 Hours 30 Minutes, you need fill here: <strong>2H30M</strong> | If the Prep Time is: 40 Minutes, you need fill here: <strong>40M</strong> | If the Prep Time is: 2 Hours, you need fill here: <strong>2H</strong>. All characters need uppercase.', 'penci-recipe' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => get_post_meta( get_the_ID(), 'penci_recipe_preptime_format', true ),
			)
		);
		$this->add_control(
			'penci_recipe_cooktime', array(
				'label'   => esc_html__( 'Cooking Time:', 'penci-recipe' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '1 Hour',
				'label_block' => true,
				'default' => get_post_meta( get_the_ID(), 'penci_recipe_cooktime', true ),
			)
		);
		$this->add_control(
			'penci_recipe_cooktime_format', array(
				'label'       => esc_html__( 'Cooking Time Structured Data Format:', 'penci-recipe' ),
				'description' => __( 'This is Structured Data time format for Cooking Time, Google and other the search engines will read it. Example: If the Cooking Time is: 2 Hours 30 Minutes, you need fill here: <strong>2H30M</strong> | If the Cooking Time is: 40 Minutes, you need fill here: <strong>40M</strong> | If the Cooking Time is: 2 Hours, you need fill here: <strong>2H</strong>. All characters need uppercase.', 'penci-recipe' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => get_post_meta( get_the_ID(), 'penci_recipe_cooktime_format', true ),
			)
		);
		$this->add_control(
			'penci_recipe_totaltime_format', array(
				'label'       => esc_html__( 'Total Time Structured Data Format:', 'penci-recipe' ),
				'description' => __( 'This is Structured Data time format for Total Time, Google and other the search engines will read it. Example: If the Total Time is: 2 Hours 30 Minutes, you need fill here: <strong>2H30M</strong> | If the Total Time is: 40 Minutes, you need fill here: <strong>40M</strong> | If the Total Time is: 2 Hours, you need fill here: <strong>2H</strong>. All characters need uppercase.', 'penci-recipe' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => get_post_meta( get_the_ID(), 'penci_recipe_totaltime_format', true ),
			)
		);
		$this->add_control(
			'penci_recipe_calories', array(
				'label'   => esc_html__( 'Number calories for this recipe:', 'penci-recipe' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => get_post_meta( get_the_ID(), 'penci_recipe_calories', true ),
			)
		);
		$this->add_control(
			'penci_recipe_fat', array(
				'label'   => esc_html__( 'Number fat for this recipe:', 'penci-recipe' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => get_post_meta( get_the_ID(), 'penci_recipe_fat', true ),
			)
		);
		$this->add_control(
			'penci_recipe_cuisine', array(
				'label'   => esc_html__( 'Recipe Cuisine:', 'penci-recipe' ),
				'type'    => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => get_post_meta( get_the_ID(), 'penci_recipe_cuisine', true ),
			)
		);
		$this->add_control(
			'penci_recipe_keywords', array(
				'label'       => esc_html__( 'Recipe Keywords:', 'penci-recipe' ),
				'description' => __( 'Fill the keywords for your recipe here. Example: <strong>cake for a party, coffee</strong>', 'penci-recipe' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => get_post_meta( get_the_ID(), 'penci_recipe_keywords', true ),
			)
		);
		$this->add_control(
			'penci_recipe_videoid', array(
				'label'       => esc_html__( 'Recipe Video ID:', 'penci-recipe' ),
				'description' => __( 'Fill the Youtube video ID for your recipe here. Example: If the video has URL like this: <br><strong>https://www.youtube.com/watch?v=<span
                                style="color: #6759d2;">YQHsXMglC9A<span></strong> - the video ID will be is <strong>YQHsXMglC9A</strong>', 'penci-recipe' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => get_post_meta( get_the_ID(), 'penci_recipe_videoid', true ),
			)
		);
		$this->add_control(
			'penci_recipe_videotitle', array(
				'label'   => esc_html__( 'Recipe Video Title:', 'penci-recipe' ),
				'type'    => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => get_post_meta( get_the_ID(), 'penci_recipe_videotitle', true ),
			)
		);
		$this->add_control(
			'penci_recipe_videoduration', array(
				'label'       => esc_html__( 'Recipe Video Duration:', 'penci-recipe' ),
				'description' => __( 'Fill the Youtube video duration here. Example: If the video has  duration is: 30 Minutes 17 Secs, you need fill here: <strong>30M17S</strong>', 'penci-recipe' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => get_post_meta( get_the_ID(), 'penci_recipe_videoduration', true ),
			)
		);
		$this->add_control(
			'penci_recipe_videodate', array(
				'label'       => esc_html__( 'Recipe Video Upload Date:', 'penci-recipe' ),
				'description' => __( 'Fill the Youtube video upload date here. Example: <strong>2018-07-31</strong> ( format: YYYY-MM-DD )', 'penci-recipe' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => get_post_meta( get_the_ID(), 'penci_recipe_videodate', true ),
			)
		);
		$this->add_control(
			'penci_recipe_videodes', array(
				'label'   => esc_html__( 'Recipe Video Description:', 'penci-recipe' ),
				'type'    => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => get_post_meta( get_the_ID(), 'penci_recipe_videodes', true ),
			)
		);
		$this->add_control(
			'penci_recipe_ingredients', array(
				'label'   => esc_html__( 'Ingredients:', 'penci-recipe' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => get_post_meta( get_the_ID(), 'penci_recipe_ingredients', true ),
			)
		);
		$this->add_control(
			'penci_recipe_instructions', array(
				'label'   => esc_html__( 'Instructions:', 'penci-recipe' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => get_post_meta( get_the_ID(), 'penci_recipe_instructions', true ),
			)
		);
		$this->add_control(
			'penci_recipe_note', array(
				'label'   => esc_html__( 'Notes:', 'penci-recipe' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => get_post_meta( get_the_ID(), 'penci_recipe_note', true ),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_color', array(
				'label' => esc_html__( 'Recipe Style', 'penci-recipe' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'penci_recipe_acolor', array(
				'label'     => esc_html__( 'Notes:', 'penci-recipe' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ '{{WRAPPER}} .penci-recipe-tagged .prt-icon span, {{WRAPPER}} .penci-recipe-action-buttons .penci-recipe-button:hover' => 'background-color: {{VALUE}}' ],
			)
		);
		$this->add_control(
			'penci_recipe_notebgcolor', array(
				'label'     => esc_html__( 'Notes Background Color:', 'penci-recipe' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ '{{WRAPPER}} .penci-recipe-tagged' => 'background-color: {{VALUE}}' ],
			)
		);

		// title
		$this->add_group_control(
			Group_Control_Typography::get_type(), array(
				'name'     => 'recipe_title_typo_overlay',
				'label'    => __( 'Title Overlay Typography', 'penci-recipe' ),
				'selector' => '{{WRAPPER}} .penci-recipe-heading .recipe-title-nooverlay, {{WRAPPER}} .penci-recipe-heading .recipe-title-overlay',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), array(
				'name'     => 'recipe_title_typo',
				'label'    => __( 'Title Typography', 'penci-recipe' ),
				'selector' => '{{WRAPPER}} .penci-recipe-title',
			)
		);

		$this->add_control(
			'recipe_title_typo_color', array(
				'label'     => esc_html__( 'Title Color', 'penci-recipe' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ '{{WRAPPER}} .penci-recipe-heading .recipe-title-nooverlay, {{WRAPPER}} .penci-recipe-heading .recipe-title-overlay, {{WRAPPER}} .penci-recipe-title' => 'color: {{VALUE}}' ],
			)
		);

		$this->add_control(
			'recipe_rating_typo_color', array(
				'label'     => esc_html__( 'Rating Color', 'penci-recipe' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ '{{WRAPPER}} .penci-recipe-heading .penci-recipe-meta, .penci-recipe-rating' => 'color: {{VALUE}}' ],
			)
		);

		// meta
		$this->add_group_control(
			Group_Control_Typography::get_type(), array(
				'name'     => 'recipe_meta_typo',
				'label'    => __( 'Meta Typography', 'penci-recipe' ),
				'selector' => '{{WRAPPER}} .penci-recipe-heading .penci-recipe-meta, {{WRAPPER}} .penci-recipe-rating, {{WRAPPER}} .precipe-style-2 .penci-recipe-heading .penci-recipe-meta span.remeta-item',
			)
		);

		$this->add_control(
			'recipe_meta_typo_color', array(
				'label'     => esc_html__( 'Meta Color', 'penci-recipe' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ '{{WRAPPER}} .penci-recipe-heading .penci-recipe-meta, {{WRAPPER}} .penci-recipe-rating, {{WRAPPER}} .precipe-style-2 .penci-recipe-heading .penci-recipe-meta span.remeta-item' => 'color: {{VALUE}}' ],
			)
		);

		$this->add_control(
			'recipe_icon_font_size', array(
				'label'     => esc_html__( 'Icons Font Size', 'penci-recipe' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [ '{{WRAPPER}} .precipe-style-2 .penci-recipe-heading .penci-recipe-meta span i, {{WRAPPER}} .precipe-style-2 .penci-ficon.ficon-fire, {{WRAPPER}} .penci-recipe-heading .penci-recipe-meta span i, {{WRAPPER}} .penci-ficon.ficon-fire' => 'font-size: {{SIZE}}{{UNIT}}' ],
			)
		);

		// did you make heading
		$this->add_group_control(
			Group_Control_Typography::get_type(), array(
				'name'     => 'recipe_dym_typo',
				'label'    => __( '"DID YOU MAKE THIS RECIPE?" Heading Typo', 'penci-recipe' ),
				'selector' => '{{WRAPPER}} .penci-recipe-tagged .prt-span-heading',
			)
		);
		$this->add_control(
			'recipe_dym_color', array(
				'label'     => esc_html__( '"DID YOU MAKE THIS RECIPE?" Heading Color', 'penci-recipe' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ '{{WRAPPER}} .penci-recipe-tagged .prt-span-heading' => 'color: {{VALUE}}' ],
			)
		);

		// did you make description
		$this->add_group_control(
			Group_Control_Typography::get_type(), array(
				'name'     => 'recipe_dedym_typo',
				'label'    => __( '"DID YOU MAKE THIS RECIPE?" Description Typo', 'penci-recipe' ),
				'selector' => '{{WRAPPER}} .penci-recipe-tagged .prt-span-des, {{WRAPPER}} .penci-recipe-tagged .prt-span-des *',
			)
		);
		$this->add_control(
			'recipe_dedym_color', array(
				'label'     => esc_html__( '"DID YOU MAKE THIS RECIPE?" Description Color', 'penci-recipe' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ '{{WRAPPER}} .penci-recipe-tagged .prt-span-des, {{WRAPPER}} .penci-recipe-tagged .prt-span-des *' => 'color: {{VALUE}}' ],
			)
		);

		// other colors
		$this->add_control(
			'recipe_bd_color', array(
				'label'     => esc_html__( 'Border Color', 'penci-recipe' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wrapper-penci-recipe .penci-recipe, {{WRAPPER}} .wrapper-penci-recipe .penci-recipe-heading, {{WRAPPER}} .wrapper-penci-recipe .penci-recipe-ingredients, {{WRAPPER}} .wrapper-penci-recipe .penci-recipe-notes' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .precipe-style-4, {{WRAPPER}} .precipe-style-4 .penci-recipe-thumb .recipe-thumb-top'                                                                                                                             => 'border-color: {{VALUE}}'
				],
			)
		);
		$this->add_control(
			'recipe_headingbg_color', array(
				'label'      => esc_html__( 'Heading Background Color', 'penci-recipe' ),
				'type'       => Controls_Manager::COLOR,
				'condition' => [ 'penci_recipe_style' => 'style-4' ],
				'selectors'  => [
					'{{WRAPPER}} .precipe-style-4 .penci-recipe-heading' => 'background-color: {{VALUE}}'
				],
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		if ( 'meta' == $settings['data_source'] ) {
			$this->render_meta( $settings );
		} else {
			$this->render_elementor( $settings );
		}
	}

	protected function render_elementor( $settings ) {

		$recipe_id  = get_the_ID();
		$element_id = $this->get_id();

		// Get recipe meta
		$recipe_style = $settings['penci_recipe_style'];

		$recipe_class = $recipe_style;
		if ( $recipe_style == 'style-3' ) {
			$recipe_class = 'style-2 precipe-style-3';
		}

		$recipe_title        = $settings['penci_recipe_title'];
		$recipe_servings     = $settings['penci_recipe_servings'];
		$recipe_cooktime     = $settings['penci_recipe_cooktime'];
		$recipe_cooktime_fm  = $settings['penci_recipe_cooktime_format'];
		$recipe_preptime     = $settings['penci_recipe_preptime'];
		$recipe_preptime_fm  = $settings['penci_recipe_preptime_format'];
		$recipe_ingredients  = $settings['penci_recipe_ingredients'];
		$recipe_instructions = $settings['penci_recipe_instructions'];
		$recipe_note         = $settings['penci_recipe_note'];

		$recipe_calories      = $settings['penci_recipe_calories'];
		$recipe_fat           = $settings['penci_recipe_fat'];
		$recipe_keywords      = $settings['penci_recipe_keywords'];
		$recipe_cuisine       = $settings['penci_recipe_cuisine'];
		$recipe_videoid       = $settings['penci_recipe_videoid'];
		$recipe_videotitle    = $settings['penci_recipe_videotitle'];
		$recipe_videoduration = $settings['penci_recipe_videoduration'];
		$recipe_videodate     = $settings['penci_recipe_videodate'];
		$recipe_videodes      = $settings['penci_recipe_videodes'];

		$recipe_calories = $recipe_calories ? $recipe_calories : '200';
		$recipe_fat      = $recipe_fat ? $recipe_fat : '20 grams';

		$penci_recipe_rate_total_meta = 'penci_recipe_' . $element_id . '_rate_total';
		$penci_recipe_rate_people     = 'penci_recipe_' . $element_id . '_rate_people';

		if ( ! metadata_exists( 'post', $recipe_id, $penci_recipe_rate_total_meta ) ) {
			add_post_meta( $recipe_id, $penci_recipe_rate_total_meta, '5' );
		}
		if ( ! metadata_exists( 'post', $recipe_id, $penci_recipe_rate_people ) ) {
			add_post_meta( $recipe_id, $penci_recipe_rate_people, '1' );
		}

		$rate_total  = get_post_meta( $recipe_id, $penci_recipe_rate_total_meta, true );
		$rate_people = get_post_meta( $recipe_id, $penci_recipe_rate_people, true );

		// Turn ingredients into an array
		$recipe_ingredients_array = '';
		if ( $recipe_ingredients ):
			$recipe_ingredients_trim  = wp_strip_all_tags( $recipe_ingredients );
			$recipe_ingredients_array = preg_split( '/\r\n|[\r\n]/', $recipe_ingredients_trim );
		endif;

		// Rate number
		$rate_number = 5;
		if ( $rate_total && $rate_people ) {
			$rate_number = number_format( intval( $rate_total ) / intval( $rate_people ), 1 );
			if ( ( $rate_number * 10 ) > 50 ) {
				$rate_number = '5.0';
			}
		}
		$allow_rate = 1;
		if ( isset( $_COOKIE[ 'recipe_rate_postid_' . $recipe_id ] ) ) {
			$allow_rate = 0;
		}

		$rand = rand( 100, 9999 );
		wp_enqueue_script( 'jquery-recipe-print' );
		$excerpt = has_excerpt() ? get_the_excerpt() : get_the_title();

		$thumb_alt = $thumb_title_html = '';
		$thumb_id  = '';

		if ( isset( $settings['penci_recipe_custom_featured_image']['id'] ) ) {
			$thumb_id = $settings['penci_recipe_custom_featured_image']['id'];
		} elseif ( has_post_thumbnail( $recipe_id ) ) {
			$thumb_id = get_post_thumbnail_id( $recipe_id );
		}

		if ( $thumb_id && function_exists( 'penci_get_image_alt' ) && function_exists( 'penci_get_image_title' ) ) {
			$thumb_alt        = penci_get_image_alt( $thumb_id, $recipe_id );
			$thumb_title_html = penci_get_image_title( $thumb_id );
		}

		$flag_title = false;
		$flag_style = false;
		if ( in_array( $recipe_style, array(
				'style-2',
				'style-3'
			) ) && $settings['penci_recipe_title_overlay'] && ! $settings['penci_recipe_featured_image'] ): $flag_title = true; endif;
		if ( in_array( $recipe_style, array( 'style-2', 'style-3' ) ) ): $flag_style = true; endif;
		$recipe_url = get_the_permalink( $recipe_id );
		$pin_url    = 'https://www.pinterest.com/pin/create/button/?url=' . urlencode( $recipe_url );
		if ( has_post_thumbnail( $recipe_id ) ) {
			$pin_url .= '&media=' . urlencode( get_the_post_thumbnail_url( $recipe_id, 'penci-full-thumb' ) );
		}
		if ( $recipe_title ) {
			$pin_url .= '&description=' . urlencode( $recipe_title );
		}
		?>
        <div id="penci-recipe-card"></div>
        <div class="wrapper-penci-recipe<?php if ( $settings['penci_recipe_make_trecipe'] ): echo ' showing-tagged-recipe'; endif; ?>">
            <div class="penci-recipe<?php if ( $settings['penci_recipe_featured_image'] ): echo ' penci-recipe-hide-featured'; endif; ?><?php if ( $settings['penci_recipe_hide_image_print'] ): echo ' penci-hide-images-print'; endif; ?><?php if ( $flag_title == true ) {
				echo ' penci-recipe-overtitle';
			} else {
				echo ' penci-recipe-novertitle';
			} ?> precipe-<?php echo esc_attr( $recipe_class ); ?>">
                <div class="penci-recipe-heading">

					<?php if ( ! $settings['penci_recipe_featured_image'] ): ?>
						<?php $sthumb = 'penci-thumb-square';
						if ( $flag_style == true ) {
							$sthumb = 'penci-full-thumb';
						}
						$thumb_url = get_the_post_thumbnail_url( $recipe_id, $sthumb );
						if ( isset( $settings['penci_recipe_custom_featured_image']['url'] ) ) {
							$custom_thumb_url = $settings['penci_recipe_custom_featured_image']['url'];
							$thumb_url        = $custom_thumb_url ? $custom_thumb_url : $thumb_url;
						}

						?>
                        <div class="penci-recipe-thumb">
							<?php if ( $recipe_style == 'style-4' ): echo '<span class="recipe-thumb-top">'; endif; ?>
                            <img src="<?php echo esc_url( $thumb_url ); ?>"
                                 alt="<?php echo esc_attr( $thumb_alt ); ?>"<?php echo esc_html( $thumb_title_html ); ?> />
							<?php if ( $recipe_style == 'style-4' ): echo '</span>'; endif; ?>
							<?php if ( $recipe_title && $recipe_style == 'style-2' && $settings['penci_recipe_title_overlay'] ) { ?>
                                <h2 class="recipe-title-overlay"><?php echo esc_html( $recipe_title ); ?></h2>
							<?php } ?>
							<?php if ( $flag_style == true && ( $settings['penci_recipe_print'] || $settings['penci_recipe_pinterest'] ) ) { ?>
                                <div class="wrapper-buttons-overlay">
									<?php if ( $settings['penci_recipe_pinterest'] ) : ?>
                                        <a href="<?php echo esc_url( $pin_url ); ?>" target="_blank" class="penci-recipe-pin"
                                           data-print="<?php echo plugin_dir_url( __FILE__ ) . 'print.css?ver=' . PENCI_RECIPE_VER; ?>"><?php if ( function_exists( 'penci_fawesome_icon' ) ) {
												penci_fawesome_icon( 'fas fa-pinterest-p' );
											} else {
												echo '<i class="fa fa-pinterest-p"></i>';
											} ?><?php if ( get_theme_mod( 'penci_recipe_pin_text' ) ) {
												echo do_shortcode( get_theme_mod( 'penci_recipe_pin_text' ) );
											} else {
												esc_html_e( 'Pin', 'penci-recipe' );
											} ?></a>
									<?php endif; ?>
									<?php if ( $settings['penci_recipe_print'] ) : ?>
                                        <a href="#" class="penci-recipe-print-btn penci-recipe-print-overlay"
                                           data-print="<?php echo plugin_dir_url( __FILE__ ) . 'print.css?ver=' . PENCI_RECIPE_VER; ?>"><?php if ( function_exists( 'penci_fawesome_icon' ) ) {
												penci_fawesome_icon( 'fas fa-print' );
											} else {
												echo '<i class="fa fa-print"></i>';
											} ?><?php if ( get_theme_mod( 'penci_recipe_print_text' ) ) {
												echo do_shortcode( get_theme_mod( 'penci_recipe_print_text' ) );
											} else {
												esc_html_e( 'Print', 'penci-recipe' );
											} ?></a>
									<?php endif; ?>
									<?php if ( $recipe_title && $recipe_style == 'style-3' && $settings['penci_recipe_title_overlay'] ) { ?>
                                        <h2 class="recipe-title-overlay"><?php echo esc_html( $recipe_title ); ?></h2>
									<?php } ?>
                                </div>
							<?php } ?>
							<?php if ( $recipe_title && $flag_title == true ) { ?>
                                <div class="recipe-header-overlay"></div>
							<?php } ?>
                        </div>
					<?php endif; ?>

                    <div class="penci-recipe-metades">
						<?php if ( $recipe_title && $flag_title != true ) : ?>
                            <h2 class="recipe-title-nooverlay"><?php echo esc_html( $recipe_title ); ?></h2>
						<?php endif; ?>

						<?php if ( $settings['penci_recipe_print'] && $recipe_style == 'style-1' ) : ?>
                            <a href="#" class="penci-recipe-print-btn penci-recipe-print"
                               data-print="<?php echo plugin_dir_url( __FILE__ ) . 'print.css?ver=' . PENCI_RECIPE_VER; ?>"><?php if ( function_exists( 'penci_fawesome_icon' ) ) {
									penci_fawesome_icon( 'fas fa-print' );
								} else {
									echo '<i class="fa fa-print"></i>';
								} ?><?php if ( get_theme_mod( 'penci_recipe_print_text' ) ) {
									echo do_shortcode( get_theme_mod( 'penci_recipe_print_text' ) );
								} else {
									esc_html_e( 'Print', 'penci-recipe' );
								} ?></a>
						<?php endif; ?>

						<?php if ( ! $settings['penci_recipe_rating'] && $flag_style == true ) : ?>
                            <div class="penci-recipe-rating penci-recipe-review">
								<span class="penci-rate-text">
									<?php if ( get_theme_mod( 'penci_recipe_rating_text' ) ) {
										echo do_shortcode( get_theme_mod( 'penci_recipe_rating_text' ) ) . ' ';
									} else {
										esc_html_e( 'Rating: ', 'penci-recipe' );
									} ?>
									<span class="penci-rate-number"><?php echo esc_html( $rate_number ); ?></span>/5
								</span>
                                <div class="penci_rateyo" id="penci_rateyo"
                                     data-allow="<?php esc_attr_e( $allow_rate ) ?>"
                                     data-rate="<?php esc_attr_e( $rate_number ); ?>"
                                     data-postid="<?php esc_attr_e( $recipe_id ); ?>"
                                     data-postidsub="<?php esc_attr_e( $element_id ); ?>"
                                     data-people="<?php echo esc_attr( $rate_people ); ?>"
                                     data-total="<?php echo esc_attr( $rate_total ); ?>"></div>
                                <span class="penci-numbers-rate">( <span
                                            class="penci-number-people"><?php echo esc_attr( $rate_people ); ?></span> <?php if ( get_theme_mod( 'penci_recipe_voted_text' ) ) {
										echo do_shortcode( get_theme_mod( 'penci_recipe_voted_text' ) );
									} else {
										esc_html_e( 'voted', 'penci-recipe' );
									} ?> )</span>
                            </div>
						<?php endif; ?>

						<?php if ( $recipe_servings || $recipe_cooktime || $recipe_preptime ) : ?>
                            <div class="penci-recipe-meta">
								<?php if ( $recipe_servings ) : ?><span>
                                    <i class="penci-ficon ficon-hot-food"></i> <span
                                            class="remeta-item"><?php if ( get_theme_mod( 'penci_recipe_serves_text' ) ) {
											echo do_shortcode( get_theme_mod( 'penci_recipe_serves_text' ) );
										} else {
											esc_html_e( 'Serves', 'penci-recipe' );
										} ?>:</span> <span class="servings"><?php echo esc_html( $recipe_servings ); ?></span>
                                    </span>
								<?php endif; ?>
								<?php if ( $recipe_preptime ) : ?>
                                    <span>
									<i class="penci-ficon ficon-clock"></i> <span
                                                class="remeta-item"><?php if ( get_theme_mod( 'penci_recipe_prep_time_text' ) ) {
												echo do_shortcode( get_theme_mod( 'penci_recipe_prep_time_text' ) );
											} else {
												esc_html_e( 'Prep Time', 'penci-recipe' );
											} ?>:</span> <time <?php if ( $recipe_preptime_fm ): echo 'datetime="PT' . $recipe_preptime_fm . '" '; endif; ?>><?php echo esc_html( $recipe_preptime ); ?></time>
									</span>
								<?php endif; ?>
								<?php if ( $recipe_cooktime ) : ?>
                                    <span>
									<i class="penci-ficon ficon-cooking"></i> <span
                                                class="remeta-item"><?php if ( get_theme_mod( 'penci_recipe_cooking_text' ) ) {
												echo do_shortcode( get_theme_mod( 'penci_recipe_cooking_text' ) );
											} else {
												esc_html_e( 'Cooking Time', 'penci-recipe' );
											} ?>:</span> <time <?php if ( $recipe_cooktime_fm ): echo 'datetime="PT' . $recipe_cooktime_fm . '" '; endif; ?>><?php echo esc_html( $recipe_cooktime ); ?></time>
									<time class="penci-hide-tagupdated" <?php if ( $recipe_cooktime_fm ): echo 'datetime="PT' . $recipe_cooktime_fm . '" '; endif; ?>><?php echo esc_html( $recipe_cooktime ); ?></time>
									</span>
								<?php endif; ?>
								<?php if ( ! $settings['penci_recipe_remove_nutrition'] && $flag_style == true ): ?>
                                    <span class="penci-nutrition-meta<?php if ( $settings['penci_recipe_nutrition'] ): echo ' penci-show-nutrition'; endif; ?>">
										<i class="penci-ficon ficon-fire"></i>
										<span class="remeta-item nutrition-lable"><?php if ( get_theme_mod( 'penci_recipe_nutrition_text' ) ) {
												echo do_shortcode( get_theme_mod( 'penci_recipe_nutrition_text' ) );
											} else {
												esc_html_e( 'Nutrition facts:', 'penci-recipe' );
											} ?></span>
										<span class="nutrition-item<?php if ( ! $settings['penci_recipe_calories'] ): echo ' penci-hide-nutrition'; endif; ?>"><?php echo esc_html( $recipe_calories ) . ' ';
											if ( get_theme_mod( 'penci_recipe_calories_text' ) ) {
												echo do_shortcode( get_theme_mod( 'penci_recipe_calories_text' ) );
											} else {
												esc_html_e( 'calories', 'penci-recipe' );
											} ?></span>
										<span class="nutrition-item<?php if ( ! $settings['penci_recipe_fat'] ): echo ' penci-hide-nutrition'; endif; ?>"><?php echo esc_html( $recipe_fat ) . ' ';
											if ( get_theme_mod( 'penci_recipe_fat_text' ) ) {
												echo do_shortcode( get_theme_mod( 'penci_recipe_fat_text' ) );
											} else {
												esc_html_e( 'fat', 'penci-recipe' );
											} ?></span>
									</span>
								<?php endif; ?>
                            </div>
						<?php endif; ?>

						<?php if ( ! $settings['penci_recipe_remove_nutrition'] && $flag_style != true ) : ?>
                            <div class="penci-recipe-rating penci-nutrition<?php if ( get_theme_mod( 'penci_recipe_nutrition' ) ): echo ' penci-show-nutrition'; endif; ?>">
                                <i class="penci-ficon ficon-fire"></i><span
                                        class="nutrition-lable"><?php if ( get_theme_mod( 'penci_recipe_nutrition_text' ) ) {
										echo do_shortcode( get_theme_mod( 'penci_recipe_nutrition_text' ) );
									} else {
										esc_html_e( 'Nutrition facts:', 'penci-recipe' );
									} ?></span>
                                <span class="nutrition-item<?php if ( $settings['penci_recipe_calories'] ): echo ' penci-hide-nutrition'; endif; ?>"><?php echo esc_html( $recipe_calories ) . ' ';
									if ( get_theme_mod( 'penci_recipe_calories_text' ) ) {
										echo do_shortcode( get_theme_mod( 'penci_recipe_calories_text' ) );
									} else {
										esc_html_e( 'calories', 'penci-recipe' );
									} ?></span>
                                <span class="nutrition-item<?php if ( $settings['penci_recipe_fat'] ): echo ' penci-hide-nutrition'; endif; ?>"><?php echo esc_html( $recipe_fat ) . ' ';
									if ( get_theme_mod( 'penci_recipe_fat_text' ) ) {
										echo do_shortcode( get_theme_mod( 'penci_recipe_fat_text' ) );
									} else {
										esc_html_e( 'fat', 'penci-recipe' );
									} ?></span>
                            </div>
						<?php endif; ?>

						<?php if ( ! $settings['penci_recipe_rating'] && $flag_style != true ) : ?>
                            <div class="penci-recipe-rating penci-recipe-review">
								<span class="penci-rate-text">
									<?php if ( get_theme_mod( 'penci_recipe_rating_text' ) ) {
										echo do_shortcode( get_theme_mod( 'penci_recipe_rating_text' ) ) . ' ';
									} else {
										esc_html_e( 'Rating: ', 'penci-recipe' );
									} ?>
									<span class="penci-rate-number"><?php echo esc_html( $rate_number ); ?></span>/5
								</span>
                                <div class="penci_rateyo" id="penci_rateyo"
                                     data-allow="<?php esc_attr_e( $allow_rate ) ?>"
                                     data-rate="<?php esc_attr_e( $rate_number ); ?>"
                                     data-postid="<?php esc_attr_e( $recipe_id ); ?>"
                                     data-people="<?php echo esc_attr( $rate_people ); ?>"
                                     data-total="<?php echo esc_attr( $rate_total ); ?>"></div>
                                <span class="penci-numbers-rate">( <span
                                            class="penci-number-people"><?php echo esc_html( $rate_people ); ?></span> <?php if ( get_theme_mod( 'penci_recipe_voted_text' ) ) {
										echo do_shortcode( get_theme_mod( 'penci_recipe_voted_text' ) );
									} else {
										esc_html_e( 'voted', 'penci-recipe' );
									} ?> )</span>
                            </div>
						<?php endif; ?>
                    </div>
                </div>

				<?php if ( $recipe_style == 'style-4' && ( $settings['penci_recipe_print'] || $settings['penci_recipe_pinterest'] ) ) { ?>
                    <div class="wrapper-buttons-style4">
						<?php if ( $settings['penci_recipe_pinterest'] ) : ?>
                            <div class="wrapper-col-btn">
                                <a href="<?php echo esc_url( $pin_url ); ?>" target="_blank" class="penci-recipe-pin"
                                   data-print="<?php echo plugin_dir_url( __FILE__ ) . 'print.css?ver=' . PENCI_RECIPE_VER; ?>"><?php if ( function_exists( 'penci_fawesome_icon' ) ) {
										penci_fawesome_icon( 'fas fa-pinterest-p' );
									} else {
										echo '<i class="fa fa-pinterest-p"></i>';
									} ?><?php if ( get_theme_mod( 'penci_recipe_pin_text' ) ) {
										echo do_shortcode( get_theme_mod( 'penci_recipe_pin_text' ) );
									} else {
										esc_html_e( 'Pin', 'penci-recipe' );
									} ?></a>
                            </div>
						<?php endif; ?>
						<?php if ( $settings['penci_recipe_print'] ) : ?>
                            <div class="wrapper-col-btn">
                                <a href="#" class="penci-recipe-print-btn penci-recipe-print-overlay"
                                   data-print="<?php echo plugin_dir_url( __FILE__ ) . 'print.css?ver=' . PENCI_RECIPE_VER; ?>"><?php if ( function_exists( 'penci_fawesome_icon' ) ) {
										penci_fawesome_icon( 'fas fa-print' );
									} else {
										echo '<i class="fa fa-print"></i>';
									} ?><?php if ( get_theme_mod( 'penci_recipe_print_text' ) ) {
										echo do_shortcode( get_theme_mod( 'penci_recipe_print_text' ) );
									} else {
										esc_html_e( 'Print', 'penci-recipe' );
									} ?></a>
                            </div>
						<?php endif; ?>
                    </div>
				<?php } ?>

				<?php if ( $recipe_ingredients ) : ?>
                    <div class="penci-recipe-ingredients penci-recipe-ingre-visual">
                        <h3 class="penci-recipe-title"><?php if ( get_theme_mod( 'penci_recipe_ingredients_text' ) ) {
								echo do_shortcode( get_theme_mod( 'penci_recipe_ingredients_text' ) );
							} else {
								esc_html_e( 'Ingredients', 'penci-recipe' );
							} ?></h3>

						<?php
						echo do_shortcode( wpautop( htmlspecialchars_decode( $recipe_ingredients ) ) );
						?>

                    </div>
				<?php endif; ?>

				<?php if ( $recipe_instructions ) : ?>
                    <div class="penci-recipe-method">
                        <h3 class="penci-recipe-title"><?php if ( get_theme_mod( 'penci_recipe_instructions_text' ) ) {
								echo do_shortcode( get_theme_mod( 'penci_recipe_instructions_text' ) );
							} else {
								esc_html_e( 'Instructions', 'penci-recipe' );
							} ?></h3>
						<?php
						echo do_shortcode( wpautop( htmlspecialchars_decode( $recipe_instructions ) ) );
						?>
                    </div>
				<?php endif; ?>

				<?php if ( $recipe_note ) : ?>
                    <div class="penci-recipe-notes penci-recipe-notes-novisual">
                        <h3 class="penci-recipe-title"><?php if ( get_theme_mod( 'penci_recipe_notes_text' ) ) {
								echo do_shortcode( get_theme_mod( 'penci_recipe_notes_text' ) );
							} else {
								esc_html_e( 'Notes', 'penci-recipe' );
							} ?></h3>
						<?php
						echo do_shortcode( wpautop( htmlspecialchars_decode( $recipe_note ) ) );
						?>
                    </div>
				<?php endif; ?>
            </div>
        </div>
		<?php if ( $settings['penci_recipe_make_trecipe'] ): ?>
            <div class="penci-recipe-tagged">
				<span class="prt-wrap-span prt-icon"><span><?php if ( function_exists( 'penci_fawesome_icon' ) ) {
							penci_fawesome_icon( 'fab fa-instagram' );
						} else {
							echo '<i class="fa fa-instagram"></i>';
						} ?></span></span>
                <div class="prt-wrap-span prt-wrap-spantext">
					<span class="prt-span-heading"><?php if ( $settings['penci_recipe_did_you_make'] ) {
							echo do_shortcode( $settings['penci_recipe_did_you_make'] );
						} else {
							esc_html_e( 'Did You Make This Recipe?', 'penci-recipe' );
						} ?></span>
					<div class="prt-span-des"><?php if ( $settings['penci_recipe_descmake_recipe'] ) {
							echo do_shortcode( $settings['penci_recipe_descmake_recipe'] );
						} else {
							echo 'How you went with my recipes? Tag me on Instagram at <a href="https://www.instagram.com/">@PenciDesign.</a>';
						} ?></div>
				</div>
            </div>
		<?php endif;
	}

	protected function render_meta( $settings ) {
		$style = $settings['penci_recipe_style'];

		$post_id = get_the_ID();

		$meta_keys = [
			'penci_recipe_title',
			'penci_recipe_servings',
			'penci_recipe_cooktime',
			'penci_recipe_cooktime_format',
			'penci_recipe_preptime',
			'penci_recipe_preptime_format',
			'penci_recipe_ingredients',
			'penci_recipe_instructions',
			'penci_recipe_note',
			'penci_recipe_calories',
			'penci_recipe_fat',
			'penci_recipe_keywords',
			'penci_recipe_cuisine',
			'penci_recipe_videoid',
			'penci_recipe_videotitle',
			'penci_recipe_videoduration',
			'penci_recipe_videodate',
			'penci_recipe_videodes',
		];

		foreach ( $meta_keys as $key_id => $meta ) {
			$meta_arr_value = $settings[ $meta ];
			if ( $meta_arr_value ) {
				update_post_meta( $post_id, $meta, $meta_arr_value );
			}
		}

		$options_keys = [
			'penci_recipe_style',
			'option_penci_recipe_fat',
			'penci_recipe_remove_nutrition',
			'penci_recipe_calories', //penci_hide_recipe_calories
			'penci_recipe_make_trecipe',
			'penci_recipe_featured_image',
			'penci_recipe_title_overlay',
			'penci_recipe_hide_image_print',
			'penci_recipe_print',
			'penci_recipe_pinterest',
			'penci_recipe_rating',
		];

		foreach ( $options_keys as $key ) {
			$option_value = $settings[ $key ];
			add_filter( 'theme_mod_' . $key, function ( $value ) use ( $option_value ) {
				return $option_value ? $option_value : $value;
			} );
		}

		add_filter( 'theme_mod_penci_recipe_notes_visual', '__return_true' );
		add_filter( 'theme_mod_penci_recipe_ingredients_visual', '__return_true' );

		if ( function_exists( 'penci_recipe_shortcode_function' ) ) {
			echo penci_recipe_shortcode_function( array(
				'id'    => $post_id,
				'style' => $style
			) );
		}
	}
}
