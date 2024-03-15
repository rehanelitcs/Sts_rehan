<?php
require_once("database.php");
$id = $_GET['id'];
$sql = hapus("barang", $id);
if ($sql) {
  header("location:barang.php");
} else {
  echo "Hapus Gagal";
}
