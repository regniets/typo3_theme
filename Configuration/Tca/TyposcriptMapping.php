<?php
if (!defined ('TYPO3_MODE')) {
    die ('Access denied.');
}

$TCA['typoscript_mapping'] = array(
    'ctrl' => $TCA['typoscript_mapping']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'identifier',
    ),
    'types' => array(
        '1' => array('showitem' => 'identifier'),
    ),
    'palettes' => array(
        '1' => array('showitem' => ''),
    ),
    'columns' => array(
        'identifier' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:typo3_theme/Resources/Private/Language/locallang_db.xml:typoscript_mapping.identifier',
            'config' => array(
                'type' => 'input',
                'size' => 20,
                'eval' => 'trim,required,unique,lower'
            ),
        ),
    ),
);

?>