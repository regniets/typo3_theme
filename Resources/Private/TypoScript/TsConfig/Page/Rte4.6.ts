/**
 * Config for RTE in TYPO3 <= 4.6
 *
 * @author Stefan Regniet, TechDivision GmbH
 * @package Typo3Theme
 * @subpackage Resources\Private\TypoScript\TsConfig
 */
 
RTE.default {
	contentCSS = typo3conf/ext/typo3_theme/Resources/Public/Css/Rte.css
	enableWordClean = 1
	removeTrailingBR = 1
	removeComments = 1
	removeTags = center, font, o:p, sdfield,u
	removeTagsAndContents = script,title,meta
 	disableObjectResizing = 1
 	schema.sources.schemaOrg = EXT:rtehtmlarea/extensions/MicrodataSchema/res/schemaOrgAll.rdf
	keepButtonGroupTogether = 1
	showStatusBar =  1
	hideTableOperationsInToolbar = 1
	buttons.toggleborders.keepInToolbar = 1

	showButtons = *
	hideButtons >
	toolbarOrder (
		copy,cut,paste,undo,redo,,removeformat,chMode,link,table,toggleborders,insertcharacter,editelement,showmicrodata,
		linebreak,formatblock,textstyle,linebreak,abbr,
		linebreak,strong,small,emphasis,subscript,superscript,strikethrough,orderedlist,unorderedlist,
		tableproperties,
		bar,rowproperties,rowinsertabove,rowinsertunder,rowdelete,rowsplit,
		bar,columnproperties,columninsertbefore,columninsertafter,columndelete,columnsplit,
		bar,cellproperties, cellinsertbefore, cellinsertafter, celldelete, cellsplit, cellmerge
 	)
	contextMenu.hideButtons (
		copy,cut,paste,undo,redo,editelement,insertparagraphbefore,code,quotation,citation,insertparagraphafter,editelement,removeformat,chMode,,user
		formatblock,textstyle,class,
		strong,small,emphasis,subscript,superscript,strikethrough,code,quotation,citation,orderedlist,unorderedlist,indent,outdent,left,center,right,justifyfull,link,table,toggleborders,insertcharacter,user
 	)
}

RTE.classesAnchor >
RTE.classes >

RTE.classes {
	#table-condensed.name = Weniger Abstände
	table.name = Standard
	table-hover.name = Mouse-Over Effekt
	table-bordered.name = Mit Rändern
	table-striped.name = Gestreift

	#Textstyle Labels
	#label-default.name = Label: Default
	#label-success.name = Label: Success
	#label-warning.name = Label: Warning
	#label-important.name = Label: Important
	#label-info.name = Label: Info
	#label-inverse.name = Label: Inverse

	#Owen Textstyle Labels
	fontColorBlue.name = Textfarbe blau
	microdata.name = Textblock für Microdata

	#Link Labels
	external-link.name = Standard Link
	external-link-new-window.name = Standard Link Externe Domain
	download.name = Download Link
	mail.name = Mail Link
	btn btn-mini.name = Kleiner Button
	btn btn-small.name = Mitterer Button
	btn btn-large.name = Großer Button

	own.name = Eigener Linkstyle (Orange, Underline)
}


//Format the Formatblock (Label, Class, Tag)
RTE.default.buttons {
	formatblock {
		removeItems = div,h3,h4,h5,h6,lead,blockquote,pre,lead,alert-warning,alert-error,alert-info,alert-success
		addItems =
		orderItems = h1,h2

		items.lead.label = Lead
		items.lead.tagName = p
		items.lead.addClass = lead

		items.alert-warning.label = Alert: Warning
		items.alert-warning.tagName = p
		items.alert-warning.addClass = alert alert-warning

		items.alert-error.label = Alert: Error
		items.alert-error.tagName = p
		items.alert-error.addClass = alert alert-error

		items.alert-info.label = Alert: Info
		items.alert-info.tagName = p
		items.alert-info.addClass = alert alert-info

		items.alert-success.label = Alert: Success
		items.alert-success.tagName = p
		items.alert-success.addClass = alert alert-success
	}


	# Allowed Classes for Links
	link {
		properties.class.allowedClasses (
			external-link, external-link-new-window,  download,  mail, btn,btn btn-mini,btn btn-small,btn btn-large,owen
		)

	}

	allowedClasses = own, table,table-condensed,table-bordered,table-striped,table-hover,btn,btn-mini,btn-small,btn-large,fontColorBlue,microdata

	table {
		removeFieldsets = spacing,alignment,borders,color,layout
		properties.numberOfRows.defaultValue = 4
		properties.numberOfColumns.defaultValue = 4
		properties.width.defaultValue = 100
		properties.widthUnit.removeItems = px,em
		properties.widthUnit.defaultValue = %
		properties.removed = height
	}

 	tableproperties {
		removeFieldsets = spacing,alignment, borders, color,layout
		properties.widthUnit.removeItems = px,em
	}

	rowproperties {
		removeFieldsets = layout,borders,color
	}
	columnproperties {
		removeFieldsets = layout,borders,color
	}
	cellproperties {
		removeFieldsets = layout,borders,color
	}
	editelement {
		removeFieldsets = events,language
	}

	blockstyle.tags.table.allowedClasses = table,table-bordered,table-striped,table-hover

	textstyle.tags.span.allowedClasses = fontColorBlue,microdata
}
