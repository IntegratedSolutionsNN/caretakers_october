<?php namespace Keios\ProUser\Controllers;

use Lang;
use Flash;
use Backend;
use Redirect;
use BackendMenu;
use Keios\ProUser\Models\Country;
use Backend\Classes\Controller;
use System\Classes\SettingsManager;

/**
 * Locations Back-end Controller
 */
class Locations extends Controller
{
    /**
     * @var array
     */
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.RelationController',
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
     * @var string
     */
    public $relationConfig = 'config_relation.yaml';

    /**
     * Locations constructor.
     */
    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('October.System', 'system', 'settings');
        SettingsManager::setContext('Keios.ProUser', 'location');
    }


    /**
     * @param      $record
     * @param      $definition
     *
     * @return null|string
     */
    public function listInjectRowClass($record, $definition = null)
    {
        if (!$record->is_enabled) {
            return 'safe disabled';
        }

        return null;
    }

    /**
     * @return mixed
     * @throws \SystemException
     */
    public function onLoadDisableForm()
    {
        try {
            $this->vars['checked'] = post('checked');
        } catch (\Exception $ex) {
            $this->handleError($ex);
        }

        return $this->makePartial('disable_form');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function onDisableLocations()
    {
        $enable = post('enable', false);
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $objectId) {
                if (!$object = Country::find($objectId)) {
                    continue;
                }

                $object->is_enabled = $enable;
                $object->save();
            }

        }

        if ($enable) {
            Flash::success(Lang::get('keios.prouser::lang.locations.enable_success'));
        } else {
            Flash::success(Lang::get('keios.prouser::lang.locations.disable_success'));
        }

        return Redirect::to(Backend::url('keios/prouser/locations'));
    }
}