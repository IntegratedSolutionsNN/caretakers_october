<?php namespace Keios\ProUser\Controllers;

use Backend\Classes\AuthManager;
use Keios\ProUser\Models\Settings as UserSettings;
use System\Classes\SettingsManager;
use Backend\Classes\Controller;
use Keios\ProUser\Models\User;
use BackendMenu;
use Flash;
use Auth;
use Lang;

/**
 * Class Users
 *
 * @package Keios\ProUser\Controllers
 */
class Users extends Controller
{
    /**
     * @var array
     */
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.ImportExportController',
    ];

    /**
     * @var string
     */
    public $formConfig = 'config_form.yaml';

    /**
     * @var string
     */
    public $importExportConfig = 'config_import_export.yaml';

    /**
     * @var string
     */
    public $listConfig = 'config_list.yaml';

    /**
     * @var array
     */
    public $requiredPermissions = ['users.access_users'];

    /**
     * @var string
     */
    public $bodyClass = 'compact-container';

    /**
     * Users constructor.
     */
    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Keios.ProUser', 'user', 'users');
        SettingsManager::setContext('Keios.ProUser', 'settings');
    }



    /**
     * Manually activate a user
     *
     * @param null $recordId
     *
     * @return \Redirect|null
     */
    public function update_onActivate($recordId = null)
    {
        $model = $this->formFindModelObject($recordId);

        $model->attemptActivation($model->activation_code);

        Flash::success('User has been activated successfully!');

        if ($redirect = $this->makeRedirect('update', $model)) {
            return $redirect;
        }

        return null;
    }

    /**
     * @param integer $recordId
     * @param null    $context
     *
     * @return mixed
     */
    public function update($recordId, $context = null)
    {
        $userId = $this->params[0];
        $status = $this->getMigrateStatus($userId);
        if ($status) {
            $this->vars['is_migrated'] = $status->is_migrated;
        } else {
            $this->vars['is_migrated'] = null;
        }

        return $this->asExtension('FormController')->update($recordId, $context);
    }


    /**
     * @param $userId
     *
     * @return mixed|static
     */
    private function getMigrateStatus($userId)
    {
        return \DB::table('keios_prouser_import_status')->where('user_id', $userId)->first();

    }

    /**
     * @param $userId
     *
     * @return \Redirect
     */
    public function onManualMigrate($userId)
    {
        $userId = $this->params[0];
        \DB::table('keios_prouser_import_status')->where('user_id', $userId)->update(['is_migrated' => 1]);
        Flash::success(trans('keios.prouser::lang.controllers.migration_success'));

        return \Redirect::to(\Backend::url('keios/prouser/users/update/'.$userId));
    }

    /**
     * Display username field if settings permit
     * Add available permission fields to the User form.
     *
     * @param $form
     */
    protected function formExtendFields($form)
    {
        $permissionFields = [];
        foreach (Auth::listPermissions() as $permission) {

            $fieldName = 'permissions['.$permission->code.']';
            $fieldConfig = [
                'label'      => $permission->label,
                'comment'    => $permission->comment,
                'type'       => 'balloon-selector',
                'options'    => [
                    1  => 'backend::lang.user.allow',
                    0  => 'backend::lang.user.inherit',
                    -1 => 'backend::lang.user.deny',
                ],
                'attributes' => [
                    'data-trigger'           => "input[name='User[permissions][superuser]']",
                    'data-trigger-type'      => 'disable',
                    'data-trigger-condition' => 'checked',
                ],
                'span'       => 'auto',
            ];

            if (isset($permission->tab)) {
                $fieldConfig['tab'] = $permission->tab;
            }

            $permissionFields[$fieldName] = $fieldConfig;
        }

        $form->addTabFields($permissionFields);

        $loginAttribute = UserSettings::get('login_attribute', UserSettings::LOGIN_EMAIL);
        if ($loginAttribute != UserSettings::LOGIN_USERNAME) {
            return;
        }

        if (array_key_exists('username', $form->getFields())) {
            $form->getField('username')->hidden = false;
        }
    }

    /**
     * Deleted checked users.
     */
    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {
            foreach ($checkedIds as $userId) {
                if (!$user = User::find($userId)) {
                    continue;
                }
                $user->delete();
            }
            Flash::success(Lang::get('keios.prouser::lang.users.delete_selected_success'));
        } else {
            Flash::error(Lang::get('keios.prouser::lang.users.delete_selected_empty'));
        }

        return $this->listRefresh();
    }
}