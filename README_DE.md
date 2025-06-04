## Socialshareprivacy_XH

<img src="../socialshareprivacy.png" alt="Zwei Daumen hoch" align="right">

Socialshareprivacy_XH ermöglicht die Einbindung von Teilen-Schaltern für verschiedene
soziale Netzwerke auf Ihrer Website, ohne die Privatsphäre Ihrer Besucher zu verletzen.
Im Gegensatz zu den Code-Schnipseln, die diese Netwerke zum Einbinden auf Websites
anbieten, verwendet Socialshareprivacy_XH kein JavaScript oder andere Assets der
Anbieter, so dass keine Daten zu Fremdservern übertragen werden, bevor Besucher
einen Teilen-Schalter anklicken.

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
Socialshareprivacy_XH benötigt weiterhin [Plib_XH](https://github.com/cmb69/plib_xh) ≥ 1.10;
ist dieses noch nicht installiert (siehe `Einstellungen` → `Info`),
laden Sie das [aktuelle Release](https://github.com/cmb69/plib_xh/releases/latest)
herunter, und installieren Sie es.

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

Um die Teilen-Buttons auf einer Seite oder in einer Newsbox anzuzeigen,
fügen Sie dort ein:

    {{{socialshareprivacy}}}

Um die Teilen-Buttons auf jeder Seite anzuzeigen, fügen Sie in Ihr
Template ein:

    <?=socialshareprivacy()?>

Beachten Sie, dass die Likes, Tweet und Shares sich auf die aktuell
angezeigte Seite beziehen, inklusive aller zusätzlicher Query-Parameter, d.h.
das, was in der Adressleiste des Browsers angezeigt wird. Wenn ein kanonischer
Link ("canonical link") im (X)HTML der Seite enthalten ist, wird allerdings
dieser verwendet. Wenn Sie es bevorzugen, dass sich alle Likes, Tweets und
Shares auf eine bestimmte URL beziehen, können Sie diesen in der Konfiguration
hinterlegen.

## Einschränkungen

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

Das Plugin-Logo wurde von [Heise Zeitschriften Verlag GmbH & Co. KG](http://www.heise.de/) entworfen.
Vielen Dank für die Veröffentlichung dieses Icons unter MIT Lizenz.

Vielen Dank an die Gemeinschaft im [CMSimple_XH Forum](https://www.cmsimpleforum.com/)
für Tipps, Vorschläge und das Testen.

Und zu guter letzt vielen Dank an [Peter Harteg](https://www.harteg.dk/),
den „Vater“ von CMSimple, und allen Entwicklern von [CMSimple_XH](https://www.cmsimple-xh.org/de/)
ohne die es dieses phantastische CMS nicht gäbe.
