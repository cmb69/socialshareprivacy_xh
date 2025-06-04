<?php

namespace Socialshareprivacy;

use ApprovalTests\Approvals;
use PHPUnit\Framework\TestCase;
use Plib\FakeSystemChecker;
use Plib\SystemChecker;
use Plib\View;

class InfoCommandTest extends TestCase
{
    private SystemChecker $systemChecker;
    private View $view;

    protected function setUp(): void
    {
        global $plugin_tx;
        $plugin_tx = XH_includeVar("./languages/en.php", "plugin_tx");
        $this->systemChecker = new FakeSystemChecker();
        $this->view = new View("./views/", $plugin_tx["socialshareprivacy"]);
    }

    private function sut(): InfoCommand
    {
        return new InfoCommand("./plugins/socialshareprivacy", $this->systemChecker, $this->view);
    }

    public function testRendersSystemCheck(): void
    {
        $response = $this->sut()();
        $this->assertSame("Socialshareprivacy 2.0RC1", $response->title());
        Approvals::verifyHtml($response->output());
    }
}
