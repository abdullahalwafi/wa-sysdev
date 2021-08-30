<?php
include_once("helpers/koneksi.php");
include_once("helpers/function.php");

session_destroy();
redirect("login.php");