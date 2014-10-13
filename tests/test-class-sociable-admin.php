<?php

require_once dirname( __FILE__ ) . '/../admin/class-sociable-admin.php';

class Yoast_Sociable_Admin_Test extends WP_UnitTestCase {

    private $class_instance;

    public function __construct() {
        global $yoast_sociable_admin;

        $this->class_instance = $yoast_sociable_admin;
    }

    /**
     * Create a form and check if output is correct
     *
     * @covers Sociable_Admin::create_form()
     */
    public function test_create_form() {
        $action = admin_url( 'admin.php' );

        $output = $this->class_instance->create_form( 'phpunit' );

        $expected = '<form action="' . $action . '" method="post" id="yoast-sociable-form-phpunit" class="yoast_sociable_form">' . wp_nonce_field( 'save_settings', 'yoast_sociable_nonce', null, false );

        $this->assertEquals( $output , $expected );
    }

    /**
     * End a form and check if output is correct
     *
     * @covers Sociable_Admin::end_form()
     */
    public function test_end_form() {
        $output = $this->class_instance->end_form();

        $expected = '<div class="sociable-form sociable-form-input">';
        $expected .= '<input type="submit" name="sociable-form-submit" value="Save changes" class="button button-primary sociable-form-submit" id="yoast-sociable-form-submit-phpunit">';
        $expected .= '</div></form>';

        $this->assertEquals( $output, $expected );
    }

    /**
     * Make a checkbox for a form and check if output is correct
     *
     * @covers Sociable_Admin::input()
     */
    public function test_input_checkbox() {
        $output = $this->class_instance->input( 'checkbox', 'Enable Sociable', 'enabled', null, null );

        $expected = '<div class="sociable-form sociable-form-input">';
        $expected .= '<label class="sociable-form sociable-form-checkbox-label sociable-form-label-left" id="yoast-sociable-form-label-checkbox-phpunit-enabled" />Enable Sociable:</label>';
        $expected .= '<input type="checkbox" class="sociable-form sociable-form-checkbox" id="yoast-sociable-form-checkbox-phpunit-enabled" name="enabled" value="1" /></div>';

        $this->assertEquals( $output, $expected );
    }

    /**
     * Make a text field for a form and check if output is correct
     *
     * @covers Sociable_Admin::input()
     */
    public function test_input_text() {
        $output = $this->class_instance->input( 'text', 'Active social networks', 'networks', null, null );

        $expected = '<div class="sociable-form sociable-form-input">';
        $expected .= '<label class="sociable-form sociable-form-text-label sociable-form-label-left" id="yoast-sociable-form-label-text-phpunit-networks" />Active social networks:</label>';
        $expected .= '<input type="text" class="sociable-form sociable-form-text" id="yoast-sociable-form-text-phpunit-networks" name="networks" value="" /></div>';

        $this->assertEquals( $output, $expected );
    }

}
?>