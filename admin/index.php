<?php
session_start();
if($_SERVER['is_login'] && $_SESSION['is_login'] == true){
    header('location: dashboard.php');
}else{
    header('location: login.php');
}