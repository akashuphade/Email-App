<?php

define('BASE_PATH', realpath(dirname(__FILE__) . '/..'));
define('SERVER',"{imap.gmail.com:993/imap/ssl}");
define('USER', "uphade.akash25@gmail.com");
define('PASSWORD', "bmkkkjnybxsfbbsd");
define('FOLDER', 'INBOX');


function PathToUrl($path)
{
    $path = str_replace($_SERVER['DOCUMENT_ROOT'], '', $path);
    return $path;
}