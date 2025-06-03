## Socialshareprivacy_XH

<img src="../socialshareprivacy.png" alt="Zwei Daumen hoch" align="right">

Socialshareprivacy_XH ermöglicht es Facebook,
Twitter, Google+, XING und/oder LinkedIn Buttons auf Ihrer Website zu zeigen,
ohne die Privatsphäre Ihrer Besucher zu verletzen. Bevor Daten an Facebook,
Twitter, Google+, XING bzw. LinkedIn übertragen werden, muss der Besucher
explizit einwilligen. Dieses Plugin ist nur ein Wrapper für das jQuery-Plugin
[socialshareprivacy-xl](http://www.illusions-schmiede.com/Socialshareprivacy-XL)
von der [Illusions-Schmiede](http://www.illusions-schmiede.com/).
Socialshareprivacy_XH bietet keine zusätzlichen Features, sondern ist lediglich
als einfache Möglichkeit gedacht, das jQuery-Plugin zu verwenden, und, ohne an
JavaScript-Dateien herumbasteln zu müssen, konfigurieren zu können.

- [Voraussetzungen](#voraussetzungen)
- [Download](#download)
- [Installation](#installation)
- [Einstellungen](#einstellungen)
- [Verwendung](#verwendung)
- [Einschränkungen](#einschränkungen)
- [Fehlerbehebung](#fehlerbehebung)
- [Lizenz](#lizenz)
- [Danksagung](#danksagung)

## Voraussetzungen

Socialshareprivacy_XH ist ein Plugin für [CMSimple_XH](https://cmsimple-xh.org/de/).
Es benötigt CMSimple_XH ≥ 1.7.0 und PHP ≥ 7.4.0.

## Download

Das [aktuelle Release](https://github.com/cmb69/socialshareprivacy_xh/releases/latest)
kann von Github herunter geladen werden.

## Installation

Die Installation erfolgt wie bei vielen anderen CMSimple_XH-Plugins auch.

1. Sichern Sie die Daten auf Ihrem Server.
1. Entpacken Sie die ZIP-Datei auf Ihrem Rechner.
1. Laden Sie das ganzen Ordner `socialshareprivacy/` auf Ihren Server in den
   `plugins/` Ordner von CMSimple_XH hoch.
1. Machen Sie die Unterordner `config/`, `css/` und `languages/` beschreibbar.
1. Prüfen Sie unter `Plugins` → `Socialshareprivacy` im Administrationsbereich,
   ob alle Voraussetzungen erfüllt sind.

## Einstellungen

Die Plugin-Konfiguration erfolgt wie bei vielen anderen CMSimple_XH-Plugins
auch im Administrationsbereich der Website. Gehen Sie zu `Plugins` → `Socialshareprivacy`.

Sie können die Voreinstellungen von Socialshareprivacy_XH unter
`Konfiguration` ändern. Hinweise zu den Optionen werden beim Überfahren der
Hilfe-Icons mit der Maus angezeigt.

Die Lokalisierung wird unter `Sprache` vorgenommen. Sie können die
Sprachtexte in Ihre eigene Sprache übersetzen, falls keine entsprechende
Sprachdatei zur Verfügung steht, oder diese Ihren Wünschen gemäß anpassen.

Das Aussehen von Socialshareprivacy_XH kann unter `Stylesheet` angepasst werden.

## Verwendung

Stellen Sie zunächst sicher, dass in den Spracheinstellungen der passende
[ISO-3166-1 alpha-2 Sprachcode](http://de.wikipedia.org/wiki/ISO-3166-1-Kodierliste)
unter `General` → `Country code` hinterlegt ist.
Andernfalls funktioniert die Lokalisierung der Buttons möglicherweise nicht.

Um die Gefällt-Mir-Buttons auf einer Seite oder in einer Newsbox anzuzeigen,
fügen Sie dort ein:

    {{{socialshareprivacy()}}}

Um die Gefällt-Mir-Buttons auf jeder Seite anzuzeigen, fügen Sie in Ihr
Template ein:

    <?=socialshareprivacy()?>

In diesem Fall ist es notwendig, in der Konfiguration `Template` → `Call` zu
aktivieren.

Beachten Sie, dass die Likes, Tweet und Shares sich auf die aktuell
angezeigte Seite beziehen, inklusive aller zusätzlicher Query-Parameter, d.h.
das, was in der Adressleiste des Browsers angezeigt wird. Wenn ein kanonischer
Link ("canonical link") im (X)HTML der Seite enthalten ist, wird allerdings
dieser verwendet. Wenn Sie es bevorzugen, dass sich alle Likes, Tweets und
Shares auf eine bestimmte URL beziehen, können Sie diesen in der Konfiguration
hinterlegen.

## Einschränkungen

Das Plugin erfordert, dass JavaScript im Browser des Besuchers aktiviert ist;
andernfalls wird nichts angezeigt. Eigentlich ist das keine wirkliche
Beschränkung, da Likes, Tweets und Shares ohnehin erfordern, dass JavaScript
aktiviert ist.

In alten Browsern, die das JSON-Objekt nicht implementieren (z.B. IE 7 und
früher), ist die Möglichkeit die Buttons permanent zu aktivieren nicht
vorhanden. In Browsern die den Wert "inline-block" für die "display" Deklaration
nicht verstehen (z.B. IE 7 und früher), ist das Layout defekt. Trotz dieser
Beschränkungen ist das Plugin in IE 6 und 7 verwendbar.

Wenn Sie auf dem localhost testen, können einige der Buttons nicht
ordnungsgemäß funktionieren, da die Domain localhost von den Diensten eventuell
nicht akzeptiert wird. Sie können die Konfigurationsoption `Url` nutzen, um
diese Einschränkung zu umgehen.

## Fehlerbehebung

Melden Sie Programmfehler und stellen Sie Supportanfragen entweder auf
[Github](https://github.com/cmb69/socialshareprivacy_xh/issues) oder im
[CMSimple_XH Forum](https://cmsimpleforum.com/).

## Lizenz

Socialshareprivacy_XH ist freie Software. Sie können es unter den Bedingungen der
GNU General Public License, wie von der Free Software Foundation
veröffentlicht, weitergeben und/oder modifizieren, entweder gemäß
Version 3 der Lizenz oder (nach Ihrer Option) jeder späteren Version.

Die Veröffentlichung von Socialshareprivacy_XH erfolgt in der Hoffnung, dass es
Ihnen von Nutzen sein wird, aber ohne irgendeine Garantie, sogar ohne
die implizite Garantie der Marktreife oder der Verwendbarkeit für einen
bestimmten Zweck. Details finden Sie in der GNU General Public License.

Sie sollten ein Exemplar der GNU General Public License zusammen mit
Socialshareprivacy_XH erhalten haben. Falls nicht, siehe <https://www.gnu.org/licenses/>.

Copyright © Christoph M. Becker

Slovakische Übersetzung © Dr. Martin Sereday

## Danksagung

Socialshareprivacy_XH basiert auf
[socialshareprivacy-xl](http://www.illusions-schmiede.com/Socialshareprivacy-XL),
das auf [socialshareprivacy](http://www.heise.de/extras/socialshareprivacy/)
basiert. Vielen Dank an die [Heise Zeitschriften Verlag GmbH & Co. KG](http://www.heise.de/)
und die [Illusions-Schmiede](http://www.illusions-schmiede.com/) für die
Veröffentlichung unter MIT-Lizenz. Und natürlich vielen Dank an *Christian*, der
mich auf socialshareprivacy aufmerksam gemacht hat, und *Martin*, der mich auf
socialshareprivacy-xl aufmerksam gemacht hat.

Dieses Plugin verwendet freie Anwendungs-Icons von [Aha-Soft](http://www.aha-soft.com/).
Vielen Dank für die freie Verwendbarkeit dieser Icons.

Vielen Dank an die Gemeinschaft im [CMSimple_XH Forum](https://www.cmsimpleforum.com/)
für Tipps, Vorschläge und das Testen.

Und zu guter letzt vielen Dank an [Peter Harteg](https://www.harteg.dk/),
den „Vater“ von CMSimple, und allen Entwicklern von [CMSimple_XH](https://www.cmsimple-xh.org/de/)
ohne die es dieses phantastische CMS nicht gäbe.
