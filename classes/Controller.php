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

/**
 * The plugin controller.
 *
 * @category CMSimple_XH
 * @package  Socialshareprivacy
 * @author   Christoph M. Becker <cmbecker69@gmx.de>
 * @license  http://www.gnu.org/licenses/gpl-3.0.en.html GNU GPLv3
 * @link     http://3-magi.net/?CMSimple_XH/Socialshareprivacy_XH
 */
class Socialshareprivacy_Controller
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
        if (XH_ADM) {
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
                'facebook' => self::getFacebookConfiguration(),
                'twitter' => self::getTwitterConfiguration(),
                'gplus' => self::getGPlusConfiguration(),
                'xing' => self::getXINGConfiguration(),
                'linkedin' => self::getLinkedInConfiguration()
            )
        );
        if ($pcf['url'] != '') {
            $config['uri'] = $pcf['url'];
        }
        return $config;
    }

    /**
     * Returns the Facebook configuration.
     *
     * @return array
     *
     * @global array  The paths of system files and folders.
     * @global string The requested language.
     * @global array  The configuration of the core.
     * @global array  The configuration of the plugins.
     * @global array  The localization of the plugins.
     */
    protected static function getFacebookConfiguration()
    {
        global $pth, $sl, $cf, $plugin_cf, $plugin_tx;

        $pcf = $plugin_cf['socialshareprivacy'];
        $ptx = $plugin_tx['socialshareprivacy'];
        $dir = $pth['folder']['plugins'] . 'socialshareprivacy/';
        $lang = strlen($sl) == 2 ? $sl : $cf['language']['default'];
        return array(
            'status' => $pcf['facebook_status'],
            'dummy_img' => $dir . 'css/images/dummy_facebook_en.png',
            'txt_info' => $ptx['facebook_info'],
            'txt_fb_off' => $ptx['facebook_off'],
            'txt_fb_on' => $ptx['facebook_on'],
            'perma_option' => $pcf['facebook_perma_option'],
            'display_name' => $ptx['facebook_display_name'],
            'referrer_track' => $pcf['facebook_referrer_track'],
            'language' => $lang. '_' . $ptx['general_country_code'],
            'action' => $pcf['facebook_action']
        );
    }

    /**
     * Returns the Twitter configuration.
     *
     * @return array
     *
     * @global array  The paths of system files and folders.
     * @global string The requested language.
     * @global array  The configuration of the core.
     * @global array  The configuration of the plugins.
     * @global array  The localization of the plugins.
     */
    protected static function getTwitterConfiguration()
    {
        global $pth, $sl, $cf, $plugin_cf, $plugin_tx;

        $pcf = $plugin_cf['socialshareprivacy'];
        $ptx = $plugin_tx['socialshareprivacy'];
        $dir = $pth['folder']['plugins'] . 'socialshareprivacy/';
        $lang = strlen($sl) == 2 ? $sl : $cf['language']['default'];
        return array(
            'status' => $pcf['twitter_status'],
            'dummy_img' => $dir. 'css/images/dummy_twitter.png',
            'txt_info' => $ptx['twitter_info'],
            'txt_twitter_off' => $ptx['twitter_off'],
            'txt_twitter_on' => $ptx['twitter_on'],
            'perma_option' => $pcf['twitter_perma_option'],
            'display_name' => $ptx['twitter_display_name'],
            'referrer_track' => $pcf['twitter_referrer_track'],
            'language' => $lang
        );
    }

    /**
     * Returns the Google Plus configuration.
     *
     * @return array
     *
     * @global array  The paths of system files and folders.
     * @global string The requested language.
     * @global array  The configuration of the core.
     * @global array  The configuration of the plugins.
     * @global array  The localization of the plugins.
     */
    protected static function getGPlusConfiguration()
    {
        global $pth, $sl, $cf, $plugin_cf, $plugin_tx;

        $pcf = $plugin_cf['socialshareprivacy'];
        $ptx = $plugin_tx['socialshareprivacy'];
        $dir = $pth['folder']['plugins'] . 'socialshareprivacy/';
        $lang = strlen($sl) == 2 ? $sl : $cf['language']['default'];
        return array(
            'status' => $pcf['gplus_status'],
            'dummy_img' => $dir . 'css/images/dummy_gplus.png',
            'txt_info' => $ptx['gplus_info'],
            'txt_gplus_off' => $ptx['gplus_off'],
            'txt_gplus_on' => $ptx['gplus_on'],
            'perma_option' => $pcf['gplus_perma_option'],
            'display_name' => $ptx['gplus_display_name'],
            'referrer_track' => $pcf['gplus_referrer_track'],
            'language' => $lang
        );
    }

    /**
     * Returns the XING configuration.
     *
     * @return array
     *
     * @global array  The paths of system files and folders.
     * @global string The requested language.
     * @global array  The configuration of the core.
     * @global array  The configuration of the plugins.
     * @global array  The localization of the plugins.
     */
    protected static function getXINGConfiguration()
    {
        global $pth, $sl, $cf, $plugin_cf, $plugin_tx;

        $pcf = $plugin_cf['socialshareprivacy'];
        $ptx = $plugin_tx['socialshareprivacy'];
        $dir = $pth['folder']['plugins'] . 'socialshareprivacy/';
        $lang = strlen($sl) == 2 ? $sl : $cf['language']['default'];
        return array(
            'status' => $pcf['xing_status'],
            'dummy_img' => $dir . 'css/images/dummy_xing.png',
            'txt_info' => $ptx['xing_info'],
            'txt_gplus_off' => $ptx['xing_off'],
            'txt_gplus_on' => $ptx['xing_on'],
            'perma_option' => $pcf['xing_perma_option'],
            'display_name' => $ptx['xing_display_name'],
            'referrer_track' => $pcf['xing_referrer_track'],
            'language' => $lang
        );
    }

    /**
     * Returns the LinkedIn configuration.
     *
     * @return array
     *
     * @global array  The paths of system files and folders.
     * @global string The requested language.
     * @global array  The configuration of the core.
     * @global array  The configuration of the plugins.
     * @global array  The localization of the plugins.
     */
    protected static function getLinkedInConfiguration()
    {
        global $pth, $sl, $cf, $plugin_cf, $plugin_tx;

        $pcf = $plugin_cf['socialshareprivacy'];
        $ptx = $plugin_tx['socialshareprivacy'];
        $dir = $pth['folder']['plugins'] . 'socialshareprivacy/';
        $lang = strlen($sl) == 2 ? $sl : $cf['language']['default'];
        return array(
            'status' => $pcf['linkedin_status'],
            'dummy_img' => $dir . 'css/images/dummy_linkedin.png',
            'txt_info' => $ptx['linkedin_info'],
            'txt_gplus_off' => $ptx['linkedin_off'],
            'txt_gplus_on' => $ptx['linkedin_on'],
            'perma_option' => $pcf['linkedin_perma_option'],
            'display_name' => $ptx['linkedin_display_name'],
            'referrer_track' => $pcf['linkedin_referrer_track'],
            'language' => $lang
        );
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
            $o .= plugin_admin_common($action, $admin, 'socialshareprivacy');
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
        return Socialshareprivacy_SystemCheck::render();
    }
}

?>
