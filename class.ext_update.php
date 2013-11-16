<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Stefan Regniet(s.regniet@techdivision.com)
 *  All rights reserved
 *
 *  This script is part of the Typo3 project. The Typo3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/



/**
 * Class for Theme Installing
 *
 * $Id: class.ext_update.php 9462 2008-07-15 16:05:14Z
 *
 * @author Stefan Regniet(s.regniet@techdivision.com)
 */


class ext_update  {

	/**
	 * Execute Method for installing themes
	 *
	 * @return void
	 */
	public function main() {
		$objectManager = new \TYPO3\CMS\Extbase\Object\ObjectManager();
		$commandController = $objectManager->create('TechDivision\Typo3Theme\Command\InstallTypoScriptCommandController');
		$commandController->installAllTypoScriptCommand();
		return 'Installed successfully, for details consult the system log';
	}

    /**
     * access is always allowed
     *
     * @return    boolean        Always returns true
     */
    function access() {
        return true;
    }


}


?>
