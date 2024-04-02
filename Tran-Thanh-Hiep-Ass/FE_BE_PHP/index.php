<?php
// Include the functions file
require_once "function.php";

$servername = "localhost";
$username = "root";
$password = "123456789";
$dbname = "joke_assignment";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// Get a random joke
$joke = getRandomJoke($conn);

// Check if a joke was retrieved
if ($joke) {
  $joke_text = $joke["joke_text"];
  $joke_id = $joke["joke_id"];

  // Set cookie to track voted joke (if not already set)
  if (!isset($_COOKIE["voted_joke"])) {
    setcookie("voted_joke", $joke_id, time() + (60 * 60 * 24)); // Expires in 24 hours
  }
?>

  <!DOCTYPE html>
  <html lang="vi">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A Joke a Day Keeps the Doctor Away</title>
    <link rel="stylesheet" href="css/style.css">
  </head>

  <body>
    <header class="header">
      <div class="logo-container">
        <img src="images/Logo_H.jpg" alt="Logo 1">
        <span class="handcrafted">Handicrafted by Jim HLS</span>
        <img src="images/Logo_Flower.jpg" alt="Logo 2">
      </div>
    </header>
    <main>
      <section class="jokeSologan">
        <h1>A joke a day keeps the doctor away</h1>
        <h2>If you joke wrong way, your teeth have to pay.(Serious)</h2>
      </section>
      <section class="joke">

        <p><?php echo $joke_text; ?></p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <div class="vote">
            <button class="funny" type="submit" name="vote" value="1">This is Funny!</button>
            <button class="not-funny" type="submit" name="vote" value="0">This is not funny</button>
          </div>
        </form>
      <?php
    } else {
      echo "That's all the jokes for today! Come back another day!";
    }
    // Process vote if submitted
    if (isset($_POST["vote"])) {
      $jokeId = $joke["joke_id"];
      $vote = (int) $_POST["vote"];
      recordVote($conn, $joke_id, $vote);
    }
      ?>
      </section>

    </main>
    <footer>
      <section class="disclaimer">
        <p>
          This website is created as part of Hisolutions program. The materials contained on this website are
          provided for general</br> information only and do not constitute any form of advice. HLS assumes no
          responsibility for the accuracy of any particular statement and </br>
          accepts no liability for any loss or
          damage which may arise from reliance on the information contained on this site.
        </p>
      </section>
      <p>Copyright 2021 HLS</p>
    </footer>
  </body>

  </html>