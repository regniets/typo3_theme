<?php
/*                                                                        *
 * This script is part of the TYPO3 project - inspiring people to share!  *
 *                                                                        *
 * TYPO3 is free software; you can redistribute it and/or modify it under *
 * the terms of the GNU General Public License version 2 as published by  *
 * the Free Software Foundation.                                          *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General      *
 * Public License for more details.                                       *
 *                                                                        */

/**
 * View helper for insert header data.
 *
 * = Examples =
 *
 * <code title="Include JavaScript file normal (like [tsref:(page).includeJS])">
 * {namespace ext=Tx_Typo3Theme_ViewHelpers}
 * <ext:headerData>
 *   <!-- some additional header data -->
 * </ext:headerData>
 * </code>
 * Taken from http://typo3.org/extensions/repository/view/ad_additionalheaderdata/current/
 */
class Tx_Typo3Theme_ViewHelpers_HeaderDataViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

    /**
     * @var array
     */
    public static $dataPositionKeyMap = array(
        '' => 'headerData.',
        'default' => 'headerData.',
        'footer' => 'footerData.',
    );
    
    /**
     * Render the view helper.
     *
     * @param string $position default (empty), footer
     * @return void
     * @api
     */
	public function render($position = 'default') {
        $position = self::$dataPositionKeyMap[$position];
        end($GLOBALS['TSFE']->pSetup[$position]);
        $key = intval(key($GLOBALS['TSFE']->pSetup[$position])) + 10;

        $GLOBALS['TSFE']->additionalHeaderData[$key] = $this->renderChildren();
    }
}
?>
