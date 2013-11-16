<?php

namespace TechDivision\Typo3Theme\Command;

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

class InstallTypoScriptCommandController extends \TYPO3\CMS\Extbase\Mvc\Controller\CommandController {

	/**
	 * Extension Key
	 *
	 * @var string
	 */
	protected $extensionKey = 'typo3_theme';

	/**
	 * BasePath for all RootTemplates from Webroot
	 *
	 * @var string
	 * @example '/Configuration/TypoScriptInstaller/Templates/Sites/'
	 */
	protected $rootTemplatesBasePath;

	/**
	 * Identifier for single RootPage
	 *
	 * @var string
	 */
	protected $identifierForSingleRootPage;


	/**
	 * typoScriptMappingRepository
	 *
	 * @var \TechDivision\Typo3Theme\Domain\Repository\TypoScriptMappingRepository
	 * @inject
	 */
	protected $typoScriptMappingRepository;
	
	
	/**
	 * typoScriptTemplateRepository
	 *
	 * @var \TechDivision\Typo3Theme\Domain\Repository\TypoScriptTemplateRepository
	 * @inject
	 */
	protected $typoScriptTemplateRepository;

	/**
	 * pageRepository
	 *
	 * @var \TechDivision\Typo3Theme\Domain\Repository\PageRepository
	 * @inject
	 */
	protected $pageRepository;

	/**
	 * backendUserRepository
	 *
	 * @var \TechDivision\Typo3Theme\Domain\Repository\BackendUserRepository
	 * @inject
	 */
	protected $backendUserRepository;

	/**
	 * backendGroupRepository
	 *
	 * @var \TechDivision\Typo3Theme\Domain\Repository\BackendGroupRepository
	 * @inject
	 */
	protected $backendGroupRepository;

    /**
     * persistenceManager
     * 
     * @var Tx_Extbase_Persistence_ManagerInterface
	 * @inject
     */    
    protected $persistenceManager;
    
    /**
     * templateFileStructureUtility
     * 
     * @var \TechDivision\Typo3Theme\Utility\TemplateFileStructureUtility
     */    
    protected $templateFileStructureUtility;

    /**
     * typoScriptTemplateInstallationUtility
     * 
     * @var \TechDivision\Typo3Theme\Utility\TypoScriptTemplateInstallationUtility
     */    
    protected $typoScriptTemplateInstallationUtility;

    
    /**
     * loggerUtility
     * 
     * @var \TechDivision\Typo3Theme\Utility\LoggerUtility
	 * @inject
     */    
    protected $loggerUtility;
    
	/**
	 * Constructor
	 *
	 */
	public function __construct()
		{
		$this->identifierForSingleRootPage = 'RootPage';
		$this->loggerUtility = new \TechDivision\Typo3Theme\Utility\LoggerUtility(
			$this->extensionKey,
			$GLOBALS['BE_USER']
		);
				
	}

	/**
	 * Install All kinds of typoscript
	 * 
	 * @return void
	 */
	public function installAllTypoScriptCommand(){
		$this->installTemplatesCommand();
		$this->installPageTsCommand();
		$this->installUserTsCommand();
		$this->installGroupTsCommand();
	}

	/**
	 * Install Templates
	 * 
	 * @return void
	 */
	public function installTemplatesCommand(){
		$this->prepareControllerSettings(
			'Templates/Sites/',
			'ExtensionTemplates'
		);
		
		$this->typoScriptTemplateInstallationUtility = new \TechDivision\Typo3Theme\Utility\TypoScriptTemplateInstallationUtility(
			$this->extensionKey,
			$this->rootTemplatesBasePath,
			PATH_site,
			$this->templateFileStructureUtility
		);

		//Get all Root Templates
		$templateFoldersToBeMapped = $this->templateFileStructureUtility->readCollectionOfPossibleTemplatesToBeInstalledFromFileSystem();

		//Find PIDs for Root Templates				
		foreach($templateFoldersToBeMapped as $templateFolderToBeMapped){
			/*Check if it is a RootPage identifier*/
			if($templateFolderToBeMapped == $this->identifierForSingleRootPage){
				$pageIdForThisTemplateFolder = $this->getPageIdForSingleRootPage();
			} else {
				$pageIdForThisTemplateFolder = $this->getPageIdForThisIdentifier($templateFolderToBeMapped);
			}
			
			/*Check if template is to be updated or added*/
			if($this->typoScriptTemplateRepository->countByPid($pageIdForThisTemplateFolder) > 0){
				$this->updateTemplateForPageId($templateFolderToBeMapped, $pageIdForThisTemplateFolder);
			} else {
				$this->addTemplateForPageId($templateFolderToBeMapped, $pageIdForThisTemplateFolder);
			}
		}
		
		$this->persistenceManager->persistAll();
	}


