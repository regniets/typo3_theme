=====
Verwendung des Installers
=====
Der Installer durchsucht die folgenden Verzeichnisse:
- Configuration/TypoScriptInstaller/Templates/Sites/ (TS-Templates)
- Configuration/TypoScriptInstaller/TsConfig/Group/ (User-TsConfig)
- Configuration/TypoScriptInstaller/TsConfig/User/ (User-TsConfig)
- Configuration/TypoScriptInstaller/TsConfig/Page/ (Page-TsConfig)

Je nachdem, welche Ordner dort gefunden werden, wird der Datenbank ein entsprechender Eintrag hinzugefügt oder der bestehende geupdated
Der Installer reagiert also auf Ordner, die sich dort befinden. Die Namen der Ordner haben eine entscheidende Bedeutung.


Ordnernamen
--------
:RootPage:
	Für Templates oder PageTsConfig - Das Keyword "Rootpage" kann verwendet werden, wenn es nur eine Seite gibt und diese als "Rootpage" markiert ist.
	Z.B.: Configuration/TypoScriptInstaller/Templates/Sites/RootPage/
:TypoScriptMappingIdentifier:
	Dies ist eine besondere Art von Datensatz, die auf einer Seite oder auf der RootNode eingefügt werden kann
	Der Identifier ist systemweit eindeutig. Statt IDs von Seiten können damit lesbare Strings angesprochen werden
	Dadurch kann die Extension auch auf Testsystemen, die evtl. andere IDs im Seitenbaum besitzen, eingesetzt werden
	Der TypoScriptMappingIdentifier wird auf der Seite / der Gruppe / dem Benutzer angelegt, der angesprochen werden soll.
	Im Code kann Uppercase verwendet werden, es wird case-insensitive verglichen
	Z.B.: Configuration/TypoScriptInstaller/TsConfig/User/Redakteur/
	oder Configuration/TypoScriptInstaller/Templates/Sites/KundeXyz/
:Domain-Record:
	Auf Multi-Domain-Seiten können statt TypoScriptMappingIdentifiers auch die Domain-Namen der einzelnen Domain-Records verwendet werden
	Z.B.: Configuration/TypoScriptInstaller/Templates/Sites/www.domain.tld/
:_All:
	Für UserTS: Das Keyword "_All" mappt die vorhandenen Dateien auf alle Gruppen oder Benutzer
	Z.B.: Configuration/TypoScriptInstaller/TsConfig/User/_All/
:Page-Id:
	(Deprecated) - Der Ordner kann als Namen die ID der Seite / Gruppe / des Benutzers haben, mit dem er verbunden werden soll
	Z.B.: Configuration/TypoScriptInstaller/Templates/Sites/1/
	oder Configuration/TypoScriptInstaller/TsConfig/User/11/


Ordnerinhalt
--------
1) Templates
:Setup.ts:
	Die Setup.ts inkludiert sämtliche notwendigen Dateien aus Resources/Private/TypoScript/Templates/
	Sie enthält keinen eigenen TypoScript-Code außer ggf. eingefügte JS oder CSS Dateien.
:Constants.ts:
	Die Constants.ts beinhaltet sämtliche notwendigen Konstanten, mit denen das System konfiguriert wird
:IncludeStatic.ts:
	Die IncludeStatic.ts enthält Einträge, die dann auf das Feld "Include Static Templates (from extensions)" gemappt werden.
	Pro Zeile ein Eintrag, Eintrag entspricht dem, was dann auch in der Datenbank steht.
:ExtensionTemplates:
	Jedem RootTemplate können beliebige ExtensionTemplates zugeordnet sein. Der Ordner ExtensionTemplates kann seinerseits wieder mit Unterordnern versehen werden.
	Z.B.: Configuration/TypoScriptInstaller/Templates/Sites/KundeXyz/ExtensionTemplates/Contact/
	und dann
	Configuration/TypoScriptInstaller/Templates/Sites/KundeXyz/ExtensionTemplates/Contact/Setup.ts etc.

2) PageTsConfig / UserTsConfig
:Setup.ts:
	Die Setup.ts inkludiert sämtliche notwendigen Dateien aus Resources/Private/TypoScript/TsConfig/
	Sie sollte keinen eigenen TypoScript-Code enthalten


Bedienung des Installers
--------
Der Installer kann nun, wenn die TypoScript-Dateien vorbereitet sind, benutzt werden.
Beim Installieren der Extension kann der link "Check update script" verwendet werden.
Alternativ kann auch ein Scheduler-Task angelegt und ausgeführt werden, der mit dem ThemePaket mitgeliefert wird.
Dies ist z.B. sinnvoll, wenn man den Task über die CommandLine aufgerufen wird.
Durch die Betätigung des Installers werden Datenbank-Templates angelegt oder überschrieben.



