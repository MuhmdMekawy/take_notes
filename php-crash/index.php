<?php
$name = $email = $notes = '';
$nameErr = $emailErr = $notesErr = '';

if (isset($_POST['submit'])) {
  if ($_POST['name'] === '') {
    $nameErr = 'this field is required';
  } else {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }
  if ($_POST['email'] === '') {
    $emailErr = 'this field is required';
  } else {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }
  if ($_POST['notes'] === '') {
    $notesErr = 'this field is required';
  } else {
    $notes = filter_input(INPUT_POST, 'notes', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }
  if (empty($nameErr) && empty($emailErr) && empty($notesErr)) {
    include './database/database.php';

    $sql = "INSERT INTO notes (name, email, body) VALUES ('$name', '$email', '$notes')";
    if (mysqli_query($conn, $sql)) {
      header('Location: ./notes.php');
    } else {
      echo 'Error';
    }
  }
}






?>

<?php include 'database/database.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Notes</title>
  <link rel="stylesheet" href="./style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900;1000&display=swap" rel="stylesheet">
</head>

<body>
  <div class="feedbackProject">
    <div class="content">
      <h1>Enter Your Notes</h1>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="input">
          <label for="name">UserName:</label>
          <input dir="auto" type="text" name="name" id="name" placeholder=" Your Name:">
          <div class="alert"><?php echo $nameErr ?? null ?></div>
        </div>
        <div class="input">
          <label for="email">Email:</label>
          <input dir="auto" type="text" name="email" id="email" placeholder="Your Email:">
          <div class="alert"><?php echo $emailErr ?? null ?></div>
        </div>
        <div class="input">
          <label for="Notes">Notes:</label>
          <textarea dir="auto" name=" notes" id="Notes" placeholder="Your Notes:"></textarea>
          <div class="alert"><?php echo $notesErr ?? null ?></div>
        </div>
        <input type="submit" value="Submit" name="submit">
      </form>
    </div>
  </div>
</body>

</html>