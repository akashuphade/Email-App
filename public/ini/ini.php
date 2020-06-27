<?php

define('BASE_PATH', realpath(dirname(__FILE__) . '/..'));
define('SERVER',"{imap.gmail.com:993/imap/ssl}");
define('USER', "USERNAME");
define('PASSWORD', "PASSWORD");
define('FOLDER', 'INBOX');


function PathToUrl($path)
{
    $path = str_replace($_SERVER['DOCUMENT_ROOT'], '', $path);
    return $path;
}
