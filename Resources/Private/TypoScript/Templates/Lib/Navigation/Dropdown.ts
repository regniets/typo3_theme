/**
 * General dropdown-menu
 *
 * @author Stefan Regniet, TechDivision GmbH
 * @package Typo3Theme
 * @subpackage Resources\Private\TypoScript\Lib\Navigation
 * @depends Resources\Private\TypoScript\Lib\Navigation\AbstractBase.ts
 * @usage <f:cObject typoscriptObjectPath="lib.navigation.dropdown" data="{entryLevelUid}" />
 * (Enter the entry level in {entryLevelUid}), defaults to 0
 */


lib.navigation.dropdown < lib.navigation.abstractBase
lib.navigation.dropdown {
	entryLevel.current = 1
	1 = TMENU
	1 {
		expAll = 1
	}
	2 < .1
	2.wrap = <ul class="dropdown-menu">|</ul>
	3 < .2
}
