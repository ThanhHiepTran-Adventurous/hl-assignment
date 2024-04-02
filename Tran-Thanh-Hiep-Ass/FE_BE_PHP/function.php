<?php
// Database connection details (replace with your actual details)
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

function getRandomJoke($conn)
{
    $sql = "SELECT * FROM jokes WHERE joke_id NOT IN (SELECT joke_id FROM votes WHERE user_cookie = ?) ORDER BY RAND() LIMIT 1";
    $stmt = $conn->prepare($sql);
    $votedJoke = $_COOKIE["voted_joke"] ?? "";
    $stmt->bind_param("s", $votedJoke);
    $stmt->execute();
    $result = $stmt->get_result();
    $joke = $result->fetch_assoc();
    return $joke;
}

function recordVote($conn, $jokeId, $vote)
{
    $sql = "INSERT INTO votes (joke_id, user_cookie, vote) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $votedJoke = $_COOKIE["voted_joke"] ?? "";
    $stmt->bind_param("iss", $jokeId, $votedJoke, $vote); // Check for user cookie
    $stmt->execute();
}
