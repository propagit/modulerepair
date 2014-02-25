/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	//config.language = 'fr';
	config.forcePasteAsPlainText = false;
	config.removeFormatTags = 'html,body';
	config.uiColor = '#CCCCCC';
	config.fullPage=false;
	
	config.skin = 'kama';
	config.extraPlugins = 'youtube';
	config.height = '800px';
	
		//
		
	config.font_names =
    'Arial/Arial, Helvetica, sans-serif;' +
    'Times New Roman/Times New Roman, Times, serif;' +
    'Verdana;'+
    'Buenard;'+
    'Open Sans;'+
    'Parisienne;'+
    'Lato';

};


