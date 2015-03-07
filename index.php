<?php

/**
 * Front-end of Socialshareprivacy_XH.
 *
 * PHP versions 4 and 5
 *
 * @category  CMSimple_XH
 * @package   Socialshareprivacy_XH
 * @author    Christoph M. Becker <cmbecker69@gmx.de>
 * @copyright 2012-2015 Christoph M. Becker
 * @license   GNU GPL v3
 * @link      http://3-magi.net/?CMSimple_XH/Socialshareprivacy_XH
 */

/*
 * Prevent direct access.
 */
if (!defined('CMSIMPLE_XH_VERSION')) {
    header('HTTP/1.0 403 Forbidden');
    exit;
}

/**
 * The plugin version.
 */
define('SOCIALSHAREPRIVACY_VERSION', '1rc2');

/**
 * Returns the JS to initialize the social buttons.
 *
 * @return string
 *
 * @global string The script name.
 * @global string The requested language.
 * @global array  The configuration of the core.
 * @global array  The configuration of the plugins.
 * @global array  The localization of the plugins.
 */
function Socialshareprivacy_config()
{
    global $sn, $sl, $cf, $plugin_cf, $plugin_tx;

    $pcf = array();
    foreach ($plugin_cf['socialshareprivacy'] as $key => $opt) {
        $pcf[$key] = addcslashes($opt, "\n\r\t\\\'");
    }
    $ptx = array();
    foreach ($plugin_tx['socialshareprivacy'] as $key => $opt) {
        $ptx[$key] = addcslashes($opt, "\n\r\t\\\'");
    }
    $lang = strlen($sl) == 2 ? $sl : $cf['language']['default'];
    return <<<SCRIPT
// automatically generated by Socialshareprivacy_XH
// do not modify directly
jQuery(function() {
    jQuery('.socialshareprivacy').socialSharePrivacy({
        info_link: '$ptx[general_info_link]',
        txt_help: '$ptx[general_help]',
        settings_perma: '$ptx[general_settings_perma]',
        cookie_path: '$sn',
        cookie_expires: $pcf[cookie_expires],
        css_path: '',
        services: {
            facebook: {
                status: '$pcf[facebook_status]',
                dummy_img: '${dir}css/images/dummy_facebook_en.png',
                txt_info: '$ptx[facebook_info]',
                txt_fb_off: '$ptx[facebook_off]',
                txt_fb_on: '$ptx[facebook_on]',
                perma_option: '$pcf[facebook_perma_option]',
                display_name: '$ptx[facebook_display_name]',
                referrer_track: '$pcf[facebook_referrer_track]',
                language: '${lang}_$ptx[general_country_code]',
                action: '$pcf[facebook_action]'
            },
            twitter: {
                status: '$pcf[twitter_status]',
                dummy_img: '${dir}css/images/dummy_twitter.png',
                txt_info: '$ptx[twitter_info]',
                txt_twitter_off: '$ptx[twitter_off]',
                txt_twitter_on: '$ptx[twitter_on]',
                perma_option: '$pcf[twitter_perma_option]',
                display_name: '$ptx[twitter_display_name]',
                referrer_track: '$pcf[twitter_referrer_track]',
                language: '$lang'
            },
            gplus: {
                status: '$pcf[gplus_status]',
                dummy_img: '${dir}css/images/dummy_gplus.png',
                txt_info: '$ptx[gplus_info]',
                txt_gplus_off: '$ptx[gplus_off]',
                txt_gplus_on: '$ptx[gplus_on]',
                perma_option: '$pcf[gplus_perma_option]',
                display_name: '$ptx[gplus_display_name]',
                referrer_track: '$pcf[gplus_referrer_track]',
                language: '$lang'
            }
        }
    })
})
SCRIPT;
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
function Socialshareprivacy_init()
{
    global $hjs, $sl, $pth;
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
    $fn = $dir . 'js/socialshareprivacy-' . $sl . '.js';
    $init = Socialshareprivacy_config();
    if (!file_exists($fn)
        || filemtime($fn) <= filemtime($dir . 'config/config.php')
        || filemtime($fn) <= filemtime($dir . 'languages/' . $sl . '.php')
    ) {
        if (file_exists($fn) && !is_writable($fn)
            ||($fh = fopen($fn, 'w')) === false
            || fwrite($fh, $init) === false
        ) {
            e('cntsave', 'file', $fn);
        }
        if ($fh !== false) {
            fclose($fh);
        }
    }
    $hjs .= '<script type="text/javascript" src="' . $fn . '"></script>';
}

/**
 * Displays the social buttons.
 *
 * @return string (X)HTML
 */
function socialshareprivacy()
{
    Socialshareprivacy_init();
    return '<div class="socialshareprivacy"></div>';
}


/*
 * Initialize plugin, if template_call is set.
 */
if ($plugin_cf['socialshareprivacy']['template_call']) {
    Socialshareprivacy_init();
}

?>
