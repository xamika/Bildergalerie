Tobias Bildergalerie
=============

Dies ist eine mit dem GIBB MVC erstellt Bildergalerie. Bower wurde als Management System der Erweiterungen verwendet.

Dependencies
-------
Es wurden verschiedene Plugins verwendet:
 * bootstrap: "^3.3.6" -> für das Layout
 * font-awesome: "fontawesome#^4.6.2" -> Für verschiedene icons
 * bootstrap-fileinput: "^4.3.1" -> Für den Bilderupload
 * select2: "^4.0.3" -> Für die Suche nach Tags

Alle dependecies können mithilfe von bower installiert werden

Installation
-------

* 1. Code clonen:
```
git colne https://github.com/xamika/Bildergalerie.git
```
* 2. Dependencies installieren:
```
cd bildergalerie
bower install
```
* 3. Datenbank erstellen SQL script befindet sich im Ordner sql/bilderdb.sql
* 4. Config File DB anpassen php/config.php