<?php


session_start();
session_cache_expire(0.1);
if (empty($_SESSION["usuario"])) {

    echo "<script>";
    echo " window.location='../index.php'";
    echo "</script>";
    
}