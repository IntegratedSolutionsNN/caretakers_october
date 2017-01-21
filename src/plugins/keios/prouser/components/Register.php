<?php namespace Keios\ProUser\Components;

use Cms\Classes\ComponentBase;
use Cms\Classes\Page;

/**
 * Class Register
 *
 * @package Keios\ProUser\Components
 */
class Register extends ComponentBase
{

    /**
     * @var
     */
    protected $target;

    /**
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name' => 'keios.prouser::lang.register_component.name',
            'description' => 'keios.prouser::lang.register_component.description'
        ];
    }

    /**
     * @return array
     */
    public function defineProperties()
    {
        return [
            'redirect' => [
                'title' => 'keios.prouser::lang.register_component.redirect_title',
                'description' => 'keios.prouser::lang.register_component.redirect_description',
                'type' => 'dropdown',
                'default' => ''
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
    public function registerTarget()
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
     * @return mixed
     */
    public function redirect()
    {
        return $this->stripCodePart($this->property('redirect'));
    }


}