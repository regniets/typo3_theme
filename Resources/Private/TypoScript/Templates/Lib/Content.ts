/**
 * Renders content and sliding content
 *
 * @author Stefan Regniet, TechDivision GmbH
 * @package Typo3Theme
 * @subpackage Resources\Private\TypoScript\Lib
 * @usage <f:cObject typoscriptObjectPath="lib.content" data="{colPos}" />, <f:cObject typoscriptObjectPath="lib.slidingContent" data="{colPos}" />
 */

lib.content < styles.content.get
lib.content {
	select.where >
	select.andWhere.current = 1
	select.andWhere.wrap = colPos=|
}

lib.slidingContent < lib.content 
lib.slidingContent {
	slide = -1
}