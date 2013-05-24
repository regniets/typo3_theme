/**
 * Adds html5 modifications
 *
 * @author Stefan Regniet, TechDivision GmbH
 * @package Typo3Theme
 * @subpackage Resources\Private\TypoScript\Plugin
 */

tt_content.stdWrap.innerWrap.cObject.default {
	10.value = <article id="c{field:uid}"
	10.value.override.cObject.value = <article
	10.value.override.cObject.if.value = article
	30.value = >|</article>
}