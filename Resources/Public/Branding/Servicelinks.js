/***************************************************************
*  Copyright notice
*
*  <>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*  A copy is found in the textfile GPL.txt and important notices to the license
*  from the author is found in LICENSE.txt distributed with these scripts.
*
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * class to handle the service links menu
 *
 * $Id$
 */


var ServiceLinks = Class.create({
	ajaxScript: 'ajax.php',
	menu: null,
	toolbarItemIcon: null,

	/**
	 * registers for resize event listener and executes on DOM ready
	 */
	initialize: function() {
		Event.observe(window, 'resize', this.positionMenu);

		Event.observe(window, 'load', function(){
			this.positionMenu();
			this.toolbarItemIcon = $$('#service-links-actions-menu .toolbar-item img')[0].src;

			Event.observe($$('#service-links-actions-menu')[0], 'click', this.toggleMenu);
			this.menu = $$('#service-links-actions-menu .toolbar-item-menu')[0];
		}.bindAsEventListener(this));
	},

	/**
	 * positions the menu below the toolbar icon, let's do some math!
	 */
	positionMenu: function() {
		var calculatedOffset = 0;
		var parentWidth      = $('service-links-actions-menu').getWidth();
		var ownWidth         = $$('#service-links-actions-menu .toolbar-item-menu')[0].getWidth();
		var parentSiblings   = $('service-links-actions-menu').previousSiblings();

		parentSiblings.each(function(toolbarItem) {
			calculatedOffset += toolbarItem.getWidth() - 1;
			// -1 to compensate for the margin-right -1px of the list items,
			// which itself is necessary for overlaying the separator with the active state background

			if(toolbarItem.down().hasClassName('no-separator')) {
				calculatedOffset -= 1;
			}
		});
		calculatedOffset = calculatedOffset - ownWidth + parentWidth;


		$$('#service-links-actions-menu .toolbar-item-menu')[0].setStyle({
			left: calculatedOffset + 'px'
		});
	},

	/**
	 * toggles the visibility of the menu and places it under the toolbar icon
	 */
	toggleMenu: function(event) {
		var toolbarItem = $$('#service-links-actions-menu > a')[0];
		var menu        = $$('#service-links-actions-menu .toolbar-item-menu')[0];
		toolbarItem.blur();

		if(!toolbarItem.hasClassName('toolbar-item-active')) {
			$$('#service-links-actions-menu .toolbar-item img')[0].src = '../typo3conf/ext/typo3_theme/Resources/Public/Branding/ServicelinksTechDivisionLogo.png';
			toolbarItem.addClassName('toolbar-item-active');
			Effect.Appear(menu, {duration: 0.2});
			TYPO3BackendToolbarManager.hideOthers(toolbarItem);
		} else {
			$$('#service-links-actions-menu .toolbar-item-active img')[0].src = '../typo3conf/ext/typo3_theme/Resources/Public/Branding/ServicelinksTechDivisionLogoDark.png';
			toolbarItem.removeClassName('toolbar-item-active');
			Effect.Fade(menu, {duration: 0.1});
		}

		if(event) {
			Event.stop(event);
		}
	}



});

var TYPO3BackendServiceLinks = new ServiceLinks();