<?php

require_once '../srcnew_2016_June/Registration.php';
require '../srcnew_2016_June/events/MyEvents.php';

$debug = true;

function onCredentialsBad($mynumber, $status, $reason)
{
    if ($reason == 'blocked') {
        echo "\n\nYour number is blocked \n";
    }
    if ($reason == 'incorrect') {
        echo "\n\nWrong identity. \n";
    }
}

function onCredentialsGood($mynumber, $login, $password, $type, $expiration, $kind, $price, $cost, $currency, $price_expiration)
{
    echo "\n\nYour number $mynumber with the following password $password is not blocked \n";
}

echo "####################\n";
echo "#                  #\n";
echo "# WA Block Checker #\n";
echo "#                  #\n";
echo "####################\n";

echo "\n\nUsername (country code + number without + or 00): ";
$username = "553488883345";

$w = new Registration($username, $debug);
$w->eventManager()->bind('onCredentialsBad', 'onCredentialsBad');
$w->eventManager()->bind('onCredentialsGood', 'onCredentialsGood');

$w->checkCredentials();
