/**
 * TypoScript-Menus "special = browse", prev and next
 *
 * @author Stefan Regniet, TechDivision GmbH
 * @package Typo3Theme
 * @subpackage Resources\Private\TypoScript\Lib\Navigation
 * @depends Resources\Private\TypoScript\Lib\Navigation\AbstractBase.ts
 * @usage <f:cObject typoscriptObjectPath="lib.navigation.browseMenu.prev" />, <f:cObject typoscriptObjectPath="lib.navigation.browseMenu.next" />
 */

lib.navigation.browseMenu.prev < lib.navigation.abstractBase
lib.navigation.browseMenu.prev {
	special = browse
	special {
		items = prev
		items.prevnextToSection = 0
		index.target = _blank
		index.fields.title = INDEX
	}
}

lib.navigation.browseMenu.next < lib.navigation.abstractBase
lib.navigation.browseMenu.next {
	special = browse
	special {
		items = next
		items.prevnextToSection = 0
		index.target = _blank
		index.fields.title = INDEX
	}
}