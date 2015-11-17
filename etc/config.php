<?php

define('DEBUG', false);
define('BASE_PATH', '/srv/');
define('WEB_PATH', BASE_PATH . '/web');
define('LOGO_PATH', WEB_PATH . '/user/logos');
define('LOGO_PATH_WEB', '/user/logos');
define('THUMBNAIL_PATH', LOGO_PATH . '/thumbs');
define('THUMBNAIL_PATH_WEB', LOGO_PATH_WEB . '/thumbs');
define('EMAIL_PATH', LOGO_PATH . '/ems');
define('EMAIL_PATH_WEB', LOGO_PATH_WEB . '/ems');
define('FONT_PATH', BASE_PATH . '/var/fonts');
define('COUPON_PATH', WEB_PATH . '/user/coupons');
define('COUPON_PATH_WEB', '/user/coupons');
define('PHOTO_PATH', WEB_PATH . '/user/clientPhotos');
define('PHOTO_PATH_WEB', '/user/clientPhotos');
define('BGIMAGE_PATH', WEB_PATH . '/user/bgimages');
define('BGIMAGE_PATH_WEB', '/user/bgimages');
define('PHOTO_SIZE', '350px');
define('SALT', '0h93yb0ic0decbei');
define('MYSQL_USERNAME', 'user');
define('MYSQL_PASSWORD', 'password');
define('MYSQL_DATABASE', 'database');
define('MYSQL_HOST', 'db.server');

define('EW_PAGE_LIMIT', 15);