/**
 * Configures css_styled_content
 *
 * @author Stefan Regniet, TechDivision GmbH
 * @package Typo3Theme
 * @subpackage Resources\Private\TypoScript\Plugin
 */

lib.stdheader.3.headerClass >

tt_content{ 
	image.20.stdWrap.prefixComment >
	textpic.20.stdWrap.prefixComment >
}

lib.parseFunc_RTE {
	nonTypoTagStdWrap.encapsLines {
		addAttributes.P.class >
		remapTag.DIV >
		encapsTagList = p,pre,h1,h2,h3,h4,h5,h6,hr,dl,dt,dd
	}
	allowTags := addToList(tbody,thead)
	externalBlocks = article, aside, blockquote, div, dl, footer, header, nav, ol, section, table, ul,pre
	externalBlocks {
		table {
			HTMLtableCells.default.callRecursive = 0
			stdWrap.HTMLparser.removeTags = p
			stdWrap.HTMLparser.tags.table.fixAttrib.class.list >
			stdWrap.HTMLparser.tags.table.fixAttrib.class.default = table
			#stdWrap.HTMLparser.tags.table.fixAttrib.cellspacing.set = 0
			#stdWrap.HTMLparser.tags.table.fixAttrib.cellpadding.set = 0
			#stdWrap.HTMLparser.tags.table.fixAttrib.width.set = 100%
		}
		blockquote {
			callRecursive.tagStdWrap.HTMLparser.tags.blockquote.overrideAttribs >
			callRecursive.tagStdWrap.HTMLparser.tags.table.overrideAttribs = cellspacing="0"
		}
		div {
			stripNL = 1
			callRecursive = 1
		}
		dd {
			callRecursive = 0
			stdWrap.parseFunc = < lib.parseFunc
		}
		pre {
			stripNL = 1
		}
	}
}