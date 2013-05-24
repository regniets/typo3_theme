<?php

/***************************************************************
*  Copyright notice
*
*  (c) 2012 Stefan Regniet, s.regniet@techdivision.com 
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
 * Realurl-Automatische Konfiguration
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class tx_news_realurl {

		/**
		 * Generates additional RealURL configuration and merges it with provided configuration
		 *
		 * @param array $params Default configuration
		 * @param tx_realurl_autoconfgen $pObjParent object
		 * @return array Updated configuration
		 */
		function addNewsConfig($params, &$pObj) {
			return array_merge_recursive($params['config'], array(
		        'fileName' => array (
		            'index' => array (
		                'rss.xml' => array (
		                    'keyValues' => array (
		                        'type' => '100'
		                    ),
		                ),
		                'rss091.xml' => array (
		                    'keyValues' => array (
		                        'type' => '101'
		                    ),
		                ),
		                'rdf.xml' => array (
		                    'keyValues' => array (
		                        'type' => '102'
		                    ),
		                ),
		                'atom.xml' => array (
		                    'keyValues' => array (
		                        'type' => '103'
		                    ),
		                ),
		            ),
		        ),
				'postVarSets' => array (
		            '_DEFAULT' => array (
		                'archive' => array (
		                    '0' => array (
		                        'GETvar' => 'tx_ttnews[year]'
		                    ),
		                    '1' => array (
		                        'GETvar' => 'tx_ttnews[month]',
		                        'valueMap' => array (
		                            'jan' => '01',
		                            'feb' => '02',
		                            'mar' => '03',
		                            'apr' => '04',
		                            'may' => '05',
		                            'jun' => '06',
		                            'jul' => '07',
		                            'aug' => '08',
		                            'sep' => '09',
		                            'oct' => '10',
		                            'nov' => '11',
		                            'dec' => '12'
		                        ),
		                    ),
		                ),
		                'browse' => array (
		                    '0' => array (
		                        'GETvar' => 'tx_ttnews[pointer]',
		                    ),
		                ),
		                'select_category' => array (
		                    '0' => array (
		                        'GETvar' => 'tx_ttnews[cat]',
		                    ),
		                ),
		                'article' => array (
		                    '0' => array (
		                        'GETvar' => 'tx_ttnews[tt_news]',
		                        'lookUpTable' => array (
		                            'table' => 'tt_news',
		                            'id_field' => 'uid',
		                            'alias_field' => 'title',
		                            'addWhereClause' => ' AND NOT deleted',
		                            'useUniqueCache' => '1',
		                            'useUniqueCache_conf' => array (
		                                'strtolower' => '1',
		                                'spaceCharacter' => '-'
		                            ),
		                        ),
		                    ),
		                    '1' => array (
		                        'GETvar' => 'tx_ttnews[swords]'
		                    ),
		                ),
		            ),
		        )
			));
		
		}
	
}
?>