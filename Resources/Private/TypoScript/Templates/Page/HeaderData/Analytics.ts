/**
 * Includes Google Analytics at the very bottom of the Head Section
 *
 * @author Stefan Regniet, TechDivision GmbH
 * @package Typo3Theme
 * @subpackage Resources\Private\TypoScript
 */

page.headerData.99999 = TEXT
page.headerData.99999 {
	value (
		<script type="text/javascript">
  			var _gaq = _gaq || [];
			_gaq.push(['_setAccount','{$td.config.headerData.googleAnalyticsId}']);
			_gaq.push(['_gat._anonymizeIp']);
			_gaq.push(['_trackPageview']);
			(function() {
				var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
		</script>
	)
}