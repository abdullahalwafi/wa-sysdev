<?php

include_once("../helpers/koneksi.php");
include_once("../helpers/function.php");

$login = cekSession();
if($login == 0){
    redirect("../login.php");
}

syncMSG();
echo "success";
?>