<?php

/**
 * Copyright (c) Christoph M. Becker
 *
 * This file is part of Socialshareprivacy_XH.
 *
 * Socialshareprivacy_XH is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Socialshareprivacy_XH is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Socialshareprivacy_XH.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Socialshareprivacy;

use Plib\Request;
use Plib\Response;
use Plib\View;

class Controller
{
    private string $pluginFolder;
    /** @var array<string,string> */
    private array $conf;
    private View $view;

    /** @param array<string,string> $conf */
    public function __construct(string $pluginFolder, array $conf, View $view)
    {
        $this->pluginFolder = $pluginFolder;
        $this->conf = $conf;
        $this->view = $view;
    }

    public function init(Request $request): Response
    {
        return Response::create($this->view->render("share", [
            "url" => urlencode($this->conf["url"] ?: $request->url()->absolute()),
            "script" => $this->script(),
            "facebook" => $this->conf["allow_facebook"],
            "x" => $this->conf["allow_x"],
            "xing" => $this->conf["allow_xing"],
            "linkedin" => $this->conf["allow_linkedin"],
        ]));
    }

    private function script(): string
    {
        if (is_file($this->pluginFolder . "socialshareprivacy.min.js")) {
            return $this->pluginFolder . "socialshareprivacy.min.js";
        }
        return $this->pluginFolder . "socialshareprivacy.js";
    }
}
