<?php namespace Keios\ProUser\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Keios\ProUser\Models\Group;
use Flash;
use Auth;

/**
 * Class Groups
 *
 * @package Keios\ProUser\Controllers
 */
class Groups extends Controller
{
    /**
     * @var array
     */
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    /**
     * @var string
     */
    public $formConfig = 'config_form.yaml';
    /**
     * @var string
     */
    public $listConfig = 'config_list.yaml';

    /**
     * Groups constructor.
     */
    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Keios.ProUser', 'user', 'roles');
    }

    /**
     * @return mixed
     */
    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) 
        {
            foreach ($checkedIds as $groupId) {
                if (!$group = Group::find($groupId))
                    continue;

                $group->delete();
            }

            Flash::success('The Group has been deleted successfully.');
        }

         return $this->listRefresh();
    }

    /**
     * Add available permission fields to the Group form.
     *
     * @param $form
     */
    protected function formExtendFields($form)
    {
        $permissionFields = [];
        foreach (Auth::listPermissions() as $permission) {

            $fieldName = 'permissions['.$permission->code.']';
            $fieldConfig = [
                'label' => $permission->label,
                'comment' => $permission->comment,
                'type' => 'checkbox',
            ];

            if (isset($permission->tab)) {
                $fieldConfig['tab'] = $permission->tab;
            }

            $permissionFields[$fieldName] = $fieldConfig;
        }

        $form->addTabFields($permissionFields);

    }
}