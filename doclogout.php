<?php
session_start();
session_unset();
session_destroy();
header("location: doctor-login.php");
exit;
?>