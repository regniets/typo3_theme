<?php

namespace TechDivision\Typo3Theme\Domain\Repository;

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
class BackendUserRepository extends AbstractBaseRepository {


    /**
     * Get Users that match certain identifier
     * @param string $identifier
     *
     * @return QueryResult
     * @codeCoverageIgnore
     */
    public function findAllUsersWithMatchingIdentifier($identifier) {
    	$query = $this->createQuery();
        return $query->matching(
        	$query->equals('typoScriptMapping.identifier', strtolower($identifier))
        )->execute();
    }

}
?>