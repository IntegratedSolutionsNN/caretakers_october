<?php namespace Keios\ProUser\Scenarios;

use Keios\Apparatus\Core\Scenario;
use Keios\Apparatus\Core\Step;
use Keios\ProUser\Actions\ActivateUser;
use Keios\ProUser\Actions\SendWelcomeEmail;

/**
 * Class ActivationScenario
 *
 * @package Keios\ProUser\Scenarios
 */
class ActivationScenario extends Scenario
{
    /**
     *
     */
    protected function setUp()
    {
        $this->add(
            (new Step('attempting user account activation', new ActivateUser(), ['Keios.ProUser.activate']))
                ->with(new SendWelcomeEmail())
        );
    }
}