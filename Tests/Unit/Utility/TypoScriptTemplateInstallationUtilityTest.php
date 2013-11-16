<?php

namespace TechDivision\Typo3Theme\Tests;

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
class TypoScriptTemplateInstallationUtilityTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {

	/**
	 * @var \TechDivision\Typo3Theme\Utility\TypoScriptTemplateInstallationManager
	 */
	protected $fixture;

	/**
	 * @var string
	 */
	protected $extensionKey = 'theme';

	/**
	 * @var string
	 */
	protected $rootTemplatesBasePath = '/Configuration/TypoScriptInstaller/Templates/Sites/';

	/**
	 * Setup Method
	 */
	public function setUp(){
		$templateFileStructureUtility = $this->getMock('\TechDivision\Typo3Theme\Interfaces\FileStructureUtilityInterface');
		$this->fixture = new \TechDivision\Typo3Theme\Utility\TypoScriptTemplateInstallationUtility(
			$this->extensionKey,
			$this->rootTemplatesBasePath,
			$absoluteSitePath,
			$templateFileStructureUtility
		);
	}

	/**
	 *
	 */
	public function testGetExtensionKeyReturnsCorrectString(){
		$this->fixture->setExtensionKey($this->extensionKey);

		$this->assertSame(
			$this->extensionKey,
			$this->fixture->getExtensionKey()
		);
	}
	
	/**
	 *
	 */
	public function testGetRootTemplatesBasePathReturnsCorrectString(){
		$this->fixture->setRootTemplatesBasePath($this->rootTemplatesBasePath);

		$this->assertSame(
			$this->rootTemplatesBasePath,
			$this->fixture->getRootTemplatesBasePath()
		);
	}

	/**
	 *
	 */
	public function testPrepareTemplatesForInstallationPreparesTemplateCorrectlyForNonRootTemplates(){
		$dummyIdentifier = 'RootPage/ExtensionTemplates/Subpage';
		$dummyPageId = 1;
		
		$templateMockToBeComparedTo = new \TechDivision\Typo3Theme\Domain\Model\TypoScriptTemplate;
		$templateMockToBeComparedTo->setTitle($this->extensionKey . ': ' . $dummyIdentifier);
		$templateMockToBeComparedTo->setPid($dummyPageId);
		$templateMockToBeComparedTo->setIsRootTemplate(FALSE);
		$templateMockToBeComparedTo->setSetupCodeFileInclusion($this->rootTemplatesBasePath . $dummyIdentifier . '/Setup.ts');
		$templateMockToBeComparedTo->setConstantsCodeFileInclusion($this->rootTemplatesBasePath . $dummyIdentifier . '/Constants.ts');
		$templateMockToBeComparedTo->setIncludeStaticTyposcriptFiles('');		
		
		$templateMockToCompare = $this->fixture->prepareTemplateForInstallation(new \TechDivision\Typo3Theme\Domain\Model\TypoScriptTemplate, $dummyIdentifier, $dummyPageId);
		
		$this->assertEquals(
			$templateMockToBeComparedTo,
			$templateMockToCompare
		);
	}
	
	/**
	 *
	 */
	public function testPrepareTemplatesForInstallationPreparesTemplateCorrectlyForRootTemplates(){
		$dummyIdentifier = 'RootPage';
		$dummyPageId = 1;
		
		$templateMockToBeComparedTo = new \TechDivision\Typo3Theme\Domain\Model\TypoScriptTemplate;
		$templateMockToBeComparedTo->setTitle($this->extensionKey . ': ' . $dummyIdentifier);
		$templateMockToBeComparedTo->setPid($dummyPageId);
		$templateMockToBeComparedTo->setIsRootTemplate(TRUE);
		$templateMockToBeComparedTo->setSetupCodeFileInclusion($this->rootTemplatesBasePath . $dummyIdentifier . '/Setup.ts');
		$templateMockToBeComparedTo->setConstantsCodeFileInclusion($this->rootTemplatesBasePath . $dummyIdentifier . '/Constants.ts');
		$templateMockToBeComparedTo->setIncludeStaticTyposcriptFiles('');		
		
		$templateMockToCompare = $this->fixture->prepareTemplateForInstallation(new \TechDivision\Typo3Theme\Domain\Model\TypoScriptTemplate, $dummyIdentifier, $dummyPageId);
		
		$this->assertEquals(
			$templateMockToBeComparedTo,
			$templateMockToCompare
		);
	}

	/**
	 *
	 */
	public function testGetCleanedIdentifierReturnsCorrectStringForRootTemplate(){
		$dummyIdentifier = 'RootPage';
		
		$this->assertEquals(
			$dummyIdentifier,
			$this->fixture->getCleanedIdentifier($dummyIdentifier)
		);
	}
	/**
	 *
	 */
	public function testGetIdentifierReturnsCorrectStringForExtensionTemplate(){
		$dummyIdentifier = 'RootPage/ExtensionTemplates/Subpage';
		
		$this->assertEquals(
			'Subpage',
			$this->fixture->getCleanedIdentifier($dummyIdentifier)
		);
	}
	
}