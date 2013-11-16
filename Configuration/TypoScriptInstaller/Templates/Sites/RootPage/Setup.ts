/**
 * Main Setup file
 * This file is being included in your template-record.
 * It may contain inclusion of JS and CSS files, but no other TypoScript Code
 *
 * @author Stefan Regniet, TechDivision GmbH
 * @package Typo3Theme
 * @subpackage Configuration\TypoScript
 * @required Config/GlobalConfig.ts, Page/Body.ts, Page/Head.ts, Lib/Navigation/AbstractBase.ts
 */

//PAGE:
<INCLUDE_TYPOSCRIPT: source="FILE:typo3conf/ext/typo3_theme/Resources/Private/TypoScript/Templates/Config/GlobalConfig.ts">
<INCLUDE_TYPOSCRIPT: source="FILE:typo3conf/ext/typo3_theme/Resources/Private/TypoScript/Templates/Page/Body.ts">
<INCLUDE_TYPOSCRIPT: source="FILE:typo3conf/ext/typo3_theme/Resources/Private/TypoScript/Templates/Page/Head.ts">
<INCLUDE_TYPOSCRIPT: source="FILE:typo3conf/ext/typo3_theme/Resources/Private/TypoScript/Templates/Plugin/TxRealurl.ts">
<INCLUDE_TYPOSCRIPT: source="FILE:typo3conf/ext/typo3_theme/Resources/Private/TypoScript/Templates/Lib/Content.ts">
<INCLUDE_TYPOSCRIPT: source="FILE:typo3conf/ext/typo3_theme/Resources/Private/TypoScript/Templates/Lib/StdHeader.ts">
<INCLUDE_TYPOSCRIPT: source="FILE:typo3conf/ext/typo3_theme/Resources/Private/TypoScript/Templates/Lib/Copyright.ts">

// NAVIGATIONS:
<INCLUDE_TYPOSCRIPT: source="FILE:typo3conf/ext/typo3_theme/Resources/Private/TypoScript/Templates/Lib/Navigation/AbstractBase.ts">
<INCLUDE_TYPOSCRIPT: source="FILE:typo3conf/ext/typo3_theme/Resources/Private/TypoScript/Templates/Lib/Navigation/General.ts">
<INCLUDE_TYPOSCRIPT: source="FILE:typo3conf/ext/typo3_theme/Resources/Private/TypoScript/Templates/Lib/Navigation/Breadcrumb.ts">


// Inclusion of JS and CSS files
page {
	includeCSS {

	}
	includeJS {

	}
}

