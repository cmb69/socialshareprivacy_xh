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

class Plugin
{
    public const VERSION = "2.0RC1";

    private static ?Controller $controller = null;

    public static function controller(): Controller
    {
        global $pth, $plugin_cf;
        if (self::$controller === null) {
            self::$controller = new Controller(
                $pth["folder"]["plugins"] . "socialshareprivacy/",
                $plugin_cf["socialshareprivacy"],
                self::view()
            );
        }
        return self::$controller;
    }

    public static function infoCommand(): InfoCommand
    {
        global $pth;
        return new InfoCommand(
            $pth["folder"]["plugins"] . "socialshareprivacy/",
            new SystemChecker(),
            self::view()
        );
    }

    private static function view(): View
    {
        global $pth, $plugin_tx;
        return new View($pth["folder"]["plugins"] . "socialshareprivacy/views/", $plugin_tx["socialshareprivacy"]);
    }
}
