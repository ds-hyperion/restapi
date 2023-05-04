<?php

namespace Hyperion\RestAPI;

use WP_Error;

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

    public static function isCallAuthentified($result, $server, $request)
    {
        $authorization_header = $request->get_header( 'Authorization' );
        $salt = get_option(Plugin::API_ANTIBOT_SALT_OPTION);

        if ( isset( $authorization_header ) && $salt ) {
            // Vérifier si l'en-tête Authorization contient un jeton valide
            $token = str_replace( 'Bearer ', '', $authorization_header );
            if($token !== md5($salt.time())) {
                return new WP_Error( 'rest_not_authenticated', __( 'Invalid authentification.', 'text-domain' ), array( 'status' => 401 ) );
            }
        } else {
            // L'en-tête Authorization n'est pas présent, renvoyer une erreur
            return new WP_Error( 'rest_not_authenticated', __( 'Invalid authentification.', 'text-domain' ), array( 'status' => 401 ) );
        }

        return $result;
    }

    abstract public static function getEndpoint(): string;
}