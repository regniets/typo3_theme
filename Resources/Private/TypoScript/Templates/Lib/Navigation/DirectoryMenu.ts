/**
 * TypoScript-Menu "special = directory"
 *
 * @author Stefan Regniet, TechDivision GmbH
 * @package Typo3Theme
 * @subpackage Resources\Private\TypoScript\Lib\Navigation
 * @depends Resources\Private\TypoScript\Lib\Navigation\AbstractBase.ts
 * @usage <f:cObject typoscriptObjectPath="lib.navigation.directoryMenu" data="{pageUid}" />
 * (Enter the page uid of the parent page in {pageUid})
 */

lib.navigation.directoryMenu < lib.navigation.abstractBase
lib.navigation.directoryMenu {
	special = directory
	special.value.current = 1
	1 {
		IFSUB >
		ACTIFSUB >
		CURIFSUB >
	}

}