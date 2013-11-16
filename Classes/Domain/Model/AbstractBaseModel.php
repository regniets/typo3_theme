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
class AbstractBaseModel extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * @var string title
	 */
	protected $title;
	
	/**
	 * @var string title
	 */
	protected $setupCode;
	
	/**
	 * @param string
	 * return void
	 */
	public function setTitle($title){
		$this->title = $title;
	}

	/**
	 * gets setup code
	 * return string
	 */
	public function getTitle(){
		return $this->title;
	}

	/**
	 * @param string
	 * return void
	 */
	public function setSetupCode($setupCode){
		$this->setupCode = $setupCode;
	}

	/**
	 * @param string filePathForInclusion
	 * e.g. 'typo3conf/ext/theme/SetupFile.ts'
	 * return void
	 */
	public function setSetupCodeFileInclusion($filePathForInclusion){
		$this->setupCode = '<INCLUDE_TYPOSCRIPT:source="file:' . $filePathForInclusion . '">';
	}

	/**
	 * gets setup code
	 * return string
	 */
	public function getSetupCode(){
		return $this->setupCode;
	}

}
?>