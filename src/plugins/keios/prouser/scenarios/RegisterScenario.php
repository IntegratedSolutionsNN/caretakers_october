<?php namespace Keios\ProUser\Scenarios;

use Keios\Apparatus\Core\Scenario;
use Keios\Apparatus\Core\Step;
use Keios\ProUser\Actions\RegisterUser;
use Keios\ProUser\Actions\SendActivationEmail;

/**
 * Class RegisterScenario
 *
 * @package Keios\ProUser\Scenarios
 */
class RegisterScenario extends Scenario
{
    /**
     *
     */
    protected function setUp()
    {
        $this->add(
            (new Step('performing user registration', new RegisterUser(), ['Keios.ProUser.register']))
                ->with(new SendActivationEmail())
        );
    }
}