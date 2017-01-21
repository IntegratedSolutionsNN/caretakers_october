<?php namespace Keios\ProUser\Facades;

use October\Rain\Support\Facade;

/**
 * Class Auth
 *
 * @package Keios\ProUser\Facades
 */
class Auth extends Facade
{
    /**
     * Get the registered name of the component.
     * @return string
     */
    protected static function getFacadeAccessor() { return 'user.auth'; }
}
