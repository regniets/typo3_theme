/**
 * Renders a copyright line with current year
 *
 * @author Stefan Regniet, TechDivision GmbH
 * @package Typo3Theme
 * @subpackage Resources\Private\TypoScript\Lib
 * @usage <f:cObject typoscriptObjectPath="lib.copyright" />
 */

lib.copyright = TEXT
lib.copyright {
	data = date:U
	strftime = %Y
	wrap = &copy;&nbsp;{$td.config.copyright.name}&nbsp;|
}