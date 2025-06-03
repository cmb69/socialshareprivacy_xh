<?php

namespace Socialshareprivacy;

use ApprovalTests\Approvals;
use PHPUnit\Framework\TestCase;
use Plib\FakeSystemChecker;
use Plib\SystemChecker;
use Plib\View;

class SystemCheckTest extends TestCase
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

    private function sut(): SystemCheck
    {
        return new SystemCheck("./plugins/socialshareprivacy", $this->systemChecker, $this->view);
    }

    public function testRendersSystemCheck(): void
    {
        $response = $this->sut()->render();
        Approvals::verifyHtml($response);
    }
}
