<?php

require_once '../vendor/autoload.php';

define('MAILGUN_KEY', 'key-d01b6d0615061c7b4548d2feaa874ea5');
define('MAILGUN_PUBKEY', 'pubkey-438115fcdfdf472d0109a9e8a90e48aa');

define('MAILGUN_DOMAIN', 'pubkey-438115fcdfdf472d0109a9e8a90e48aa');

$mailgun = new Mailgun\Mailgun(MAILGUN_KEY);
$mailgunValidate = new Mailgun\Mailgun(MAILGUN_PUBKEY);

$mailgunOptIn = $mailgun->OptInHandler();
