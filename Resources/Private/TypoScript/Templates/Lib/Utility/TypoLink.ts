/**
 * Renders a typolink
 *
 * @author Stefan Regniet, TechDivision GmbH
 * @package Typo3Theme
 * @subpackage Resources\Private\TypoScript\Lib\Utility
 * @usage <f:cObject typoscriptObjectPath="lib.utility.typolink" data="{parameter}"/>
 * @usage <f:cObject typoscriptObjectPath="lib.utility.typolink.returnUrl" data="{parameter}"/>
 * @usage <f:cObject typoscriptObjectPath="lib.utility.typolink.returnTarget" data="{parameter}"/>
 */

lib.utility.typolink = TEXT
lib.utility.typolink {
	typolink {
		parameter.current = 1
	}
}

lib.utility.typolink.returnUrl = TEXT
lib.utility.typolink {
	typolink {
		parameter.current = 1
		returnLast = url
	}
}

lib.utility.typolink.returnTarget = TEXT
lib.utility.typolink.returnTarget {
	typolink {
		parameter.current = 1
		returnLast = target
	}
}