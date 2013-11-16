/**
 * Page Head
 * Sets all important parameters for Page-Head
 *
 * @author Stefan Regniet, TechDivision GmbH
 * @package Typo3Theme
 * @subpackage Resources\Private\TypoScript
 */

page {
	config {
		noPageTitle = 2
		removeDefaultJS = external
		inlineStyle2TempFile = 1
		moveJsFromHeaderToFooter = {$td.config.headerData.moveJsFromHeaderToFooter}
		concatenateJsAndCss = {$td.config.headerData.concatenateJsAndCss}
		minifyJS = {$td.config.headerData.minifyJsAndCss}
		minifyCSS = {$td.config.headerData.minifyJsAndCss}
	}

    headTag (
        <head>
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
<!--[if lte IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"" type="text/javascript"></script><![endif]-->
    )

	headerData {
		//Title Tag function
		5 = COA
		5 {
			10 = TEXT
			10 {
				value = <title>
				noTrimWrap = |	||
			}
			20 = COA
			20 {
				10 = TEXT
				10 {
					data = field:title
					stdWrap.htmlSpecialChars = 1
				}
				20 = HMENU
				20 {
					special = browse
					special.items = up
					includeNotInMenu = 1
					data = field:title
					1 = TMENU
					1 {
						NO = 1
						NO {
							doNotLinkIt = 1
							stdWrap {
								noTrimWrap = | : | |
								htmlSpecialChars = 1
							}
						}
					}
				}
				30 = TEXT
				30 {
						value = {leveltitle:0}
						insertData = 1
						noTrimWrap = | : | |
				}
				if.isFalse.field = titletag
			}
			30 = COA
			30 {
				10 = TEXT
				10.data = field:titletag
				if.isTrue.field = titletag
			}
			50 = TEXT
			50.value = </title>
		}
	}
	includeCSS {
		main = {$td.config.resourcesPath}/Public/Css/Sites/{$td.config.siteIdentifier}/{$td.config.headerData.cssFileName}
	}
	includeJS {

	}
	meta {
  		description {
			data = page:description
			ifEmpty.data = levelfield :-1, description, slide
			crop = 200|
  		}
  		keywords {
			data = page:keywords
			ifEmpty.data = levelfield :-1, keywords, slide
			crop = 1000|
		}
	}
	shortcutIcon = {$td.config.resourcesPath}/Public/Images/Icons/Favicon.ico
}

[globalVar = LIT:1 = {$td.config.headerData.includeJqueryFromGoogle}]
    page.includeJS {
		jQuery = http://ajax.googleapis.com/ajax/libs/jquery/{$td.config.headerData.includeJqueryVersion}/jquery.min.js
		jQuery.external = 1
    }
[global]


page.includeJS {
    file1 = {$td.config.resourcesPath}/Public/Javascript/jquery.colorbox-min.js
}

// activate lightbox
page.jsFooterInline{
    10 = COA
    10.wrap = jQuery(document).ready(function(){|});
    10.10 = TEXT
    10.10.value = jQuery(".rzcolorbox").colorbox();
}


[globalVar = LIT:1 = {$td.config.twitterBootstrap.includeJavascripts.affix}]
page.includeJS.affix = {$td.config.resourcesPath}/Public/Javascript/TwitterBootstrap/{$td.config.twitterBootstrap.version}/bootstrap-affix.js
[global]

[globalVar = LIT:1 = {$td.config.twitterBootstrap.includeJavascripts.alert}]
page.includeJS.alert = {$td.config.resourcesPath}/Public/Javascript/TwitterBootstrap/{$td.config.twitterBootstrap.version}/bootstrap-alert.js
[global]

[globalVar = LIT:1 = {$td.config.twitterBootstrap.includeJavascripts.button}]
page.includeJS.button = {$td.config.resourcesPath}/Public/Javascript/TwitterBootstrap/{$td.config.twitterBootstrap.version}/bootstrap-button.js
[global]

[globalVar = LIT:1 = {$td.config.twitterBootstrap.includeJavascripts.carousel}]
page.includeJS.carousel = {$td.config.resourcesPath}/Public/Javascript/TwitterBootstrap/{$td.config.twitterBootstrap.version}/bootstrap-carousel.js
[global]

[globalVar = LIT:1 = {$td.config.twitterBootstrap.includeJavascripts.collapse}]
page.includeJS.collapse = {$td.config.resourcesPath}/Public/Javascript/TwitterBootstrap/{$td.config.twitterBootstrap.version}/bootstrap-collapse.js
[global]

[globalVar = LIT:1 = {$td.config.twitterBootstrap.includeJavascripts.dropdown}]
page.includeJS.dropdown = {$td.config.resourcesPath}/Public/Javascript/TwitterBootstrap/{$td.config.twitterBootstrap.version}/bootstrap-dropdown.js
[global]

[globalVar = LIT:1 = {$td.config.twitterBootstrap.includeJavascripts.modal}]
page.includeJS.modal = {$td.config.resourcesPath}/Public/Javascript/TwitterBootstrap/{$td.config.twitterBootstrap.version}/bootstrap-modal.js
[global]

[globalVar = LIT:1 = {$td.config.twitterBootstrap.includeJavascripts.popover}]
page.includeJS.popover = {$td.config.resourcesPath}/Public/Javascript/TwitterBootstrap/{$td.config.twitterBootstrap.version}/bootstrap-popover.js
[global]

[globalVar = LIT:1 = {$td.config.twitterBootstrap.includeJavascripts.scrollspy}]
page.includeJS.scrollspy = {$td.config.resourcesPath}/Public/Javascript/TwitterBootstrap/{$td.config.twitterBootstrap.version}/bootstrap-scrollspy.js
[global]

[globalVar = LIT:1 = {$td.config.twitterBootstrap.includeJavascripts.tab}]
page.includeJS.tab = {$td.config.resourcesPath}/Public/Javascript/TwitterBootstrap/{$td.config.twitterBootstrap.version}/bootstrap-tab.js
[global]

[globalVar = LIT:1 = {$td.config.twitterBootstrap.includeJavascripts.tooltip}]
page.includeJS.tooltip = {$td.config.resourcesPath}/Public/Javascript/TwitterBootstrap/{$td.config.twitterBootstrap.version}/bootstrap-tooltip.js
[global]

[globalVar = LIT:1 = {$td.config.twitterBootstrap.includeJavascripts.transition}]
page.includeJS.transition = {$td.config.resourcesPath}/Public/Javascript/TwitterBootstrap/{$td.config.twitterBootstrap.version}/bootstrap-transition.js
[global]

[globalVar = LIT:1 = {$td.config.twitterBootstrap.includeJavascripts.typeahead}]
page.includeJS.typeahead = {$td.config.resourcesPath}/Public/Javascript/TwitterBootstrap/{$td.config.twitterBootstrap.version}/bootstrap-typeahead.js
[global]

