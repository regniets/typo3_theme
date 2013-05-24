/**
 * Adds global TCEMAIN Config - configure permissions and others here
 *
 * @author Stefan Regniet, TechDivision GmbH
 * @package Typo3Theme
 * @subpackage Resources\Private\TypoScript\TsConfig
 */

TCEMAIN {
	default {
		history.maxAgeDays = 3650
		history.keepEntries = 10000
	}

	permissions {
		groupid = 1
		user = show,edit,delete,new,editcontent
		group = show,edit,delete,new,editcontent
		everybody = show
	}
}

