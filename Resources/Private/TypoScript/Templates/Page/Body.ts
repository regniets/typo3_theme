/**
 * Page generation
 * Sets all important parameters for Page-Body
 *
 * @author Stefan Regniet, TechDivision GmbH
 * @package Typo3Theme
 * @subpackage Resources\Private\TypoScript
 */

page = PAGE
page {
	typeNum = 0
	bodyTagCObject = COA
	bodyTagCObject {
		wrap = <body class="|">
		10 = TEXT
		10 {
			value = page
			dataWrap = |{field:uid}
		}
	}
	10 = FLUIDTEMPLATE
	10 {
		file = {$td.config.resourcesPath}/Private/Html/Templates/Default.html
		layoutRootPath = {$td.config.resourcesPath}/Private/Html/Layouts/
		partialRootPath = {$td.config.resourcesPath}/Private/Html/Partials/
		variables {
			backendLayout = TEXT
			backendLayout {
				field = backend_layout
				ifEmpty.data = levelfield:-2, backend_layout_next_level, slide
				override.ifEmpty.value = 1
			}
		}
	}
}
