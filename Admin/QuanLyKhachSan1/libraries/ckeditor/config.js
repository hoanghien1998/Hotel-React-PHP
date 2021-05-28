/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function (config) {
    // Define changes to default configuration here. For example:
    // config.language = 'fr';
    // config.uiColor = '#AADC6E';
//    config.allowedContent = true;
//    config.filebrowserBrowseUrl = 'ckfinder/ckfinder.html';
//    config.filebrowserUploadUrl = 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
    config.filebrowserBrowseUrl = 'http://localhost/Backend/DoAn/QuanLyKhachSan1/libraries/ckfinder/ckfinder.html';

    config.filebrowserImageBrowseUrl = 'http://localhost/Backend/DoAn/QuanLyKhachSan1/libraries/ckfinder/ckfinder.html?type=Images';

    config.filebrowserFlashBrowseUrl = 'http://localhost/Backend/DoAn/QuanLyKhachSan1/libraries/ckfinder/ckfinder.html?type=Flash';

    config.filebrowserUploadUrl = 'http://localhost/Backend/DoAn/QuanLyKhachSan1/libraries/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';

    config.filebrowserImageUploadUrl = 'http://localhost/Backend/DoAn/QuanLyKhachSan1/libraries/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';

    config.filebrowserFlashUploadUrl = 'http://localhost/Backend/DoAn/QuanLyKhachSan1/libraries/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';

};


