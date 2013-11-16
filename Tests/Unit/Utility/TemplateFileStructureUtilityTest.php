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
class TemplateFileStructureUtilityTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {

	/**
	 * @var \TechDivision\Typo3Theme\Utility\TemplateFileStructureUtility
	 */
	protected $fixture;

	/**
	 * @var string
	 */
	protected $extensionKey = 'theme';

	/**
	 * @var string
	 */
	protected $rootDirectory = 'www';

	/**
	 * @var string
	 */
	public function setUp()
    {
		vfsStreamWrapper::register();
        vfsStreamWrapper::setRoot(new vfsStreamDirectory($this->rootDirectory));
        vfsStreamWrapper::getRoot()->addChild(new vfsStreamDirectory('typo3conf'));
        vfsStreamWrapper::getRoot()->getChild('typo3conf')
        	->addChild(new vfsStreamDirectory('ext'));
        vfsStreamWrapper::getRoot()->getChild('typo3conf')->getChild('ext')
        	->addChild(new vfsStreamDirectory($this->extensionKey));		
        vfsStreamWrapper::getRoot()->getChild('typo3conf')->getChild('ext')->getChild($this->extensionKey)
        	->addChild(new vfsStreamDirectory('Configuration'));		
        vfsStreamWrapper::getRoot()->getChild('typo3conf')->getChild('ext')->getChild($this->extensionKey)->getChild('Configuration')
        	->addChild(new vfsStreamDirectory('TypoScriptInstaller'));		
        vfsStreamWrapper::getRoot()->getChild('typo3conf')->getChild('ext')->getChild($this->extensionKey)->getChild('Configuration')->getChild('TypoScriptInstaller')
        	->addChild(new vfsStreamDirectory('Templates'));		
        vfsStreamWrapper::getRoot()->getChild('typo3conf')->getChild('ext')->getChild($this->extensionKey)->getChild('Configuration')->getChild('TypoScriptInstaller')->getChild('Templates')
        	->addChild(new vfsStreamDirectory('Sites'));		
        vfsStreamWrapper::getRoot()->getChild('typo3conf')->getChild('ext')->getChild($this->extensionKey)->getChild('Configuration')->getChild('TypoScriptInstaller')->getChild('Templates')->getChild('Sites')
        	->addChild(new vfsStreamDirectory('RootPage'));
        	
		$this->fixture = new \TechDivision\Typo3Theme\Utility\TemplateFileStructureUtility(
				vfsStream::url($this->rootDirectory . '/typo3conf/ext/' . $this->extensionKey . '/Configuration/TypoScriptInstaller/Templates/Sites/'),
				'ExtensionTemplates'
		);	
        
    }

	/**
	 * Setup Method
	 */
	public function testReadCollectionOfPossibleTemplatesToBeInstalledFromFileSystemReturnsCorrectStructureMappedToArrayForRootTemplates(){
        
		
		$expectedArray = array(
			'RootPage'
		);
		
		$returnArray = $this->fixture->readCollectionOfPossibleTemplatesToBeInstalledFromFileSystem();
		
		$this->assertEquals(
			$expectedArray,
			$returnArray
		);

	}


	/**
	 *
	 */
	public function testReadCollectionOfPossibleTemplatesToBeInstalledFromFileSystemReturnsCorrectStructureMappedToArrayForExtensionTemplates(){

        vfsStreamWrapper::getRoot()->getChild('typo3conf')->getChild('ext')->getChild($this->extensionKey)->getChild('Configuration')->getChild('TypoScriptInstaller')->getChild('Templates')->getChild('Sites')->getChild('RootPage')
        	->addChild(new vfsStreamDirectory('ExtensionTemplates'));
        vfsStreamWrapper::getRoot()->getChild('typo3conf')->getChild('ext')->getChild($this->extensionKey)->getChild('Configuration')->getChild('TypoScriptInstaller')->getChild('Templates')->getChild('Sites')->getChild('RootPage')->getChild('ExtensionTemplates')
        	->addChild(new vfsStreamDirectory('Subpage'));

		$expectedArray = array(
			'RootPage',
			'RootPage/ExtensionTemplates/Subpage'
		);

		$returnArray = $this->fixture->readCollectionOfPossibleTemplatesToBeInstalledFromFileSystem();
		
		$this->assertEquals(
			$expectedArray,
			$returnArray
		);
	}
	
	/**
	 *
	 */
	public function testGetFileContentAndSplitLinesToArrayReturnsCorrectArray(){
		$mockFileContent = "Template1\nTemplate2\nTemplate3";
		vfsStreamWrapper::getRoot()->getChild('typo3conf')->getChild('ext')->getChild($this->extensionKey)->getChild('Configuration')->getChild('TypoScriptInstaller')->getChild('Templates')->getChild('Sites')->getChild('RootPage')
        	->addChild(new vfsStreamFile('IncludeStatic.ts'));
       	vfsStreamWrapper::getRoot()->getChild('typo3conf')->getChild('ext')->getChild($this->extensionKey)->getChild('Configuration')->getChild('TypoScriptInstaller')->getChild('Templates')->getChild('Sites')->getChild('RootPage')->getChild('IncludeStatic.ts')->withContent($mockFileContent);
       	
        $expectedArray = explode("\n",$mockFileContent);
        	
        $returnArray = $this->fixture->getFileContentAndSplitLinesToArray(
	        vfsStream::url($this->rootDirectory . '/typo3conf/ext/' . $this->extensionKey . '/Configuration/TypoScriptInstaller/Templates/Sites/RootPage/IncludeStatic.ts')
        );

		$this->assertEquals(
			$expectedArray,
			$returnArray
		);        		
	}
		
}