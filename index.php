<?php

/**
 * Front-end of Socialshareprivacy_XH.
 *
 * PHP version 5
 *
 * @category  CMSimple_XH
 * @package   Socialshareprivacy
 * @author    Christoph M. Becker <cmbecker69@gmx.de>
 * @copyright 2012-2015 Christoph M. Becker <http://3-magi.net>
 * @license   http://www.gnu.org/licenses/gpl-3.0.en.html GNU GPLv3
 * @link      http://3-magi.net/?CMSimple_XH/Socialshareprivacy_XH
 */

/*
 * Prevent direct access and usage from unsupported CMSimple_XH versions.
 */
if (!defined('CMSIMPLE_XH_VERSION')
    || strpos(CMSIMPLE_XH_VERSION, 'CMSimple_XH') !== 0
    || version_compare(CMSIMPLE_XH_VERSION, 'CMSimple_XH 1.5.4', 'lt')
) {
    header('HTTP/1.1 403 Forbidden');
    header('Content-Type: text/plain; charset=UTF-8');
    die(<<<EOT
Socialshareprivacy_XH detected an unsupported CMSimple_XH version.
Uninstall Socialshareprivacy_XH or upgrade to a supported CMSimple_XH version!
EOT
    );
}

/**
 * The plugin version.
 */
define('SOCIALSHAREPRIVACY_VERSION', '@SOCIALSHAREPRIVACY_VERSION@');

/**
 * Displays the social buttons.
 *
 * @return string (X)HTML
 */
function socialshareprivacy()
{
    Socialshareprivacy_Controller::init();
    return '<div class="socialshareprivacy"></div>';
}

Socialshareprivacy_Controller::dispatch();

?>
