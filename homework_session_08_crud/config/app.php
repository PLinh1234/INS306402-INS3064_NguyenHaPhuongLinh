<?php

$env = 'dev'; // đổi thành 'production' khi nộp

if ($env === 'dev') {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
}