<?php namespace Keios\ProUser\Components;

use Auth;
use Keios\ProUser\Models\User;
use Request;
use Redirect;
use Flash;
use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use October\Rain\Support\ValidationException;
use Keios\ProUser\Models\Permission;

/**
 * Class Session
 *
 * @package Keios\ProUser\Components
 */
class Session extends ComponentBase
{

    const ALLOW_ALL = 'all';

    const ALLOW_GUEST = 'guest';

    const ALLOW_USER = 'user';

    /**
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name' => 'keios.prouser::lang.session_component.name',
            'description' => 'keios.prouser::lang.session_component.description'
        ];
    }

    /**
     * @return array
     */
    public function defineProperties()
    {
        return [
            'security' => [
                'title' => 'keios.prouser::lang.session_component.security_title',
                'description' => 'keios.prouser::lang.session_component.security_description',
                'type' => 'dropdown',
                'default' => 'all',
                'depends' => ['permission']
            ],
            'permission' => [
                'title' => 'keios.prouser::lang.session_component.permission_title',
                'description' => 'keios.prouser::lang.session_component.permission_description',
                'type' => 'dropdown',
                'default' => '',
            ],
            'redirect' => [
                'title' => 'keios.prouser::lang.session_component.redirect_title',
                'description' => 'keios.prouser::lang.session_component.redirect_description',
                'type' => 'dropdown',
                'default' => ''
            ],
            'flashMessage' => [
                'title' => 'keios.prouser::lang.session_component.flash_title',
                'description' => 'keios.prouser::lang.session_component.flash_description',
                'type' => 'checkbox',
                'default' => false
            ]
        ];
    }

    /**
     * @return array
     */
    public function getRedirectOptions()
    {
        return ['' => '- none -'] + Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    /**
     * @return array
     */
    public function getPermissionOptions()
    {
        return ['' => '- none -'];
    }

    /**
     * @return array
     */
    public function getSecurityOptions()
    {
        $permission = post('permission');
        if (!$permission)
            return [
                'all' => 'All',
                'guest' => 'Guest',
                'user' => 'Users'
            ];
        else
            return [
                'user' => 'Users'
            ];
    }


    /**
     * Executed when this component is bound to a page or layout.
     *
     * @return \Illuminate\Http\RedirectResponse|null
     */
    public function onRun()
    {
        $redirectUrl = $this->controller->pageUrl($this->property('redirect'));
        $allowedGroup = $this->property('security', self::ALLOW_ALL);
        $isAuthenticated = Auth::check();

        if (!$isAuthenticated && $allowedGroup == self::ALLOW_USER) {
            $this->showFlashMessageMaybe();
            return Redirect::intended($redirectUrl);
        } elseif ($isAuthenticated && $allowedGroup == self::ALLOW_GUEST) {
            $this->showFlashMessageMaybe();
            return Redirect::intended($redirectUrl);
        }

        /*
         * Permissions check
         */
        $user = $this->user();
        $requiredPermission = $this->property('permission');
        if ($requiredPermission && !$user->hasPermission($requiredPermission)) {
            $this->showFlashMessageMaybe();
            return Redirect::intended($redirectUrl);
        }

        $this->page['user'] = $user;

        return null;
    }

    /**
     *
     */
    protected function showFlashMessageMaybe()
    {
        if ($this->property('flashMessage'))
            Flash::warning(trans('keios.prouser::lang.flash.forbidden'));
    }

    /**
     * Log out the user
     *
     * Usage:
     *   <a data-request="onLogout">Sign out</a>
     *
     * With the optional redirect parameter:
     *   <a data-request="onLogout" data-request-data="redirect: '/good-bye'">Sign out</a>
     *
     *
     * @return Redirect
     */
    public function onLogout()
    {
        Auth::logout();
        Flash::success(trans('keios.prouser::lang.flash.loggedout'));
        $url = post('redirect', Request::fullUrl());
        return Redirect::to($url);
    }

    /**
     * Returns the logged in user, if available
     *
     * @return null|User
     */
    public function user()
    {
        if (!Auth::check())
            return null;

        return Auth::getUser();
    }

}