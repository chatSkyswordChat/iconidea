<?php

namespace FCFProVendor\WPDesk\Composer\Codeception;

use FCFProVendor\WPDesk\Composer\Codeception\Commands\CreateCodeceptionTests;
use FCFProVendor\WPDesk\Composer\Codeception\Commands\PrepareCodeceptionDb;
use FCFProVendor\WPDesk\Composer\Codeception\Commands\PrepareLocalCodeceptionTests;
use FCFProVendor\WPDesk\Composer\Codeception\Commands\PrepareParallelCodeceptionTests;
use FCFProVendor\WPDesk\Composer\Codeception\Commands\PrepareWordpressForCodeception;
use FCFProVendor\WPDesk\Composer\Codeception\Commands\RunCodeceptionTests;
use FCFProVendor\WPDesk\Composer\Codeception\Commands\RunLocalCodeceptionTests;
/**
 * Links plugin commands handlers to composer.
 */
class CommandProvider implements \FCFProVendor\Composer\Plugin\Capability\CommandProvider
{
    public function getCommands()
    {
        return [new \FCFProVendor\WPDesk\Composer\Codeception\Commands\CreateCodeceptionTests(), new \FCFProVendor\WPDesk\Composer\Codeception\Commands\RunCodeceptionTests(), new \FCFProVendor\WPDesk\Composer\Codeception\Commands\RunLocalCodeceptionTests(), new \FCFProVendor\WPDesk\Composer\Codeception\Commands\PrepareCodeceptionDb(), new \FCFProVendor\WPDesk\Composer\Codeception\Commands\PrepareWordpressForCodeception(), new \FCFProVendor\WPDesk\Composer\Codeception\Commands\PrepareLocalCodeceptionTests(), new \FCFProVendor\WPDesk\Composer\Codeception\Commands\PrepareParallelCodeceptionTests()];
    }
}
