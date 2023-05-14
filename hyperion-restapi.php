<?php
/**
 * Plugin Name: Hyperion - Module REST API -
 * Plugin URI:
 * Description: Gestion de l'API
 * Version: 0.1
 * Requires PHP: 8.1
 * Author: Benoit DELBOE & Grégory COLLIN
 * Author URI:
 * Licence: GPLv2
 */

add_action('admin_menu', ['\Hyperion\RestAPI\Admin\Settings','createMenu']);
add_action(Hyperion\RestAPI\Plugin::ADD_API_ENDPOINT_ACTION, 'Hyperion\RestAPI\APIManagement::registerAPIEndpoint',1,10);
add_action( 'rest_api_init', function() {
    remove_filter( 'rest_pre_serve_request', 'rest_send_cors_headers' );
    add_filter( 'rest_pre_serve_request', ['\Hyperion\RestAPI\Plugin', 'activeCors']);
}, 15 );
add_filter('rest_pre_dispatch', '\Hyperion\RestAPI\APIEnpointAbstract::isCallAuthentified',10,3);
register_activation_hook(__FILE__, '\Hyperion\RestAPI\Plugin::install');
register_uninstall_hook(__FILE__, '\Hyperion\RestAPI\Plugin::uninstall');