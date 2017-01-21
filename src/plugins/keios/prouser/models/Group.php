<?php namespace Keios\ProUser\Models;

use October\Rain\Auth\Models\Group as GroupBase;

/**
 * Frontend user group
 */
class Group extends GroupBase
{
    /**
     * @var array
     */
    protected $fillable = [
        'name', 'permissions'
    ];
    /**
     * @var string The database table used by the model.
     */
    protected $table = 'keios_prouser_groups';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'name' => 'required|between:4,16|unique:keios_prouser_groups',
    ];

    /**
     * @var array Relations
     */
    public $belongsToMany = [
        'users' => ['Keios\ProUser\Models\User', 'table' => 'keios_prouser_user_group']
    ];
}


