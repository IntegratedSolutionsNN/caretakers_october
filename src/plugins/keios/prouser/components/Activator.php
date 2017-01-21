<?php namespace Keios\ProUser\Components;

use Keios\Apparatus\Contracts\ApparatusEventSource;
use Keios\LaravelApparatus\Facades\Dispatch;
use Cms\Classes\ComponentBase;
use Cms\Classes\Page;

/**
 * Class Activator
 *
 * @package Keios\ProUser\Components
 */
class Activator extends ComponentBase implements ApparatusEventSource
{

    /**
     *
     */
    const APPARATUS_EVENT = 'Keios.ProUser.activate';

    /**
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name' => 'User Activator',
            'description' => 'Provides user activation page functionality'
        ];
    }

    /**
     * @return array
     */
    public function defineProperties()
    {
        return [
            'redirect' => [
                'title' => 'keios.prouser::lang.account_component.redirect_title',
                'description' => 'keios.prouser::lang.account_component.redirect_description',
                'type' => 'dropdown',
                'default' => ''
            ],
            'activationCode' => [
                'title' => 'keios.prouser::lang.account_component.paramcode_title',
                'description' => 'keios.prouser::lang.account_component.paramcode_description',
                'type' => 'string',
                'default' => '{{ :code }}'
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
     * Executed when this component is bound to a page or layout.
     *
     * @return null|\Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Exception
     */
    public function onRun()
    {
        $code = $this->property('activationCode');
        /*
         * Activation code supplied
         */
        if ($code) {
            return $this->onActivate(false, $code);
        }

        return null;
    }

    /**
     * Activate the user
     *
     * @param bool   $isAjax
     * @param string $code Activation code
     *
     * @throws \Exception
     * @return \Symfony\Component\HttpFoundation\RedirectResponse | null
     */
    public function onActivate($isAjax = true, $code = null)
    {
        $reaction = null;
        $redirectUrl = $this->controller->pageUrl($this->property('redirect'));

        try {
            $code = post('code', $code);

            $reaction = Dispatch::event(static::APPARATUS_EVENT)
                                ->with([$code, $redirectUrl])
                                ->expect(['redirect'])
                                ->getReaction();

        } catch (\Exception $ex) {
            if ($isAjax) {
                throw $ex;
            } else {
                \Flash::error($ex->getMessage());
            }
        }

        return $reaction;
    }

}