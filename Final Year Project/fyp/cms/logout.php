<?php
setcookie("admin_session", "", time() - 3600); // 86400 = 1 day

unset($_SESSION['admin_id']);
unset($_SESSION['admin_fullname']);
unset($_SESSION['admin_email']);

header("Location:login.php");
exit();
?>