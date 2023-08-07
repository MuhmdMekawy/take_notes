<?php
session_start();
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'take_notes';


// Connect to the database
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Retrieve user's hashed password from the database
  $sql = "SELECT password FROM users WHERE username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $hashedPassword = $row["password"];

    // Verify the password
    if (password_verify($password, $hashedPassword)) {
      // Set a session variable to mark the user as logged in
      $_SESSION["loggedin"] = true;
      $_SESSION["username"] = $username;

      // Redirect to a protected page
      header("Location: ./notes.php");
      exit;
    } else {
      $loginError = "Invalid username or password.";
    }
  } else {
    $loginError = "Invalid username or password.";
  }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="./style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900;1000&display=swap" rel="stylesheet">
</head>

<body>
  <div class="login">
    <div class="content">
      <form method="post" action="login.php">
        <div class="input">
          <label for="name">Name:</label>
          <input type="text" id="name" name="username" placeholder="Enter you username:">
        </div>
        <div class="input">
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" placeholder="Enter you password:">
        </div>
        <input type="submit" value="Submit" name="submit">
        <a href='./signup.php'>Signup</a>
      </form>
    </div>
  </div>
</body>

</html>