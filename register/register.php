<?php
require_once '../classes/user.php';

// Initialize dependencies
$user = new User();

$error = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $dateOfBirth = $_POST['birthday'] ?? '';
        $gender = $_POST['gender'] ?? '';

        if ($user->register($username, $email, $password, $dateOfBirth, $gender)) {
            header("Location: ../index.php");
            exit();
        } else {
            $error = "User already exists";
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="register.css">
        <script src="register.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="logologin">
            <img class="logo" src="../data/images/logo-white.svg" alt="Logo">
            <form id="register-form" method="POST" onsubmit="return validateForm()">
                <h2 class="signup-title">Create a new account</h2>
                <div class="details">
                    <input
                        type="text"
                        id="username"
                        name="username"
                        placeholder="Username"
                    >
                </div>
                <div class="details">
                    <input
                        type="text"
                        id="email"
                        name="email"
                        placeholder="Email"
                    >
                </div>
                <div class="details">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Password"
                    >
                </div>
                <div class="details">
                    <label for="birthday">Birthday</label>
                    <input type="date" id="birthday" name="birthday">
                </div>
                <div class="details">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <button type="submit" class="submitbutton">Sign Up</button>
                <div class="forgot-password">
                    <a href="#">Forgot Account?</a>
                </div>
                <div class="line"></div>
                <div class="create-account">
                    <a href="../index.html">Log In</a>
                </div>
            </form>
            <div class="error-message" id="error-message">
                <h3 class="error-text" id="error-text">This is the error</h3>
            </div>

            <?php if ($error !== ''): ?>
            <script>
                // Call JavaScript function from PHP
                showError("<?= htmlspecialchars($error) ?>");
            </script>
            <?php endif; ?>
        </div>
    </body>
</html>