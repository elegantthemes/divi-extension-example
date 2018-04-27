<?php
/**
 * Basic Call To Action module (title, content, and button) with FULL builder support which contains
 * all possible fields that can be used on 3rd party module
 * This module appears on Visual Builder and requires react component to be provided
 * Due to full builder support, all advanced options (except button options) are added by default
 *
 * @since 1.0.0
 */
class DICM_CTA_All_Options extends ET_Builder_Module {
	// Module slug (also used as shortcode tag)
	public $slug       = 'dicm_cta_all_options';

	// Visual Builder support.
	// Expected value: on|partial
	// - on:      you need to provide JS component for visual builder to render your content
	//            dynamically in visual builder
	// - partial: you don't need to provide JS component for visual builder to render your content
	//            divi will generate blank placeholder for your module instead
	public $vb_support = 'on';

	// Module Credits (Appears at the bottom of the module settings modal)
	protected $module_credits = array(
		'module_uri' => 'https://divi-dev.site/my-extension',
		'author'     => 'Divi Developer',
		'author_uri' => 'https://divi-dev.site',
	);

	/**
	 * Module properties initialization
	 *
	 * @since 1.0.0
	 */
	function init() {
		// Module name
		$this->name             = esc_html__( 'Custom CTA All Options', 'dicm-divi-custom-modules' );

		// Module Icon
		// $this->icon          = 'x';
		$this->icon_path        =  plugin_dir_path( __FILE__ ) . 'icon.svg';

		// Custom modal tab options.
		// Design wise, it'd be better to stick with Divi's 3 tabs system (content|design|advanced).
		// However, if you ever need custom tab, this is where you can define it.
		$this->options_tabs = array(
			'demo' => array(
				'name' => esc_html__( 'Demo', 'dicm-divi-custom-modules' ),
			),
		);

		// Toggle settings
		// Toggles are grouped into array of tab name > toggles > toggle definition
		$this->settings_modal_toggles  = array(
			// Content tab's slug is "general"
			'general'  => array(
				'toggles' => array(
					'main_content' => esc_html__( 'Text', 'dicm-divi-custom-modules' ),
					'button'       => esc_html__( 'Button', 'dicm-divi-custom-modules' ),
				),
			),
			// Design tab's slug is "advanced"
			'advanced' => array(
				'toggles' => array(
					'title'  => esc_html__( 'Title', 'dicm-divi-custom-modules' ),
					'body'   => array(
						'title' => esc_html__( 'Body', 'dicm-divi-custom-modules' ),
						'priority' => 50,
						// Groups can be organized into tab
						'tabbed_subtoggles' => true,
						// Subtoggle tab configuration. Add `sub_toggle` attribute on field to put them here
						'sub_toggles' => array(
							'p'     => array(
								'name' => 'P',
								'icon' => 'text-left',
							),
							'a'     => array(
								'name' => 'A',
								'icon' => 'text-link',
							),
							'quote' => array(
								'name' => 'QUOTE',
								'icon' => 'text-quote',
							),
						),
					),
				),
			),
			// Advance tab's slug is "custom_css"
			'custom_css' => array(
				'toggles' => array(
					'limitation' => esc_html__( 'Limitation', 'dicm-divi-custom-modules' ), // totally made up
				),
			),
			// Your custom tab
			'demo' => array(
				'toggles' => array(
					'input'      => esc_html( 'Basic Fields', 'dicm-divi-custom-modules' ),
					'code'       => esc_html( 'Code Fields', 'dicm-divi-custom-modules' ),
					'form'       => esc_html( 'Form Fields', 'dicm-divi-custom-modules' ),
					'typography' => esc_html( 'Typography Fields', 'dicm-divi-custom-modules' ),
					'color'      => esc_html( 'Colorpicker Fields', 'dicm-divi-custom-modules' ),
					'upload'     => esc_html( 'Upload Fields', 'dicm-divi-custom-modules' ),
					'advanced'   => esc_html( 'Advanced Fields', 'dicm-divi-custom-modules' ),
				),
			),
		);

		// %%order_class%% is unique class that is used to target this module's styling. Its output
		// is based on slug + module order which in this module's case will be translated into
		// `.et_demo_module_0`. If for some reason (mostly CSS quirks) you need stronger base selector
		// (for example `.et_demo_module_0.dark-background`) you can define it on this class prototype
		// You can exclude this property if you want.
		$this->main_css_element = '%%order_class%%';

		// Add Custom CSS
		// This property will add CSS fields on Advanced > Custom CSS
		$this->custom_css_fields = array(
			'title' => array(
				'label'    => esc_html__( 'Title', 'dicm-divi-custom-modules' ),
				'selector' => '.et-demo-title',
			),
			'button' => array(
				'label'    => esc_html__( 'Button', 'dicm-divi-custom-modules' ),
				'selector' => '.et_pb_button',
			),
		);

		// Modify wrapper and inner wrapper settings
		// This is rarely needed and not recommended to be modified. However, these are configurable
		// if changing them is needed to achieve particular visual output
		$this->wrapper_settings = array(
			// 'parallax_background'     => '',
			// 'video_background'        => '',
			// 'attrs'                   => array(),
			// 'inner_attrs'             => array(
			// 	'class' => 'et_pb_module_inner',
			// ),
		);

		// Add help videos
		// This video will be displayed on different modal if the help icon on the bottom of the modal is clicked
		$this->help_videos = array(
			array(
				'id'   => esc_html__( 'FkQuawiGWUw', 'et_builder' ), // YouTube video ID
				'name' => esc_html__( 'Custom Module Video', 'et_builder' ),
			),
		);
	}

