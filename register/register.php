<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="register.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <!-- Add PHP error display -->
        <?php if (!empty($error)): ?>
            <div class="error-message" id="error-message">
                <h3 class="error-text"><?php echo htmlspecialchars($error); ?></h3>
            </div>
        <?php endif; ?>

        <div class="logologin">
            <img class="logo" src="../data/images/logo-white.svg" alt="Logo">
            <!-- Wrap inputs in a form -->
            <form method="POST" action="register.php" id="register-form">
                <h2 class="signup-title">Create a new account</h2>
                <div class="details">
                    <input
                        type="text"
                        id="Username"
                        name="Username"
                        placeholder="Username"
                        required
                    >
                </div>
                <div class="details">
                    <input
                        type="text"
                        id="email"
                        name="email"
                        placeholder="Email"
                        required
                    >
                </div>
                <div class="details">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Password"
                        required
                    >
                </div>
                <div class="details">
                    <label for="birthday">Birthday</label>
                    <input type="date" id="birthday" name="birthday" required>
                </div>
                <div class="details">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" required>
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
        </div>
    </body>
</html>