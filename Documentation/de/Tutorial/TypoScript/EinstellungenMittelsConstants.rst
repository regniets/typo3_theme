=====
Einstellungen treffen mittels Constants
=====
Configuration/TypoScriptInstaller/Sites

Vieles im Theme lässt sich mit einfachen Constants regeln
Dabei stehen per default auch TYPO3-eigene Constants unter styles.content zur Verfügung

Im Bereich td.config werden die meisten Einstellungen getroffen:


:themeExtensionKey:
	Extension-Key - zur Verwendung im Theme

:resourcesPath:
	Pfad in den Resources-Folder. Zur Einbindung von CSS und JS-Files

:developmentContext:
	Globale Variable, die z.B. das Caching der Seite, die Indizierung und andere bei der Entwicklung störende Features deaktiviert
	*Default* 1

:siteIdentifier:
	Das ist der String, der sowohl für den TypoScriptInstaller als auch für Sass verwendet wird.
	*Default* RootPage

:headerData:
	In diesem Bereich werden Einstellungen getroffen, die den <head> Bereich der Seite betreffen

:domains:
	Hier werden die Domains fürs Live-, Testing- und Lokale System eingetragen.
	Das Lokale System wird über ${domain} durch den Ant ersetzt.
	Dies setzt die BaseURL für die Seite (berücksichtigt auch https)

:language:
	Hier werden TYPO3-spezifische Spracheinstellungen getroffen.
	Am Ende der Constants über Conditions überschrieben
	Bei languageLinkVar wird der L-Parameter validiert L(0-1) bedeutet, dass nur 0 und 1 vorkommen dürfen

:twitterBootstrap:
	Einstellungen für Bootstrap, z.B. welche Version verwendet wird und welche JS inkludiert werden sollen

:navigation:
	Einstellungen für Navigationselemente, besonders Klassen

:copyright:
	Name, der im Copyright stehen soll

