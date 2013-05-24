/**
 * Renders a timestamp as Graphical Date
 *
 * @author Stefan Regniet, TechDivision GmbH
 * @package Typo3Theme
 * @subpackage Resources\Private\TypoScript\Lib\Utility
 * @usage <f:cObject typoscriptObjectPath="lib.utility.graphicalDate" data="{timestamp}"/>
 */

lib.utility.graphicalDate.month = CASE
lib.utility.graphicalDate.month {
  key.current = 1
  key.strftime = %m
  01 = TEXT
  01.data = JAN
  02 < .01
  02.data = FEB
  03 < .01
  03.data = MAR
  04 < .01
  04.data = APR
  05 < .01
  05.data = MAI
  06 < .01
  06.data = JUN
  07 < .01
  07.data = JUL
  08 < .01
  08.data = AUG
  09 < .01
  09.data = SEP
  10 < .01
  10.data = OKT
  11 < .01
  11.data = NOV
  12 < .01
  12.data = DEC

}


lib.utility.graphicalDate = IMAGE
lib.utility.graphicalDate.file = GIFBUILDER
lib.utility.graphicalDate.file {
  reduceColors = 8
  XY = 55, 22
  transparentBackground = 1
  10 = TEXT
  10 {
    text.strftime = %d
    fontSize = 32
    fontColor = #5795ce
    align = left
    offset = 0,22
    niceText = 0
  }
  
  20 = TEXT
  20 {
    text.append < lib.utility.graphicalDate.month
    fontSize = 15
    align = left
    fontColor = #000000
    offset = 30, 11
    niceText = 0
  } 
  30 < .10
  30 {
    text.strftime = %Y
    fontSize = 14
    fontColor = #000000
    align = left
    offset = 30, 22
  }
}

