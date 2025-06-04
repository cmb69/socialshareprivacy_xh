<?php

namespace Socialshareprivacy;

use ApprovalTests\Approvals;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Plib\FakeRequest;
use Plib\Jquery;
use Plib\View;

class ControllerTest extends TestCase
{
    /** @var array<string,string> */
    private array $conf;
    /** @var Jquery&MockObject */
    private $jquery;
    private View $view;

    protected function setUp(): void
    {
        global $plugin_cf, $plugin_tx;
        $plugin_cf = XH_includeVar("./config/config.php", "plugin_cf");
        $plugin_tx = XH_includeVar("./languages/en.php", "plugin_tx");
        $this->conf = $plugin_cf["socialshareprivacy"];
        $this->jquery = $this->createMock(Jquery::class);
        $this->view = new View("./views/", $plugin_tx["socialshareprivacy"]);
    }

    private function sut(): Controller
    {
        return new Controller("./", $this->conf, $this->jquery, $this->view);
    }

    public function testRendersScripts(): void
    {
        $this->jquery->expects($this->once())->method("include");
        $this->jquery->expects($this->once())->method("includePlugin")->with("socialshareprivacy");
        $request = new FakeRequest();
        $response = $this->sut()->init($request);
        Approvals::verifyHtml($response->bjs());
    }

    public function testRendersWidget(): void
    {
        $request = new FakeRequest();
        $response = $this->sut()->init($request);
        Approvals::verifyHtml($response->output());
    }
}
