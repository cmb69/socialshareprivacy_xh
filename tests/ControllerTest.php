<?php

namespace Socialshareprivacy;

use ApprovalTests\Approvals;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Plib\FakeRequest;
use Plib\Jquery;

class ControllerTest extends TestCase
{
    /** @var Jquery&MockObject */
    private $jquery;

    protected function setUp(): void
    {
        global $plugin_cf, $plugin_tx;
        $plugin_cf = XH_includeVar("./config/config.php", "plugin_cf");
        $plugin_tx = XH_includeVar("./languages/en.php", "plugin_tx");
        $this->jquery = $this->createMock(Jquery::class);
    }

    private function sut(): Controller
    {
        return new Controller(
            "./",
            $this->jquery
        );
    }

    public function testRendersScripts(): void
    {
        $this->jquery->expects($this->once())->method("include");
        $this->jquery->expects($this->once())->method("includePlugin")->with("socialshareprivacy");
        $request = new FakeRequest();
        $response = $this->sut()->init($request);
        Approvals::verifyHtml($response->bjs());
    }
}
