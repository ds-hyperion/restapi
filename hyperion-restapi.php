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

add_action('init', '\Hyperion\RestAPI\Plugin::init');
add_action('admin_menu', '\Hyperion\RestAPI\Plugin::addAdminPage');
register_activation_hook(__FILE__, '\Hyperion\RestAPI\Plugin::install');
register_uninstall_hook(__FILE__, '\Hyperion\RestAPI\Plugin::uninstall');