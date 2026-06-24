<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Notes App</title>
    <style>
        /* Exact same CSS as the Register page for perfect consistency */
        body {
            background-color: #000000;
            color: #FAFAFA;
            font-family: system-ui, -apple-system, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .form-container {
            width: 90%;
            max-width: 400px;
        }
        h1 {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            text-align: center;
        }
        .subtitle {
            color: #666;
            text-align: center;
            margin-bottom: 2.5rem;
            font-size: 0.95rem;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
        }
        input {
            width: 100%;
            box-sizing: border-box;
            background-color: #0a0a0a;
            color: #FAFAFA;
            border: 1px solid #333;
            border-radius: 6px;
            padding: 1rem;
            font-size: 1rem;
        }
        input:focus {
            outline: none;
            border-color: #666;
            background-color: #111;
        }
        button {
            background-color: #FAFAFA;
            color: #000000;
            border: none;
            padding: 1rem;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-top: 1rem;
        }
        button:hover {
            background-color: #cccccc;
        }
        .text-red {
            color: #ff4444;
            font-size: 0.85rem;
            margin-top: -0.8rem;
            margin-bottom: 0;
        }
        .footer-text {
            text-align: center;
            margin-top: 2rem;
            color: #666;
            font-size: 0.9rem;
        }
        .footer-text a {
            color: #FAFAFA;
            text-decoration: none;
            font-weight: 600;
        }
        .footer-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h1>Welcome Back</h1>
        <p class="subtitle">Login to your account to continue</p>

        <form action="../backend/auth/login.php" method="POST">
            
            <input type="email" name="email" placeholder="Enter Email" required>
            
            <input type="password" name="password" placeholder="Password" required>
            
            <?php if (isset($_SESSION['login_error'])): ?>
                <p class="text-red"><?= $_SESSION['login_error']; ?></p>
            <?php endif; ?>

            <button type="submit">Login</button>
        </form>

        <p class="footer-text">
            Don't have an account? <a href="../register.php">Register</a>
        </p>
    </div>

</body>
</html>

<?php 
unset($_SESSION['login_error']); 
?>