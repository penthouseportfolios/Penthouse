<?php
session_start();

// Database connection
$host = 'localhost';
$dbname = 'website_db';
$user = 'root';
$pass = 'your_password';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$username = $_POST['username'];
$password = $_POST['password'];

// Prepare and execute SQL query
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    // Verify password (assuming it's hashed)
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: dashboard.php"); // Redirect to a protected page
    } else {
        echo "Invalid password.";
    }
} else {
    echo "No user found with that username.";
}

$stmt->close();
$conn->close();
?>

<!doctype html>
<html>

<title>
Penthouse Portfolios
</title>
  <meta name="viewport" content="width=device-width, initial-scale=0.1">
	<link href="https://fonts.googleapis.com/css?family=Lexend+Tera&display=swap" rel="stylesheet">
  <link href="https://db.onlinewebfonts.com/c/953440d6182da090377d805e5156873c?family=Korbin+W01+Medium" rel="stylesheet">
	<link href="main.css" rel="stylesheet" type="text/css"/>

<body>
  <div class = "navbar">
    <div class = "companylogoheader" onclick="window.location.href='index.html'">
        <img src="phwhitelogo.png" alt="logo" width="100vw">
    </div>
    <ul id="nav-links" class="collapsed">
      <li><a href="login.html">Client Login</a></li>
    </ul>
    <div class = "companynameheader" onclick="toggleMenu()">
      <h1>Penthouse Portfolios</h1>
    </div>
  </div>
  <script src="script.js"></script>

<div class="fullscreen">
  <h3 class = "page1header">Sign In</h3>
    <div class = "loginpage">
      <form action="login.php" method="POST">
        <label for="username">Username</label><br>
        <input type="text" id="username" name="username" required><br><br>
      
        <label for="password">Password</label><br>
        <input type="password" id="password" name="password" required><br><br>
      
        <input type="submit" value="Login">
      </form>
    </div>  
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

</div>

</body>
</html>