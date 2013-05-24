/**
 * Configures and outputs indexed_search
 *
 * @author Stefan Regniet, TechDivision GmbH
 * @package Typo3Theme
 * @subpackage Resources\Private\TypoScript\Plugin
 */
 
config {
	index_enable = 1
	index_externals = 1
	index_metatags = 0
	index_descrLgd = 50
}

[globalVar = LIT:1 = {$td.config.developmentContext}]
config {
	index_enable = 0
	index_externals = 0
}
[global]

plugin.tx_indexedsearch {
	templateFile = {$td.config.resourcesPath}/Private/Html/Plugin/TxIndexedsearch/Search.html

	blind {
		media = -1
	}

	show {
		rules = 0
		advancedSearchLink = 0
	}

	_DEFAULT_PI_VARS {
		lang < config.sys_language_uid
		type = 1
		results = 10
	}
	_CSS_DEFAULT_STYLE >
}
