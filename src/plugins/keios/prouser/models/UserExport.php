<?php namespace Keios\ProUser\Models;

use Backend\Models\ExportModel;
use ApplicationException;

/**
 * User Export Model
 */
class UserExport extends ExportModel
{
    /**
     * @var string
     */
    public $table = 'keios_prouser_users';

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [];

    /**
     * @param      $columns
     * @param null $sessionKey
     *
     * @return mixed
     */
    public function exportData($columns, $sessionKey = null)
    {
        $users = User::all();
        $users->each(
            function ($user) use ($columns) {
                $user->addVisible($columns);
            }
        );

        return $users->toArray();
    }

}