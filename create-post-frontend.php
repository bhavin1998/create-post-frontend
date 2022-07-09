<?php
/**
 * Plugin Name: Front-End Post Create
 * Plugin URI: http://pbsolution.in/
 * Description: The plugin that I have ever created.
 * Version: 1.0
 * Author: Bhavin Gediya
 * Author URI: http://pbsolution.in/
 */

add_action('wp_footer', 'myplugin_ajaxurl');
function myplugin_ajaxurl() {

   echo '<script type="text/javascript">
           var ajaxurl = "' . admin_url('admin-ajax.php') . '";
           var redirecturl = "'.admin_url().'";
         </script>';
}

function myenqueuescript(){
    wp_enqueue_script('mycustomjs1', plugins_url('js/customjs.js', __FILE__),'','1.0',true);
    // wp_enqueue_script('jqueryslimmin', plugins_url('js/jquery.slim.min.js', __FILE__),'','1.0',true);
    wp_enqueue_script('bootsrapjs', plugins_url('js/bootstrap.bundle.min.js', __FILE__),'','1.0',true);
    wp_enqueue_script('bootsrapcss', plugins_url('css/bootstrap.min.css', __FILE__),'','1.0',false);
    wp_enqueue_script('mycustomcss', plugins_url('css/mycustomcss.css', __FILE__),'','1.0',true);
    wp_localize_script( 'ajax-script', 'my_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'myenqueuescript' );

include('includes/cpf.php');

register_activation_hook( __FILE__, 'fx_admin_notice_example_activation_hook' );
 
/**
 * Runs only when the plugin is activated.
 * @since 0.1.0
 */
function fx_admin_notice_example_activation_hook() {
 
    /* Create transient data */
    set_transient( 'fx-admin-notice-example', true, 5 );
}
 
 
/* Add admin notice */
add_action( 'admin_notices', 'fx_admin_notice_example_notice' );
 
 
/**
 * Admin Notice on Activation.
 * @since 0.1.0
 */
function fx_admin_notice_example_notice(){
 
    /* Check transient, if available display notice */
    if( get_transient( 'fx-admin-notice-example' ) ){
        ?>
        <div class="updated notice is-dismissible">
            <p>Thank you for using this plugin! <strong> use shortcode: [create_post_front_end]</strong>.</p>
        </div>
        <?php
        /* Delete transient, only display this notice once. */
        delete_transient( 'fx-admin-notice-example' );
    }
}
