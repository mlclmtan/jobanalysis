<?php
$conn = new mysqli('127.0.0.1', '', '', '');
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

datain();


function datain()
{
  $content = htmlspecialchars(file_get_contents("https://www.104.com.tw/jobs/search/?keyword=vue"));
  preg_match('/－(.*?)個工作機會/', $content, $vue);
  $content = htmlspecialchars(file_get_contents("https://www.104.com.tw/jobs/search/?keyword=react"));
  preg_match('/－(.*?)個工作機會/', $content, $react);
  $content = htmlspecialchars(file_get_contents("https://www.104.com.tw/jobs/search/?keyword=angular"));
  preg_match('/－(.*?)個工作機會/', $content, $angular);

  global $conn;
  $stmt = $conn->prepare('INSERT INTO `web` 
                                        (`vue`, 
                                        `react`, 
                                        `angular`) 
                                SELECT ?,?,?
                                FROM   DUAL 
                                WHERE  NOT EXISTS (SELECT * 
                                            FROM   `web` 
                                            WHERE  CURDATE() = 
                                                    Date_format(`date`, "%Y/%m/%e")) ');

  $stmt->bind_param("iii", $vue[1], $react[1], $angular[1]);
  if (!$stmt->execute()) {
    $err = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
  }

  $stmt->close();
  $conn->close();

  echo json_encode(mysqli_affected_rows($conn));
}
