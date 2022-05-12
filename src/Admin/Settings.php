<?php

namespace Hyperion\RestAPI\Admin;

class Settings
{
    public const SETTINGS_GROUP = 'restAPISettingsGroup';

    public static function createMenu()
    {
        //create new top-level menu
        add_menu_page('Configuration du plugin API',
            'Rest API',
            'administrator',
            __DIR__."/SettingsPageView.php"
        );

        //call register settings function
        add_action('admin_init', 'registerPluginSettings');
    }

    public static function registerPluginSettings()
    {
        register_setting(self::SETTINGS_GROUP, 'api_namespace');
    }
}