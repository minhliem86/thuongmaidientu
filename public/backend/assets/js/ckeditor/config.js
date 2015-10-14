/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';

	config.filebrowserBrowseUrl = 'http://localhost:8012/backend/public/backend/assets/js/kcfinder/browse.php?opener=ckeditor&type=files';
	config.filebrowserImageBrowseUrl = 'http://localhost:8012/backend/public/backend/assets/js/kcfinder/browse.php?opener=ckeditor&type=images';
	config.filebrowserFlashBrowseUrl = 'http://localhost:8012/backend/public/backend/assets/js/kcfinder/browse.php?opener=ckeditor&type=flash';
	config.filebrowserUploadUrl = 'http://localhost:8012/backend/public/backend/assets/js/kcfinder/upload.php?opener=ckeditor&type=files';
	config.filebrowserImageUploadUrl = 'http://localhost:8012/backend/public/backend/assets/js/kcfinder/upload.php?opener=ckeditor&type=images';
	config.filebrowserFlashUploadUrl = 'http://localhost:8012/backend/public/backend/assets/js/kcfinder/upload.php?opener=ckeditor&type=flash';
};