	/**
	 * Install Templates
	 * 
	 * @return void
	 */
	public function installPageTsCommand(){
		$this->prepareControllerSettings(
			'TsConfig/Page/',
			''
		);

		//Get all PageTs
		$pageTsFoldersToBeMapped = $this->templateFileStructureUtility->readCollectionOfPossibleTemplatesToBeInstalledFromFileSystem();

		//Find PIDs				
		foreach($pageTsFoldersToBeMapped as $pageTsFolderToBeMapped){
			/*Check if it is a RootPage identifier*/
			if($pageTsFolderToBeMapped == $this->identifierForSingleRootPage){
				$pageIdForThisPageTsFolder = $this->getPageIdForSingleRootPage();
			} else {
				$pageIdForThisPageTsFolder = $this->getPageIdForThisIdentifier($pageTsFolderToBeMapped);
			}
			
			/*Check if template is to be updated or added*/
			if($this->pageRepository->countByUid($pageIdForThisPageTsFolder) > 0){
				$this->updatePage($pageTsFolderToBeMapped, $pageIdForThisPageTsFolder);
			} else {
				$this->loggerUtility->logErrorMessageAndThrowException('No Page found with id ' . $pageIdForThisPageTsFolder);
			}
		}
		
		$this->persistenceManager->persistAll();
	}



	/**
	 * Install User TSConfig
	 * 
	 * @return void
	 */
	public function installUserTsCommand(){
		$this->prepareControllerSettings(
			'TsConfig/User/',
			''
		);
	
			//Get all PageTs
		$userTsFoldersToBeMapped = $this->templateFileStructureUtility->readCollectionOfPossibleTemplatesToBeInstalledFromFileSystem();

		//Find PIDs				
		foreach($userTsFoldersToBeMapped as $userTsFolderToBeMapped){
			$backendUsersToBeUpdated = $this->getUserIdsForThisIdentifier($userTsFolderToBeMapped);
			foreach($backendUsersToBeUpdated as $backendUserToBeUpdated){
				$this->updateUser($userTsFolderToBeMapped, $backendUserToBeUpdated);
			}
		}
		
		$this->persistenceManager->persistAll();
	}




	/**
	 * Install User TSConfig for Groups
	 * 
	 * @return void
	 */
	public function installGroupTsCommand(){
		$this->prepareControllerSettings(
			'TsConfig/Group/',
			''
		);

		//Get all PageTs
		$groupTsFoldersToBeMapped = $this->templateFileStructureUtility->readCollectionOfPossibleTemplatesToBeInstalledFromFileSystem();
		//Find PIDs				
		foreach($groupTsFoldersToBeMapped as $groupTsFolderToBeMapped){
			$backendGroupsToBeUpdated = $this->getGroupIdsForThisIdentifier($groupTsFolderToBeMapped);

			foreach($backendGroupsToBeUpdated as $backendGroupToBeUpdated){
				$this->updateGroup($groupTsFolderToBeMapped, $backendGroupToBeUpdated);
			}
		}
		
		$this->persistenceManager->persistAll();
	}

	/**
	 * Prepares Controller Settings
	 * @param string 
	 * @param string 
	 * 
	 * @return void
	 */
	protected function prepareControllerSettings($folderToSearch, $subFolderNameForExtensionTemplateStructure = ''){
		$this->rootTemplatesBasePath = 'typo3conf/ext/' . $this->extensionKey . '/Configuration/TypoScriptInstaller/' . $folderToSearch;

		$absoluteRootTemplatesPath = PATH_site . $this->rootTemplatesBasePath;

		$this->templateFileStructureUtility = new \TechDivision\Typo3Theme\Utility\TemplateFileStructureUtility(
			$absoluteRootTemplatesPath,
			$subFolderNameForExtensionTemplateStructure
		);
	}
	

	/**
	 * Gets PageId for given Identifier
	 * @param string
	 * @return integer
	 */
	protected function getPageIdForThisIdentifier($potentialIdentifier){
		$potentialIdentifier = $this->typoScriptTemplateInstallationUtility->getCleanedIdentifier($potentialIdentifier);
		
		$typoScriptMapping = $this->typoScriptMappingRepository->findOneByIdentifier($potentialIdentifier);
		if($typoScriptMapping instanceof \TechDivision\Typo3Theme\Domain\Model\TypoScriptMapping){
			return $typoScriptMapping->getPid();
		} else {
			$this->loggerUtility->logErrorMessageAndThrowException('No TypoScriptMapping identifier found for ' . $potentialIdentifier);
			return FALSE;
		}
	}

	/**
	 * Gets UserId for given Identifier
	 * @param string 
	 * @return integer
	 */
	protected function getUserIdsForThisIdentifier($identifier){
		$users = $this->backendUserRepository->findAllUsersWithMatchingIdentifier($identifier);
		if(count($users)){
			return $users;
		} else {
			$this->loggerUtility->logErrorMessageAndThrowException('No Users found for identifier ' . $identifier);
			return FALSE;
		}
	}

