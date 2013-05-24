/**
 * TypoScript-Menu "special = list"
 *
 * @author Stefan Regniet, TechDivision GmbH
 * @package Typo3Theme
 * @subpackage Resources\Private\TypoScript\Lib\Navigation
 * @depends Resources\Private\TypoScript\Lib\Navigation\AbstractBase.ts
 * @usage <f:cObject typoscriptObjectPath="lib.navigation.listMenu" data="{pageUids}" />
 * (Enter the page uid list, comma-separated, of the used pages in {pageUids})
 */

lib.navigation.listMenu < lib.navigation.abstractBase
lib.navigation.listMenu {
	special = list
	special.value.current = 1
	1 {
		IFSUB >
		ACTIFSUB >
		CURIFSUB >
	}

}