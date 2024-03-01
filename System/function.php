<?php

function dataClean($input = null) {                                   //Data Clear funtion//
    return htmlspecialchars(stripcslashes(trim($input)));
}

function dbconn() {                                                //Data Base Connection//
    $server = "localhost";
    $user = "root";
    $password = "";
    $dbname = "db_future_tech";

    $conn = new mysqli($server, $user, $password, $dbname);

    if ($conn->connect_error) {
        die("Database connection error" . $conn->connect_error);
    } else {
        return $conn;
    }
}


function validatePasswordStrength($password) {
    // Define the rules for password strength
    $lengthRule = '/^.{8,}$/';  // Minimum 8 characters
    $uppercaseRule = '/[A-Z]/'; // At least one uppercase letter
    $lowercaseRule = '/[a-z]/'; // At least one lowercase letter
    $numberRule = '/[0-9]/';    // At least one number
    $specialCharRule = '/[\W_]/'; // At least one special character

    // Check if the password meets all the rules
    if (
        preg_match($lengthRule, $password) &&
        preg_match($uppercaseRule, $password) &&
        preg_match($lowercaseRule, $password) &&
        preg_match($numberRule, $password) &&
        preg_match($specialCharRule, $password)
    ) {
        return true; // Password meets all the rules
    } else {
        return false; // Password does not meet all the rules
    }
}


function validateNumber($number) {
    return is_numeric($number);
}