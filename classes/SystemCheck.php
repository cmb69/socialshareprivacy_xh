<?php

/**
 * The system check.
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
 * The system check.
 *
 * @category CMSimple_XH
 * @package  Socialshareprivacy
 * @author   Christoph M. Becker <cmbecker69@gmx.de>
 * @license  http://www.gnu.org/licenses/gpl-3.0.en.html GNU GPLv3
 * @link     http://3-magi.net/?CMSimple_XH/Socialshareprivacy_XH
 */
class Socialshareprivacy_SystemCheck
{
    /**
     * Returns the requirements information view.
     *
     * @return string (X)HTML
     *
     * @global array The localization of the plugins.
     */
    public static function render()
    {
        global $plugin_tx;

        $o = '<h4>' . $plugin_tx['socialshareprivacy']['syscheck_title'] . '</h4>'
            . self::checkPHPVersion('7.4.0') . tag('br');
        foreach (array('json') as $ext) {
            $o .= self::checkExtension($ext) . tag('br');
        }
        $o .= self::checkXHVersion('1.5.4') . tag('br')
            . self::checkUTF8Encoding() . tag('br') . tag('br');
        foreach (self::getWritableFolders() as $folder) {
            $o .= self::checkWritability($folder) . tag('br');
        }
        return $o;
    }

    /**
     * Renders the PHP version check.
     *
     * @param string $version Required PHP version.
     *
     * @return string (X)HTML
     *
     * @global array The localization of the plugins.
     */
    protected static function checkPHPVersion($version)
    {
        global $plugin_tx;

        $kind = version_compare(PHP_VERSION, $version) >= 0 ? 'ok' : 'fail';
        return self::renderCheckIcon($kind) . '&nbsp;&nbsp;'
            . sprintf(
                $plugin_tx['socialshareprivacy']['syscheck_phpversion'], $version
            );
    }

    /**
     * Renders the extension availability check.
     *
     * @param string $name An extension name.
     *
     * @return string (X)HTML
     *
     * @global array The localization of the plugins.
     */
    protected static function checkExtension($name)
    {
        global $plugin_tx;

        $kind = extension_loaded($name) ? 'ok' : 'fail';
        return self::renderCheckIcon($kind) . '&nbsp;&nbsp;'
            . sprintf(
                $plugin_tx['socialshareprivacy']['syscheck_extension'], $name
            );
    }

    /**
     * Renders the CMSimple_XH version check.
     *
     * @param string $version Required CMSimple_XH version.
     *
     * @return string (X)HTML
     *
     * @global array The localization of the plugins.
     */
    protected static function checkXHVersion($version)
    {
        global $plugin_tx;

        $kind = self::hasXHVersion($version) ? 'ok' : 'fail';
        return self::renderCheckIcon($kind) . '&nbsp;&nbsp;'
            . sprintf(
                $plugin_tx['socialshareprivacy']['syscheck_xhversion'], $version
            );
    }

    /**
     * Returns whether at least a certain CMSimple_XH version is installed.
     *
     * @param string $version A CMSimple_XH version number.
     *
     * @return bool
     */
    protected static function hasXHVersion($version)
    {
        return defined('CMSIMPLE_XH_VERSION')
            && strpos(CMSIMPLE_XH_VERSION, 'CMSimple_XH') === 0
            && version_compare(CMSIMPLE_XH_VERSION, "CMSimple_XH {$version}", 'gt');
    }

    /**
     * Renders the UTF-8 encoding check.
     *
     * @return string (X)HTML
     *
     * @global array The localization of the core.
     * @global array The localization of the plugins.
     */
    protected static function checkUTF8Encoding()
    {
        global $tx, $plugin_tx;

        $kind = strtoupper($tx['meta']['codepage']) == 'UTF-8' ? 'ok' : 'warn';
        return self::renderCheckIcon($kind) . '&nbsp;&nbsp;'
            . $plugin_tx['socialshareprivacy']['syscheck_encoding'];
    }

    /**
     * Renders a writability check.
     *
     * @param string $filename A filename.
     *
     * @return string (X)HTML
     *
     * @global array The localization of the plugins.
     */
    protected static function checkWritability($filename)
    {
        global $plugin_tx;

        $kind = is_writable($filename) ? 'ok' : 'warn';
        return self::renderCheckIcon($kind) . '&nbsp;&nbsp;'
            . sprintf(
                $plugin_tx['socialshareprivacy']['syscheck_writable'], $filename
            );
    }

    /**
     * Renders a check icon.
     *
     * @param string $kind A kind.
     *
     * @return string (X)HTML
     *
     * @global array The paths of system files and folders.
     * @global array The localization of the plugins.
     */
    protected static function renderCheckIcon($kind)
    {
        global $pth, $plugin_tx;

        $path = $pth['folder']['plugins'] . 'socialshareprivacy/images/'
            . $kind . '.png';
        $alt = $plugin_tx['socialshareprivacy']['syscheck_alt_' . $kind];
        return tag('img src="' . $path  . '" alt="' . $alt . '"');
    }

    /**
     * Returns the folders that should be writable.
     *
     * @return array
     *
     * @global array The paths of system files and folders.
     */
    protected static function getWritableFolders()
    {
        global $pth;

        $folders = array();
        foreach (array('config/', 'css/', 'languages/') as $folder) {
            $folders[] = $pth['folder']['plugins'] . 'socialshareprivacy/' . $folder;
        }
        return $folders;
    }
}

?>
