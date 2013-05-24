/**
 * Adds global TCEFORM Config
 *
 * @author Stefan Regniet, TechDivision GmbH
 * @package Typo3Theme
 * @subpackage Resources\Private\TypoScript\TsConfig
 */

TCEFORM {
	pages {
		layout {
			disabled = 1
		}

		backend_layout {
			PAGE_TSCONFIG_ID = 1
			removeItems= -1
			altLabels.0 = LLL:EXT:typo3_theme/Resources/Private/Language/locallang_db.xml:TsConfig.TCEFORM.default
		}

		backend_layout_next_level {
			PAGE_TSCONFIG_ID = 1
			removeItems= -1
		}
	}

	pages_language_overlay {
		sys_language_uid {
			altLabels.0 = LLL:EXT:typo3_theme/Resources/Private/Language/locallang_db.xml:TsConfig.TCEFORM.sys_language_uid.0
		}
	}

	tt_content {
		sys_language_uid {
			altLabels.0 = LLL:EXT:typo3_theme/Resources/Private/Language/locallang_db.xml:TsConfig.TCEFORM.sys_language_uid.0
		}

		header_layout {
			removeItems = 1,3,4,5
			altLabels.0 = LLL:EXT:typo3_theme/Resources/Private/Language/locallang_db.xml:TsConfig.TCEFORM.tt_content.header_layout.0
			altLabels.2 = LLL:EXT:typo3_theme/Resources/Private/Language/locallang_db.xml:TsConfig.TCEFORM.tt_content.header_layout.2
		}

		section_frame {
			addItems.100 = LLL:EXT:typo3_theme/Resources/Private/Language/locallang_db.xml:TsConfig.TCEFORM.tt_content.section_frame.100
		}
	}
}
