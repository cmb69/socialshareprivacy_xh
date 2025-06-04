<?php

namespace Socialshareprivacy;

use ApprovalTests\Approvals;
use PHPUnit\Framework\TestCase;
use Plib\FakeRequest;
use Plib\View;

class ControllerTest extends TestCase
{
    /** @var array<string,string> */
    private array $conf;
    private View $view;

    protected function setUp(): void
    {
        global $plugin_cf, $plugin_tx;
        $plugin_cf = XH_includeVar("./config/config.php", "plugin_cf");
        $plugin_tx = XH_includeVar("./languages/en.php", "plugin_tx");
        $this->conf = $plugin_cf["socialshareprivacy"];
        $this->view = new View("./views/", $plugin_tx["socialshareprivacy"]);
    }

    private function sut(): Controller
    {
        return new Controller("./", $this->conf, $this->view);
    }

    public function testRendersWidget(): void
    {
        $request = new FakeRequest();
        $response = $this->sut()->init($request);
        Approvals::verifyHtml($response->output());
    }

    public function testUsesConfiguredUrl(): void
    {
        $url = "https://cmsimple-xh.org/";
        $this->conf["url"] = $url;
        $request = new FakeRequest();
        $response = $this->sut()->init($request);
        $this->assertStringContainsString(urlencode($url), $response->output());
    }
}
