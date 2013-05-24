/**
 * Modifies lib.stdheader
 *
 * @author Stefan Regniet, TechDivision GmbH
 * @package Typo3Theme
 * @subpackage Resources\Private\TypoScript\Lib
 */

lib.stdheader >

lib.stdheader = FLUIDTEMPLATE
lib.stdheader {
	file = {$td.config.resourcesPath}/Private/Html/TypoScriptObjects/Templates/Lib/StdHeader.html
	layoutRootPath = {$td.config.resourcesPath}/Private/Html/TypoScriptObjects/Layouts/
	partialRootPath = {$td.config.resourcesPath}/Private/Html/TypoScriptObjects/Partials/
	variables {
		headerText = TEXT
		headerText.field = header

		headerPosition = TEXT
		headerPosition.field = header_position

		headerLayout = TEXT
		headerLayout.field = header_layout

		subHeaderText = TEXT
		subHeaderText.field = subheader

		isHeaderDateSet = TEXT
		isHeaderDateSet.field = date

		headerDate = TEXT
		headerDate {
			field = date
			strftime = {$td.config.language.dateFormat}
		}

		headerHtml5DatetimeFormat = TEXT
		headerHtml5DatetimeFormat {
			field = date
			strftime = %Y-%m-%d
		}

		headerLink = TEXT
		headerLink.field = header_link

		headerLinkUrl = TEXT
		headerLinkUrl {
			typolink {
				parameter.field = header_link
				returnLast = url
			}
		}

		headerLinkTarget = TEXT
		headerLinkTarget {
			typolink {
				parameter.field = header_link
				returnLast = target
			}
		}

		parentRecordNumber = TEXT
		parentRecordNumber.data = cObj:parentRecordNumber
	}
}
