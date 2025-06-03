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

class SystemCheck
{
    public static function render(): string
    {
        global $plugin_tx;

        $o = '<h4>' . $plugin_tx['socialshareprivacy']['syscheck_title'] . '</h4>'
            . self::checkPHPVersion('7.4.0') . tag('br');
        $o .= self::checkXHVersion('1.7.0') . tag('br')
            . tag('br');
        foreach (self::getWritableFolders() as $folder) {
            $o .= self::checkWritability($folder) . tag('br');
        }
        return $o;
    }

    protected static function checkPHPVersion(string $version): string
    {
        global $plugin_tx;

        $kind = version_compare(PHP_VERSION, $version) >= 0 ? 'ok' : 'fail';
        return self::renderCheckIcon($kind) . '&nbsp;&nbsp;'
            . sprintf($plugin_tx['socialshareprivacy']['syscheck_phpversion'], $version);
    }

    protected static function checkXHVersion(string $version): string
    {
        global $plugin_tx;

        $kind = self::hasXHVersion($version) ? 'ok' : 'fail';
        return self::renderCheckIcon($kind) . '&nbsp;&nbsp;'
            . sprintf($plugin_tx['socialshareprivacy']['syscheck_xhversion'], $version);
    }

    protected static function hasXHVersion(string $version): bool
    {
        return defined('CMSIMPLE_XH_VERSION')
            && strpos(CMSIMPLE_XH_VERSION, 'CMSimple_XH') === 0
            && version_compare(CMSIMPLE_XH_VERSION, "CMSimple_XH {$version}", 'gt');
    }

    protected static function checkWritability(string $filename): string
    {
        global $plugin_tx;

        $kind = is_writable($filename) ? 'ok' : 'warn';
        return self::renderCheckIcon($kind) . '&nbsp;&nbsp;'
            . sprintf($plugin_tx['socialshareprivacy']['syscheck_writable'], $filename);
    }

    protected static function renderCheckIcon(string $kind): string
    {
        global $pth, $plugin_tx;

        $path = $pth['folder']['plugins'] . 'socialshareprivacy/images/'
            . $kind . '.png';
        $alt = $plugin_tx['socialshareprivacy']['syscheck_alt_' . $kind];
        return tag('img src="' . $path  . '" alt="' . $alt . '"');
    }

    protected static function getWritableFolders(): array
    {
        global $pth;

        $folders = array();
        foreach (array('config/', 'css/', 'languages/') as $folder) {
            $folders[] = $pth['folder']['plugins'] . 'socialshareprivacy/' . $folder;
        }
        return $folders;
    }
}
