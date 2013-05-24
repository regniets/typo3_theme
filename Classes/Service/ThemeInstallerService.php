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

class ThemeInstallerService {

	/**
	 * Extension key should come from scheduler task
	 * Scheduler Task is being inserted manually or in the build process.
	 * @var string
	 */
	private $extKey;

	/**
	 * Base Path for Installer Folder
	 *
	 * @var string
	 */
	private $basePath;


	/**
	 * Get Extension Key
	 *
	 * @return void
	 */
	public function getExtKey() {
		return $this->extKey;
	}

	/**
	 * Set Extension Key
	 * @param string
	 * @return void
	 */
	public function setExtKey($extKey) {
		return $this->extKey = $extKey;
	}

	/**
	 * Get Base Path
	 *
	 * @return void
	 */
	public function getBasePath() {
		return $this->basePath;
	}

	/**
	 * Set Base Path
	 * @param string
	 * @return void
	 */
	public function setBasePath($basePath) {
		return $this->basePath = $basePath;
	}

	/**
	 * Execute Method for installing themes
	 *
	 * @return void
	 */
	public function installTheme() {
		$returnError = FALSE;
		$templateFolder = 'Templates/Sites';
		$pageTsFolder = 'TsConfig/Page';
		$userTsFolder = 'TsConfig/User';
		$groupTsFolder = 'TsConfig/Group';

		//1: iterate over RootTemplates and insert/update
		//RootTemplates are now TS-Mapping Identifier based
		$rootTemplates = $this->searchFolderForTemplates($templateFolder);
		if(is_array($rootTemplates)){
			foreach($rootTemplates as $rootTemplate){
				$pageId = '';
				if($pageId = $this->getPageIdByTyposcriptMappingIdentifier($rootTemplate)){
					$rootTemplateFolder = $templateFolder . '/' . $rootTemplate;
					$this->insertOrUpdateTemplate($pageId, $root = TRUE, $rootTemplateFolder);
					//2: iterate over ExtensionTemplates first - because if root template is available by accident, it will overrule
					$extensionTemplates = $this->searchFolderForTemplates($rootTemplateFolder . '/ExtensionTemplates');
					if(is_array($extensionTemplates)){
						foreach($extensionTemplates as $extensionTemplate){
							if($extensionTemplatePageId = $this->getPageIdByTyposcriptMappingIdentifier($extensionTemplate)) {
								$extensionTemplateFolder = $rootTemplateFolder . '/ExtensionTemplates/' . $extensionTemplate;
								$this->insertOrUpdateTemplate($extensionTemplatePageId, $root = FALSE, $extensionTemplateFolder);
							} else {
								$error[] = 'Attempted to insert extension template: ' . $rootTemplate . ' from ' . $rootTemplateFolder .  ' on non-existing page';
							}
						}
					}
				} else {
					$error[] = 'Domain Record ' . $rootTemplate . ' doesnt map to any page';
				}
			}
		}
		//3. iterate through page ts config
		//RootTemplates are now Domain-Based
		$pageTsConfigs = $this->searchFolderForTemplates($pageTsFolder);
		if(is_array($pageTsConfigs)){
			foreach($pageTsConfigs as $pageTsConfig){
				$pageId = '';
				if($pageId = $this->getPageIdByTyposcriptMappingIdentifier($pageTsConfig)){
					$pageTsConfigFolder = $pageTsFolder . '/' . $pageTsConfig;
					$this->updatePageTsConfig($pageId, $pageTsConfigFolder);
				} else {
					$error[] = 'Attempted to insert pageTsConfig: ' . $pageTsConfig . ' on non-existing page';
				}
			}
		}
		//4. iterate through user ts config
		$userTsConfigs = $this->searchFolderForTemplates($userTsFolder);
		if(is_array($userTsConfigs)){
			foreach($userTsConfigs as $userTsConfig){
				$userIds = array();
				$userIds = $this->getUserOrGroupIdByTyposcriptMappingIdentifier($userTsConfig, 'be_users');
				if(count($userIds)){
					$userTsConfigFolder = $userTsFolder . '/' . $userTsConfig;
					foreach($userIds as $userId){
						$this->updateUserTsConfig($userId, $userTsConfigFolder);
					}
				} else {
					$error[] = 'Attempted to insert userTsConfig: ' . $userTsConfig . ' on non-existing user';
				}
			}
		}
		//5. iterate through group ts config
		$groupTsConfigs = $this->searchFolderForTemplates($groupTsFolder);
		if(is_array($groupTsConfigs)){
			foreach($groupTsConfigs as $groupTsConfig){
				$groupIds = '';
				$groupIds = $this->getUserOrGroupIdByTyposcriptMappingIdentifier($groupTsConfig, 'be_groups');
				if(count($groupIds)){
					$groupTsConfigFolder = $groupTsFolder . '/' . $groupTsConfig;
					foreach($groupIds as $groupId){
						$this->updateGroupTsConfig($groupId, $groupTsConfigFolder);
					}
				} else {
					$error[] = 'Attempted to insert groupTsConfig: ' . $groupTsConfig . ' on non-existing group';
				}
			}
		}
		if(count($error)){
			$GLOBALS['BE_USER']->simplelog('Theme Installer: Failed to insert templates on theme extension ' . $this->extKey . ': ' . implode(', ',$error), 'et_platforms_theme', $error=1);
			$returnError = TRUE;
		} else {
			$GLOBALS['BE_USER']->simplelog('Theme Installer ran correctly on theme extension ' . $this->extKey . ': ' , 'et_platforms_theme', $error=0);
		}
		$error = array();
		return $returnError;
	}

