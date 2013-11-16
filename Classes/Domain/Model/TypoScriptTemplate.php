<?php
namespace TechDivision\Typo3Theme\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Stefan Regniet <s.regniet@techdivision.com>, TechDivision
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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
 *
 *
 * @package typo3_theme
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class TypoScriptTemplate extends AbstractBaseModel {


	/**
	 * @var boolean root
	 */
	protected $root;

	/**
	 * @var integer clear
	 */
	protected $clear;

	/**
	 * @var string constants
	 */
	protected $constants;

	/**
	 * @var string includeStaticFile
	 */
	protected $includeStaticFile;

	/**
	 * @var integer sorting 
	 */
	protected $sorting = 0;


	/**
	 * @param boolean
	 * return void
	 */
	public function setIsRootTemplate($isRootTemplate){
		if($isRootTemplate === TRUE){
			$this->root = TRUE;
			$this->clear = 3;
		} else {
			$this->root = FALSE;
			$this->clear = 0;
		}

	}

	/**
	 * checks if is a root template
	 * return boolean
	 */
	public function getIsRootTemplate(){
		if($this->root === TRUE && $this->clear === 3){
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * @param string
	 * return void
	 */
	public function setConstantsCode($constantsCode){
		$this->constants = $constantsCode;
	}

	/**
	 * gets constants code
	 * return string
	 */
	public function getConstantsCode(){
		return $this->constants;
	}

	/**
	 * @param string filePathForInclusion
	 * e.g. 'typo3conf/ext/theme/ConstantsFile.ts'
	 * return void
	 */
	public function setConstantsCodeFileInclusion($filePathForInclusion){
		$this->constants = '<INCLUDE_TYPOSCRIPT:source="file:' . $filePathForInclusion . '">';
	}
	
	/**
	 * @param array includeStaticFiles
	 * e.g. array(
	 * 		'EXT:css_styled_content/static/',
	 * 		'EXT:static_info_tables/static/static_info_tables/',
	 * 		'EXT:gridelements/static/gridelements/',
	 * );
	 * return void
	 */
	public function setIncludeStaticTyposcriptFiles($includeStaticFiles = array()){
		$this->includeStaticFile = implode(",",$includeStaticFiles);
	}

	/**
	 * gets includeStaticFilesArray
	 * return array
	 */
	public function getIncludeStaticTyposcriptFiles(){
		return explode(",",$this->includeStaticFile);
	}

}
?>