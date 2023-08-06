<?php include './database/database.php' ?>

<?php

$sql = 'SELECT * from notes';
$result = mysqli_query($conn, $sql);
$notes = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>
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
  <div class="notes-page">
    <h1>The Notes</h1>
    <?php if (empty($notes)) : ?>
      <p>there is no notes yet</p>
    <?php endif ?>
    <div class="content ">
      <?php foreach ($notes as $item) : ?>
        <div class=" note">
          <p>
            <?php echo $item['body'] ?>
          </p>
          <h3>By : <span><?php echo $item['name'] ?></span> on : <span><?php echo $item['date'] ?></span></h3>
        </div>
      <?php endforeach; ?>
      <a href="./index.php">Back to Home</a>
    </div>
  </div>
</body>

</html>