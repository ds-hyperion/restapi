<?php

namespace Hyperion\RestAPI;

class Plugin
{
    public const API_NAMESPACE_OPTION = 'hyperion_api_namespace';
    public const ADD_API_ENDPOINT_ACTION = 'add_api_endpoint';

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