<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ONLINE VOTING SYSTEM - REGISTRATION</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .error-message {
            color: #ff3333;
            font-size: 14px;
            margin-top: 5px;
            display: none;
        }
        .captcha-error {
            border-color: #ff3333;
        }
    </style>
</head>
<body style="background-image: url('../images/bg2.png');">
    <header class="header">
        <hr>
        <h1>ONLINE VOTING SYSTEM</h1>
        <hr>
    </header>
    
    <div class="container">
        <div class="card" style="max-width: 550px; margin: 2rem auto;">
            <form action="../api/registration.php" method="POST" id="registrationForm" enctype="multipart/form-data" onsubmit="return validateForm(event)">
                <h2 class="card-title">REGISTRATION</h2>
                
                <div class="form-group">
                    <label for="Name">Name:</label>
                    <input type="text" id="Name" name="Name" placeholder="Enter full name" required 
                    pattern="[A-Za-z\s]+" title="Please enter alphabetic characters and spaces only.">
                </div>
                
                <div class="form-group">
                    <label for="mobile">Mobile No:</label>
                    <input type="tel" id="mobile" name="mobile" placeholder="Enter mobile number" required 
                    pattern="[0-9]{10}" title="Please enter a 10-digit mobile number.">
                </div>
                
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>

                <div class="form-group">
                    <label for="cpassword">Confirm Password:</label>
                    <input type="password" id="cpassword" name="cpassword" placeholder="Confirm your password" required>
                </div>

                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" placeholder="Address" required>
                </div>

                <div class="form-group">
                    <label for="photo">Upload Image:</label>
                    <input type="file" id="photo" name="photo" accept="image/*">
                </div>

                <div class="form-group">
                    <label for="role">Select Role:</label>
                    <select name="role" id="role">
                        <option value="1">VOTER</option>
                        <option value="2">CANDIDATE</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="captcha">CAPTCHA:</label>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <img src="../api/captcha.php" alt="CAPTCHA Image" style="border: 1px solid #ddd; border-radius: 4px; width: 200px; height: 60px;">
                        <a href="javascript:void(0)" onclick="refreshCaptcha()" style="font-size: 24px;" title="Refresh CAPTCHA">↻</a>
                    </div>
                    <p style="font-size: 12px; margin-top: 5px; color: #666;">Can't read? Click the refresh button ↻</p>
                    <input type="text" id="captcha" name="captcha" placeholder="Enter the code shown above" required style="font-size: 16px; letter-spacing: 2px;">
                    <div id="captcha-error" class="error-message">CAPTCHA is written wrong! Please try again.</div>
                </div>

                <button type="submit" class="btn">Register</button>
                
                <p class="text-center" style="margin-top: 1.5rem;">
                    Already registered? <a href="../index.php" class="link">Back to login</a>
                </p>
            </form>
        </div>
    </div>

    <script>
        // Add form validation
        document.getElementById('registrationForm').addEventListener('submit', function(event) {
            const password = document.getElementById('password').value;
            const cpassword = document.getElementById('cpassword').value;
            
            if (password !== cpassword) {
                event.preventDefault();
                alert('Passwords do not match!');
                return false;
            }
        });

        // Add subtle animation to the registration card
        document.addEventListener('DOMContentLoaded', function() {
            const card = document.querySelector('.card');
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 100);
        });
        
        // Function to refresh CAPTCHA
        function refreshCaptcha() {
            const captchaImg = document.querySelector('img[src="../api/captcha.php"]');
            captchaImg.src = '../api/captcha.php?' + new Date().getTime();
            document.getElementById('captcha').value = '';
            document.getElementById('captcha-error').style.display = 'none';
            document.getElementById('captcha').classList.remove('captcha-error');
        }
        
        // Function to validate the form
        function validateForm(event) {
            event.preventDefault();
            
            // Check if passwords match
            const password = document.getElementById('password').value;
            const cpassword = document.getElementById('cpassword').value;
            
            if (password !== cpassword) {
                alert('Passwords do not match!');
                return false;
            }
            
            const captchaInput = document.getElementById('captcha');
            const captchaError = document.getElementById('captcha-error');
            
            // Create FormData object
            const formData = new FormData();
            formData.append('captcha', captchaInput.value);
            
            // Send AJAX request to validate CAPTCHA
            fetch('../api/validate_captcha.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.valid) {
                    // CAPTCHA is valid, submit the form
                    document.getElementById('registrationForm').submit();
                } else {
                    // CAPTCHA is invalid, show error message
                    captchaError.style.display = 'block';
                    captchaInput.classList.add('captcha-error');
                    refreshCaptcha();
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
            
            return false;
        }
    </script>
</body>
</html>
