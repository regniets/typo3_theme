/**
 * Modifies felogin
 *
 * @author Stefan Regniet, TechDivision GmbH
 * @package Typo3Theme
 * @subpackage Resources\Private\TypoScript\Plugin
 */

plugin.tx_felogin_pi1 {
	storagePid =
	showPermaLogin = 1

	email_from =
	email_fromName =

	templateFile = {$td.config.resourcesPath}/Private/Html/Plugin/TxFelogin/Login.html
}