	/**
	 * Searches specified folder for directories. Numbers of directories equal page ids (maybe later user ids)
	 *
	 * @param $folder Folder for Templates: ExtensionTemplates, RootTemplates or TsConfig/Page, maybe later TsConfig/User
	 * return array
	 */
	private function searchFolderForTemplates($folder) {
		$dir = PATH_site . $this->basePath . $folder;
		if(is_dir($dir)){
			$directoryArray = scandir($dir);
			foreach($directoryArray as $k => $v){
				if($v == '.' || $v == '..' )
					unset($directoryArray[$k]);
				if(!is_dir($dir . '/' . $v))
					unset($directoryArray[$k]);
			}
			return $directoryArray;
		} else {
			return false;
		}
	}

	/**
	 * Checks if Template exists and inserts or updates
	 * @param $pageId integer Id if the Page a template has to be inserted
	 * @param $root boolean root-template or not
	 * @param $folder String correct folder name, can be integer or domain
	 */
	private function insertOrUpdateTemplate($pageId, $root, $folder = ''){
		$templateExists = $GLOBALS['TYPO3_DB']->sql_num_rows($GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'sys_template', 'pid = "' . $pageId . '" AND deleted = 0 AND hidden = 0'));
		if($templateExists){
			$this->updateTemplate($pageId,$root,$folder);
		} else {
			$this->insertTemplate($pageId,$root,$folder);
		}

	}

	/**
	 * Inserts a new template
	 * @param $pageId integer Id if the Page a template has to be inserted
	 * @param $root boolean root-template or not
	 * @param $folder String correct folder name
	 */
	private function insertTemplate($pageId, $root, $folder){
		if(!$folder)
			$folder = $pageId;
		if($root == TRUE){
			$config = '<INCLUDE_TYPOSCRIPT:source="file:' . $this->basePath . $folder . '/Setup.ts">';
			$constants = '<INCLUDE_TYPOSCRIPT:source="file:' . $this->basePath  . $folder . '/Constants.ts">';
			$includes = $this->includeStatics($pageId,$root,$folder);
			$clear = 3;
		} else {
			$config = '<INCLUDE_TYPOSCRIPT:source="file:' . $this->basePath . $folder . '/Setup.ts">';
			$constants = '<INCLUDE_TYPOSCRIPT:source="file:' . $this->basePath . $folder . '/Constants.ts">';
			$includes = $this->includeStatics($pageId,$root,$folder);
			$clear = 0;
		}
		$insertArray = array(
			'pid' => $pageId,
			'tstamp' => time(),
			'crdate' => time(),
			'cruser_id' => $GLOBALS['BE_USER']->user['uid'],
			'deleted' => 0,
			'hidden' => 0,
			'clear' => $clear,
			'title' => $this->extKey,
			'sorting' => 256,
			'root' => $root,
			'constants' => $constants,
			'config' => $config,
			'include_static_file' => $includes
		);

		$res = $GLOBALS['TYPO3_DB']->exec_INSERTquery('sys_template', $insertArray);

	}

	/**
	 * Updates an existing template
	 * @param $pageId integer Id if the Page a template has to be updated
	 * @param $root boolean root-template or not
	 * @param $folder String correct folder name
	 */
	private function updateTemplate($pageId,$root, $folder){
		if($root == TRUE){
			$config = '<INCLUDE_TYPOSCRIPT:source="file:' . $this->basePath . $folder . '/Setup.ts">';
			$constants = '<INCLUDE_TYPOSCRIPT:source="file:' . $this->basePath  . $folder . '/Constants.ts">';
			$includes = $this->includeStatics($pageId,$root,$folder);
			$clear = 3;
		} else {
			$config = '<INCLUDE_TYPOSCRIPT:source="file:' . $this->basePath . $folder . '/Setup.ts">';
			$constants = '<INCLUDE_TYPOSCRIPT:source="file:' . $this->basePath . $folder . '/Constants.ts">';
			$includes = $this->includeStatics($pageId,$root,$folder);
			$clear = 0;
		}
		$existingTemplate = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'sys_template', 'pid = "' . $pageId . '" AND deleted = 0 LIMIT 0,1'));
		$updateArray = array(
			'tstamp' => time(),
			'crdate' => time(),
			'cruser_id' => $GLOBALS['BE_USER']->user['uid'],
			'deleted' => 0,
			'hidden' => 0,
			'clear' => $clear,
			'title' => $this->extKey,
			'sorting' => 256,
			'root' => $root,
			'constants' => $constants,
			'config' => $config,
			'include_static_file' => $includes
		);
		//Assuming there is only one valid template on each page!
		$res = $GLOBALS['TYPO3_DB']->exec_UPDATEquery('sys_template', 'uid=' . $existingTemplate['uid'] , $updateArray);
	}

	/**
	 * Checks for mapping identifier
	 * @param $pageId integer Id of the record
	 *
	 *
	 */
	private function getPageIdByTyposcriptMappingIdentifier($mappingIdentifier){
		//Special Case for "RootPage": Searches for Rootpage in Pagetree (only if one)
		if($mappingIdentifier == 'RootPage') {
			$count = $GLOBALS['TYPO3_DB']->sql_num_rows($GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'pages', 'is_siteroot = 1 AND deleted = 0'));
			if($count == 1){
				$result = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->exec_SELECTquery('uid', 'pages', 'is_siteroot = 1 AND deleted = 0'));
				return intval($result['uid']);
			}
			return false;
		} else {
			$count = $GLOBALS['TYPO3_DB']->sql_num_rows($GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'typoscript_mapping', 'identifier = "' . mysql_real_escape_string(strtolower($mappingIdentifier)) . '" AND deleted = 0'));
			if($count > 0){
				$result = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->exec_SELECTquery('pid', 'typoscript_mapping', 'identifier = "' . mysql_real_escape_string(strtolower($mappingIdentifier)) . '" AND deleted = 0'));
				return intval($result['pid']);
			} else {
				if($pageIdByDomainRecord = $this->getPageIdByDomainRecord($mappingIdentifier)){
					return $pageIdByDomainRecord;
				}
			}
			return false;
		}
	}

	/**
	 * Checks if page exists
	 * @param $pageId integer Id of the record
	 *
	 *
	 */
	private function getPageIdByDomainRecord($mappingIdentifier){
		$count = $GLOBALS['TYPO3_DB']->sql_num_rows($GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'sys_domain', 'domainName = "' . mysql_real_escape_string(strtolower($mappingIdentifier)) . '" AND hidden = 0'));
		if($count > 0){
			$result = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->exec_SELECTquery('pid', 'sys_domain', 'domainName = "' . mysql_real_escape_string(strtolower($mappingIdentifier)) . '" AND hidden = 0'));
			return intval($result['pid']);
		}
		return false;
	}

	/**
	 * Gets User Or Group Id by TS Mapping Identifier
	 * @param $pageId integer Id of the record
	 * @param $table Table to check, standard is pages
	 *
	 *
	 */
	private function getUserOrGroupIdByTyposcriptMappingIdentifier($mappingIdentifier, $table = 'be_users'){
		$ids = array();
		$whereStatement = ' typoscript_mapping.uid = ' . $table . '.typoscript_mapping AND typoscript_mapping.deleted = 0 AND ' . $table . '.deleted = 0 ' ;
		$addWhereStatement = '';
		if($mappingIdentifier != '_All')
			$addWhereStatement = " AND typoscript_mapping.identifier = '" . mysql_real_escape_string(strtolower($mappingIdentifier)) . "'";

		$count = $GLOBALS['TYPO3_DB']->sql_num_rows($GLOBALS['TYPO3_DB']->exec_SELECTquery(
			'*',
			'typoscript_mapping, ' . $table,
			$whereStatement . $addWhereStatement
		));
		if($count > 0){
			$result = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
				'*',
				'typoscript_mapping, ' . $table,
				$whereStatement . $addWhereStatement
			);
			while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($result)){
				$ids[] = intval($row['uid']);
			}
			if(count($ids))
				return $ids;
		}
		return false;
	}

	/**
	 * Inserts UserTSConfig
	 * @param $userId integer Id if the Page the config has to be inserted
	 *
	 *
	 */
	private function updateUserTsConfig($userId, $folder){
		$config = '<INCLUDE_TYPOSCRIPT:source="file:' . $this->basePath . $folder . '/Setup.ts">';
		$updateArray = array(
			'TSconfig' => $config
		);
		$res = $GLOBALS['TYPO3_DB']->exec_UPDATEquery('be_users', 'uid=' . $userId, $updateArray);
	}

	/**
	 * Inserts UserTSConfig
	 * @param $userId integer Id if the Page the config has to be inserted
	 *
	 *
	 */
	private function updateGroupTsConfig($groupId, $folder){
		$config = '<INCLUDE_TYPOSCRIPT:source="file:' . $this->basePath . $folder . '/Setup.ts">';
		$updateArray = array(
			'TSconfig' => $config
		);
		$res = $GLOBALS['TYPO3_DB']->exec_UPDATEquery('be_groups', 'uid=' . $groupId, $updateArray);
	}

	/**
	 * Inserts PageTSConfig
	 * @param $pageId integer Id if the Page the config has to be inserted
	 *
	 *
	 */
	private function updatePageTsConfig($pageId, $folder){
		$config = '<INCLUDE_TYPOSCRIPT:source="file:' . $this->basePath . $folder . '/Setup.ts">';
		$updateArray = array(
			'TSconfig' => $config
		);
		$res = $GLOBALS['TYPO3_DB']->exec_UPDATEquery('pages', 'uid=' . $pageId, $updateArray);
	}

	/**
	 * Returns includeStatics for Templates
	 * includeStatic.ts has to be a file with the required static template paths, one per line
	 *
	 * @param $pageId integer Id if the Page the config has to be inserted
	 * @param $root boolean Is root template
	 * @param $folder string Folder
	 *
	 * return string static Includes
	 */
	private function includeStatics($pageId, $root, $folder ){
		$file = PATH_site . $this->basePath . $folder . '/IncludeStatic.ts';
		$staticIncludes = '';
		if(file_exists($file)) {
			$staticIncludes = file_get_contents($file);
			$staticIncludes = str_replace("\n",',',trim($staticIncludes));
		}
		return $staticIncludes;
	}

}