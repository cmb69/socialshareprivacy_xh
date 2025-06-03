<?php

/**
 * The plugin controller.
 *
 * PHP version 5
 *
 * @category  CMSimple_XH
 * @package   Socialshareprivacy
 * @author    Christoph M. Becker <cmbecker69@gmx.de>
 * @copyright 2012-2015 Christoph M. Becker <http://3-magi.net/>
 * @license   http://www.gnu.org/licenses/gpl-3.0.en.html GNU GPLv3
 * @link      http://3-magi.net/?CMSimple_XH/Socialshareprivacy_XH
 */

namespace Socialshareprivacy;

/**
 * The plugin controller.
 *
 * @category CMSimple_XH
 * @package  Socialshareprivacy
 * @author   Christoph M. Becker <cmbecker69@gmx.de>
 * @license  http://www.gnu.org/licenses/gpl-3.0.en.html GNU GPLv3
 * @link     http://3-magi.net/?CMSimple_XH/Socialshareprivacy_XH
 */
class Controller
{
    /**
     * Dispatches on plugin related requests.
     *
     * @return void
     *
     * @global array The configuration of the plugins.
     */
    public static function dispatch()
    {
        global $plugin_cf;

        if ($plugin_cf['socialshareprivacy']['template_call']) {
            self::init();
        }
        if (defined('XH_ADM') && XH_ADM) {
            if (function_exists('XH_registerStandardPluginMenuItems')) {
                XH_registerStandardPluginMenuItems(false);
            }
            if (self::isAdministrationRequested()) {
                self::handleAdministration();
            }
        }
    }

    /**
     * Embeds the necessary JS into the <head> to display the social buttons.
     *
     * @return void
     *
     * @global string The (X)HTML fragment to insert at the bottom of the body.
     * @global string The requested language.
     * @global array  The paths of system files and folders.
     *
     * @staticvar bool $again Whether the function has already been called.
     */
    static function init()
    {
        global $bjs, $pth;
        static $again = false;

        if ($again) {
            return;
        }
        $again = true;
        include_once $pth['folder']['plugins'] . 'jquery/jquery.inc.php';
        include_jQuery();
        include_jQueryPlugin(
            'socialshareprivacy',
            $pth['folder']['plugins']
            . 'socialshareprivacy/jquery.socialshareprivacy-xl.js'
        );
        $bjs .= '<script type="text/javascript">/* <![CDATA[ */'
            . 'jQuery(function() {'
            . 'jQuery(".socialshareprivacy").socialSharePrivacy('
            . json_encode(self::getConfiguration())
            . ');'
            . '});'
            . '/* ]]> */</script>';
    }

    /**
     * Returns the JS configuration array.
     *
     * @return array
     *
     * @global string The script name.
     * @global array  The configuration of the plugins.
     * @global array  The localization of the plugins.
     */
    protected static function getConfiguration()
    {
        global $sn, $plugin_cf, $plugin_tx;

        $pcf = $plugin_cf['socialshareprivacy'];
        $ptx = $plugin_tx['socialshareprivacy'];
        $config = array(
            'info_link' => $ptx['general_info_link'],
            'txt_help' => $ptx['general_help'],
            'settings_perma' => $ptx['general_settings_perma'],
            'cookie_path' => $sn,
            'cookie_expires' => $pcf['cookie_expires'],
            'css_path' => '',
            'services' => array(
                'facebook' => self::getServiceConfiguration('facebook'),
                'twitter' => self::getServiceConfiguration('twitter'),
                'gplus' => self::getServiceConfiguration('gplus'),
                'xing' => self::getServiceConfiguration('xing'),
                'linkedin' => self::getServiceConfiguration('linkedin')
            )
        );
        if ($pcf['url'] != '') {
            $config['uri'] = $pcf['url'];
        }
        return $config;
    }

    /**
     * Returns the configuration for a certain service.
     *
     * @param string $service A service name.
     *
     * @return array
     *
     * @global array The configuration of the plugins.
     * @global array The localization of the plugins.
     */
    protected static function getServiceConfiguration($service)
    {
        global $plugin_cf, $plugin_tx;

        $pcf = $plugin_cf['socialshareprivacy'];
        $ptx = $plugin_tx['socialshareprivacy'];
        $config = array(
            'status' => $pcf["{$service}_status"],
            'dummy_img' => self::getServiceImage($service),
            'txt_info' => $ptx["{$service}_info"],
            "txt_{$service}_off" => $ptx["{$service}_off"],
            "txt_{$service}_on" => $ptx["{$service}_on"],
            'perma_option' => $pcf["{$service}_perma_option"],
            'display_name' => $ptx["{$service}_display_name"],
            'referrer_track' => $pcf["{$service}_referrer_track"],
            'language' => self::getServiceLanguage($service)
        );
        if ($service == 'facebook') {
            $config['action'] = $pcf['facebook_action'];
        }
        return $config;
    }

