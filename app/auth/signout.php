<?php

session_start();

session_unset();
session_destroy();

header("Location: /IT34A/index.php");
exit;

?>