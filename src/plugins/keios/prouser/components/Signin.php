<?php namespace Keios\ProUser\Components;

use Cms\Classes\ComponentBase;
use Cms\Classes\Page;

/**
 * Class Signin
 *
 * @package Keios\ProUser\Components
 */
class Signin extends ComponentBase
{

    /**
     * @var
     */
    public $target;

    /**
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name'        => 'keios.prouser::lang.signin_component.name',
            'description' => 'keios.prouser::lang.signin_component.description'
        ];
    }

    /**
     * @return array
     */
    public function defineProperties()
    {
        return [
            'redirect' => [
                'title'       => 'keios.prouser::lang.signin_component.redirect_title',
                'description' => 'keios.prouser::lang.signin_component.redirect_description',
                'type'        => 'dropdown',
                'default'     => ''
            ],
            'anchor'   => [
                'title'       => 'keios.prouser::lang.signin_component.anchor_title',
                'description' => 'keios.prouser::lang.signin_component.anchor_description',
                'default'     => ''
            ]
        ];
    }

    /**
     * @return array
     */
    public function getRedirectOptions()
    {
        return ['' => '- none -'] + Page::sortBy('baseFileName')->lists('baseFileName', 'url');
    }

    /**
     * @return mixed
     */
    public function signInTarget()
    {
        $this->target = \Resolver::resolveRouteTo('account');
        $this->target = $this->stripCodePart($this->target);

        return $this->target;
    }

    /**
     * @param $toStrip
     *
     * @return mixed
     */
    protected function stripCodePart($toStrip)
    {
        $parts = explode('/:', $toStrip);

        return $parts[0];
    }

    /**
     * @return bool|null
     */
    public function hasRedirect()
    {
        if ($this->property('redirect')) {
            return true;
        }

        return null;
    }

    /**
     * @return string
     */
    public function redirect()
    {
        return $this->property('redirect').$this->getAnchor();
    }

    /**
     * @return null|string
     */
    protected function getAnchor()
    {
        $anchor = $this->property('anchor');

        return $anchor ? '#'.$anchor : null;
    }
}