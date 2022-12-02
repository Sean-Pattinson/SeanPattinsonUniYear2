<?php
session_start();
unset($_SESSION['username']);
unset($_SESSION['logged-in']);
session_destroy();
session_write_close();
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>