	/**
	 * Module's specific fields
	 *
	 *
	 * The following modules are automatically added regardless being defined or not:
	 *   Tabs     | Toggles          | Fields
	 *   --------- ------------------ -------------
	 *   Content  | Admin Label      | Admin Label
	 *   Advanced | CSS ID & Classes | CSS ID
	 *   Advanced | CSS ID & Classes | CSS Class
	 *   Advanced | Custom CSS       | Before
	 *   Advanced | Custom CSS       | Main Element
	 *   Advanced | Custom CSS       | After
	 *   Advanced | Visibility       | Disable On
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	function get_fields() {
		$basic_fields = array(
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


		// All possible official field types that can be used on custom module
		$all_types_tab_slug    = 'demo';
		$all_types_of_fields   = array(
			'text' => array(
				'label'           => esc_html__( 'Text', 'dicm-divi-custom-modules' ),
				'type'            => 'text',
				'tab_slug'        => $all_types_tab_slug,
				'toggle_slug'     => 'input',
			),
			'textarea' => array(
				'label'           => esc_html__( 'Textarea', 'et_builder' ),
				'type'            => 'textarea',
				'tab_slug'        => $all_types_tab_slug,
				'toggle_slug'     => 'input',
			),
			'select' => array(
				'label'           => esc_html__( 'Select', 'et_builder' ),
				'type'            => 'select',
				'options'         => array(
					'off' => esc_html__( 'Close', 'et_builder' ),
					'on'  => esc_html__( 'Open', 'et_builder' ),
				),
				'tab_slug'        => $all_types_tab_slug,
				'toggle_slug'     => 'input',
			),
			'toggle' => array(
				'label'             => esc_html__( 'Toggle', 'et_builder' ),
				'type'              => 'yes_no_button',
				'options'           => array(
					'on'  => esc_html__( 'On', 'et_builder' ),
					'off' => esc_html__( 'Off', 'et_builder' ),
				),
				'tab_slug'        => $all_types_tab_slug,
				'toggle_slug'     => 'input',
			),
			'multiple_buttons'        => array(
				'label'       => esc_html__( 'Multiple Buttons', 'et_builder' ),
				'type'        => 'multiple_buttons',
				'options'     => array(
					'horizontal' => array(
						'title' => esc_html__( 'Horizontal', 'et_builder' ),
						'icon'  => 'flip-horizontally', // Any svg icon that is defined on ETBuilderIcon component
					),
					'vertical'   => array(
						'title' => esc_html__( 'Vertical', 'et_builder' ),
						'icon'  => 'flip-vertically', // Any svg icon that is defined on ETBuilderIcon component
					),
				),
				'default'         => '',
				'toggleable'      => true,
				'multi_selection' => true,
				'tab_slug'        => $all_types_tab_slug,
				'toggle_slug'     => 'input',
			),
			'multiple_checkboxes' => array(
				'label'           => esc_html__( 'Multiple Checkboxes', 'et_builder' ),
				'type'            => 'multiple_checkboxes',
				'options'         => array(
					'option_1'    => esc_html__( 'Option 1', 'et_builder' ),
					'option_2'    => esc_html__( 'Option 2', 'et_builder' ),
					'option_3'    => esc_html__( 'Option 3', 'et_builder' ),
				),
				'tab_slug'        => $all_types_tab_slug,
				'toggle_slug'     => 'input',
			),
			'input_range' => array(
				'label'           => esc_html__( 'Input Range', 'dicm-divi-custom-modules' ),
				'type'            => 'range',
				'tab_slug'        => $all_types_tab_slug,
				'toggle_slug'     => 'input',
			),
			'input_datetime' => array(
				'label'           => esc_html__( 'Input Datetime', 'et_builder' ),
				'type'            => 'date_picker',
				'tab_slug'        => $all_types_tab_slug,
				'toggle_slug'     => 'input',
			),
			'input_margin' => array(
				'label'           => esc_html__( 'Input Margin', 'et_builder' ),
				'type'            => 'custom_margin',
				'tab_slug'        => $all_types_tab_slug,
				'toggle_slug'     => 'input',
			),
			'checkboxes_category' => array(
				'label'            => esc_html__( 'Checkboxes Category', 'et_builder' ),
				'type'            => 'categories',
				'taxonomy_name'   => 'category',
				'tab_slug'        => $all_types_tab_slug,
				'toggle_slug'     => 'input',
			),
			'select_sidebar' => array(
				'label'           => esc_html__( 'Select Sidebar', 'et_builder' ),
				'type'            => 'select_sidebar',
				'tab_slug'        => $all_types_tab_slug,
				'toggle_slug'     => 'input',
			),
			'codemirror' => array(
				'label'           => esc_html__( 'Codemirror', 'dicm-divi-custom-modules' ),
				'type'            => 'codemirror',
				'tab_slug'        => $all_types_tab_slug,
				'toggle_slug'     => 'code',
			),
			'options_list' => array(
				'label'           => esc_html__( 'Options List', 'et_builder' ),
				'type'            => 'options_list',
				'tab_slug'        => $all_types_tab_slug,
				'toggle_slug'     => 'form',
			),
			'options_list_checkbox' => array(
				'label'           => esc_html__( 'Options List: Checkbox', 'et_builder' ),
				'type'            => 'options_list',
				'checkbox'        => true,
				'tab_slug'        => $all_types_tab_slug,
				'toggle_slug'     => 'form',
			),
			'options_list_radio' => array(
				'label'           => esc_html__( 'Options List: Radio', 'et_builder' ),
				'type'            => 'options_list',
				'radio'           => true,
				'tab_slug'        => $all_types_tab_slug,
				'toggle_slug'     => 'form',
			),
			'select_fonticon' => array(
				'label'               => esc_html__( 'Select Font Icon', 'et_builder' ),
				'type'                => 'et_font_icon_select',
				'renderer'            => 'et_pb_get_font_icon_list',
				'renderer_with_field' => true,
				'tab_slug'        => $all_types_tab_slug,
				'toggle_slug'     => 'typography',
			),
			'text_align' => array(
				'label'           => esc_html__( 'Text Align', 'et_builder' ),
				'type'            => 'text_align',
				'options'         => et_builder_get_text_orientation_options(),
				'tab_slug'        => $all_types_tab_slug,
				'toggle_slug'     => 'typography',
			),
			'select_font' => array(
				'label'           => esc_html__( 'Select Font', 'et_builder' ),
				'type'            => 'font',
				'tab_slug'        => $all_types_tab_slug,
				'toggle_slug'     => 'typography',
			),
			'color' => array(
				'label'           => esc_html__( 'Color', 'dicm-divi-custom-modules' ),
				'type'            => 'color',
				'tab_slug'        => $all_types_tab_slug,
				'toggle_slug'     => 'color',
			),
			'color_alpha' => array(
				'label'           => esc_html__( 'Color Alpha', 'dicm-divi-custom-modules' ),
				'type'            => 'color-alpha',
				'tab_slug'        => $all_types_tab_slug,
				'toggle_slug'     => 'color',
			),
			'upload' => array(
				'label'              => esc_html__( 'Upload', 'et_builder' ),
				'type'               => 'upload',
				'upload_button_text' => esc_attr__( 'Upload an image', 'et_builder' ),
				'choose_text'        => esc_attr__( 'Choose an Image', 'et_builder' ),
				'update_text'        => esc_attr__( 'Set As Image', 'et_builder' ),
				'tab_slug'           => $all_types_tab_slug,
				'toggle_slug'        => 'upload',
			),
			'composite_tabbed' => array(
				'label'               => esc_html__( 'Composite Tabbed', 'et_builder' ),
				'tab_slug'            => $all_types_tab_slug,
				'toggle_slug'         => 'advanced',
				'attr_suffix'         => '',
				'type'                => 'composite',
				'composite_type'      => 'default',
				'composite_structure' => array(
					'tab_1' => array(
						'label'    => esc_html( 'Tab 1', 'dicm-divi-custom-modules' ),
						'controls' => array(
							'tab_1_text' => array(
								'label' => esc_html__( 'Text 1', 'dicm-divi-custom-modules' ),
								'type'  => 'text',
							),
						),
					),
					'tab_2' => array(
						'label' => esc_html( 'Tab 2', 'dicm-divi-custom-modules' ),
						'controls' => array(
							'tab_2_text' => array(
								'label' => esc_html__( 'Text 2', 'dicm-divi-custom-modules' ),
								'type'  => 'text',
							),
						),
					),
				),
			),
			'presets_shadow' => array(
				'label'           => esc_html__( 'Presets', 'et_builder' ),
				'type'            => 'presets_shadow',
				'tab_slug'        => $all_types_tab_slug,
				'toggle_slug'     => 'advanced',
				'affects'         => array(
					'preset_affected_1',
					'preset_affected_2',
				),
				'presets'         => array(
					array(
						'icon'  => 'none',
						'value' => 'none',
					),
					array(
						'content' => array(
							'class'   => 'preset preset1',
							'content' => 'aA',
						),
						'fields'  => array(
							'preset_affected_1' => '0.1em',
							'preset_affected_2' => '1em',
						),
						'value'   => 'preset1'
					),
					array(
						'content' => array(
							'class'   => 'preset preset2',
							'content' => 'aA',
						),
						'fields'  => array(
							'preset_affected_1' => '0.5em',
							'preset_affected_2' => '5em',
						),
						'value'   => 'preset2'
					),
				),
				'default'         => 'none',
				'default_on_front'=> true,
			),
			'preset_affected_1' => array(
				'label'           => esc_html__( 'Preset Affected 1', 'dicm-divi-custom-modules' ),
				'type'            => 'range',
				'tab_slug'        => $all_types_tab_slug,
				'toggle_slug'     => 'advanced',
				'depends_show_if_not' => 'none',
				'default'         => array(
					'presets_shadow',
					array(
						'none'    => '0em',
						'preset1' => '0.1em',
						'preset2' => '0.5em',
					),
				),
			),
			'preset_affected_2' => array(
				'label'           => esc_html__( 'Preset Affected 2', 'dicm-divi-custom-modules' ),
				'type'            => 'range',
				'tab_slug'        => $all_types_tab_slug,
				'toggle_slug'     => 'advanced',
				'depends_show_if_not' => 'none',
				'default'         => array(
					'presets_shadow',
					array(
						'none'    => '0em',
						'preset1' => '1em',
						'preset2' => '5em',
					),
				),
			),
		);

		return array_merge( $basic_fields, $all_types_of_fields );
	}

	/**
	 * Module's advanced fields configuration
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	function get_advanced_fields_config() {
		// Advanced fields
		// The goal of advanced fields are to reduce repetitiveness of field definition. Many modules
		// use the same set of fields with slight differences (i.e.: most modules have box shadow
		// fields but Blurb has additional box-shadow fields for its image) so advanced fields
		// enables module to declare minimum variable to auto generate commonly used fields.

		// NOTE:
		// IF MODULE HAS PARTIAL OR FULL BUILDER SUPPORT, ALL ADVANCED OPTIONS (EXCEPT BUTTON) ARE ADDED BY DEFAULT
		$advanced_fields = array();

		// The following advanced fields are automatically added regardless builder support or explicit definition
		// Tabs     | Toggles          | Fields
		// --------- ------------------ -------------
		// Design   | Border           | Rounded Corners (multiple fields)
		// Design   | Border           | Border Styles (multiple fields)
		// Design   | Box Shadow       | Box Shadow (multiple fields)
		// Design   | Animation        | Animation (multiple fields)

		// Note: "// default" comment after the configuration attribute means that Divi automatically
		// adds this value. The attribute can be left undeclared if you want to use default value

		// Add advanced fields: module background
		// There can only be one module background so its setting is as minimal as possible.
		// The location of the background is at Content > Background > Background
		$advanced_fields['background'] = array(
			'has_background_color_toggle'   => false, // default. Warning: to be deprecated
			'use_background_color'          => true, // default
			'use_background_color_gradient' => true, // default
			'use_background_image'          => true, // default
			'use_background_video'          => true, // default
		);

		// Add advanced fields: fonts
		// There can be multiple advanced font options in a module, so it is designed to accept
		// multiple advanced fields
		// Adding very basic font options
		$advanced_fields['fonts'] = array(
			'text'   => array(
				'label'    => esc_html__( 'Text', 'dicm-divi-custom-modules' ),
				'toggle_slug' => 'body',
				'sub_toggle'  => 'p',
			),
		);

		// Example of more advanced font options
		$advanced_fields['fonts']['link'] = array(
			'label'    => esc_html__( 'Link', 'dicm-divi-custom-modules' ),
			'css'      => array(
				'main' => "{$this->main_css_element} a",
			),
			'toggle_slug' => 'body',
			'sub_toggle'  => 'a',
		);

		$advanced_fields['fonts']['quote'] = array(
			'label'    => esc_html__( 'Blockquote', 'dicm-divi-custom-modules' ),
			'css'      => array(
				'main' => "{$this->main_css_element} blockquote",
			),
			'line_height' => array(
				'default' => '1em',
			),
			'font_size' => array(
				'default' => '16px',
			),
			'toggle_slug' => 'body',
			'sub_toggle'  => 'quote',
		);

		// Add advanced fields: border (radius & style)
		// Most module has border, thus it is automatically added even without explicit definition
		// However, some module might have multiple border (ie. blurb which has module and image
		// border options) or slightly different border configuration
		$advanced_fields['borders'] = array(
			'default' => array(), // default
		);

		// Adding additional border options
		$advanced_fields['borders']['title'] = array(
			'css'             => array(
				'main' => array(
					'border_radii' => "%%order_class%% .et-demo-title",
					'border_styles' => "%%order_class%% .et-demo-title",
				)
			),
			'label_prefix'    => esc_html__( 'Title', 'dicm-divi-custom-modules' ),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'title',
		);

		// Add advanced fields: text
		// Automatically add text orientation field (left|center|right|justified) to advanced tab.
		// text_orientation are commonly not printing anything; the attribute is used to outputs
		// text-align affecting class name. To manually output CSS styling, `css` attribute containing
		// `text` orientation and valid selector template needs to be declared
		$advanced_fields['text'] = array(
			'use_text_orientation'  => true, // default
			'css' => array(
				'text_orientation' => '%%order_class%%',
			),
		);

		// Add advanced fields: Max Width (sizing)
		// This advanced fields automatically adds Width and Module Alignment (responsive) fields
		// on Design > Sizing toggle. Module Alignment only appears if Width value isn't (100%)
		// because Module Alignment is irrelvant if the module widht fills its entire wrapper
		$advanced_fields['max_width'] = array(
			'use_max_width'        => true, // default
			'use_module_alignment' => true, // default
		);

		// Add advanced fields: margin & padding
		// Adding advanced fields automatically adds Margin and Padding fields on Design > Spacing
		// Module is expected to have max one margin and padding option so the only option this
		// advanced field has is either to activate / deactivate margin / padding options
		$advanced_fields['margin_padding'] = array(
			'use_margin'  => true,
			'use_padding' => true,
		);

		// Add advanced fields: button
		// Similar to advanced font options, there can be multiple advanced button options in a
		// module (ie. Fullwidth Header module), so it is designed to accept multiple advanced
		// options and requires module to at least explicitly set one setting

		// NOTE:
		// Button fields are not automatically added even if the module has builder support
		$advanced_fields['button'] = array(
			'button' => array(
				'label' => esc_html__( 'Button', 'dicm-divi-custom-modules' ),
				'css'   => array(
					'alignment'   => "%%order_class%% .et_pb_button_wrapper",
				),
			),
		);

		// Add advanced fields: filter
		// Adding CSS-based color filter options to the module. CSS filter is pre-deterministic:
		// It is assumed that module can only have maximum two filters advanced fields at the same
		// time so there's no flexibility in terms of attribute naming (unlike font and button options)
		$advanced_fields['filters'] = array(
			// The following are optional. only if you'd like to add secondary filter options to module
			'child_filters_target' => array(
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'title',
			),
		);

		// Add advanced fields: animation
		// Advanced animation options is automatically added to all module except to module item
		// It doesn't have many option except to have it disabled (uncomment the line below to try it)
		// $advanced_fields['animation'] = false;

		// Add advanced fields: text shadow
		// Text shadow option is automatically added when advanced_options property is defined.
		// Module normally only defined one advanced advanced text shadow fields but it accepts
		// parameter to define additional text shadow options
		$advanced_fields['text_shadow'] = array(
			'default' => array(), // default
		);

		return $advanced_fields;
	}

	/**
	 * Render prop value
	 * Some prop value needs to be parsed before can be used
	 * This method is added to display how to parse certain saved value
	 *
	 * @since 1.0.0
	 *
	 * @param string|array $value
	 * @param string       $field_name
	 * @param string       $field_type
	 * @param string       $render_slug
	 *
	 * @return string
	 *
	 */
	function render_prop( $value = '', $field_name = '', $field_type = '', $render_slug = '') {
		$order_class = self::get_module_order_class( $render_slug );
		$output      = '';

		if ( '' === $value ) {
			return $output;
		}

		$option_search  = array( '&#91;', '&#93;' );
		$option_replace = array( '[', ']' );

		switch ( $field_type ) {
			case 'options_list':
				$options = '';

				if ( $value ) {
					$value = str_replace( $option_search, $option_replace, $value );
					$value = json_decode( $value );

					foreach ( $value as $option ) {
						$options .= sprintf(
							'<option value="%1$s">%2$s</option>',
							esc_attr( wp_strip_all_tags( $option->value ) ),
							wp_strip_all_tags( $option->value )
						);
					}
				}

				$output = $options;
				break;
			case 'options_list_checkbox':
				$checkboxes = '';
				$value          = str_replace( $option_search, $option_replace, $value );
				$value          = json_decode( $value );
				$checkbox_name  = sprintf( '%1$s_%2$s', $order_class, $field_name );

				foreach ( $value as $index => $option ) {
					$checkbox_id  = sprintf( '%1$s_checkbox_%2$s', $checkbox_name, $index );
					$is_checked   = 1 === $option->checked ? true : false;
					$option_value = wp_strip_all_tags( $option->value );

					$checkboxes .= sprintf(
						'<span class="checkbox-wrap">
							<input type="checkbox" id="%1$s" class="input" value="%2$s"%3$s>
							<label for="%1$s"><i></i>%2$s</label>
						</span>',
						esc_attr( $checkbox_id ),
						esc_attr( $option_value ),
						$is_checked ? ' checked="checked"' : ''
					);
				}

				$output = $checkboxes;
				break;
			case 'options_list_radio':
				$radios = '';

				if ( $value ) {
					$value       = str_replace( $option_search, $option_replace, $value );
					$value       = json_decode( $value );
					$radio_name  = sprintf( '%1$s_%2$s', $order_class, $field_name );

					foreach ( $value as $index => $option ) {
						$radio_id  = sprintf( '%1$s_radio_%2$s', $radio_name, $index );
						$is_checked = 1 === $option->checked ? true : false;

						$radios .= sprintf(
							'<span class="radio-wrap">
								<input type="radio" id="%1$s" class="input" value="%3$s" name="%2$s" %4$s>
								<label for="%1$s"><i></i>%3$s</label>
							</span>',
							esc_attr( $radio_id ),
							esc_attr( $radio_name ),
							wp_strip_all_tags( $option->value ),
							checked( $is_checked, true, false )
						);
					}
				}

				$output = $radios;
				break;
			case 'select_fonticon':
				$output = sprintf(
					'<span style="font-family: ETmodules!important; font-size: 40px;">%1$s</span>',
					esc_attr( et_pb_process_font_icon( $value ) )
				);
				break;
			case 'upload_image':
				$output = sprintf(
					'<img src="%1$s" />',
					esc_attr( $value )
				);
				break;
			default:
				$output = $value;
				break;
		}

		return $output;
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

		// Basic fields
		$basic_fields = sprintf(
			'<div class="basic-fields fields-group">
				<h3>%1$s</h3>
				<h4>%2$s</h4>
				%3$s
				<h4>%4$s</h4>
				%5$s
				<h4>%6$s</h4>
				%7$s
				<h4>%8$s</h4>
				%9$s
				<h4>%10$s</h4>
				%11$s
				<h4>%12$s</h4>
				%13$s
				<h4>%14$s</h4>
				%15$s
				<h4>%16$s</h4>
				%17$s
				<h4>%18$s</h4>
				%19$s
				<h4>%20$s</h4>
				%21$s
				<h4>%22$s</h4>
				%23$s
			</div>',
			esc_html__( 'Basic Fields', 'dicm-divi-custom-modules' ),
			esc_html__( 'Text', 'dicm-divi-custom-modules' ),
			esc_html( $this->props['text'] ),
			esc_html__( 'Textarea', 'dicm-divi-custom-modules' ),
			esc_html( $this->props['textarea'] ), // 5
			esc_html__( 'Select', 'dicm-divi-custom-modules' ),
			esc_html( $this->props['select'] ),
			esc_html__( 'Toggle', 'dicm-divi-custom-modules' ),
			esc_html( $this->props['toggle'] ),
			esc_html__( 'Multiple Buttons', 'dicm-divi-custom-modules' ), // 10
			esc_html( $this->props['multiple_buttons'] ),
			esc_html__( 'Multiple Checkboxes', 'dicm-divi-custom-modules' ),
			esc_html( $this->props['multiple_checkboxes'] ),
			esc_html__( 'Input Range', 'dicm-divi-custom-modules' ),
			esc_html( $this->props['input_range'] ), // 15
			esc_html__( 'Input Date Time', 'dicm-divi-custom-modules' ),
			esc_html( $this->props['input_datetime'] ),
			esc_html__( 'Input Margin', 'dicm-divi-custom-modules' ),
			esc_html( $this->props['input_margin'] ),
			esc_html__( 'Checkboxes Category', 'dicm-divi-custom-modules' ), // 20
			esc_html( $this->props['checkboxes_category'] ),
			esc_html__( 'Select Sidebar', 'dicm-divi-custom-modules' ),
			esc_html( $this->props['select_sidebar'] )
		);

		// Code fields
		$code_fields = sprintf(
			'<div class="code-fields fields-group">
				<h3>%1$s</h3>
				<h4>%2$s</h4>
				%3$s
			</div>',
			esc_html__( 'Code Fields', 'dicm-divi-custom-modules' ),
			esc_html__( 'Codemirror', 'dicm-divi-custom-modules' ),
			et_builder_convert_line_breaks( et_builder_replace_code_content_entities( $this->props['codemirror'] ) )
		);

		// Form Fields
		$options_list = sprintf(
			'<p>%1$s</p>
			<pre>%2$s</pre>
			<p>%3$s</p>
			<select name="option-name">%4$s</select>',
			esc_html__( 'Prop value: ', 'dicm-divi-custom-modules' ),
			$this->props['options_list'],
			esc_html__( 'Rendered prop value: ', 'dicm-divi-custom-modules' ),
			$this->render_prop( $this->props['options_list'], 'options_list', 'options_list', $render_slug )
		);

		$options_list_checkbox = sprintf(
			'<p>%1$s</p>
			<pre>%2$s</pre>
			<p>%3$s</p>
			<p>%4$s</p>',
			esc_html__( 'Prop value: ', 'dicm-divi-custom-modules' ),
			$this->props['options_list_checkbox'],
			esc_html__( 'Rendered prop value: ', 'dicm-divi-custom-modules' ),
			$this->render_prop( $this->props['options_list_checkbox'], 'options_list_checkbox', 'options_list_checkbox', $render_slug )
		);

		$options_list_radio = sprintf(
			'<p>%1$s</p>
			<pre>%2$s</pre>
			<p>%3$s</p>
			<p>%4$s</p>',
			esc_html__( 'Prop value: ', 'dicm-divi-custom-modules' ),
			$this->props['options_list_radio'],
			esc_html__( 'Rendered prop value: ', 'dicm-divi-custom-modules' ),
			$this->render_prop( $this->props['options_list_radio'], 'options_list_radio', 'options_list_radio', $render_slug )
		);

		$form_fields = sprintf(
			'<div class="form-fields fields-group">
				<h3>%1$s</h3>
				<h4>%2$s</h4>
				%3$s
				<h4>%4$s</h4>
				%5$s
				<h4>%6$s</h4>
				%7$s
			</div>',
			esc_html__( 'Form Fields', 'dicm-divi-custom-modules' ),
			esc_html__( 'Option List', 'dicm-divi-custom-modules' ),
			et_sanitized_previously( $options_list ),
			esc_html__( 'Option List Checkbox', 'dicm-divi-custom-modules' ),
			et_sanitized_previously( $options_list_checkbox ), // 5
			esc_html__( 'Option List Radio', 'dicm-divi-custom-modules' ),
			et_sanitized_previously( $options_list_radio )
		);

		// Typography Fields
		$font_icon = sprintf(
			'<p>%1$s</p>
			<pre>%2$s</pre>
			<p>%3$s</p>
			<p>%4$s</p>',
			esc_html__( 'Prop value: ', 'dicm-divi-custom-modules' ),
			$this->props['select_fonticon'],
			esc_html__( 'Rendered prop value: ', 'dicm-divi-custom-modules' ),
			$this->render_prop( $this->props['select_fonticon'], 'select_fonticon', 'select_fonticon', $render_slug )
		);

		$typography_fields = sprintf(
			'<div class="typography-fields fields-group">
				<h3>%1$s</h3>
				<h4>%2$s</h4>
				%3$s
				<h4>%4$s</h4>
				%5$s
				<h4>%6$s</h4>
				%7$s
			</div>',
			esc_html__( 'Typography Fields', 'dicm-divi-custom-modules' ),
			esc_html__( 'Select Font Icon', 'dicm-divi-custom-modules' ),
			et_sanitized_previously( $font_icon ),
			esc_html__( 'Select Text Align', 'dicm-divi-custom-modules' ),
			esc_html( $this->props['text_align'] ), // 5
			esc_html__( 'Select Font', 'dicm-divi-custom-modules' ),
			esc_html( $this->props['select_font'] )
		);

		// Process text-align value into style
		if ( '' !== $this->props['text_align'] ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .typography-fields',
				'declaration' => sprintf(
					'text-align: %1$s;',
					esc_html( $this->props['text_align'] )
				),
			) );
		}

		// Process font option into style
		if ( '' !== $this->props['select_font'] ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .typography-fields',
				'declaration' => et_builder_set_element_font( $this->props['select_font'] ),
			) );
		}

		// Color Fields
		$color_fields = sprintf(
			'<div class="color-fields fields-group">
				<h3>%1$s</h3>
				<h4>%2$s</h4>
				%3$s
				<div class="colorpicker-preview color"></div>
				<h4>%4$s</h4>
				%5$s
				<div class="colorpicker-preview color-alpha"></div>
			</div>',
			esc_html__( 'Color Fields', 'dicm-divi-custom-modules' ),
			esc_html__( 'Color', 'dicm-divi-custom-modules' ),
			esc_html( $this->props['color'] ),
			esc_html__( 'Color Alpha', 'dicm-divi-custom-modules' ),
			esc_html( $this->props['color_alpha'] ) // 5
		);

		// Process saved color into style
		if ( '' !== $this->props['color'] ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .colorpicker-preview.color',
				'declaration' => sprintf(
					'background-color: %1$s;',
					esc_html( $this->props['color'] )
				),
			) );
		}

		if ( '' !== $this->props['color_alpha'] ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .colorpicker-preview.color-alpha',
				'declaration' => sprintf(
					'background-color: %1$s;',
					esc_html( $this->props['color_alpha'] )
				),
			) );
		}

		// Upload Fields
		$upload = sprintf(
			'<p>%1$s</p>
			<pre>%2$s</pre>
			<p>%3$s</p>
			<p>%4$s</p>',
			esc_html__( 'Prop value: ', 'dicm-divi-custom-modules' ),
			$this->props['upload'],
			esc_html__( 'Rendered prop value: ', 'dicm-divi-custom-modules' ),
			$this->render_prop( $this->props['upload'], 'upload', 'upload_image', $render_slug )
		);

		$upload_fields = sprintf(
			'<div class="upload-fields fields-group">
				<h3>%1$s</h3>
				<h4>%2$s</h4>
				%3$s
			</div>',
			esc_html__( 'Upload Fields', 'dicm-divi-custom-modules' ),
			esc_html__( 'Upload', 'dicm-divi-custom-modules' ),
			et_sanitized_previously( $upload )
		);

		// Advanced field types
		$advanced_field_types = sprintf(
			'<div class="advanced-fields fields-group">
				<h3>%1$s</h3>
				<h4>%2$s</h4>
				%3$s
				<h4>%4$s</h4>
				%5$s
				<h4>%6$s</h4>
				%7$s
				<h4>%8$s</h4>
				%9$s
				<h4>%10$s</h4>
				%11$s
			</div>',
			esc_html__( 'Advanced Fields', 'dicm-divi-custom-modules' ),
			esc_html__( 'Tab 1 Text', 'dicm-divi-custom-modules' ),
			esc_html( $this->props['tab_1_text'] ),
			esc_html__( 'Tab 2 Text', 'dicm-divi-custom-modules' ),
			esc_html( $this->props['tab_2_text'] ), // #5
			esc_html__( 'Presets Shadow', 'dicm-divi-custom-modules' ),
			esc_html( $this->props['presets_shadow'] ),
			esc_html__( 'Preset Affected 1', 'dicm-divi-custom-modules' ),
			esc_html( $this->props['preset_affected_1'] ),
			esc_html__( 'Preset Affected 2', 'dicm-divi-custom-modules' ), // #10
			esc_html( $this->props['preset_affected_2'] )
		);

		// Render module content
		$output = sprintf(
			'<h2 class="dicm-title">%1$s</h2>
			<div class="dicm-content">%2$s</div>
			%3$s
			%4$s
			%5$s
			%6$s
			%7$s
			%8$s
			%9$s
			%10$s',
			esc_html( $title ),
			et_sanitized_previously( $this->content ),
			et_sanitized_previously( $button ),
			$basic_fields,
			$code_fields,
			$form_fields,
			$typography_fields,
			$color_fields,
			$upload_fields,
			$advanced_field_types
		);

		// Render wrapper
		// Module with full builder support DOES NOT need to wrap its render() output with $this->_render_module_wrapper()
		return $output;
	}
}

new DICM_CTA_All_Options;