	/**
	 * Gets GroupId for given Identifier
	 * @param string 
	 * @return integer
	 */
	protected function getGroupIdsForThisIdentifier($identifier){
		$groups = $this->backendGroupRepository->findAllGroupsWithMatchingIdentifier($identifier);
		if(count($groups)){
			return $groups;
		} else {
			$this->loggerUtility->logErrorMessageAndThrowException('No Backend Groups found for identifier ' . $identifier);
			return FALSE;
		}
	}


	/**
	 * GetPageID for single RootPage
	 *
	 * @return integer
	 */
	protected function getPageIdForSingleRootPage(){
		if($this->pageRepository->countByIsSiteroot(TRUE) === 1) {
			$page = $this->pageRepository->findOneByIsSiteroot(TRUE);
			if($page instanceof \TechDivision\Typo3Theme\Domain\Model\Page){
				return $page->getUid();
			} else {
				$this->loggerUtility->logErrorMessageAndThrowException('Page was not of type \TechDivision\Typo3Theme\Domain\Model\Page!');
			}
		} else if ($this->pageRepository->countByIsSiteroot(TRUE) > 1){
			$this->loggerUtility->logErrorMessageAndThrowException('More than one root page found');
		} else if ($this->pageRepository->countByIsSiteroot(TRUE) < 1) {
			$this->loggerUtility->logErrorMessageAndThrowException('There is no root page available');
		}
		return FALSE;
	}
	
	

	/**
	 * Actual process logic of installing Root and Extension Templates
	 * 
	 * @param string
	 * @param integer
	 *
	 * @return void
	 */
	protected function updateTemplateForPageId($identifier, $pageId){
	
		$template =  $this->typoScriptTemplateRepository->findOneByPid($pageId);
		if($template instanceof \TechDivision\Typo3Theme\Domain\Model\TypoScriptTemplate){
			$template = $this->typoScriptTemplateInstallationUtility->prepareTemplateForInstallation($template, $identifier, $pageId, $isRootTemplate);
			$this->typoScriptTemplateRepository->update($template);
			return TRUE;
		}

		$this->loggerUtility->logErrorMessageAndThrowException('Template ' . $identifier . ' on page id ' . $pageId . ' was not of type \TechDivision\Typo3Theme\Domain\Model\TypoScriptTemplate!');
		return FALSE;
	}

	/**
	 * Actual process logic of installing Root and Extension Templates
	 * 
	 * @param string
	 * @param boolean
	 *
	 * @return void
	 */
	protected function addTemplateForPageId($identifier, $pageId){
		$template = $this->objectManager->create('TechDivision\Typo3Theme\Domain\Model\TypoScriptTemplate');
		$template = $this->typoScriptTemplateInstallationUtility->prepareTemplateForInstallation($template, $identifier, $pageId);
		$this->typoScriptTemplateRepository->add($template);
	}


	/**
	 * Update the Page
	 * 
	 * @param string
	 * @param integer
	 *
	 * @return void
	 */
	protected function updatePage($identifier, $pageId){
	
		$page =  $this->pageRepository->findByUid($pageId);
		if($page instanceof \TechDivision\Typo3Theme\Domain\Model\Page){
			$page->setSetupCodeFileInclusion($this->rootTemplatesBasePath . $identifier . '/Setup.ts');
			$this->pageRepository->update($page);
			return TRUE;
		}

		$this->loggerUtility->logErrorMessageAndThrowException('PageTs ' . $identifier . ' on page id ' . $pageId . ' was not of type \TechDivision\Typo3Theme\Domain\Model\TypoScriptTemplate!');
		return FALSE;
	}


	/**
	 * Actual process logic of installing User TS
	 * 
	 * @param string
	 * @param \TechDivision\Typo3Theme\Domain\Model\BackendUser
	 *
	 * @return void
	 */
	protected function updateUser($identifier, \TechDivision\Typo3Theme\Domain\Model\BackendUser $user){
		$user->setSetupCodeFileInclusion($this->rootTemplatesBasePath . $identifier . '/Setup.ts');
		$this->backendUserRepository->update($user);
	}

	/**
	 * Actual process logic of installing User TS for Groups
	 * 
	 * @param string
	 * @param \TechDivision\Typo3Theme\Domain\Model\BackendGroup
	 *
	 * @return void
	 */
	protected function updateGroup($identifier, \TechDivision\Typo3Theme\Domain\Model\BackendGroup $group){
		$group->setSetupCodeFileInclusion($this->rootTemplatesBasePath . $identifier . '/Setup.ts');
		$this->backendGroupRepository->update($group);
	}
}

?>
