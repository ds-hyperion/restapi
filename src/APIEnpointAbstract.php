<?php

namespace Hyperion\RestAPI;

abstract class APIEnpointAbstract implements APIEndpointInterface
{
    private static string $apiNamespace;

    public static function getUrl(): string
    {
        return getenv('WP_HOME')."/wp-json/".static::getAPINamespace()."/".static::getEndpoint();
    }

    protected static function getAPINamespace() : string
    {
        if(!isset(self::$apiNamespace)) {
            self::$apiNamespace = get_option(Plugin::API_NAMESPACE_OPTION);
        }

        return self::$apiNamespace;
    }

    abstract public static function getEndpoint(): string;
}