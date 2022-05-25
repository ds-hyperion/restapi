<?php

namespace Hyperion\RestAPI;

abstract class APIEnpointAbstract implements APIEndpointInterface
{
    private static string $apiNamespace;

    public static function getUrl(array $queryArgs = null): string
    {
        if($queryArgs === null) {
            return getenv('WP_HOME') . "/wp-json/" . static::getAPINamespace() . "/" . static::getEndpoint();
        }

        return getenv('WP_HOME') . "/wp-json/" . static::getAPINamespace() . "/" . static::getEndpoint()."?".http_build_query($queryArgs);
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