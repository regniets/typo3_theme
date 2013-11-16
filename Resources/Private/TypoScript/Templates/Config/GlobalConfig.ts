/**
 * Global Configuration
 * Sets all important parameters
 *
 * @author Stefan Regniet, TechDivision GmbH
 * @package Typo3Theme
 * @subpackage Resources\Private\TypoScript
 */

config {
	no_cache = {$td.config.developmentContext}
	admPanel = 0

	doctype = html5
	xhtml_cleaning = all
	xmlprologue = none

	meaningfulTempFilePrefix = 100
	disablePreviewNotification = 1
	disablePrefixComment = 1
	typolinkEnableLinksAcrossDomains = 1
	typolinkCheckRootline = 1

	domainTarget = _top
	intTarget = _self
	extTarget = 

	notification_email_encoding = base64
	notification_email_charset = utf-8
	notification_email_urlmode = all

	spamProtectEmailAddresses = 2
	spamProtectEmailAddresses_atSubst = <script type="text/javascript">document.write('');document.write('&#64;');</script>
	spamProtectEmailAddresses_lastDotSubst = <script type="text/javascript">document.write('');document.write('&#46;');</script>
	
	linkVars = type, {$td.config.language.languageLinkVar}
	uniqueLinkVars = 1
	cache_period = 86400
	cache_clearAtMidnight = 1
	sendCacheHeaders = 1
	
	headerComment = Konzept, Design und technische Umsetzung - TechDivision GmbH - www.techdivision.com
	//baseURL = http://{$td.config.domains.live}/

	sys_language_uid = {$td.config.language.sys_language_uid}
	htmlTag_setParams = {$td.config.language.htmlTag_setParams}
	htmlTag_langKey = {$td.config.language.htmlTag_langKey}
	language = {$td.config.language.language}
	locale_all = {$td.config.language.locale_all}

}

//Set Base URLs

[globalString = IENV:TYPO3_SITE_URL=http://{$td.config.domains.live}/]
config.baseURL = http://{$td.config.domains.live}/
[global]
[globalString = IENV:TYPO3_SITE_URL=https://{$td.config.domains.live}/]
config.baseURL = https://{$td.config.domains.live}/
[global]

[globalString = IENV:TYPO3_SITE_URL=http://{$td.config.domains.testing}/]
config.baseURL = http://{$td.config.domains.testing}/
[global]
[globalString = IENV:TYPO3_SITE_URL=https://{$td.config.domains.testing}/]
config.baseURL = https://{$td.config.domains.testing}/
[global]

[globalString = IENV:TYPO3_SITE_URL=http://{$td.config.domains.local}/]
config.baseURL = http://{$td.config.domains.local}/
[global]
[globalString = IENV:TYPO3_SITE_URL=https://{$td.config.domains.local}/]
config.baseURL = https://{$td.config.domains.local}/
[global]


// eleminate p class="bodytext"
lib.parseFunc_RTE.nonTypoTagStdWrap.encapsLines.addAttributes.P.class >