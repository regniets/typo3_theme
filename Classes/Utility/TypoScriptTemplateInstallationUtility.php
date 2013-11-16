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

class TypoScriptTemplateInstallationUtility {

	/**
	 * Extension Key
	 *
	 * @var string
	 */
	protected $extensionKey;

	/**
	 * BasePath for all RootTemplates from Webroot
	 *
	 * @var string
	 * @example '/Configuration/TypoScriptInstaller/Templates/Sites/'
	 */
	protected $rootTemplatesBasePath;

	/**
	 * FileStructureUtility
	 *
	 * @var \TechDivision\Typo3Theme\Interfaces\FileStructureUtilityInterface;
	 *
	 */
	protected $fileStructureUtility;

	/**
	 * absoluteSitePath
	 *
	 * @var string 
	 *
	 */
	protected $absoluteSitePath;

	/**
	 * Constructor
	 *
	 * @param string $extensionKey
	 * @param string $rootTemplatesBasePath
	 * @param string $$absoluteSitePath
	 * @param \TechDivision\Typo3Theme\Interfaces\FileStructureUtilityInterface $fileStructureUtility
	 *
	 */
	public function __construct(
			$extensionKey,
			$rootTemplatesBasePath,
			$absoluteSitePath,
			\TechDivision\Typo3Theme\Interfaces\FileStructureUtilityInterface $fileStructureUtility
			
		){
		$this->extensionKey = $extensionKey;
		$this->rootTemplatesBasePath = $rootTemplatesBasePath;
		$this->absoluteSitePath = $absoluteSitePath;
		$this->fileStructureUtility = $fileStructureUtility;
		
	}
	
	/**
	 * @param string $extensionKey
	 */
	public function setExtensionKey($extensionKey)
	{
		$this->extensionKey = $extensionKey;
	}

	/**
	 * @return string
	 */
	public function getExtensionKey()
	{
		return $this->extensionKey;
	}

	/**
	 * @param string $rootTemplatesBasePath
	 */
	public function setRootTemplatesBasePath($rootTemplatesBasePath)
	{
		$this->rootTemplatesBasePath = $rootTemplatesBasePath;
	}

	/**
	 * @return string
	 */
	public function getRootTemplatesBasePath()
	{
		return $this->rootTemplatesBasePath;
	}

			
    /**
	 * Prepare Template for installing
	 * 
	 * @param \TechDivision\Typo3Theme\Domain\Model\TypoScriptTemplate $template
	 * @param string $identifier
	 * @param integer $pageId
	 * 	 
	 * @return \TechDivision\Typo3Theme\Domain\Model\TypoScriptTemplate
	 */
	public function prepareTemplateForInstallation($template, $identifier, $pageId){
		//If identifier contains a slash, it is an extension template
		$isRootTemplate = TRUE;
		if(strstr($identifier,'/')){
			$isRootTemplate = FALSE;
		}
		$template->setTitle($this->extensionKey . ': ' . $identifier);
		$template->setPid($pageId);
		$template->setIsRootTemplate($isRootTemplate);
		$template->setSetupCodeFileInclusion($this->rootTemplatesBasePath . $identifier . '/Setup.ts');
		$template->setConstantsCodeFileInclusion($this->rootTemplatesBasePath . $identifier . '/Constants.ts');

		$includeStaticFilePath = $this->absoluteSitePath . $this->rootTemplatesBasePath . $identifier . '/IncludeStatic.ts';
		$includeStaticFileContent = $this->fileStructureUtility->getFileContentAndSplitLinesToArray($includeStaticFilePath);
		
		$template->setIncludeStaticTyposcriptFiles($includeStaticFileContent);
		
		return $template;
	}
	
    /**
	 * Cleans string and returns correct identifier
	 * 
	 * @param string $identifier
	 * 	 
	 * @return string
	 */
	public function getCleanedIdentifier($identifier){
		if(strstr($identifier, '/')){
			$explodedIdentifier = explode('/', $identifier);
			return array_pop($explodedIdentifier);
		} else {
			return $identifier;
		}
	}
	

}