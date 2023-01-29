/**
 * @license Copyright (c) 2003-2020, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.toolbar =
[
    /*[ 'Bold','Italic','Underline', 'Link','Unlink','Anchor' ]*/
    { name: 'basicstyles', items : [ 'Bold','Italic','Underline' ] },
    { name: 'links',       items : [ 'Link','Unlink' ] },
    { name: 'paragraph',   items : [ 'NumberedList','BulletedList','Blockquote' ] },
    { name: 'insert',      items : [ 'Image','Table','HorizontalRule','SpecialChar', 'Smiley' ] }

];

	config.removeButtons = 'Underline,Subscript,Superscript, Styles, Source, Format';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';

	config.image_previewText = ' ';
};
