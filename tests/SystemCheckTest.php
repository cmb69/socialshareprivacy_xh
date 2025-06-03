<?php

namespace Socialshareprivacy;

use ApprovalTests\Approvals;
use PHPUnit\Framework\TestCase;
use Plib\FakeSystemChecker;
use Plib\SystemChecker;

class SystemCheckTest extends TestCase
{
    private SystemChecker $systemChecker;

    protected function setUp(): void
    {
        global $plugin_tx;
        $plugin_tx = XH_includeVar("./languages/en.php", "plugin_tx");
        $this->systemChecker = new FakeSystemChecker();
    }

    private function sut(): SystemCheck
    {
        return new SystemCheck("./plugins/socialshareprivacy", $this->systemChecker);
    }

    public function testRendersSystemCheck(): void
    {
        $response = $this->sut()->render();
        Approvals::verifyHtml($response);
    }
}
