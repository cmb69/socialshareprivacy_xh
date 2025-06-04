# Socialshareprivacy_XH

<img src="../socialshareprivacy.png" alt="Double thumbs up" align="right">

Socialshareprivacy_XH facilitates to have share buttons for several social
networks on your website without violating the privacy of visitors.
Contrary to the code snippets these networks offer to embed on websites,
Socialshareprivacy_XH does not include any third-party JavaScript or other assets,
so no data are transferred to third-party servers until visitors press a share button.
Currently, Facebook, X, Xing, LinkedIn, Reddit and Mastodon are supported.

- [Requirements](#requirements)
- [Download](#download)
- [Installation](#installation)
- [Settings](#settings)
- [Usage](#usage)
- [Limitations](#limitations)
- [Troubleshooting](#troubleshooting)
- [License](#license)
- [Credits](#credits)

## Requirements

Socialshareprivacy_XH is a plugin for [CMSimple_XH](https://cmsimple-xh.org/).
It requires CMSimple_XH ≥ 1.7.0 and PHP ≥ 7.4.0.
Socialshareprivacy_XH also requires [Plib_XH](https://github.com/cmb69/plib_xh) ≥ 1.10;
if that is not already installed (see `Settings` → `Info`),
get the [lastest release](https://github.com/cmb69/plib_xh/releases/latest),
and install it.

## Download

The [lastest release](https://github.com/cmb69/socialshareprivacy_xh/releases/latest)
is available for download on Github.

## Installation
The installation is done as with many other CMSimple_XH plugins.

1. Backup the data on your server.
1. Unzip the distribution on your computer.
1. Upload the whole folder `socialshareprivacy/` to your server into
   the `plugins/` folder of CMSimple_XH.
1. Set write permissions to the subfolders `config/`, `css/` and
   `languages/`.
1. Check under `Plugins` → `Socialshareprivacy` in the back-end of the website
   whether all requirements are fulfilled.

## Settings

The configuration of the plugin configuration is done as with many other CMSimple_XH
plugins in the back-end of the website. Go to `Plugins` → `Socialshareprivacy`.

You can change the default settings of Socialshareprivacy_XH under `Config`.
Hints for the options will be displayed when hovering over the help icon with
your mouse.

Localization is done under `Language`.  You can translate the character
strings to your own language if there is no appropriate language file available,
or customize them according to your needs.

The look of Socialshareprivacy_XH can be customized under `Stylesheet`.

## Usage

To display the share buttons on a page or in a newsbox insert:

    {{{socialshareprivacy}}}

To display the share buttons on every page insert into your template:

    <?=socialshareprivacy()?>

Note that the likes, tweets and shares refer to the currently displayed page,
including all additional query parameters, i.e. what is shown in the browser's
address bar. If a canonical link is contained in the page's (X)HTML, this will
be used, however. If you prefer that all likes, tweets and shares refer to a
certain URL, you can set this URL in the configuration.

## Limitations

When testing on localhost, some of the buttons might not properly work,
because the domain localhost might not be accepted by the services. You can use
the configuration option `Url` to work around this limitation.

## Troubleshooting

Report bugs and ask for support either on
[Github](https://github.com/cmb69/socialshareprivacy_xh/issues)
or in the [CMSimple_XH Forum](https://cmsimpleforum.com/).

## License

Socialshareprivacy_XH is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

Socialshareprivacy_XH is distributed in the hope that it will be useful,
but *without any warranty*; without even the implied warranty of
*merchantibility* or *fitness for a particular purpose*. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Socialshareprivacy_XH.  If not, see <https://www.gnu.org/licenses/>.

Copyright © Christoph M. Becker

Slovak translation © Dr. Martin Sereday

## Credits

The plugin logo is designed by [Heise Zeitschriften Verlag GmbH & Co. KG](https://www.heise.de/).
Many thanks for releasing this icon under MIT license.

The logos of the social networks are from
[iconfinder.com](https://www.iconfinder.com/search/icons?price=free&category=social-media&q=social+media).
Many thanks for making these icons available for free.

Many thanks to the community at the [CMSimple_XH forum](https://www.cmsimpleforum.com/)
for tips, suggestions and testing.
Especially, I like to thank *olape* who provided a
[plugin](https://olaf.penschke.net/?CMSimple_XH/Plugins/Shariff_XH) for
[Shariff](https://www.heise.de/hintergrund/Ein-Shariff-fuer-mehr-Datenschutz-2467514.html),
which is a better solution than what Socialshareprivacy_XH 1.x offered.
Special thanks to *hufnala* who triggered the development of Socialshareprivacy_XH 2.x
with a request for Mastodon support for Shariff_XH, which revealed that Shariff is
somehow obsolete.

And last but not least many thanks to [Peter Harteg](httsp://www.harteg.dk),
the “father” of CMSimple,
and all developers of [CMSimple_XH](https://www.cmsimple-xh.org)
without whom this amazing CMS would not exist.
