<?php

class DICM_HelloWorld extends ET_Builder_Module {

	public $slug       = 'dicm_hello_world';
	public $vb_support = 'on';

	public function init() {
		$this->name = esc_html__( 'Hello World', 'dicm-divi-custom-modules' );
	}

	public function get_fields() {
		return array(
			'content' => array(
				'label'           => esc_html__( 'Content', 'dicm-divi-custom-modules' ),
				'type'            => 'tiny_mce',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Content entered here will appear inside the module.', 'dicm-divi-custom-modules' ),
				'toggle_slug'     => 'main_content',
			),
		);
	}

	public function render( $attrs, $content = null, $render_slug ) {
		return sprintf( '<h1>%1$s</h1>', $this->props['content'] );
	}
}

new DICM_HelloWorld;
