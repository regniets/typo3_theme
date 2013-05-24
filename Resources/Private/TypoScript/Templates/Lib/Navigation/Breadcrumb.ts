/**
 * Breadcrumb Menus
 *
 * @author Stefan Regniet, TechDivision GmbH
 * @package Typo3Theme
 * @subpackage Resources\Private\TypoScript\Lib\Navigation
 * @usage <f:cObject typoscriptObjectPath="lib.navigation.breadcrumb" />
 */

lib.navigation.breadcrumb = COA
lib.navigation.breadcrumb.10 = HMENU
lib.navigation.breadcrumb.10 {

	special = rootline
	special.range = 1|-1
	#includeNotInMenu = 1

	stdWrap {
		required = 1
		wrap = <ul class="breadcrumb">|</ul>
	}

	1 = TMENU
	1 {
		noBlur = 1
		NO {
			stdWrap.cObject = COA
			stdWrap.cObject {
				10 = TEXT
				10.field = title
			}
			allWrap =  <li>|</li> |*| <li>|&nbsp;<span class="divider">{$td.config.navigation.breadcrumb.separator}</span></li> |*| <li>|</li>
			ATagTitle.field = subtitle // title
			ATagAlt.field = subtitle // title
			stdWrap.htmlSpecialChars = 1
		}
		CUR < .NO
		CUR = 1
		CUR {
			allWrap =  <li class="{$td.config.navigation.activeClass}"><span class="divider">{$td.config.navigation.breadcrumb.separator}</span>|</li>
			doNotLinkIt = 1
		}
	}
}



