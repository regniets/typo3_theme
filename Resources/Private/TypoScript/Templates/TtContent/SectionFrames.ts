/**
 * Configures or adds new Section Frames
 *
 * @author Stefan Regniet, TechDivision GmbH
 * @package Typo3Theme
 * @subpackage Resources\Private\TypoScript\Plugin
 * @depends Resources\Private\TsConfig
 */

tt_content.stdWrap.innerWrap.cObject {
	100 =< tt_content.stdWrap.innerWrap.cObject.default
	100.20.10.value = csc-frame csc-frame-additional
}