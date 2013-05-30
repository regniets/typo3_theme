=====
Einstieg ins Theme-Paket
=====
Das Theme-Paket ist die moderne Herangehensweise an TYPO3:
Alle Dateien (HTML, CSS, JS, TypoScript u.a.) liegen in einem Softwarepaket vor, das getestet, deployed und versioniert werden kann.
Die Abhängigkeit von der TYPO3-Datenbank wurde auf ein Minimum reduziert.
Dennoch verlangt die Verwendung Sorgfalt und Wissen über TYPO3, um vollständig verstanden und eingesetzt werden zu können.
Das Paket wird als t3x-Datei über den Extension-Manager installiert.
Das Paket ist derzeit so aufgebaut, dass sämtliche Standard-Anforderungen implementiert sind.
So funktioniert die Seite out-of-the-box.

*Hinweis*
Jeder, der mit diesem Theme im Auftrag der Firma TechDivision arbeitet, hat die Möglichkeit, zum Theme beizutragen.
Die Gerrit-URL lautet "typo3/TechDivision_MasterTheme"
Ein neues Feature muss den Coding Guidelines entsprechen und dokumentiert sein, um angenommen zu werden.


Erforderliche Kenntnisse
--------
* HTML / Fluid
* CSS / SASS
* TypoScript

Hilfreiche Kenntnisse
--------
* PHP / MySQL
* RealUrl Konfiguration
* TypoScript
* Commandline
* TYPO3-Scheduler

Unterstützte und empfohlene Erweiterungen
--------
* realurl
* news
* gridelements
* formhandler
* indexed_search
* felogin

Systemvoraussetzungen
--------
* PHP / MySQL / Apache
* Apache Ant (für die Arbeit mit Compass und Build-Scripts)
* compass

Struktur
--------
Die Struktur der Extension folgt dem de-facto TYPO3 Standard:
	Classes/
	Configuration/
	Resources/
 		Private/
 		Public/

Unter Resources/Private/ befinden sich die wichtigsten Dateien, mit denen gearbeitet wird:
			Html/
			TypoScript/
			Sass/

Resources/Private/ ist nicht von außen erreichbar, kann also nur von TYPO3 verarbeitet werden.
Css und Javascript-Dateien werden unter Resources/Public/ angelegt

Obligatorische TYPO3 Features
--------
* Fluid
* Backend Layouts
*

=====
Kurzanleitung
=====
1) Anlegen und/oder verwenden des Fluid/HTML-Codes
2) Anlegen und/oder verwenden der SASS-Dateien
3) Anlegen und Konfigurieren der TYPOScript-Dateien
4) Anlegen und Konfigurieren der TS-Installer-Dateien
5) Installieren des Themes als Extension
6) Ausführen des Installer-Scripts

=====
Weitere Inhalte
=====
.. toctree::

		Fluid/MitFluidDateienArbeiten
		Fluid/ViewHelpers
		Installer/VerwendungDesInstallers
		TypoScript/TypoScriptLibrary
		TypoScript/EinstellungenMittelsConstants
		Vorbereitung/System
