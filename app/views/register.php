<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Student Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="<?php echo site_url('public/assets/css/style.css'); ?>" rel="stylesheet">
    <style>
        .auth-container {
            display: flex;
            min-height: 100vh;
            align-items: center;
            justify-content: center;
            background: var(--dark-bg);
        }
        
        .auth-box {
            background: var(--dark-secondary);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 3rem;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }
        
        .auth-title {
            color: var(--neon-green);
            font-size: 2rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 0.5rem;
        }
        
        .auth-subtitle {
            color: var(--text-gray);
            text-align: center;
            margin-bottom: 2rem;
            font-size: 0.9rem;
        }
        
        .auth-form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }
        
        .auth-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .auth-label {
            color: var(--text-white);
            font-weight: 500;
            font-size: 0.9rem;
        }
        
        .auth-input, .auth-select {
            background: var(--dark-bg);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 0.75rem;
            color: var(--text-white);
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .auth-input:focus, .auth-select:focus {
            outline: none;
            border-color: var(--neon-green);
            box-shadow: 0 0 0 3px rgba(74, 255, 136, 0.1);
        }
        
        .auth-input::placeholder {
            color: var(--text-gray);
        }
        
        .auth-select option {
            background: var(--dark-bg);
            color: var(--text-white);
        }
        
        .auth-btn {
            background: var(--neon-green);
            color: var(--dark-bg);
            border: none;
            border-radius: 8px;
            padding: 0.875rem;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 0.5rem;
        }
        
        .auth-btn:hover {
            background: #3de673;
            transform: translateY(-1px);
        }
        
        .auth-link {
            text-align: center;
            margin-top: 1.5rem;
            color: var(--text-gray);
            font-size: 0.9rem;
        }
        
        .auth-link a {
            color: var(--neon-green);
            text-decoration: none;
            font-weight: 500;
        }
        
        .auth-link a:hover {
            text-decoration: underline;
        }
        
        .auth-error {
            background: rgba(255, 74, 74, 0.1);
            border: 1px solid var(--danger-color);
            color: var(--danger-color);
            padding: 0.75rem;
            border-radius: 8px;
            text-align: center;
            font-size: 0.9rem;
        }
        
        .auth-success {
            background: rgba(74, 255, 136, 0.1);
            border: 1px solid var(--neon-green);
            color: var(--neon-green);
            padding: 0.75rem;
            border-radius: 8px;
            text-align: center;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-box">
            <h1 class="auth-title">Create Account</h1>
            <p class="auth-subtitle">Sign up for a new account</p>
            
            <?php if (isset($error)): ?>
                <div class="auth-error">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            
            <?php flash_alert(); ?>
            
            <form action="<?php echo site_url('auth/register'); ?>" method="post" class="auth-form">
                <div class="auth-group">
                    <label for="username" class="auth-label">Username</label>
                    <input type="text" name="username" id="username" class="auth-input" 
                           placeholder="Choose a username" required>
                </div>
                
                <div class="auth-group">
                    <label for="password" class="auth-label">Password</label>
                    <input type="password" name="password" id="password" class="auth-input" 
                           placeholder="Create a password" required>
                </div>
                
                <div class="auth-group">
                    <label for="role" class="auth-label">Role</label>
                    <select name="role" id="role" class="auth-select">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                
                <button type="submit" class="auth-btn">Create Account</button>
            </form>
            
            <div class="auth-link">
                Already have an account? <a href="<?php echo site_url('auth/login'); ?>">Sign in</a>
            </div>
        </div>
    </div>
</body>
</html>