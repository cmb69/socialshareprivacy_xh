# Socialshareprivacy_XH

<img src="../socialshareprivacy.png" alt="Double thumbs up" align="right">

Socialshareprivacy_XH facilitates to have
Facebook, Twitter, Google+, XING and/or LinkedIn buttons on your website without
violating your visitor's privacy. Before any data are transmitted to Facebook,
Twitter, Google+, XING resp. LinkedIn, the visitor has to agree explicitely.
This plugin is only a wrapper around the jQuery plugin
[socialshareprivacy-xl](http://www.illusions-schmiede.com/Socialshareprivacy-XL)
by [Illusions-Schmiede](http://www.illusions-schmiede.com/).
Socialshareprivacy_XH doesn't provide any additional features, but is merely
meant as a simple way to use and configure the jQuery plugin without the need to
mess around in JavaScript files.

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

At first make sure that the language settings have the appropriate
[ISO-3166-1 alpha-2 country code](http://en.wikipedia.org/wiki/ISO_3166-1_alpha-2)
under `General` → `Country code`.
Otherwise the localization of the buttons might not work.

To display the social buttons on a page or in a newsbox insert:

    {{{socialshareprivacy()}}}

To display the social buttons on every page insert into your template:

    <?=socialshareprivacy()?>

In this case it's necessary to activate `Template` → `Call` in the configuration.

Note that the likes, tweets and shares refer to the currently displayed page,
including all additional query parameters, i.e. what is shown in the browser's
address bar. If a canonical link is contained in the page's (X)HTML, this will
be used, however. If you prefer that all likes, tweets and shares refer to a
certain URL, you can set this URL in the configuration.

## Limitations

The plugin requires JavaScript to be enabled in the visitor's browser;
otherwise nothing will be displayed. Actually this is not really a limitation,
as liking, tweeting and sharing requires JavaScript to be enabled anyway.

In old browsers which doesn't implement the JSON object (e.g. IE 7 and
before), the possibility to permanently activate the buttons is not available.
In browsers which doesn't understand the value "inline-block" for the "display"
declaration (e.g. IE 7 and before), the layout is broken. Despite these
limitations the plugin is still usable on IE 6 and 7.

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

Socialshareprivacy_XH is powered by
[socialshareprivacy-xl](http://www.illusions-schmiede.com/Socialshareprivacy-XL)
which is based on [socialshareprivacy](http://www.heise.de/extras/socialshareprivacy/).
Many thanks to [Heise Zeitschriften Verlag GmbH & Co. KG](http://www.heise.de/)
and [Illusions-Schmiede](http://www.illusions-schmiede.com/) for releasing
these jQuery plugins under MIT license.  And of course many thanks to *Christian*
for pointing me to socialshareprivacy and *Martin*  for pointing me to
socialshareprivacy-xl.

This plugin uses free applications icons from [Aha-Soft](http://www.aha-soft.com/).
Many thanks for making these icons freely available.

Many thanks to the community at the [CMSimple_XH forum](https://www.cmsimpleforum.com/)
for tips, suggestions and testing.

And last but not least many thanks to [Peter Harteg](httsp://www.harteg.dk),
the “father” of CMSimple,
and all developers of [CMSimple_XH](https://www.cmsimple-xh.org)
without whom this amazing CMS would not exist.
