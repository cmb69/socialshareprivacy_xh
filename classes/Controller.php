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

class Controller
{
    public function init(): void
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
            . json_encode($this->getConfiguration())
            . ');'
            . '});'
            . '/* ]]> */</script>';
    }

    /** @return array<string,mixed> */
    private function getConfiguration(): array
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
                'facebook' => $this->getServiceConfiguration('facebook'),
                'twitter' => $this->getServiceConfiguration('twitter'),
                'gplus' => $this->getServiceConfiguration('gplus'),
                'xing' => $this->getServiceConfiguration('xing'),
                'linkedin' => $this->getServiceConfiguration('linkedin')
            )
        );
        if ($pcf['url'] != '') {
            $config['uri'] = $pcf['url'];
        }
        return $config;
    }

    /** @return array<string,string> */
    private function getServiceConfiguration(string $service): array
    {
        global $plugin_cf, $plugin_tx;

        $pcf = $plugin_cf['socialshareprivacy'];
        $ptx = $plugin_tx['socialshareprivacy'];
        $config = array(
            'status' => $pcf["{$service}_status"],
            'dummy_img' => $this->getServiceImage($service),
            'txt_info' => $ptx["{$service}_info"],
            "txt_{$service}_off" => $ptx["{$service}_off"],
            "txt_{$service}_on" => $ptx["{$service}_on"],
            'perma_option' => $pcf["{$service}_perma_option"],
            'display_name' => $ptx["{$service}_display_name"],
            'referrer_track' => $pcf["{$service}_referrer_track"],
            'language' => $this->getServiceLanguage($service)
        );
        if ($service == 'facebook') {
            $config['action'] = $pcf['facebook_action'];
        }
        return $config;
    }

    private function getServiceImage(string $service): string
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

    private function getServiceLanguage(string $service): string
    {
        global $sl, $cf, $plugin_tx;

        $lang = strlen($sl) == 2 ? $sl : $cf['language']['default'];
        if (in_array($service, array('facebook', 'linkedin'))) {
            $lang .= '_'
                . $plugin_tx['socialshareprivacy']['general_country_code'];
        }
        return $lang;
    }
}
