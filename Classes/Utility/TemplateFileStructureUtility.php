<?php

namespace TechDivision\Typo3Theme\Utility;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Stefan Regniet <s.regniet@techdivision.cm>, TechDivision GmbH
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
 * @group ThemeTests
 *
 * @package typo3_theme
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */

class TemplateFileStructureUtility implements \TechDivision\Typo3Theme\Interfaces\FileStructureUtilityInterface {

	/**
	 * BasePath for all RootTemplates from Webroot
	 *
	 * @var string
	 * @example '/var/www/typo3conf/ext/theme/Configuration/TypoScriptInstaller/Templates/Sites/'
	 */
	protected $absoluteRootTemplatesBasePath;

	/**
	 * subFolderNameForExtensionTemplateStructure
	 *
	 * @var string 
	 *
	 */
	protected $subFolderNameForExtensionTemplateStructure;
		
	/**
	 * Constructor
	 *
	 * @param string $absoluteRootTemplatesBasePath
	 * @param string $subFolderNameForExtensionTemplateStructure
	 * 
	 * @return void
	 */
	public function __construct(
			$absoluteRootTemplatesBasePath = '/var/www/',
			$subFolderNameForExtensionTemplateStructure = ''
		){
		$this->absoluteRootTemplatesBasePath = $absoluteRootTemplatesBasePath;
		$this->subFolderNameForExtensionTemplateStructure = $subFolderNameForExtensionTemplateStructure;
	}
	
	/**
	 * Reads and parses static includes file 
	 *
	 * @return array of static includes
	 */	
	public function getFileContentAndSplitLinesToArray($file){
		$staticIncludes = array();
		if(file_exists($file)) {
			$staticIncludes = file_get_contents($file);
			$staticIncludes = str_replace("\n",',',trim($staticIncludes));
			$staticIncludes = explode(',', $staticIncludes);
		}
		return $staticIncludes;

	}

	/**
	 * Reads and parses static includes file 
	 *
	 * @return array 
	 */	
	public function readCollectionOfPossibleTemplatesToBeInstalledFromFileSystem(){
		$rootTemplateFoldersToBeMapped = array();
		$rootTemplateFoldersToBeMapped = $this->searchFolderForTemplatesToBeMapped($this->absoluteRootTemplatesBasePath);
		//Get all Extension Templates below Root Folders
		$templateFoldersToBeMapped = array();
		foreach($rootTemplateFoldersToBeMapped as $rootTemplateFolder) {
			$extensionTempateFoldersToBeMappedFromThisRootTemplate = $this->searchFolderForTemplatesToBeMapped($this->absoluteRootTemplatesBasePath . $rootTemplateFolder . '/' . $this->subFolderNameForExtensionTemplateStructure . '/');

			foreach($extensionTempateFoldersToBeMappedFromThisRootTemplate as $extensionTempateFoldersToBeMappedFromThisRootTemplate) {
				$templateFoldersToBeMapped[] = $rootTemplateFolder . '/' . $this->subFolderNameForExtensionTemplateStructure . '/' . $extensionTempateFoldersToBeMappedFromThisRootTemplate;
			}
		}
		
		//merge extension and root template folders
		$templateFoldersToBeMapped = array_merge(
			$rootTemplateFoldersToBeMapped, 
			$templateFoldersToBeMapped
		);
		
		return $templateFoldersToBeMapped;
	}


	/**
	 * Searches specified folder for subDirectories.
	 * 
	 * @param string $basePath
	 * @param string $directoryToBeScanned 
	 * 
	 * @return array
	 */
	protected function searchFolderForTemplatesToBeMapped($basePath, $subDirectoryToBeScanned = '') {
		$absoluteDirectoryToBeScanned = $basePath . $subDirectoryToBeScanned;

		if(is_dir($absoluteDirectoryToBeScanned)){
			$directoryContents = scandir($absoluteDirectoryToBeScanned);
			$availableTemplates = array();
			
			foreach($directoryContents as $currentDirectory){	
				if( $currentDirectory != '.' && $currentDirectory != '..' && is_dir($absoluteDirectoryToBeScanned . '/' . $currentDirectory) ) {
					$availableTemplates[] = $subDirectoryToBeScanned . $currentDirectory;
				}
			}
			
			return $availableTemplates;
		} else {
			return array();
		}
	}

}