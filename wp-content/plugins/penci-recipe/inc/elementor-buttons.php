<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PenciRecipeButtonsElementor extends \Elementor\Widget_Base {

	public function get_name() {
		return 'penci-recipe-buttons';
	}

	public function get_title() {
		if ( function_exists( 'penci_get_theme_name' ) ) {
			return penci_get_theme_name( 'Penci' ) . ' ' . esc_html__( ' Recipe Buttons', 'penci-recipe' );
		} else {
			return esc_html__( 'Penci Recipe Buttons', 'penci-recipe' );
		}
	}

	public function get_icon() {
		return 'eicon-button';
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
				'label' => esc_html__( 'Recipe Buttons', 'penci-recipe' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_responsive_control(
			'buttons_align',
			array(
				'label'     => __( 'Action Buttons Alignment', 'elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => __( 'Left', 'elementor' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'elementor' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'elementor' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .penci-recipe-action-buttons' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'penci_recipe_jump_button',
			array(
				'label'   => __( 'Show Jump Button', 'elementor' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'jumptotext',
			array(
				'label'       => __( 'Jump to Recipe Text', 'elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'condition'   => [ 'penci_recipe_jump_button' => 'yes' ],
				'default'     => esc_html__( 'Jump to Recipe', 'penci-recipe' ),
			)
		);

		$this->add_control(
			'penci_recipe_print_btn',
			array(
				'label'   => __( 'Show Print Button', 'elementor' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'penci_recipe_print_btn_text',
			array(
				'label'       => __( 'Print Recipe Text', 'elementor' ),
				'label_block' => true,
				'condition'   => [ 'penci_recipe_print_btn' => 'yes' ],
				'type'        => Controls_Manager::TEXT,
				'default'     => get_theme_mod( 'penci_recipe_print_btn_text' ) ? do_shortcode( get_theme_mod( 'penci_recipe_print_btn_text' ) ) : esc_html__( 'Print Recipe', 'penci-recipe' ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style', array(
				'label' => esc_html__( 'Button Style', 'penci-recipe' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'btn_heading',
			array(
				'label' => __( 'Button Typography', 'elementor' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), array(
				'name'     => 'btn_heading_fonts',
				'label'    => __( 'Buttons Font', 'penci-recipe' ),
				'selector' => '{{WRAPPER}} .penci-recipe-action-buttons .penci-recipe-button',
			)
		);

		// jump button

		$this->add_control(
			'jumbtn_heading',
			array(
				'label' => __( 'Jump to Recipe', 'elementor' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->start_controls_tabs(
			'recipe_btn_groups'
		);

		$this->start_controls_tab(
			'recipe_btn_normal',
			[
				'label' => esc_html__( 'Normal', 'penci-recipe' ),
			]
		);

		$this->add_control(
			'jump_btn_txtcl', array(
				'label'     => esc_html__( 'Text Color', 'penci-recipe' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ '{{WRAPPER}} .penci-recipe-action-buttons .penci-recipe-button.penci-jump-recipe' => 'color: {{VALUE}}' ],
			)
		);

		$this->add_control(
			'jump_btn_bgcl', array(
				'label'     => esc_html__( 'Background Color', 'penci-recipe' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ '{{WRAPPER}} .penci-recipe-action-buttons .penci-recipe-button.penci-jump-recipe' => 'background: {{VALUE}}' ],
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'recipe_btn_hover',
			[
				'label' => esc_html__( 'Hover', 'penci-recipe' ),
			]
		);

		$this->add_control(
			'jump_btn_txthcl', array(
				'label'     => esc_html__( 'Text Color', 'penci-recipe' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ '{{WRAPPER}} .penci-recipe-action-buttons .penci-recipe-button.penci-jump-recipe:hover' => 'color: {{VALUE}}' ],
			)
		);

		$this->add_control(
			'jump_btn_bghcl', array(
				'label'     => esc_html__( 'Background Color', 'penci-recipe' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ '{{WRAPPER}} .penci-recipe-action-buttons .penci-recipe-button.penci-jump-recipe:hover' => 'background: {{VALUE}}' ],
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		// prints button

		$this->add_control(
			'printbtn_heading',
			array(
				'label' => __( 'Print Recipe', 'elementor' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->start_controls_tabs(
			'recipe_pbtn_groups'
		);

		$this->start_controls_tab(
			'recipe_pbtn_normal',
			[
				'label' => esc_html__( 'Normal', 'penci-recipe' ),
			]
		);

		$this->add_control(
			'print_btn_txtcl', array(
				'label'     => esc_html__( 'Text Color', 'penci-recipe' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ '{{WRAPPER}} .penci-recipe-action-buttons .penci-recipe-button.penci-printbutton-recipe' => 'color: {{VALUE}}' ],
			)
		);

		$this->add_control(
			'print_btn_bgcl', array(
				'label'     => esc_html__( 'Background Color', 'penci-recipe' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ '{{WRAPPER}} .penci-recipe-action-buttons .penci-recipe-button.penci-printbutton-recipe' => 'color: {{VALUE}}' ],
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'recipe_btn_print_hover',
			[
				'label' => esc_html__( 'Hover', 'penci-recipe' ),
			]
		);

		$this->add_control(
			'print_btn_txthcl', array(
				'label'     => esc_html__( 'Text Color', 'penci-recipe' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ '{{WRAPPER}} .penci-recipe-action-buttons .penci-recipe-button.penci-printbutton-recipe:hover' => 'color: {{VALUE}}' ],
			)
		);

		$this->add_control(
			'print_btn_bghcl', array(
				'label'     => esc_html__( 'Background Color', 'penci-recipe' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ '{{WRAPPER}} .penci-recipe-action-buttons .penci-recipe-button.penci-printbutton-recipe:hover' => 'color: {{VALUE}}' ],
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		echo '<div class="penci-recipe-action-buttons">';
		if ( $settings['penci_recipe_jump_button'] ):
			$jump_text = $settings['jumptotext'];
			?>
            <a class="penci-recipe-button penci-jump-recipe"
               href="#penci-recipe-card"><?php if ( function_exists( 'penci_fawesome_icon' ) ) {
					penci_fawesome_icon( 'fas fa-arrow-down' );
				} else {
					echo '<i class="fa fa-angle-down"></i>';
				}
				echo $jump_text; ?></a>
		<?php
		endif;
		if ( $settings['penci_recipe_print_btn'] ):
			$printbtn_text = $settings['penci_recipe_print_btn_text'];
			?>
            <a class="penci-recipe-button penci-recipe-print-btn penci-printbutton-recipe" href="#"
               data-print="<?php echo plugin_dir_url( __FILE__ ) . 'print.css?ver=' . PENCI_RECIPE_VER; ?>"><?php if ( function_exists( 'penci_fawesome_icon' ) ) {
					penci_fawesome_icon( 'fas fa-print' );
				} else {
					echo '<i class="fa fa-print"></i>';
				}
				echo $printbtn_text; ?></a>
		<?php
		endif;
		echo '</div>';
	}
}
