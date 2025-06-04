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

use Plib\Jquery;
use Plib\Request;
use Plib\Response;
use Plib\View;

class Controller
{
    private string $pluginFolder;
    /** @var array<string,string> */
    private array $conf;
    private Jquery $jquery;
    private View $view;

    /** @param array<string,string> $conf */
    public function __construct(string $pluginFolder, array $conf, Jquery $jquery, View $view)
    {
        $this->pluginFolder = $pluginFolder;
        $this->conf = $conf;
        $this->jquery = $jquery;
        $this->view = $view;
    }

    public function init(Request $request): Response
    {
        $this->jquery->include();
        $this->jquery->includePlugin('socialshareprivacy', $this->pluginFolder . 'jquery.socialshareprivacy-xl.js');
        $bjs = '<script type="text/javascript">/* <![CDATA[ */'
            . 'jQuery(function() {'
            . 'jQuery(".socialshareprivacy").socialSharePrivacy('
            . json_encode($this->getConfiguration($request))
            . ');'
            . '});'
            . '/* ]]> */</script>';
        return Response::create($this->view->render("share", [
            "url" => urlencode($request->url()->absolute()),
            "facebook" => $this->conf["allow_facebook"],
            "x" => $this->conf["allow_x"],
            "xing" => $this->conf["allow_xing"],
            "linkedin" => $this->conf["allow_linkedin"],
        ]))->withBjs($bjs);
    }

    /** @return array<string,mixed> */
    private function getConfiguration(Request $request): array
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
                'facebook' => $this->getServiceConfiguration($request, 'facebook'),
                'twitter' => $this->getServiceConfiguration($request, 'twitter'),
                'gplus' => $this->getServiceConfiguration($request, 'gplus'),
                'xing' => $this->getServiceConfiguration($request, 'xing'),
                'linkedin' => $this->getServiceConfiguration($request, 'linkedin')
            )
        );
        if ($pcf['url'] != '') {
            $config['uri'] = $pcf['url'];
        }
        return $config;
    }

    /** @return array<string,string> */
    private function getServiceConfiguration(Request $request, string $service): array
    {
        global $plugin_cf, $plugin_tx;

        $pcf = $plugin_cf['socialshareprivacy'];
        $ptx = $plugin_tx['socialshareprivacy'];
        $config = array(
            'status' => $pcf["{$service}_status"],
            'dummy_img' => $this->getServiceImage($request, $service),
            'txt_info' => $ptx["{$service}_info"],
            "txt_{$service}_off" => $ptx["{$service}_off"],
            "txt_{$service}_on" => $ptx["{$service}_on"],
            'perma_option' => $pcf["{$service}_perma_option"],
            'display_name' => $ptx["{$service}_display_name"],
            'referrer_track' => $pcf["{$service}_referrer_track"],
            'language' => $this->getServiceLanguage($request, $service)
        );
        if ($service == 'facebook') {
            $config['action'] = $pcf['facebook_action'];
        }
        return $config;
    }

    private function getServiceImage(Request $request, string $service): string
    {
        $image = "{$this->pluginFolder}css/images/dummy_{$service}_{$request->language()}.png";
        if (!file_exists($image)) {
            $image = "{$this->pluginFolder}css/images/dummy_{$service}.png";
        }
        return $image;
    }

    private function getServiceLanguage(Request $request, string $service): string
    {
        global $plugin_tx;

        $lang = $request->language();
        if (in_array($service, array('facebook', 'linkedin'))) {
            $lang .= '_'
                . $plugin_tx['socialshareprivacy']['general_country_code'];
        }
        return $lang;
    }
}
