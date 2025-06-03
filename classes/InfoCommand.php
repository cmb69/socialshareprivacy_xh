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

use Plib\SystemChecker;
use Plib\View;

class InfoCommand
{
    private string $pluginFolder;
    private SystemChecker $systemChecker;
    private View $view;

    public function __construct(string $pluginFolder, SystemChecker $systemChecker, View $view)
    {
        $this->pluginFolder = $pluginFolder;
        $this->systemChecker = $systemChecker;
        $this->view = $view;
    }

    public function render(): string
    {
        return $this->view->render("info", [
            "version" => Plugin::VERSION,
            "checks" => $this->checks(),
        ]);
    }

    /** @return list<string> */
    private function checks(): array
    {
        $checks = [];
        $checks[] = $this->checkPHPVersion('7.4.0');
        $checks[] = $this->checkXHVersion('1.7.0');
        foreach ($this->getWritableFolders() as $folder) {
            $checks[] = $this->checkWritability($folder);
        }
        return $checks;
    }

    private function checkPHPVersion(string $version): string
    {
        $kind = $this->systemChecker->checkVersion(PHP_VERSION, $version) ? 'success' : 'fail';
        return $this->view->message($kind, "syscheck_phpversion", $version);
    }

    private function checkXHVersion(string $version): string
    {
        $kind = $this->hasXHVersion($version) ? 'success' : 'fail';
        return $this->view->message($kind, "syscheck_xhversion", $version);
    }

    private function hasXHVersion(string $version): bool
    {
        return $this->systemChecker->checkVersion(CMSIMPLE_XH_VERSION, "CMSimple_XH {$version}");
    }

    private function checkWritability(string $filename): string
    {
        $kind = $this->systemChecker->checkWritability($filename) ? 'success' : 'warning';
        return $this->view->message($kind, "syscheck_writable", $filename);
    }

    /** @return list<string> */
    private function getWritableFolders(): array
    {
        $folders = array();
        foreach (array('config/', 'css/', 'languages/') as $folder) {
            $folders[] = $this->pluginFolder . $folder;
        }
        return $folders;
    }
}
