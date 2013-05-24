<?php

$GLOBALS['TCA']['tt_content']['columns']['image']['config']['max_size'] = 10*1024;

/*
 * Add Columns to table pages and pages_language_overlay
 *
 * titletag (SEO)
 * CSS-Attribute (for menus)
 * Date (for display)
 *
 */
$tempColumns = Array (
    "titletag" => Array (
        "exclude" => 1,
        "label" => "LLL:EXT:typo3_theme/Resources/Private/Language/locallang_db.xml:titletag.title",
        "config" => Array (
            "type" => "input",
            "size" => "50",
        )
    ),
	"cssattribute" => Array (		
		"exclude" => 1,		
		"label" => "LLL:EXT:typo3_theme/Resources/Private/Language/locallang_db.xml:cssattribute.title",		
		"config" => Array (
			"type" => "input",	
			"size" => "30",
		)
	),
	"datum" => Array (		
		"exclude" => 1,		
		"label" => "LLL:EXT:typo3_theme/Resources/Private/Language/locallang_db.xml:cssattribute.datum",		
		"config" => Array (
			"type" => "input",	
			"size" => "30",
			"eval" => "date",
		)
	),

);

t3lib_div::loadTCA("pages");
t3lib_extMgm::addTCAcolumns("pages",$tempColumns,1);
t3lib_extMgm::addToAllTCAtypes("pages","titletag, datum, cssattribute;;;;6-6-6",'','after:subtitle');

t3lib_div::loadTCA("pages_language_overlay");
t3lib_extMgm::addTCAcolumns("pages_language_overlay",$tempColumns,1);
t3lib_extMgm::addToAllTCAtypes("pages_language_overlay","titletag, datum, cssattribute;;;;6-6-6",'','after:subtitle');

$GLOBALS['TYPO3_CONF_VARS']['FE']['pageOverlayFields'] .= ',titletag, datum, cssattribute';



/*
 * Add Table typoscript_mapping
 * and relations to this table from be_users and be_groups
 *
 */
t3lib_extMgm::allowTableOnStandardPages('typoscript_mapping');
$TCA['typoscript_mapping'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:typo3_theme/Resources/Private/Language/locallang_db.xml:typoscript_mapping',
		'label' => 'identifier',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'rootLevel' => -1,
		'delete' => 'deleted',
		'enablecolumns' => array(
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/Tca/TyposcriptMapping.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Images/Icons/TyposcriptMapping.png'
	),
);


//Add Column for CSS Class
$tempColumns = Array (
	"typoscript_mapping" => Array (
		"exclude" => 1,
		"label" => "LLL:EXT:typo3_theme/Resources/Private/Language/locallang_db.xml:typoscript_mapping",
		"config" => Array (
			'type' => 'group',
			'internal_type' => 'db',
			'allowed' => 'typoscript_mapping',
			'foreign_table' => 'typoscript_mapping',
			'max_size' => '10000',
			'size' => 1,
			'autoSizeMax' => 1,
			'maxitems' => '1',
			'wizards' => array(
				'suggest' => array(
					'type' => 'suggest',
					'typoscript_mapping' => array(
						'maxItemsInResultList' => 5,
					),
				),
				'edit' => array(
					'type' => 'popup',
					'title' => 'Edit',
					'script' => 'wizard_edit.php',
					'icon' => 'edit2.gif',
					'popup_onlyOpenIfSelected' => 1,
					'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
				),
				'add' => Array(
					'type' => 'script',
					'title' => 'Create new',
					'icon' => 'add.gif',
					'params' => array(
						'table' => 'typoscript_mapping',
						'pid' => '###CURRENT_PID###',
						'setValue' => 'prepend'
					),
					'script' => 'wizard_add.php',
				),
			),
		)
	),
);

t3lib_div::loadTCA("be_users");
t3lib_extMgm::addTCAcolumns("be_users",$tempColumns,1);
t3lib_extMgm::addToAllTCAtypes("be_users","typoscript_mapping",'','after:password');

t3lib_div::loadTCA("be_groups");
t3lib_extMgm::addTCAcolumns("be_groups",$tempColumns,1);
t3lib_extMgm::addToAllTCAtypes("be_groups","typoscript_mapping",'','after:title');





/*
 * Add Configuration from extensionConfiguration
 * display imagewidth-selector instead of text field
 *
 */
$confArr = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['typo3_theme']);

if($confArr['imagewidthSelector']){
	$GLOBALS['TCA']['tt_content']['columns']['imagewidth']['config']['type'] = 'select';
	$GLOBALS['TCA']['tt_content']['columns']['imagewidth']['config']['max'] = 1;
	$GLOBALS['TCA']['tt_content']['columns']['imagewidth']['config']['size'] = 1;
	$values = explode(',',$confArr['imagewidthValues']);
	$insertTsConfig = '';
	foreach($values as $singleVal){
		$insertTsConfig .= '
				' .$singleVal . ' = ' . $singleVal . 'px
				';
	}
	t3lib_extMgm::addPageTSConfig('
					TCEFORM.tt_content.imagewidth.types = select
					TCEFORM.tt_content.imagewidth.addItems {
					    0 = -----------------
					    '.$insertTsConfig.'
					}
					'
	);
	t3lib_extMgm::addPageTSConfig('
					TCEFORM.pages.subtitle.label = Suchmaschinentitel
					TCEMAIN.table.tt_content {
					  disablePrependAtCopy = 1
					  disableHideAtCopy = 1
					}

					TCEMAIN.table.pages{
					  disablePrependAtCopy = 1
					  disableHideAtCopy = 1
					}

					TCEMAIN.table.tt_news{
					  disablePrependAtCopy = 1
					  disableHideAtCopy = 1
					}
					'
	);
	if(!$confArr['imageheightSelector']){
		t3lib_extMgm::addPageTSConfig('
					TCEFORM.tt_content.imageheight.disabled = 1
			');
	}
	else{
		$GLOBALS['TCA']['tt_content']['columns']['imageheight']['config']['type'] = 'select';
		$GLOBALS['TCA']['tt_content']['columns']['imageheight']['config']['max'] = 1;
		$GLOBALS['TCA']['tt_content']['columns']['imageheight']['config']['size'] = 1;
		$values = '';
		$values = explode(',',$confArr['imageheightValues']);
		$insertTsConfig = '';
		foreach($values as $singleVal){
			$insertTsConfig .= '
				' .$singleVal . ' = ' . $singleVal . 'px
				';
		}

		t3lib_extMgm::addPageTSConfig('
					TCEFORM.tt_content.imageheight.types = select
					TCEFORM.tt_content.imageheight.addItems {
					    0 = -----------------
					    '.$insertTsConfig.'
					}
					'
		);

	}


}



?>