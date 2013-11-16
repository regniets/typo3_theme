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
class TypoScriptTemplateTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {

	/**
	 * @var \TechDivision\Typo3Theme\Domain\Model\TypoScriptTemplate
	 */
	protected $fixture;

	/**
	 * @var string
	 */
	protected $testSetupCode;

	/**
	 * Setup Method
	 */
	public function setUp(){
		$this->fixture = new \TechDivision\Typo3Theme\Domain\Model\TypoScriptTemplate;
		$this->testSetupCode = 'page = PAGE';
	}

	/**
	 *
	 */
	public function testSetTitleReturnsCorrectString(){
		$this->fixture->setTitle('Title');

		$this->assertSame(
			'Title',
			$this->fixture->getTitle()
		);
	}

	/**
	 *
	 */
	public function testGetIsRootTemplateReturnsTrueIfIsRootTemplate(){
		$this->fixture->setIsRootTemplate(TRUE);

		$this->assertSame(
			TRUE,
			$this->fixture->getIsRootTemplate()
		);
	}

	/**
	 *
	 */
	public function testGetIsRootTemplateReturnsFalseIfIsNotRootTemplate(){
		$this->fixture->setIsRootTemplate(FALSE);

		$this->assertSame(
			FALSE,
			$this->fixture->getIsRootTemplate()
		);
	}

	/**
	 *
	 */
	public function testSetPidReturnsCorrectPid(){
		$this->fixture->setPid(49);

		$this->assertSame(
			49,
			$this->fixture->getPid()
		);
	}

	/**
	 *
	 */
	public function testSetSetupCodeReturnsCorrectConfigCode(){
		$this->fixture->setSetupCode($this->testSetupCode);

		$this->assertSame(
			$this->testSetupCode,
			$this->fixture->getSetupCode()
		);
	}

	/**
	 *
	 */
	public function testIfSetSetupCodeFileInclusionIncludesFileCorrectlyInSetupCode(){
		$setupInclusionFile = 'typo3conf/ext/theme/SetupFile.ts';
		$this->fixture->setSetupCodeFileInclusion($setupInclusionFile);

		$this->assertSame(
			'<INCLUDE_TYPOSCRIPT:source="file:' . $setupInclusionFile . '">',
			$this->fixture->getSetupCode()
		);
	}

	/**
	 *
	 */
	public function testSetConstantsCodeReturnsCorrectConfigCode(){
		$this->fixture->setConstantsCode($this->testSetupCode);

		$this->assertSame(
			$this->testSetupCode,
			$this->fixture->getConstantsCode()
		);
	}

	/**
	 *
	 */
	public function testIfSetConstantsCodeFileInclusionIncludesFileCorrectlyInConstantsCode(){
		$constantsInclusionFile = 'typo3conf/ext/theme/ConstantsFile.ts';
		$this->fixture->setConstantsCodeFileInclusion($constantsInclusionFile);

		$this->assertSame(
			'<INCLUDE_TYPOSCRIPT:source="file:' . $constantsInclusionFile . '">',
			$this->fixture->getConstantsCode()
		);
	}

	/**
	 *
	 */
	public function testSetIncludeStaticTyposcriptFilesReturnsArrayOfIncludeStatics(){
		$testArrayOfTyposcriptIncludeStaticFiles = array(
			'EXT:css_styled_content/static/',
			'EXT:static_info_tables/static/static_info_tables/',
			'EXT:gridelements/static/gridelements/',
		);

		$this->fixture->setIncludeStaticTyposcriptFiles($testArrayOfTyposcriptIncludeStaticFiles);

		$this->assertSame(
			$testArrayOfTyposcriptIncludeStaticFiles,
			$this->fixture->getIncludeStaticTyposcriptFiles()
		);
	}
}