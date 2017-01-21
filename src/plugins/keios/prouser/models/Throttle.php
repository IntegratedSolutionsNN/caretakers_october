<?php namespace Keios\ProUser\Models;

use October\Rain\Auth\Models\Throttle as ThrottleBase;

/**
 * Class Throttle
 *
 * @package Keios\ProUser\Models
 */
class Throttle extends ThrottleBase
{
    /**
     * @var string The database table used by the model.
     */
    protected $table = 'keios_prouser_user_throttle';

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'user' => ['Keios\ProUser\Models\User']
    ];
}
