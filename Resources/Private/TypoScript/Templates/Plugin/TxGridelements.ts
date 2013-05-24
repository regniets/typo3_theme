/**
 * Configures GridElements
 * Change IDs accordingly, Use gridelements from ext_tables+static
 *
 * @author Stefan Regniet, TechDivision GmbH
 * @package Typo3Theme
 * @subpackage Resources\Private\TypoScript\Plugin
 */

tt_content.gridelements_pi1.20.10.setup {
	//2 Col Grid
	1 < lib.gridelements.defaultGridSetup
	1 {
		columns {
			5 < .default
			5.wrap = <div class="span6 equalHeight2Col">|</div>
			6 < .default
			6.wrap = <div class="span6 equalHeight2Col">|</div>
		}
		wrap = <div class="row-fluid">|</div>
	}
	
	//3 Col Grid
	2 < lib.gridelements.defaultGridSetup
	2 {
		columns {
			5 < .default
			5.wrap = <div class="span4 equalHeight3Col">|</div>
			6 < .default
			6.wrap = <div class="span4 equalHeight3Col">|</div>
			7 < .default
			7.wrap = <div class="span4 equalHeight3Col">|</div>
		}
		wrap = <div class="row-fluid">|</div>
	}
	
	// 4 Col
	3 < lib.gridelements.defaultGridSetup
	3 {
		columns {
			5 < .default
			5.wrap = <div class="span3 equalHeight4Col">|</div>
			6 < .default
			6.wrap = <div class="span3 equalHeight4Col">|</div>
			7 < .default
			7.wrap = <div class="span3 equalHeight4Col">|</div>
			8 < .default
			8.wrap = <div class="span3 equalHeight4Col">|</div>
		}
		wrap = <div class="row-fluid">|</div>
	}

	//Accordion Element
	3 >
	3 < lib.gridelements.defaultGridSetup
	3 {
		columns {
			5 = CONTENT
			5 {
					table = tt_content
					select {
						selectFields = header, uid
						where = (CType ="text" OR CType = "textpic" OR CType = "header" OR CType = "image" OR CType = "multimedia" OR CType = "qtobject" OR CType = "media" OR CType ="list")
						andWhere = tx_gridelements_columns = 14
						}
					 renderObj = COA
					 renderObj.wrap = <div class="accordion-group">|</div>
					 renderObj {
						10 = TEXT
						10 {
							field = header
							required = 1
							insertData = 1
							dataWrap = <div class="accordion-heading"><a class="accordion-toggle" data-parent="#accordion{field:tx_gridelements_columns}" href="#collapse-{field:uid}" data-toggle="collapse">|</a></div>
						}

						20 = CASE
						20.key.field = CType
						20.stdWrap {
								required = 1
								dataWrap =<div id="collapse-{field:uid}" class="accordion-body collapse"><div class="accordion-inner">|</div></div>
								dataWrap.override = TEXT
								dataWrap.override {
									value = <div id="collapse-{field:uid}" class="accordion-body collapse in"><div class="accordion-inner">|</div></div>
									if.isTrue.listNum = 0
									if.isTrue.listNum.splitChar = 32
							}
						}
						20 {
							textpic < tt_content.textpic.20
							text < tt_content.text.20
							image < tt_content.image.20
							multimedia < tt_content.multimedia.20
							qtobject < tt_content.qtobject.20
							media < tt_content.media.20
							list < tt_content.list.20
						}
				}
			}
		}
		wrap = <div class="accordion" id="accordion14">|</div>
	}

	//Tabs Element
	4 < lib.gridelements.defaultGridSetup
	4 {
		prepend = COA
		prepend {
			10 = CONTENT
			10 {
				wrap = <ul class="nav nav-tabs">|</ul>
				table = tt_content
				select {
					selectFields = header, uid
					where = (CType ="text" OR CType = "textpic" OR CType = "header" OR CType = "image" OR CType = "multimedia" OR CType = "qtobject" OR CType = "media" OR CType ="list")
					andWhere = tx_gridelements_columns = 15
				}
				renderObj = COA
				renderObj {

					10 = CASE
					10.key.data = RecordNumber
					10.default = renderObj

					10 = TEXT
					10 {
						field = header
						required = 1
						insertData = 1
						dataWrap = <li><a data-toggle="tab" href="#c{field:uid}">|</a></li>
						dataWrap.override = TEXT
						dataWrap.override {
							value = <li class="active"><a data-toggle="tab" href="#c{field:uid}">|</a></li>
							if.isTrue.listNum = 0
							if.isTrue.listNum.splitChar = 32
						}
					}
				}
			}
		}
		columns {
			5 = CONTENT
			5 {
				wrap = <div class="tab-content">|</div>
				table = tt_content
				select {
					selectFields = header, uid
					where = (CType ="text" OR CType = "textpic" OR CType = "header" OR CType = "image" OR CType = "multimedia" OR CType = "qtobject" OR CType = "media" OR CType ="list")
					andWhere = tx_gridelements_columns = 15
				}
				renderObj = COA
				renderObj {

					10 = CASE
					10.key.field = CType
					10.stdWrap {
						required = 1
						dataWrap = <div id="c{field:uid}" class="tab-pane fade">|</div>
					}

					10 {
						textpic < tt_content.textpic.20
						text < tt_content.text.20
						image < tt_content.image.20
						multimedia < tt_content.multimedia.20
						qtobject < tt_content.qtobject.20
						media < tt_content.media.20
						list < tt_content.list.20
					}
			 	}
			}
		}
	}

	//Pills Element
	5 < lib.gridelements.defaultGridSetup
	5.wrap = |</div>
	5 {
		prepend = COA
		prepend {
			10 = CONTENT
			10 {
				wrap = <div class="tabbable"><ul class="nav nav-pills">|</ul>
				table = tt_content
				select {
					selectFields = header, uid
					where = (CType ="text" OR CType = "textpic" OR CType = "header" OR CType = "image" OR CType = "multimedia" OR CType = "qtobject" OR CType = "media" OR CType ="list")
					andWhere = tx_gridelements_columns = 16
				}
				renderObj = COA
				renderObj {
					10 = TEXT
					10 {
						field = header
						required = 1
						#insertData = 1
						dataWrap = <li><a data-toggle="tab" href="#c{field:uid}">|</a></li>
						dataWrap.override = TEXT
						dataWrap.override {
							value = <li class="active"><a data-toggle="tab" href="#c{field:uid}">|</a></li>
							if.isTrue.listNum = 0
							if.isTrue.listNum.splitChar = 32
						}
					}
				}
			}
		}
		columns {
			5 = CONTENT
			5 {
				wrap = <div class="tab-content">|</div>
				table = tt_content
				select {
					selectFields = header, uid
					where = (CType ="text" OR CType = "textpic" OR CType = "header" OR CType = "image" OR CType = "multimedia" OR CType = "qtobject" OR CType = "media" OR CType ="list")
					andWhere = tx_gridelements_columns = 16
				}
				renderObj = COA
				renderObj {

					10 = CASE
					10.key.field = CType
					10.stdWrap {
						required = 1
						dataWrap = <div id="c{field:uid}" class="tab-pane fade">|</div>
					}

					10 {
						textpic < tt_content.textpic.20
						text < tt_content.text.20
						image < tt_content.image.20
						multimedia < tt_content.multimedia.20
						qtobject < tt_content.qtobject.20
						media < tt_content.media.20
						list < tt_content.list.20
					}
			 	}
			}
		}
	}

	//Tabs on Left
	6 < lib.gridelements.defaultGridSetup
	6.wrap = |</div>
	6 {
		prepend = COA
		prepend {
			10 = CONTENT
			10 {
				wrap = <div class="tabbable tabs-left"><ul class="nav nav-tabs">|</ul>
				table = tt_content
				select {
					selectFields = header, uid
					where = (CType ="text" OR CType = "textpic" OR CType = "header" OR CType = "image" OR CType = "multimedia" OR CType = "qtobject" OR CType = "media" OR CType ="list")
					andWhere = tx_gridelements_columns = 17
				}
				renderObj = COA
				renderObj {
					10 = TEXT
					10 {
						field = header
						required = 1
						insertData = 1
						dataWrap = <li><a data-toggle="tab" href="#c{field:uid}">|</a></li>
						dataWrap.override = TEXT
						dataWrap.override {
							value = <li class="active"><a data-toggle="tab" href="#c{field:uid}">|</a></li>
							if.isTrue.listNum = 0
							if.isTrue.listNum.splitChar = 32
						}
					}
				}
			}
		}
		columns {
			5 = CONTENT
			5 {
				wrap = <div class="tab-content">|</div>
				table = tt_content
				select {
					selectFields = header, uid
					where = (CType ="text" OR CType = "textpic" OR CType = "header" OR CType = "image" OR CType = "multimedia" OR CType = "qtobject" OR CType = "media" OR CType ="list")
					andWhere = tx_gridelements_columns = 16
				}
				renderObj = COA
				renderObj {
					10 = CASE
					10.key.field = CType
					10.stdWrap {
						required = 1
						dataWrap = <div id="c{field:uid}" class="tab-pane fade">|</div>
					}
					10 {
						textpic < tt_content.textpic.20
						text < tt_content.text.20
						image < tt_content.image.20
						multimedia < tt_content.multimedia.20
						qtobject < tt_content.qtobject.20
						media < tt_content.media.20
						list < tt_content.list.20
					}
			 	}
			}
		}
	}
}
