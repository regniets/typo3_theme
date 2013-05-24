/**
 * Renders a searchbox
 *
 * @author Stefan Regniet, TechDivision GmbH
 * @package Typo3Theme
 * @subpackage Resources\Private\TypoScript\Lib
 * @depends Resources\Private\TypoScript\Plugin\TxIndexedSearch.ts
 * @usage <f:cObject typoscriptObjectPath="lib.searchbox" data="{searchPageUid}" />
 */

lib.searchbox = COA
lib.searchbox {
	wrap = <div class="searchbox">|</div>
	10 = TEXT
	10 {
		typolink.parameter.current = 1
		typolink.returnLast = url
		wrap = <form action="|" method="post" id="indexedsearch" class="navbar-search">
	}

	20 = TEXT
	20 {
		value = Search
		lang.de = Suche
		wrap = <label for="searchbox-sword" class="searchbox-label">|</label>
	}

	30 = TEXT
	30 {
		data = GP:tx_indexedsearch|sword
		htmlSpecialChars = 1
		removeBadHTML = 1
		wrap = <input name="tx_indexedsearch[sword]" value="|" class="searchbox-sword search-query" type="text" id="searchbox-sword"/>
	}

	900 < .20
	900 {
		wrap = <input name="tx_indexedsearch[submit_button]" value="|" type="submit" />
	}

	1000 = TEXT
	1000.value = </form>
}
