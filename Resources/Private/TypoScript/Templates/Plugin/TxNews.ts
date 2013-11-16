/**
 * Configures tx_news
 *
 * @author Stefan Regniet, TechDivision GmbH
 * @package Typo3Theme
 * @subpackage Resources\Private\TypoScript\Plugin
 */

plugin.tx_news {
	persistence {
		classes {
			Tx_News_Domain_Model_News {
				subclasses {
					0 = Tx_News_Domain_Model_NewsDefault
					1 = Tx_News_Domain_Model_NewsExternal
					2 = Tx_News_Domain_Model_NewsInternal
				}
			}
			Tx_News_Domain_Model_NewsDefault {
				mapping {
					recordType = 0
					tableName = tx_news_domain_model_news
				}
			}
			Tx_News_Domain_Model_NewsExternal {
				mapping {
					recordType = 1
					tableName = tx_news_domain_model_news
				}
			}

			Tx_News_Domain_Model_NewsInternal {
				mapping {
					recordType = 2
					tableName = tx_news_domain_model_news
				}
			}
		}
	}
	view {
		templateRootPath = {$td.config.resourcesPath}/Private/Html/Plugin/TxNews/Templates/
		partialRootPath = {$td.config.resourcesPath}/Private/Html/Plugin/TxNews/Partials/
		layoutRootPath = {$td.config.resourcesPath}/Private/Html/Plugin/TxNews/Layouts/
		widget.Tx_News_ViewHelpers_Widget_PaginateViewHelper.templateRootPath = {$td.config.resourcesPath}/Private/Html/Plugin/TxNews/Templates/
	}
	# Modify the translation
	_LOCAL_LANG {
		default {
			 read_more = weiterlesen
		}
	}

	settings {
		//Displays a dummy image if the news have no media items
		displayDummyIfNoMedia = 0

		# Output format
		format = html

		# general settings
		overrideFlexformSettingsIfEmpty = cropMaxCharacters,dateField,timeRestriction

		pidBackAdditionalParams {

		}
		includeSubCategories = 0

		analytics {
			social {
				facebookLike = 0
				facebookShare = 1
				twitter = 1
			}
		}
		detailPidDetermination = flexform, categories, default
		defaultDetailPid = 22
		dateField = datetime
		
		link {
			hrDate = 0
			hrDate {
				day = j
				month = F
				year = Y
			}
		}
		cropMaxCharacters = 350
		orderBy = datetime
		orderDirection = desc
		orderByRespectTopNews = 0
		
		facebookLocale = de_DE
        googlePlusLocale = de
		
		# Interface implemenations
		interfaces {
			media {
				video = Tx_News_Interfaces_Audio_Mp3,Tx_News_Interfaces_Video_Quicktime,Tx_News_Interfaces_Video_Flv,Tx_News_Interfaces_Video_Videosites
			}
		}

		detail {
			# media configuration
			media {
				image {
						# choose the rel tag like gallery[fo]
					lightbox = lightbox[fo]
					maxWidth = 200
				}
				video {
					width = 250
					height = 
				}
			}
		}

		list {
			# media configuration
			media {
				image {
					maxWidth = 150
					maxHeight = 
				}
			}
			# Paginate configuration.
			paginate {
				itemsPerPage = 10
				insertAbove = FALSE
				insertBelow = TRUE
				lessPages = TRUE
				forcedNumberOfLinks = 10
				pagesBefore = 3
				pagesAfter = 3
			}

			rss {
				channel {
					title = eStrategy RSS Feed
					description = Im eStrategy-Magazin lesen Sie hochwertige Fachartikel zu den Themen eCommerce, Online-Marketing und Webentwicklung.
					language = de_DE
					copyright = TechDivision GmbH
					generator = {$plugin.tx_news.rss.channel.generator}
					link = http://www.estrategy-magazin.de
				}
			}
	
		}

		relatedFiles {
			download {
				labelStdWrap {
					cObject = TEXT
				}
			}
		}

		opengraph >
	}
}

# Rendering of content elements in detail view
lib.tx_news.contentElementRendering = RECORDS
lib.tx_news.contentElementRendering {
	tables = tt_content
	source.current = 1
	dontCheckPid = 1
}
