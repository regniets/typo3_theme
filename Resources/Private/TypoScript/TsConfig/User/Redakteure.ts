/**
 * Adds global config for editors
 *
 * @author Stefan Regniet, TechDivision GmbH
 * @package Typo3Theme
 * @subpackage Resources\Private\TypoScript\TsConfig
 */

options {
	clearCache.pages = 1
}

setup.override {
	//Uploadfeld im DateiauswahlFenster entfernen
	edit_docModuleUpload = 0

	//Maximale Höhe setzen
	resizeTextareas_MaxHeight = 400

	//Flash-uploader aktivieren
	enableFlashUploader = 0
}

page.TCEFORM.pages. {
	alias.disabled = 1
	content_from_pid.disabled = 1
}

admPanel {
	enable.preview = 1
}

//Im WEB/Info-Modul nicht freigegebene Module ausblenden
mod.web_info.menu.function {
	tx_cms_webinfo_page = 0
	tx_infopagetsconfig_webinfo = 0
	tx_realurl_modfunc1 = 0
	tx_indexedsearch_modfunc1 = 0
	tx_indexedsearch_modfunc2 = 0
}