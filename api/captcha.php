<?php
session_start();

// Function to generate a random string for CAPTCHA
function generateCaptchaText($length = 5) { // Reduced length for better readability
    // Removed potentially confusing characters like 0/O, 1/I/l, etc.
    $characters = '23456789ABCDEFGHJKLMNPQRSTUVWXYZ'; 
    $captchaText = '';
    $charactersLength = strlen($characters);
    
    for ($i = 0; $i < $length; $i++) {
        $captchaText .= $characters[rand(0, $charactersLength - 1)];
    }
    
    return $captchaText;
}

// Generate CAPTCHA text and store in session
$captchaText = generateCaptchaText(6);
$_SESSION['captcha'] = $captchaText;

// Create an image with larger dimensions
$width = 200;
$height = 60;
$image = imagecreatetruecolor($width, $height);

// Colors with better contrast
$background = imagecolorallocate($image, 240, 240, 240); // Light gray background
$textColor = imagecolorallocate($image, 0, 0, 100); // Dark blue text
$noiseColor = imagecolorallocate($image, 180, 180, 180); // Light gray noise

// Fill background
imagefill($image, 0, 0, $background);

// Add noise (random dots)
for ($i = 0; $i < 1000; $i++) {
    imagesetpixel($image, rand(0, $width), rand(0, $height), $noiseColor);
}

// Add random lines
for ($i = 0; $i < 10; $i++) {
    imageline($image, rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), $noiseColor);
}

// Add the text with larger font
$font = 5; // Built-in font (1-5, where 5 is the largest)
$x = 20;
$y = 30;

// Slightly rotate and place each character for added security
for ($i = 0; $i < strlen($captchaText); $i++) {
    $angle = rand(-10, 10); // Reduce rotation for better readability
    $x += 25; // Increase spacing between characters
    $y = rand(25, 40); // Adjust vertical position for larger image
    imagechar($image, $font, $x, $y, $captchaText[$i], $textColor);
}

// Output the image
header('Content-type: image/png');
imagepng($image);

// Free up memory
imagedestroy($image);
?>