    /**
     * Returns the path of the image of a certain service.
     *
     * @param string $service A service name.
     *
     * @return string
     *
     * @global array  The paths of system files and folders.
     * @global string The requested language.
     * @global array  The configuration of the core.
     */
    protected static function getServiceImage($service)
    {
        global $pth, $sl, $cf;

        $folder = $pth['folder']['plugins'] . 'socialshareprivacy/';
        $lang = strlen($sl) == 2 ? $sl : $cf['language']['default'];
        $image = "{$folder}css/images/dummy_{$service}_{$lang}.png";
        if (!file_exists($image)) {
            $image = "{$folder}css/images/dummy_{$service}.png";
        }
        return $image;
    }

    /**
     * Returns the language code for a certain service.
     *
     * @param string $service A service name.
     *
     * @return string
     *
     * @global string The requested language.
     * @global array  The configuration of the core.
     * @global array  The localization of the plugins.
     */
    protected static function getServiceLanguage($service)
    {
        global $sl, $cf, $plugin_tx;

        $lang = strlen($sl) == 2 ? $sl : $cf['language']['default'];
        if (in_array($service, array('facebook', 'linkedin'))) {
            $lang .= '_'
                . $plugin_tx['socialshareprivacy']['general_country_code'];
        }
        return $lang;
    }

    /**
     * Returns whether the plugin administration is requested.
     *
     * @return bool
     *
     * @global string Whether the plugin administration is requested.
     */
    protected static function isAdministrationRequested()
    {
        global $socialshareprivacy;

        return function_exists('XH_wantsPluginAdministration')
            && XH_wantsPluginAdministration('socialshareprivacy')
            || isset($socialshareprivacy) && $socialshareprivacy == 'true';
    }

    /**
     * Handles the plugin administration.
     *
     * @return void
     *
     * @global string The value of the <var>action</var> GP parameter.
     * @global string The value of the <var>admin</var> GP parameter.
     * @global string The (X)HTML fragment to insert into the contents area.
     */
    protected static function handleAdministration()
    {
        global $action, $admin, $o;

        $o .= print_plugin_admin('off');
        switch ($admin) {
        case '':
            $o .= self::renderVersion() . self::renderSystemCheck();
            break;
        default:
            $o .= plugin_admin_common($action, $admin, 'socialshareprivacy'); // @phpstan-ignore-line
        }
    }

    /**
     * Returns the version information view.
     *
     * @return string (X)HTML
     *
     * @global array The paths of system files and folders.
     * @global array The localization of the plugins.
     */
    protected static function renderVersion()
    {
        global $pth, $plugin_tx;

        $image = tag(
            'img class="socialshareprivacy_logo" src="' . $pth['folder']['plugins']
            . 'socialshareprivacy/socialshareprivacy.png" alt="'
            . $plugin_tx['socialshareprivacy']['alt_logo'] . '"'
        );
        $version = SOCIALSHAREPRIVACY_VERSION;
        return <<<EOT
<h1>Socialshareprivacy &ndash; {$plugin_tx['socialshareprivacy']['menu_info']}</h1>
$image
<p>Version: $version</p>
<p>Copyright &copy; 2012-2015 <a href="http://3-magi.net/">Christoph M.
Becker</a></p>
<p>Socialshareprivacy_XH is powered by <a
href="http://www.heise.de/extras/socialshareprivacy/">socialshareprivacy</a>.
<p class="socialshareprivacy_license">This program is free software: you can
redistribute it and/or modify it under the terms of the GNU General Public
License as published by the Free Software Foundation, either version 3 of the
License, or (at your option) any later version.</p>
<p class="socialshareprivacy_license">This program is distributed in the hope
that it will be useful, but <em>without any warranty</em>; without even the
implied warranty of <em>merchantability</em> or <em>fitness for a particular
purpose</em>. See the GNU General Public License for more details.</p>
<p class="socialshareprivacy_license">You should have received a copy of the GNU
General Public License along with this program. If not, see <a
href="http://www.gnu.org/licenses/">http://www.gnu.org/licenses/</a>.</p>
EOT;
    }

    /**
     * Returns the requirements information view.
     *
     * @return string (X)HTML
     */
    protected static function renderSystemCheck()
    {
        return SystemCheck::render();
    }
}

?>
