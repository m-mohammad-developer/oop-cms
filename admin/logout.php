<?php
require_once 'includes/init.php';

if (!isset($_SESSION['user_info'])) {
    redirect("../index.php");
} else {

    session_unset();
    session_destroy();

    redirect('../login.php');

}