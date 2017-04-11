<?php
//Function call in home.php
function display_error() {
  if (isset($_SESSION['error'])) {
    $err = $_SESSION["error"];
    $_SESSION["error"] = "";
    unset($_SESSION["error"]);
    echo $err;
  }
}
?>