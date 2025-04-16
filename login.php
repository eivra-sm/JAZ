<?php
include 'db_connection.php';
session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format!";
    } elseif (empty($password)) {
        $error = "Password cannot be empty!";
    } else {
        $sql = "SELECT * FROM customers_info WHERE Email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $storedPassword = $row['Pword'];

            if ($password === $storedPassword) { 
                $_SESSION['Email'] = $row['Email'];
                $_SESSION['User_lvl'] = $row['User_lvl'];
                $_SESSION['Fullname'] = $row['Fullname'];

                if ($row['User_lvl'] == 1) {
                    header("Location: AdminsSide/1-SUPERADMIN/dashboardSuperad.php");
                } elseif ($row['User_lvl'] == 2) {
                    header("Location: AdminsSide/1-ADMIN/dashboard.php");
                } else {
                    header("Location: GuestSide/index.php");
                }
                exit();                
            } else {
                $error = "Incorrect password!";
            }
        } else {
            $error = "User not found!";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>V&P Furniture - Login</title>
    <link rel="stylesheet" href="styles1.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="nature-bg"></div>
    <div class="falling-leaves" id="leaves-container"></div>
    
    <div class="container">
        <div class="auth-container">
            <div class="auth-image">
                <img src="https://hips.hearstapps.com/hmg-prod/images/posters-in-cozy-apartment-interior-royalty-free-image-943910360-1534189931.jpg" alt="Furniture">
                <div class="image-overlay">
                    <h3>Design Your Home</h3>
                    <p>Sign in to continue your shopping journey.</p>
                </div>
            </div>
            
            <div class="auth-form">
                <div class="logo">
                    <i class="fas fa-leaf leaf-icon fa-2x"></i>
                </div>
                <h2>Welcome to V&P Furniture</h2>
                <p class="subtitle">Sign in to your account</p>
                
                <?php if (!empty($error)): ?>
                <div class="message error">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo $error; ?>
                </div>
                <?php endif; ?>
                
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input type="text" id="Email" name="email" placeholder="@gmail.com" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="••••••••" required>
                    </div>
                    
                    <div class="form-options">
                        <div class="remember-me">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">Remember me</label>
                        </div>
                        <a href="forgot_password.php" class="forgot-link">Forgot password?</a>
                    </div>
                    
                    <button type="submit" class="btn-primary">Sign In</button>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        // Animation yung falling leaves
        document.addEventListener('DOMContentLoaded', function() {
            const leavesContainer = document.getElementById('leaves-container');
            const leafCount = 15;
            
            for (let i = 0; i < leafCount; i++) {
                createLeaf();
            }
            
            function createLeaf() {
                const leaf = document.createElement('div');
                leaf.classList.add('leaf');
                
                const size = Math.random() * 20 + 10; 
                const posX = Math.random() * 100; 
                const delay = Math.random() * 10;
                const duration = Math.random() * 10 + 10; 
                
                leaf.style.width = `${size}px`;
                leaf.style.height = `${size}px`;
                leaf.style.left = `${posX}%`;
                leaf.style.animationDelay = `${delay}s`;
                leaf.style.animationDuration = `${duration}s`;
                
                leavesContainer.appendChild(leaf);
                
                setTimeout(() => {
                    leaf.remove();
                    createLeaf();
                }, duration * 1000 + delay * 1000);
            }
        });
    </script>
</body>
</html>
