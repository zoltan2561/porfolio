<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = htmlspecialchars($_POST["name"]);
  $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
  $message = htmlspecialchars($_POST["message"]);

  $to = "pappzoltan6969@gmail.com";
  $subject = "Kapcsolatfelvétel a portfólió oldaladról - $name";

  $headers = "From: no-reply@pappzoltan.com\r\n";
  $headers .= "Reply-To: $email\r\n";
  $headers .= "Content-Type: text/plain; charset=UTF-8";

  $body = "Név: $name\nE-mail: $email\nÜzenet:\n$message";

  if (mail($to, $subject, $body, $headers)) {
    header("Location: index.php?success=1#kapcsolat");
    exit;
  } else {
    header("Location: index.php?error=1#kapcsolat");
    exit;
  }
}
?>
