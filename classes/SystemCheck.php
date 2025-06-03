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

class SystemCheck
{
    private string $pluginFolder;
    private SystemChecker $systemChecker;

    public function __construct(string $pluginFolder, SystemChecker $systemChecker)
    {
        $this->pluginFolder = $pluginFolder;
        $this->systemChecker = $systemChecker;
    }

    public function render(): string
    {
        global $plugin_tx;

        $o = '<h4>' . $plugin_tx['socialshareprivacy']['syscheck_title'] . '</h4>' . "\n"
            . $this->checkPHPVersion('7.4.0') . tag('br') . "\n";
        $o .= $this->checkXHVersion('1.7.0') . tag('br') . tag('br') . "\n";
        foreach ($this->getWritableFolders() as $folder) {
            $o .= $this->checkWritability($folder) . tag('br') . "\n";
        }
        return $o;
    }

    private function checkPHPVersion(string $version): string
    {
        global $plugin_tx;

        $kind = $this->systemChecker->checkVersion(PHP_VERSION, $version) ? 'ok' : 'fail';
        return $this->renderCheckIcon($kind) . '&nbsp;&nbsp;'
            . sprintf($plugin_tx['socialshareprivacy']['syscheck_phpversion'], $version);
    }

    private function checkXHVersion(string $version): string
    {
        global $plugin_tx;

        $kind = $this->hasXHVersion($version) ? 'ok' : 'fail';
        return $this->renderCheckIcon($kind) . '&nbsp;&nbsp;'
            . sprintf($plugin_tx['socialshareprivacy']['syscheck_xhversion'], $version);
    }

    private function hasXHVersion(string $version): bool
    {
        return $this->systemChecker->checkVersion(CMSIMPLE_XH_VERSION, "CMSimple_XH {$version}");
    }

    private function checkWritability(string $filename): string
    {
        global $plugin_tx;

        $kind = $this->systemChecker->checkWritability($filename) ? 'ok' : 'warn';
        return $this->renderCheckIcon($kind) . '&nbsp;&nbsp;'
            . sprintf($plugin_tx['socialshareprivacy']['syscheck_writable'], $filename);
    }

    private function renderCheckIcon(string $kind): string
    {
        global $plugin_tx;

        $path = $this->pluginFolder . 'images/'
            . $kind . '.png';
        $alt = $plugin_tx['socialshareprivacy']['syscheck_alt_' . $kind];
        return tag('img src="' . $path  . '" alt="' . $alt . '"');
    }

    private function getWritableFolders(): array
    {
        global $pth;

        $folders = array();
        foreach (array('config/', 'css/', 'languages/') as $folder) {
            $folders[] = $this->pluginFolder . $folder;
        }
        return $folders;
    }
}
