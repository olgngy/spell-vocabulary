<?php

session_start();

$FIRSTNAME_MIN_LEN = 1;
$FIRSTNAME_MAX_LEN = 40;
$LASTNAME_MIN_LEN = 1;
$LASTNAME_MAX_LEN = 40;
$PASSWORD_MIN_LEN = 5;
$PASSWORD_MAX_LEN = 40;
$EMAIL_MAX_LEN = 40;
$AUTH_TOKEN_LEN = 32;

function sanitizeString($str) {
  return filter_var($str, FILTER_SANITIZE_STRING);
}

function generateAuthToken() {
  global $AUTH_TOKEN_LEN;
  return substr(str_shuffle(
    '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'),
    0, $AUTH_TOKEN_LEN
  );
}

?>