<?php

function inputTrim($input = null) {
    return htmlspecialchars(stripcslashes(trim($input)));
}

function dbConn() {
    $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);
    if ($conn->connect_error) {
        return false;
    } else {
        return $conn;
    }
}
?>
