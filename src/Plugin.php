<?php

namespace Hyperion\RestAPI;

class Plugin
{
    public const API_NAMESPACE_OPTION = 'hyperion_api_namespace';

    public static function init()
    {
        add_action('add_api_endpoint', 'APIManagement::registerAPIEndpoint',1,10);
    }

    public static function addAdminPage()
    {
        add_menu_page(
            'Configuration du plugin API',
            'Rest API',
            'manage_options',
            __DIR__.'/Admin/Config.php'
        );
    }

    public static function install()
    {
        add_option(self::API_NAMESPACE_OPTION);
    }

    public static function uninstall()
    {
        // Remove option from wordpress option
        delete_option(self::API_NAMESPACE_OPTION);
    }
}