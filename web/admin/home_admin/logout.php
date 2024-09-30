<?php
session_start();
session_destroy();
header("Location: ../home_admin/home_admin.html");
exit();
?>
