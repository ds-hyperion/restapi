<?php
/**
 * Plugin Name: Hyperion - REST API Management -
 * Plugin URI:
 * Description: Gestion de l'API
 * Version: 0.1
 * Requires PHP: 8.1
 * Author: Benoit DELBOE & Grégory COLLIN
 * Author URI:
 * Licence: GPLv2
 */

add_action('init', '\Hyperion\RestAPI\Plugin::init');
register_activation_hook(__FILE__, '\Hyperion\RestAPI\Plugin::install');
register_uninstall_hook(__FILE__, '\Hyperion\RestAPI\Plugin::uninstall');