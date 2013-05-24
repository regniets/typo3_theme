/**
 * Prepares FormHandler
 *
 * @author Stefan Regniet, TechDivision GmbH
 * @package Typo3Theme
 * @subpackage Resources\Private\TypoScript\Plugin
 */

plugin.Tx_Formhandler.settings.predef.default {

	# GENERAL CONFIGURATION
	name = Formular
	debug = 0
	addErrorAnchors = 1
	formValuesPrefix = formhandler
	templateFile = {$td.config.resourcesPath}/Private/Html/Plugin/TxFormhandler/ContactForm.html
	langFile.1 = {$td.config.resourcesPath}/Private/Language/Plugin/TxFormhandler.xml

	singleErrorTemplate {
		totalWrap =
		singleWrap =
	}
	
	errorListTemplate {
		totalWrap = <ul>|</ul>
		singleWrap = <li class="error">|</li>
	}
	
	initInterceptors {
		1 {
			  class = Tx_Formhandler_Interceptor_Filtreatment
		}
	}
	
	finishers {
		1.class = Tx_Formhandler_Finisher_Mail
		1.config {
			limitMailsToUser = 5
			admin {
				to_email = 
				to_name = 
				subject = 
				sender_email = email
				sender_name = lastname
				replyto_email = email
				#cc_email = A CC email will be sent to this address
				#cc_name =
				#bcc_email =
				#bcc_name =
			}
			user {
				to_email = email
				to_name = lastname
				subject = Ihre Kontaktanfrage
				sender_email = 
				sender_name = 
				replyto_email =
			}
		}
		2 {
			class = Tx_Formhandler_Finisher_Redirect
			config.redirectPage =  
		}
	}
	
	validators {
		1 {
			class = Tx_Formhandler_Validator_Default
			config {
				fieldConf {
					firstname {
						errorCheck.1 = required
					}
					lastname {
						errorCheck.1 = required
					}
					street {
						errorCheck.1 = required
					}
					nr {
						errorCheck.1 = required
					}
					zip {
						errorCheck.1 = required
						errorCheck.2 = integer
					}
					town {
						errorCheck.1 = required
					}
					country {
						errorCheck.1 = required
					}
					email {
						errorCheck.1 = required
						errorCheck.2 = email
					}
					telephone {
						errorCheck.1 = required
					}
					message {
						errorCheck.1 = required
					}
					url {
						errorCheck.1 = maxLength
						errorCheck.1.value = 1
					}
				}
			}
		}
	}
}