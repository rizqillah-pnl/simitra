<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: logout.php");
}

header("Location: page/index.php");
