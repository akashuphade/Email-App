<?php

// Get the base path
define('BASE_PATH', realpath(dirname(__FILE__) . '/..'));

// from Email id to filter the inbox
define('EMAIL_TO_FILTER_FROM', 'EMAIL_TO_FILTER_FROM');  // EX :xyx@gmail.com

// folder name to move your deleted mails
define('TRASH_FOLDER', 'TRASH_FOLDER'); // EX: [Gmail]/Trash

// Email server credentials
define('SERVER','{imap.gmail.com:993/imap/ssl}'); // This is URL for Gmail, change it if you are using other mail server
define('USER', 'USERNAME'); // Username
define('PASSWORD', 'PASSWORD'); // Password
define('FOLDER', 'INBOX'); //Folder from which to fetch the emails


/**
 * It will get the relative path
 */
function PathToUrl($path)
{
    $path = str_replace($_SERVER['DOCUMENT_ROOT'], '', $path);
    return $path;
}
