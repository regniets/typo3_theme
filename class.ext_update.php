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
     * Extension key should come from scheduler task
     * Update Script is being inserted manually or in the build process.
     * @var string
     */
    private $extKey = 'typo3_theme';

    /**
     * Base Path for Installer Folder
     *
     * @var string
     */
    private $basePath;

    /**
     * Theme Installer
     *
     * @var ThemeInstallerService
     */
    private $themeInstaller;

    /**
     * Execute Method for installing themes
     *
     * @return void
     */
    public function main() {
        $themeInstaller = new ThemeInstallerService();
        $themeInstaller->setExtKey($this->extKey);
        $themeInstaller->setBasePath('typo3conf/ext/' . $this->extKey . '/Configuration/TypoScriptInstaller/');
        $returnError = $themeInstaller->installTheme();
        if($returnError)
            return 'Error Installing';
        else
            return 'Installed successfully';
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

// Include extension?
if (defined('TYPO3_MODE') && $GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/static_info_tables/class.ext_update.php'])    {
    include_once($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/static_info_tables/class.ext_update.php']);
}


?>
