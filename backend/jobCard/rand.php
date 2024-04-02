<?php

function generateRandomNumber($length) {
    $min = pow(10, $length - 1); // Minimum value based on length
    $max = pow(10, $length) - 1; // Maximum value based on length

    return rand($min, $max);
}

$randomNumber = generateRandomNumber(4); // Generate a 6-digit random number
?>