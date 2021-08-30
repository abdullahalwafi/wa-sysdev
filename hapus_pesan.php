<?php
include_once("helpers/koneksi.php");
include_once("helpers/function.php");


$id = get("id");

$q = mysqli_query($koneksi, "DELETE FROM pesan WHERE id='$id'");
redirect("kirim.php");
?>
