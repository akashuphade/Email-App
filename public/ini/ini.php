<?php

// Get the base path
define('BASE_PATH', realpath(dirname(__FILE__) . '/..'));

// from Email id to filter the inbox
define('EMAIL_TO_FILTER_FROM', 'uphade.akash25@gmail.com');

// folder name to move your deleted mails
define('TRASH_FOLDER', '[Gmail]/Trash');

// Email server credentials
define('SERVER','{imap.gmail.com:993/imap/ssl}');
define('USER', 'uphade.akash25@gmail.com');
define('PASSWORD', 'bmkkkjnybxsfbbsd');
define('FOLDER', 'INBOX');


/**
 * It will get the relative path
 */
function PathToUrl($path)
{
    $path = str_replace($_SERVER['DOCUMENT_ROOT'], '', $path);
    return $path;
}
