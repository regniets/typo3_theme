/**
 * Dynamic Base URL
 * Only from 4.7 on upwards
 *
 * @author Stefan Regniet, TechDivision GmbH
 * @package Typo3Theme
 * @subpackage Resources\Private\TypoScript
 */

config.baseURL >

page {
  #Bestehendes HEAD Tag ersetzen
  headTag = <meta name="author" content="">

  config.htmlTag_stdWrap {
    append = COA
    append {
      #Neues HEAD-Tag setzen
      10 = TEXT
      10.value = <head>


      #BaseURL je nach incoming URL setzen
      20 = TEXT
      20.data = getIndpEnv:HTTP_HOST
      20.wrap = <base href="http://|/" />
    }
  }
}

[globalString = IENV:TYPO3_SITE_URL=http://{$td.config.urls.local}/]
	page.config.htmlTag_stdWrap.append{
		20.data >
		20.value = {$td.config.urls.local}
	}
[global]