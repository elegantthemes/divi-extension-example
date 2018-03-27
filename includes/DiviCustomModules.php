<?php

// Remove comment block of constant below to activate debug mode
// define( 'DICM_DEBUG', true );

class DICM_DiviCustomModules extends DiviExtension {

	/**
	 * The gettext domain for the extension's translations.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $gettext_domain = 'dicm-divi-custom-modules';

	/**
	 * The extension's WP Plugin name.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $name = 'divi-custom-modules';

	/**
	 * The extension's version
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $version = '1.0.0';

	/**
	 * DICM_DiviCustomModules constructor.
	 *
	 * @param string $name
	 * @param array  $args
	 */
	public function __construct( $name = 'divi-custom-modules', $args = array() ) {
		$this->plugin_dir     = plugin_dir_path( __DIR__ );
		$this->plugin_dir_url = plugin_dir_url( $this->plugin_dir );
		$this->builder_localize_script = array(
			'i10n' => array(
				'dicm_cta_all_options' => array(
					'basic_fields'         => esc_html__( 'Basic Fields', 'dicm-divi-custom-modules' ),
					'text'                 => esc_html__( 'Text', 'dicm-divi-custom-modules' ),
					'textarea'             => esc_html__( 'Textarea', 'dicm-divi-custom-modules' ),
					'select'               => esc_html__( 'Select', 'dicm-divi-custom-modules' ),
					'toggle'               => esc_html__( 'Toggle', 'dicm-divi-custom-modules' ),
					'multiple_buttons'     => esc_html__( 'Multiple Buttons', 'dicm-divi-custom-modules' ),
					'multiple_checkboxes'  => esc_html__( 'Multiple Checkboxes', 'dicm-divi-custom-modules' ),
					'input_range'          => esc_html__( 'Input Range', 'dicm-divi-custom-modules' ),
					'input_datetime'       => esc_html__( 'Input Date Time', 'dicm-divi-custom-modules' ),
					'input_margin'         => esc_html__( 'Input Margin', 'dicm-divi-custom-modules' ),
					'checkboxes_category'  => esc_html__( 'Checkboxes Category', 'dicm-divi-custom-modules' ),
					'select_sidebar'       => esc_html__( 'Select Sidebar', 'dicm-divi-custom-modules' ),
					'code_fields'          => esc_html__( 'Code Fields', 'dicm-divi-custom-modules' ),
					'codemirror'           => esc_html__( 'Codemirror', 'dicm-divi-custom-modules' ),
					'prop_value'           => esc_html__( 'Prop value: ', 'dicm-divi-custom-modules' ),
					'rendered_prop_value'  => esc_html__( 'Rendered prop value: ', 'dicm-divi-custom-modules' ),
					'form_fields'          => esc_html__( 'Form Fields', 'dicm-divi-custom-modules' ),
					'option_list'          => esc_html__( 'Option List', 'dicm-divi-custom-modules' ),
					'option_list_checkbox' => esc_html__( 'Option List Checkbox', 'dicm-divi-custom-modules' ),
					'option_list_radio'    => esc_html__( 'Option List Radio', 'dicm-divi-custom-modules' ),
					'typography_fields'    => esc_html__( 'Typography Fields', 'dicm-divi-custom-modules' ),
					'select_font_icon'     => esc_html__( 'Select Font Icon', 'dicm-divi-custom-modules' ),
					'select_text_align'    => esc_html__( 'Select Text Align', 'dicm-divi-custom-modules' ),
					'select_font'          => esc_html__( 'Select Font', 'dicm-divi-custom-modules' ),
					'color_fields'         => esc_html__( 'Color Fields', 'dicm-divi-custom-modules' ),
					'color'                => esc_html__( 'Color', 'dicm-divi-custom-modules' ),
					'color_alpha'          => esc_html__( 'Color Alpha', 'dicm-divi-custom-modules' ),
					'upload_fields'        => esc_html__( 'Upload Fields', 'dicm-divi-custom-modules' ),
					'upload'               => esc_html__( 'Upload', 'dicm-divi-custom-modules' ),
					'advanced_fields'      => esc_html__( 'Advanced Fields', 'dicm-divi-custom-modules' ),
					'tab_1_text'           => esc_html__( 'Tab 1 Text', 'dicm-divi-custom-modules' ),
					'tab_2_text'           => esc_html__( 'Tab 2 Text', 'dicm-divi-custom-modules' ),
					'presets_shadow'       => esc_html__( 'Presets Shadow', 'dicm-divi-custom-modules' ),
					'preset_affected_1'    => esc_html__( 'Preset Affected 1', 'dicm-divi-custom-modules' ),
					'preset_affected_2'    => esc_html__( 'Preset Affected 2', 'dicm-divi-custom-modules' ),
				),
			),
		);

		parent::__construct( $name, $args );
	}
}

new DICM_DiviCustomModules;
