<?php
session_start();

// Set header to return JSON response
header('Content-Type: application/json');

// Check if it's an AJAX request
if(isset($_POST['captcha'])) {
    $captcha = $_POST['captcha'];
    
    // Validate CAPTCHA
    if(!isset($_SESSION['captcha']) || $_SESSION['captcha'] !== $captcha) {
        // Invalid CAPTCHA
        echo json_encode([
            'valid' => false,
            'message' => 'CAPTCHA is written wrong! Please try again.'
        ]);
    } else {
        // Valid CAPTCHA
        echo json_encode([
            'valid' => true,
            'message' => 'CAPTCHA validated successfully.'
        ]);
    }
} else {
    // Not a valid request
    echo json_encode([
        'valid' => false,
        'message' => 'Invalid request.'
    ]);
}
?>