<?php
require_once 'classes/user.php';

// Initialize dependencies
$user = new User();

$error = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        
        if ($user->login($email, $password)) {
            header("Location: home/home.php");
            exit();
        } else {
            $error = "Invalid email or password";
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="index.css" />
        <script src="index.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    </head>
    <body>
        <div class="logologin">
            <img class="logo" src="data/images/logo-white.svg" alt="Logo" />

            <form id="login-form" method="POST" onsubmit="return validateForm()">
                
                <div class="details">
                    <input
                        type="text"
                        id="email"
                        name="email"
                        placeholder="Email"
                    />
                </div>
                <div class="details">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Password"
                    />
                </div>
                <button type="submit" class="submitbutton">Log In</button>

                <div class="forgot-password">
                    <a href="#">Forgot Password</a>
                </div>

                <div class="line"></div>

                <div class="create-account">
                    <a href="register/register.php">Sign up</a>
                </div>
            </form>
        </div>
        

        <div class="error-message" id="error-message">
            <h3 id="error-text"></h3>
        </div>


        <?php if ($error !== ''): ?>
            <script>
                // Call JavaScript function from PHP
                showError("<?= htmlspecialchars($error) ?>");
            </script>
        <?php endif; ?>
    </body>
</html>