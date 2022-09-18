<?
/**
 * Tabdil APP
 * @package           TabdilApp StopWatch
 * @author            Jafar Naghizadeh
 * @copyright         2022 mindmade.ir
 * @license           GPL-2.0-or-later
 * @wordpress-plugin
 * Plugin Name:       Tabdil.App StopWatch
 * Plugin URI:        https://tabdil.app
 * Description:       Developed by Jafar Naghizadeh. Special Thanks to Mohsen Karezani ;) 2022.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Jafar Naghizadeh
 * Author URI:        https://mindmade.ir
 * Text Domain:       tabdilApps
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Update URI:        https://mindmade.ir/tabdil.app
 */

function tabdil_app_shortcode_fnc_StopWatch( $atts = [], $content = null, $tag = '' ){
    if( strtolower($atts[0]) == 'stopwatch' )
        return jafar_go_to_this_module_StopWatch( $atts );
}

add_shortcode('Tabdil.App','tabdil_app_shortcode_fnc_StopWatch');


function jafar_go_to_this_module_StopWatch( $atts ){

    $type_name = 'stopwatch';
    $section = 'time';
    $version = '1.0.0'; // for css and js cache

    wp_enqueue_style(
        "css_for_{$section}_{$type_name}",
        //plugins_url( "/css/{$type_name}.css", __FILE__ ), 
        plugins_url( "/css/main.css?$version", __FILE__ ),  
    );

    wp_enqueue_script(
        "ajax_script_for_{$section}_{$type_name}",
        plugins_url( "/{$section}/js/{$type_name}.js", __FILE__ ),
        array( 'jquery' ), $version, true
    );

    $inc = dirname(__FILE__) . "/{$section}/{$type_name}.php";

    ob_start();
        include $inc;
    $ret = ob_get_contents(); 
    ob_end_clean();

    return $ret;
}




function tabdilapp_install_StopWatch() {
	add_option( 'tabdilapp_install', '1' );
}

function tabdilapp_install_data_StopWatch() {
    register_uninstall_hook( __FILE__, 'tabdilapp_Uninstall_StopWatch' );
}

register_activation_hook( __FILE__, 'tabdilapp_install_StopWatch' );
register_activation_hook( __FILE__, 'tabdilapp_install_data_StopWatch' );


function tabdilapp_Uninstall_StopWatch() {

}

function tabdilapp_Deactivate_StopWatch() {
	delete_option( 'tabdilapp_install' );
}

register_deactivation_hook( __FILE__, 'tabdilapp_Deactivate_StopWatch' );


function jafar_do_shortcodes_for_everywhere_StopWatch(){
    add_filter( 'single_post_title', 'do_shortcode' );
    add_filter( 'the_title', 'do_shortcode' );
    // add_filter( 'wpseo_title', 'do_shortcode' );
    // add_filter( 'wpseo_metadesc', 'do_shortcode' );
    // add_filter( 'wpseo_opengraph_title', 'do_shortcode' );
    // add_filter( 'wpseo_opengraph_desc', 'do_shortcode' );
}
add_action( 'init', 'jafar_do_shortcodes_for_everywhere_StopWatch' );

