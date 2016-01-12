<?php namespace core\utils;

use core\routing\Get;
use core\routing\Router;

final class Url
{
    public static function current()
    {
        $url = self::base() . Get::urlSegments();
        return $url;
    }

    public static function base($str = null, $params = null)
    {
        if ($str and is_string($str) and strlen($str) > 0) {

            $routes = Router::getRoutes();

            $routeName = (array_key_exists($str, $routes)) ? $str : null;
            $routeName = (is_null($routeName)) ? array_search($str, $routes) : null;

            $segments = ($routeName) ? $routeName : $str;

            if ($params and is_array($params) and count($params) > 0) {
                $params = implode('/', $params);
                return BASE_URL . $segments . DS . $params;
            }
            return BASE_URL . $segments;
        }
        return BASE_URL;
    }

    public static function route($routeName, $params = null)
    {
        return self::base($routeName, $params);
    }

    public static function controller($controllerName, $params = null)
    {
        return self::base($controllerName, $params);
    }

    public static function asset($resource)
    {
        if (is_string($resource) and strlen($resource) > 0) {
            return PUBLIC_URL . $resource;
        }
        return null;
    }
}