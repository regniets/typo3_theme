/**
 * Abstract Base Class for Menus
 *
 * @author Stefan Regniet, TechDivision GmbH
 * @package Typo3Theme
 * @subpackage Resources\Private\TypoScript\Lib\Navigation
 */

lib.navigation.abstractBase = HMENU
lib.navigation.abstractBase {
	excludeUidList =
	1 = TMENU
	1 {
		noBlur = 1
		wrap = <ul class="nav">|</ul>
		NO = 1
		NO {
			ATagTitle.field = subtitle // title
			allWrap.dataWrap = <li class="first {field:cssattribute}">| |*| <li class="{field:cssattribute}">| |*| <li class="last {field:cssattribute}">|
			wrapItemAndSub = | </li>
			ATagBeforeWrap = 1
			stdWrap.htmlSpecialChars = 1
		}

		ACT = 1
		ACT < .NO
		ACT {
			ATagParams = class="{$td.config.navigation.activeClass}"
			allWrap.dataWrap = <li class="first {$td.config.navigation.activeClass} {field:cssattribute}">| |*| <li class="{$td.config.navigation.activeClass} {field:cssattribute}">| |*| <li class="last {$td.config.navigation.activeClass} {field:cssattribute}">|
		}

		CUR = 1
		CUR < .ACT
		CUR {
			ATagParams = class="{$td.config.navigation.activeClass} {$td.config.navigation.currentClass}"
		}

		IFSUB = 1
		IFSUB < .NO
		IFSUB {
			allWrap.dataWrap = <li class="first dropdown {field:cssattribute}">| |*| <li class="dropdown {field:cssattribute}">| |*| <li class="last dropdown {field:cssattribute}">|
			ATagParams = class="dropdown-toggle" data-toggle="dropdown"
		}

		ACTIFSUB = 1
		ACTIFSUB < .ACT
		ACTIFSUB {
			allWrap.dataWrap = <li class="first dropdown {field:cssattribute} {$td.config.navigation.activeClass}">| |*| <li class="dropdown {field:cssattribute} {$td.config.navigation.activeClass}">| |*| <li class="last dropdown {field:cssattribute} {$td.config.navigation.activeClass}">|
			ATagParams = class="{$td.config.navigation.activeClass} dropdown-toggle" data-toggle="dropdown"
		}

		CURIFSUB = 1
		CURIFSUB < .ACTIFSUB
		CURIFSUB {
			allWrap.dataWrap = <li class="first dropdown {field:cssattribute} {$td.config.navigation.activeClass}">| |*| <li class="dropdown {field:cssattribute} {$td.config.navigation.activeClass}">| |*| <li class="last dropdown {field:cssattribute} {$td.config.navigation.activeClass}">|
			ATagParams = class="{$td.config.navigation.activeClass} {$td.config.navigation.currentClass} dropdown-toggle" data-toggle="dropdown"
		}

	}
}
