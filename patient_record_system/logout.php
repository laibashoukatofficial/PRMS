<?php
session_start();
session_destroy(); // Destroy all sessions
header("Location: index.html"); // Redirect to login page
exit;
?>
