<?phpif (!defined ('TYPO3_MODE')) 	die ('Access denied.');$TYPO3_CONF_VARS['GFX']['gdlib_2'] = '1';$TYPO3_CONF_VARS['GFX']['TTFdpi'] = '96';$TYPO3_CONF_VARS['GFX']['noIconProc'] = '0';$TYPO3_CONF_VARS['SYS']['forceReturnPath'] = '1';$TYPO3_CONF_VARS['SYS']['UTF8filesystem'] = '1';$TYPO3_CONF_VARS['SYS']['cookieSecure'] = '2';$TYPO3_CONF_VARS['SYS']['cookieHttpOnly'] = '1';$TYPO3_CONF_VARS['SYS']['enableDeprecationLog'] = '0';$TYPO3_CONF_VARS['BE']['forceCharset'] = 'utf-8';$TYPO3_CONF_VARS['BE']['fileCreateMask'] = '0664';$TYPO3_CONF_VARS['BE']['folderCreateMask'] = '0775';$TYPO3_CONF_VARS['BE']['loginSecurityLevel'] = 'rsa';$TYPO3_CONF_VARS['BE']['compressionLevel'] = '0';$TYPO3_CONF_VARS['BE']['maxFileSize'] = '20480';	$TYPO3_CONF_VARS['BE']['explicitADmode'] = 'explicitAllow';	$TYPO3_CONF_VARS['FE']['compressionLevel'] = '5';$TYPO3_CONF_VARS['FE']['loginSecurityLevel'] = 'rsa';$TYPO3_CONF_VARS['FE']['pageNotFound_handling'] = '404/';$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['tx_typo3theme_installtheme'] = array(    'extension'        => $_EXTKEY,    'title'            => 'Install and configure typo3_theme',    'description'      => 'Installs and configures typo3_theme, inserts template records etc.');/* * Configuration for realurl **/$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/realurl/class.tx_realurl_autoconfgen.php']['extensionConfiguration']['theme'] = 'EXT:typo3_theme/Configuration/Code/Realurl/General.php:tx_general_realurl->addGeneralConfig';$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['clearAllCache_additionalTables']['tx_realurl_urldecodecache'] = 'tx_realurl_urldecodecache';$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['clearAllCache_additionalTables']['tx_realurl_urlencodecache'] = 'tx_realurl_urlencodecache';#$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/realurl/class.tx_realurl_autoconfgen.php']['extensionConfiguration']['news'] = 'EXT:typo3_theme/Configuration/Code/Realurl/Plugin/News.php:tx_news_realurl->addNewsConfig';#$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/realurl/class.tx_realurl_autoconfgen.php']['extensionConfiguration']['cal'] = 'EXT:typo3_theme/Configuration/Code/Realurl/Plugin/Cal.php:tx_cal_realurl->addCalConfig';?>