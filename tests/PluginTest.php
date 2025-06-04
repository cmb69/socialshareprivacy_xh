<?php

namespace Socialshareprivacy;

use PHPUnit\Framework\TestCase;

class PluginTest extends TestCase
{
    protected function setUp(): void
    {
        global $pth, $plugin_cf, $plugin_tx;
        $pth = ["folder" => ["plugins" => ""]];
        $plugin_cf = ["socialshareprivacy" => []];
        $plugin_tx = ["socialshareprivacy" => []];
    }

    public function testMakesController(): void
    {
        $this->assertInstanceOf(Controller::class, Plugin::controller());
    }

    public function testMakesInfoCommand(): void
    {
        $this->assertInstanceOf(InfoCommand::class, Plugin::infoCommand());
    }
}
