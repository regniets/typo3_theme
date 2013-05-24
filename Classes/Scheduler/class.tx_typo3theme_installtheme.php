<?php
declare(ENCODING = 'utf-8');
/***************************************************************
*  Copyright notice
*
*  (c) 2010 Stefan Regniet <s.regniet@notos-media.de>, TechDivision GmbH
*  			
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
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
 * Hook for installing themes via the extension manager.
 *
 * @author	Stefan Regniet [TechDivision GmbH] <s.regniet@techdivision.com>
 * @author	Stefan Willkommer [TechDivision GmbH] <s.willkommer@techdivision.com>
 * @package	TYPO3
 * @subpackage	typo3_theme
 */

require_once(t3lib_extMgm::extPath('typo3_theme') . 'Classes/Service/ThemeInstallerService.php');

class tx_typo3theme_installtheme extends tx_scheduler_Task {
	
	/**
	 * Extension key should come from scheduler task
	 * Scheduler Task is being inserted manually or in the build process.
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
    public function execute() {
        $themeInstaller = new ThemeInstallerService();
        $themeInstaller->setExtKey($this->extKey);
        $themeInstaller->setBasePath('typo3conf/ext/' . $this->extKey . '/Configuration/TypoScriptInstaller/');
        $returnError = $themeInstaller->installTheme();
        if($returnError)
            return FALSE;
        else
            return TRUE;
    }
}