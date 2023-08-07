<?php
// Function to handle user signup and store data in the database
function signUpUser($username, $email, $password)
{
  // Replace these with your actual database credentials
  $dbHost = 'localhost';
  $dbUsername = 'root';
  $dbPassword = '';
  $dbName = 'take_notes';

  // Connect to the database
  $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

  // Check the connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Hash the password for security
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  // Prepare the SQL statement to insert data into the database using placeholders (?)
  $stmt = $conn->prepare("INSERT INTO users (username, email,password) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $username, $email, $hashedPassword);

  // Execute the prepared statement
  if ($stmt->execute()) {
    // Successful registration
    $stmt->close();
    $conn->close();
    return true;
  } else {
    // Error occurred during registration
    $stmt->close();
    $conn->close();
    return false;
  }
}

if (!empty($_POST['username']) && !empty($_POST['password'])) {

  // Example usage:
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Call the function to sign up the user
  if (signUpUser($username, $email, $password)) {
    echo "User registered successfully!";
    setcookie('name', $username, time() + 86400);
    header('Location: ./index.php');
  } else {
    echo "Registration failed. Please try again later.";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signup</title>
  <link rel="stylesheet" href="./style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900;1000&display=swap" rel="stylesheet">
</head>

<body>
  <div class="login">
    <div class="content">
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="input">
          <label for="name">Name:</label>
          <input type="text" id="name" name="username" placeholder="Enter your username:">
        </div>
        <div class="input">
          <label for="Email">Email:</label>
          <input type="text" id="Email" name="email" placeholder="Enter your Email:">
        </div>
        <div class="input">
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" placeholder="Enter your password:">
        </div>
        <input type="submit" value="Submit" name="submit">
        <a href='./login.php'>LogIn</a>
      </form>
    </div>
  </div>
</body>

</html>