<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Notes App</title>
    <style>
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
        <h1>Create an Account</h1>
        <p class="subtitle">Fill in the details below to get started.</p>

        <form action="/backend/auth/register.php" method="post">
            
            <input name="name" value="<?= htmlspecialchars($_SESSION['user_name'] ?? ''); ?>" type="text" placeholder="Enter name" required>
            <p class="text-red"><?= $_SESSION['name_error'] ?? '' ?></p>
            
            <input name="email" value="<?= htmlspecialchars($_SESSION['user_email'] ?? ''); ?>" type="email" placeholder="Enter email" required>
            <p class="text-red"><?= $_SESSION['email_error'] ?? '' ?></p>
            
            <input name="password" type="password" placeholder="Enter password" required>
            <p class="text-red"><?= $_SESSION['password_error'] ?? '' ?></p>
            
            <button type="submit">Register</button>
        </form>

        <p class="footer-text">
            Already have an account? <a href="login.php">Login</a>
        </p>
    </div>

</body>
</html>

<?php 
unset($_SESSION['name_error']); 
unset($_SESSION['email_error']); 
unset($_SESSION['password_error']); 
?>