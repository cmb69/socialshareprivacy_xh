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
     * @global array  The configuration of the plugins.
     * @global bool   Whether we're in admin mode.
     * @global string Whether the plugin administration is requested.
     * @global string The value of the <var>action</var> GP parameter.
     * @global string The value of the <var>admin</var> GP parameter.
     * @global string The (X)HTML fragment to insert into the contents area.
     */
    public static function dispatch()
    {
        global $plugin_cf, $adm, $socialshareprivacy, $action, $admin, $o;

        if ($plugin_cf['socialshareprivacy']['template_call']) {
            self::init();
        }
        if ($adm) {
            if (isset($socialshareprivacy) && $socialshareprivacy == 'true') {
                $o .= print_plugin_admin('off');
                switch ($admin) {
                case '':
                    $o .= self::renderVersion() . tag('hr')
                        . self::renderSystemCheck();
                    break;
                default:
                    $o .= plugin_admin_common($action, $admin, 'socialshareprivacy');
                }
            }
        }
    }

    /**
     * Embeds the necessary JS into the <head> to display the social buttons.
     *
     * @return void
     *
     * @global string The (X)HTML fragment to insert into the head element.
     * @global string The requested language.
     * @global array  The paths of system files and folders.
     *
     * @staticvar bool $again Whether the function has already been called.
     */
    static function init()
    {
        global $hjs, $pth;
        static $again = false;

        if ($again) {
            return;
        }
        $again = true;
        $dir = $pth['folder']['plugins'].'socialshareprivacy/';
        include_once $pth['folder']['plugins'].'jquery/jquery.inc.php';
        include_jQuery();
        include_jQueryPlugin(
            'socialshareprivacy', $dir . 'js/jquery.socialshareprivacy.min.js'
        );
        $hjs .= '<script type="text/javascript">/* <![CDATA[ */'
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
     * @global array  The paths of system files and folders.
     * @global string The script name.
     * @global string The requested language.
     * @global array  The configuration of the core.
     * @global array  The configuration of the plugins.
     * @global array  The localization of the plugins.
     */
    protected static function getConfiguration()
    {
        global $pth, $sn, $sl, $cf, $plugin_cf, $plugin_tx;

        $pcf = $plugin_cf['socialshareprivacy'];
        $ptx = $plugin_tx['socialshareprivacy'];
        $dir = $pth['folder']['plugins'] . 'socialshareprivacy/';
        $lang = strlen($sl) == 2 ? $sl : $cf['language']['default'];
        return array(
            'info_link' => $ptx['general_info_link'],
            'txt_help' => $ptx['general_help'],
            'settings_perma' => $ptx['general_settings_perma'],
            'cookie_path' => $sn,
            'cookie_expires' => $pcf['cookie_expires'],
            'css_path' => '',
            'services' => array(
                'facebook' => array(
                    'status' => $pcf['facebook_status'],
                    'dummy_img' => "{$dir}css/images/dummy_facebook_en.png",
                    'txt_info' => $ptx['facebook_info'],
                    'txt_fb_off' => $ptx['facebook_off'],
                    'txt_fb_on' => $ptx['facebook_on'],
                    'perma_option' => $pcf['facebook_perma_option'],
                    'display_name' => $ptx['facebook_display_name'],
                    'referrer_track' => $pcf['facebook_referrer_track'],
                    'language' => "${lang}_$ptx[general_country_code]",
                    'action' => $pcf['facebook_action']
                ),
                'twitter' => array(
                    'status' => $pcf['twitter_status'],
                    'dummy_img' => "{$dir}css/images/dummy_twitter.png",
                    'txt_info' => $ptx['twitter_info'],
                    'txt_twitter_off' => $ptx['twitter_off'],
                    'txt_twitter_on' => $ptx['twitter_on'],
                    'perma_option' => $pcf['twitter_perma_option'],
                    'display_name' => $ptx['twitter_display_name'],
                    'referrer_track' => $pcf['twitter_referrer_track'],
                    'language' => $lang
                ),
                'gplus' => array(
                    'status' => $pcf['gplus_status'],
                    'dummy_img' => "{$dir}css/images/dummy_gplus.png",
                    'txt_info' => $ptx['gplus_info'],
                    'txt_gplus_off' => $ptx['gplus_off'],
                    'txt_gplus_on' => $ptx['gplus_on'],
                    'perma_option' => $pcf['gplus_perma_option'],
                    'display_name' => $ptx['gplus_display_name'],
                    'referrer_track' => $pcf['gplus_referrer_track'],
                    'language' => $lang
                )
            )
        );
    }

    /**
     * Returns the version information view.
     *
     * @return string (X)HTML
     *
     * @global array The paths of system files and folders.
     */
    protected static function renderVersion()
    {
        global $pth;

        return '<h1><a href="http://3-magi.net/?CMSimple_XH/Socialshareprivacy_XH">'
            . 'Socialshareprivacy_XH</a></h1>'
            . tag(
                'img style="float:left;margin:0 1em 0.5em 0" src="'
                . $pth['folder']['plugins']
                . 'socialshareprivacy/socialshareprivacy.png" alt="Plugin icon"'
            )
            . '<p style="margin-top: 1em">Version: ' . SOCIALSHAREPRIVACY_VERSION
            . '</p>'
            . '<p>Copyright &copy; 2012-2015 <a href="http://3-magi.net/">'
            . 'Christoph M. Becker</a></p>'
            . '<p>Socialshareprivacy_XH is powered by'
            . ' <a href="http://www.heise.de/extras/socialshareprivacy/">'
            . 'socialshareprivacy</a>.'
            . '<p style="text-align:justify">This program is free software: you can'
            . ' redistribute it and/or modify'
            . ' it under the terms of the GNU General Public License as published by'
            . ' the Free Software Foundation, either version 3 of the License, or'
            . ' (at your option) any later version.</p>'
            . '<p style="text-align:justify>This program is distributed in the hope'
            . ' that it will be useful,'
            . ' but WITHOUT ANY WARRANTY; without even the implied warranty of'
            . ' MERCHAN&shy;TABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the'
            . ' GNU General Public License for more details.</p>'
            . '<p style="text-align:justify>You should have received a copy of the'
            . ' GNU General Public License'
            . ' along with this program.  If not, see'
            . ' <a href="http://www.gnu.org/licenses/">http://www.gnu.org/licenses/'
            . '</a>.</p>';
    }

    /**
     * Returns the requirements information view.
     *
     * @return string (X)HTML
     *
     * @global array The paths of system files and folders.
     * @global array The localization of the core.
     * @global array The localization of the plugins.
     */
    protected static function renderSystemCheck()
    {
        global $pth, $tx, $plugin_tx;

        define('SOCIALSHAREPRIVACY_PHP_VERSION', '5.2.0');
        $ptx = $plugin_tx['socialshareprivacy'];
        $imgdir = $pth['folder']['plugins'] . 'socialshareprivacy/images/';
        $ok = tag('img src="' . $imgdir . 'ok.png" alt="ok"');
        $warn = tag('img src="' . $imgdir . 'warn.png" alt="warning"');
        $fail = tag('img src="' . $imgdir . 'fail.png" alt="failure"');
        $o = '<h4>' . $ptx['syscheck_title'] . '</h4>'
            . (version_compare(PHP_VERSION, SOCIALSHAREPRIVACY_PHP_VERSION) >= 0
                ? $ok : $fail)
            . '&nbsp;&nbsp;' . sprintf(
                $ptx['syscheck_phpversion'], SOCIALSHAREPRIVACY_PHP_VERSION
            )
            . tag('br');
        foreach (array('json') as $ext) {
            $o .= (extension_loaded($ext) ? $ok : $fail)
                . '&nbsp;&nbsp;' . sprintf($ptx['syscheck_extension'], $ext)
                . tag('br');
        }
        $o .= (!get_magic_quotes_runtime() ? $ok : $fail)
            . '&nbsp;&nbsp;' . $ptx['syscheck_magic_quotes'] . tag('br') . tag('br');
        $o .= (strtoupper($tx['meta']['codepage']) == 'UTF-8' ? $ok : $warn)
            . '&nbsp;&nbsp;' . $ptx['syscheck_encoding'] . tag('br') . tag('br');
        foreach (array('config/', 'css/', 'js', 'languages/') as $folder) {
            $folders[] = $pth['folder']['plugins'] . 'socialshareprivacy/' . $folder;
        }
        foreach ($folders as $folder) {
            $o .= (is_writable($folder) ? $ok : $warn)
                . '&nbsp;&nbsp;' . sprintf($ptx['syscheck_writable'], $folder)
                . tag('br');
        }
        return $o;
    }
}

?>
