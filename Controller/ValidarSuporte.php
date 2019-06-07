<?php


session_start();
session_cache_expire(1);
if (empty($_SESSION["usuario"])|| $_SESSION["tipo"]!="Suporte") {

    echo "<script>";
    echo " window.location='../index.php'";
    echo "</script>";
}