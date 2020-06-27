<?php

require_once(dirname(__FILE__, 2) . "/ini/ini.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email App</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
    
    <nav class="navbar navbar-dark bg-dark">
        <!-- Navbar content -->    
        <div class="row">
            <a class="navbar-brand" href="<?php echo PathToUrl(BASE_PATH . '/unseenMails.php'); ?>">Email App</a>
                
            <ul class="row nav-item">
                <li class="nav-link"><a href="<?php echo PathToUrl(BASE_PATH . '/unseenMails.php'); ?>">Unread e-mails</a></li>
                <li class="nav-link"><a href="<?php echo PathToUrl(BASE_PATH . '/seenMails.php'); ?>">Read e-mails</a></li>
            </ul>
        </div>
    </nav>

<?php 
