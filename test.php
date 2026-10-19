<?php
require_once 'core/dbconfig.php';
if ($conn->connect_error) {
    echo "ERR";
} else {
    echo "OK";
}