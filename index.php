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

use Plib\Request;
use Socialshareprivacy\Plugin;

if (!defined("CMSIMPLE_XH_VERSION")) {
    http_response_code(403);
    exit;
}

/**
 * @var array<string,array<string,string>> $plugin_cf
 */
if ($plugin_cf["socialshareprivacy"]["template_call"]) {
    Plugin::controller()->init(Request::current())();
}

function socialshareprivacy(): string
{
    $o = Plugin::controller()->init(Request::current())();
    return $o . '<div class="socialshareprivacy"></div>';
}
