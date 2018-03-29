<?php
/**
 * Basic Call To Action module (title, content, and button) with NO builder support
 * This module appears as placeholder box on Visual Builder
 *
 * @since 1.0.0
 */
class DICM_CTA extends ET_Builder_Module {
	// Module slug (also used as shortcode tag)
	public $slug       = 'dicm_cta';

	/**
	 * Module properties initialization
	 *
	 * @since 1.0.0
	 */
	function init() {
		// Module name
		$this->name             = esc_html__( 'Custom CTA', 'dicm-divi-custom-modules' );

		// Module Icon
		// This character will be rendered using etbuilder font-icon. For fully customized icon, create svg icon and
		// define its path on $this->icon_path property (see CustomCTAFull class)
		$this->icon             = 'j';

		// Toggle settings
		$this->settings_modal_toggles  = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => esc_html__( 'Text', 'dicm-divi-custom-modules' ),
					'button'       => esc_html__( 'Button', 'dicm-divi-custom-modules' ),
				),
			),
		);
	}

	/**
	 * Module's specific fields
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	function get_fields() {
		return array(
			'title' => array(
				'label'           => esc_html__( 'Title', 'dicm-divi-custom-modules' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Text entered here will appear as title.', 'dicm-divi-custom-modules' ),
				'toggle_slug'     => 'main_content',
			),
			'content' => array(
				'label'           => esc_html__( 'Content', 'dicm-divi-custom-modules' ),
				'type'            => 'tiny_mce',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Content entered here will appear inside the module.', 'dicm-divi-custom-modules' ),
				'toggle_slug'     => 'main_content',
			),
			'button_text' => array(
				'label'           => esc_html__( 'Button Text', 'dicm-divi-custom-modules' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Input your desired button text, or leave blank for no button.', 'dicm-divi-custom-modules' ),
				'toggle_slug'     => 'button',
			),
			'button_url' => array(
				'label'           => esc_html__( 'Button URL', 'dicm-divi-custom-modules' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Input URL for your button.', 'dicm-divi-custom-modules' ),
				'toggle_slug'     => 'button',
			),
			'button_url_new_window' => array(
				'default'         => 'off',
				'default_on_front'=> true,
				'label'           => esc_html__( 'Url Opens', 'dicm-divi-custom-modules' ),
				'type'            => 'select',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'In The Same Window', 'dicm-divi-custom-modules' ),
					'on'  => esc_html__( 'In The New Tab', 'dicm-divi-custom-modules' ),
				),
				'toggle_slug'     => 'button',
				'description'     => esc_html__( 'Choose whether your link opens in a new window or not', 'dicm-divi-custom-modules' ),
			),
		);
	}

	/**
	 * Module's advanced options configuration
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	function get_advanced_fields_config() {
		return array(
			'button' => array(
				'button' => array(
					'label' => esc_html__( 'Button', 'et_builder' ),
				),
			),
			'borders'               => array(
				'default' => array(),
				'image'   => array(
					'css'             => array(
						'main' => array(
							'border_radii' => "%%order_class%% .et_pb_main_blurb_image .et_pb_image_wrap",
							'border_styles' => "%%order_class%% .et_pb_main_blurb_image .et_pb_image_wrap",
						)
					),
				),
			),
		);
	}


	/**
	 * Render module output
	 *
	 * @since 1.0.0
	 *
	 * @param array  $attrs       List of unprocessed attributes
	 * @param string $content     Content being processed
	 * @param string $render_slug Slug of module that is used for rendering output
	 *
	 * @return string module's rendered output
	 */
	function render( $attrs, $content = null, $render_slug ) {
		// Module specific props added on $this->get_fields()
		$title                 = $this->props['title'];
		$button_text           = $this->props['button_text'];
		$button_url            = $this->props['button_url'];
		$button_url_new_window = $this->props['button_url_new_window'];

		// Design related props are added via $this->advanced_options['button']['button']
		$button_custom         = $this->props['custom_button'];
		$button_rel            = $this->props['button_rel'];
		$button_use_icon       = $this->props['button_use_icon'];

		// Render button
		$button = $this->render_button( array(
			'button_text'      => $button_text,
			'button_url'       => $button_url,
			'url_new_window'   => $button_url_new_window,
			'button_custom'    => $button_custom,
			'button_rel'       => $button_rel,
			'custom_icon'      => $button_use_icon,
		) );

		// Render module content
		$output = sprintf(
			'<h2 class="dicm-title">%1$s</h2>
			<div class="dicm-content">%2$s</div>
			%3$s',
			esc_html( $title ),
			et_sanitized_previously( $this->content ),
			et_sanitized_previously( $button )
		);

		// Render wrapper
		// 3rd party module with no full VB support has to wrap its render output with $this->_render_module_wrapper().
		// This method will automatically add module attributes and proper structure for parallax image/video background
		return $this->_render_module_wrapper( $output, $render_slug );
	}
}

new DICM_CTA;
