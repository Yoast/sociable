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

    /**
     * Make a hidden field for a form and check if output is correct
     *
     * @covers Sociable_Admin::input()
     */
    public function test_hidden_text() {
        $output = $this->class_instance->input( 'hidden', null, 'networks', null, null );

        $expected = '<div class="sociable-form sociable-form-input">';
        $expected .= '<input type="hidden" class="sociable-form sociable-form-hidden" id="yoast-sociable-form-hidden-phpunit-networks" name="networks" value="" /></div>';

        $this->assertEquals( $output, $expected );
    }

    /**
     * Test if get_inactive_networks contain social network names we specified
     *
     * @covers Sociable_Admin::get_inactive_networks()
     */
    public function test_get_inactive_networks() {
        $output = $this->class_instance->get_inactive_networks();

        $expected_values = array(
            'email','facebook','linkedin','twitter','googleplus','pinterest','tumblr',
        );

        foreach ( $output as $value ) {
            $this->assertContains( $value['name'], $expected_values );
        }
    }

    /**
     * 
     *
     * @covers Sociable_Admin::active_networks_to_string()
     */
//    public function test_active_networks_to_string() {
//        $_POST['active_networks'] = 'network[]=twitter&network[]=linkedin&network[]=googleplus&network[]=pinterest';
//
//        $_POST['wp-nonce'] = wp_create_nonce('yoast_sociable_ajax');
//
//        $output = $this->class_instance->active_networks_to_string();
//        $expected = 'twitter,linkedin,googleplus,pinterest';
//
//        $this->assertEquals( $output, $expected );
//    }


}
?>