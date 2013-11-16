/**
 * Main Constants file
 * Regulate your TS by using those constants.
 * Constants are only allowed in Configuration, not in Resources
 *
 * @author Stefan Regniet, TechDivision GmbH
 * @package Typo3Theme
 * @subpackage Configuration\TypoScript
 */

PAGE_TARGET =

styles.content {
	imgtext {
		textMargin = 25
		colSpace = 15
		rowSpace = 20
		textMargin = 20

		maxW = 850
		maxWInText = 850

		linkWrap {
			lightboxEnabled = 1
            lightboxRelAttribute = colorbox{field:uid}
            lightboxCssClass = rzcolorbox
            width = 800
		}
	}
	links.extTarget = _blank
}



td.config {
	//key of theme (to be used in various places)
	themeExtensionKey = typo3_theme

	//Resources Path
	resourcesPath = typo3conf/ext/typo3_theme/Resources

	//turn development content on or off - turns off caching and others
	developmentContext = 1

	//siteIdentifier - enter your identifier here
	siteIdentifier = RootPage


	//Configure HeaderData
	headerData {
		moveJsFromHeaderToFooter = 1
		concatenateJsAndCss = 1
		minifyJsAndCss = 1
		includeJqueryFromGoogle = 1
		includeJqueryVersion = 1.8.2
		cssFileName = Bootstrap.css
		googleAnalyticsId =
	}


	//Set Domains
	domains {
		live =
		testing =
		local = ${domain}
	}

	//Language Settings
	language {
		sys_language_uid = 0
		htmlTag_setParams = lang="de"
		htmlTag_langKey = de-DE
		language = de
		locale_all = de_DE.utf8
		dateFormat = %d.%M.%Y
		languageLinkVar = L(0-1)
	}

	//Usage of TwitterBootstrap
	twitterBootstrap {
		version = 2.1.1
		includeJavascripts {
			affix = 0
			alert = 0
			button = 0
			carousel = 0
			collapse = 0
			dropdown = 1
			modal = 0
			popover = 0
			scrollspy = 0
			tab = 0
			tooltip = 0
			transition = 0
			typeahead = 0
		}
	}

	//Navigation
	navigation {
		activeClass = active
		currentClass = current
		breadcrumb.separator = &raquo;
	}

	//Others
	copyright.name =

} 


//Set Languages, add more languages and other conditions if applicable
[globalVar = GP:L = 1]
td.config.language {
	sys_language_uid = 1
	htmlTag_setParams = lang="en"
	htmlTag_langKey = en-EN
	language = default
	locale_all = en_GB.utf8
	dateFormat = %M/%d/%Y
}
[global]

