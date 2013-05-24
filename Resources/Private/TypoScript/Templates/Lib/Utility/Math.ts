/**
 * Renders mathematical functions, returns value
 *
 * @author Stefan Regniet, TechDivision GmbH
 * @package Typo3Theme
 * @subpackage Resources\Private\TypoScript\Lib\Utility
 * @usage <f:cObject typoscriptObjectPath="lib.utility.math" data="{zahl} / 2"/>
 */

lib.utility.math = TEXT
lib.utility.math {
  current = 1
  prioriCalc = 1
  numberFormat.decimals = 2
}