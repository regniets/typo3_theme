/**
 * Config for RTE in TYPO3 <= 4.5
 * From sk-typo3.de 
 *
 * @author Stefan Regniet, TechDivision GmbH
 * @package Typo3Theme
 * @subpackage Resources\Private\TypoScript\TsConfig
 */
 
//RTE Classe des Interface (Ausrichtung)
RTE.classes {
	align-left {
		name = LLL:EXT:rtehtmlarea/htmlarea/locallang_tooltips.xml:justifyleft
		value = text-align: left;
	}
	align-center {
		name = LLL:EXT:rtehtmlarea/htmlarea/locallang_tooltips.xml:justifycenter
		value = text-align: center;
	}
	align-right {
		name = LLL:EXT:rtehtmlarea/htmlarea/locallang_tooltips.xml:justifyright
		value = text-align: right;
	}
}
 
//Entfernt das Bild vor den Links
RTE.classesAnchor {
	internalLink {
		class = internal-link
		type = page
		image >
	}
	externalLink {
		class = external-link
		type = url
		image >
	}
	externalLinkInNewWindow {
		class = external-link-new-window
		type = url
		image >
	}
	internalLinkInNewWindow {
		class = internal-link-new-window
		type = page
		image >
	}
	download {
		class = download
		type = file
		image >
	}
	mail {
		class = mail
		type = mail
		image >
	}
}
 
 
RTE.default {
 
		//Zuweisung der CSS-Datei
		contentCSS = typo3conf/ext/typo3_theme/Resources/Public/Css/Rte.css
		
		//Markup options
		enableWordClean = 1
		removeTrailingBR = 1
		removeComments = 1
		removeTags = center, sdfield
		removeTagsAndContents = style,script
 
		//Buttons die gezeigt/versteckt werden
		showButtons = textstyle, textstylelabel, blockstyle, blockstylelabel, bold, italic, underline, left, center, right, orderedlist, unorderedlist, insertcharacter, line, link, image, removeformat, table, toggleborders, tableproperties, rowproperties, rowinsertabove, rowinsertunder, rowdelete, rowsplit, columninsertbefore, columninsertafter, columndelete, columnsplit, cellproperties, cellinsertbefore, cellinsertafter, celldelete, cellsplit, cellmerge, findreplace, insertcharacter, undo, redo, showhelp, about
		hideButtons = fontstyle, formatblock, fontsize, strikethrough,lefttoright, righttoleft, textcolor, bgcolor, textindicator, emoticon, user, spellcheck, chMode, inserttag, outdent, indent, justifyfull, subscript, superscript, acronym, copy, cut, paste
 
		//Hält die RTE Icons gegroupt zusammen
		keepButtonGroupTogether = 1
 
		//blendet Statusbar in htmlarea aus
		showStatusBar =  0
 
		//Add styles Left, center and right alignment of text in paragraphs and cells.
		inlineStyle.text-alignment (
				p.align-left, h1.align-left, h2.align-left, h3.align-left, h4.align-left, h5.align-left, h6.align-left, td.align-left { text-align: left; }
				p.align-center, h1.align-center, h2.align-center, h3.align-center, h4.align-center, h5.align-center, h6.align-center, td.align-center { text-align: center; }
				p.align-right, h1.align-right, h2.align-right, h3.align-right, h4.align-right, h5.align-right, h6.align-right, td.align-right { text-align: right; }
		)
 
		//Use stylesheet file rather than the above mainStyleOverride and inlineStyle properties to style the contents (htmlArea RTE only)
		ignoreMainStyleOverride = 1
		
		proc {
				//tags die erlaubt / verboten sind
				allowTags = table, tbody, tr, th, td, h1, h2, h3, h4, h5, h6, div, p, br, span, ul, ol, li, re, blockquote, strong, em, b, i, u, sub, sup, strike, a, img, nobr, hr, tt, q, cite, abbr, acronym, center
				denyTags = font
 
				//br wird nicht zu p konvertiert
				dontConvBRtoParagraph = 1
 
				//tags sind erlaubt au�erhalt von p, div
				allowTagsOutside = img,hr
 
				//erlaubte attribute in p, div tags
				keepPDIVattribs = align,class,style,id 
 
				//List all class selectors that are allowed on the way to the database
				allowedClasses (
						external-link, external-link-new-window, internal-link, internal-link-new-window, download, mail,
						align-left, align-center, align-right, author
				)	   
 
				//html parser einstellungen
				HTMLparser_rte {
 
						//tags die erlaubt/verboten sind
						allowTags < RTE.default.proc.allowTags
						denyTags < RTE.default.proc.denyTags
 
						//tags die untersagt sind
						removeTags = font
 
						//entfernt html-kommentare
						removeComments = 1
 
						//tags die nicht �bereinstimmen werden nicht entfernt (protect / 1 / 0)
						keepNonMatchedTags = 0
				}
 
 
				//Content to database
				entryHTMLparser_db = 1
				entryHTMLparser_db {
 
						//tags die erlaubt/verboten sind
						allowTags < RTE.default.proc.allowTags
						denyTags < RTE.default.proc.denyTags
 
						//CLEAN TAGS
						noAttrib = b, i, u, strike, sub, sup, strong, em, quote, blockquote, cite, tt, br, center
 
						rmTagIfNoAttrib = span,div,font
 
						//htmlSpecialChars = 1
		
						#//align attribute werden erlaubt
						tags {
								p.fixAttrib.align.unset >
								p.allowedAttribs = class,style,align
 
								div.fixAttrib.align.unset >
 
								hr.allowedAttribs = class
 
								//b und i tags werden ersetzt (em / strong)
								b.remap = strong
								i.remap = em
 
								#//img tags werden erlaubt
								img >
						}
				}
 
		}
 
		//Classes: Ausrichtung
		classesParagraph (
				align-left, align-center, align-right
		)
 
		//Classes: Eigene Stile
		classesCharacter = author
		classesImage= rte_image
 
 
		//Classes für Links (These classes should also be in the list of allowedClasses)
		classesAnchor = external-link, external-link-new-window, internal-link, internal-link-new-window, download, mail
		classesAnchor.default {
				page = internal-link
				url = external-link-new-window
				file = download
				mail = mail
		}
 
		//zeigt alle CSS-Klassen die in formate.css vorhanden sind
		showTagFreeClasses = 1
 
		//Do not allow insertion of the following tags
		hideTags = font
 
		//Tabellen Optionen in der RTE Toolbar
		hideTableOperationsInToolbar = 0
		keepToggleBordersInToolbar = 1
 
		//Tabellen Editierungs-Optionen (cellspacing/ cellpadding / border)
		disableSpacingFieldsetInTableOperations = 1
		disableAlignmentFieldsetInTableOperations=1
		disableColorFieldsetInTableOperations=1
		disableLayoutFieldsetInTableOperations=1
		disableBordersFieldsetInTableOperations=0
}
 
//Use same processing as on entry to database to clean content pasted into the editor
RTE.default.enableWordClean.HTMLparser < RTE.default.proc.entryHTMLparser_db
 
//FE RTE configuration (htmlArea RTE only)
RTE.default.FE < RTE.default
RTE.default.FE.userElements >
RTE.default.FE.userLinks >
 
//Breite des RTE in Fullscreen-Ansicht
TCEFORM.tt_content.bodytext.RTEfullScreenWidth= 80% 