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

class LoggerUtility {

	/**
	 * current extension key
	 *
	 * @var string
	 */
	protected $extensionKey;

	/**
	 * Backend User Object
	 *
	 * @var array
	 */
	protected $backendUser;

	/**
	 * Installs root Templates
	 *
	 * @param string extensionKey
	 * @param array $GLOBALS['BE_USER']
	 */
	public function __construct(
			$extensionKey = '',
			$backendUser = array()
		){
		$this->extensionKey = $extensionKey;
		$this->backendUser = $backendUser;
	}

	/**
	 * logs any given error message to backend
	 * @param string $message
	 *
	 * @return void
	 * @throws \Exception
	 */	
	public function logErrorMessageAndThrowException($message){
		$this->logThisMessage($message, TRUE);
		throw new \ErrorException($message);
	}
	
	/**
	 * logs any given error message to backend
	 * @param string $message
	 *
	 * @return boolean
	 */	
	public function logErrorMessage($message){
		$this->logThisMessage($message, TRUE);
	}
	
	/**
	 * logs any given success message to backend
	 * @param string $message
	 *
	 * @return boolean
	 */	
	public function logSuccessMessage($message){
		$this->logThisMessage($message, FALSE);
	}

	/**
	 * sets Extension Key
	 * @param string $extensionKey
	 *
	 * @return string
	 */	
	public function setExtensionKey($extensionKey){
		$this->extensionKey = $extensionKey;
	}

	/**
	 * gets Extension Key
	 *
	 * @return string
	 */	
	public function getExtensionKey(){
		return $this->extensionKey;
	}

	/**
	 * logs any given error message to backend
	 * @param string $message
	 * @param boolean $error
	 *
	 * @return void
	 */	
	protected function logThisMessage($message, $error = FALSE){
		if(is_object($this->backendUser)){
			$this->backendUser->simplelog(
				'Theme Installation: ' . $message, 
				$this->extensionKey, 
				$error
			);
		}
	}


}