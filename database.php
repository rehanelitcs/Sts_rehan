<?php
$konek = mysqli_connect("localhost", "root", "", "peminjaman_barang");

function cek_login($username, $password)
{
  global $konek;
  $uname = $username;
  $upass = $password;

  $sql = mysqli_query($konek, "SELECT * FROM user WHERE username = '$uname' AND password = MD5('$upass')");
  $result = mysqli_num_rows($sql);

  if ($result > 0) {
    $sqls = mysqli_fetch_assoc($sql);
    $_SESSION['id'] = $sqls['id'];
    $_SESSION["username"] = $sqls['username'];
    $_SESSION["role"] = $sqls['role'];
    return true;
  } else {
    return false;
  }
}

function tampildata($query)
{
  global $konek;
  $hasil = mysqli_query($konek, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($hasil)) {
    $rows[] = $row;
  }
  return $rows;
}

function inputdata($data)
{
  global $konek;
  $sql = mysqli_query($konek, $data);
  return $sql;
}

function update($tabel, $kode_barang, $namabarang, $kategori, $merk, $jumlah, $id)
{
    global $koneksi;
    $query = "UPDATE $tabel SET kode_barang = '$kode_barang', nama_barang = '$namabarang', kategori = '$kategori', merk = '$merk', jumlah = $jumlah WHERE id = '$id'";
    $hasil = mysqli_query($koneksi,$query);
    return $hasil;
}

function edit($tabel, $id)
{
    global $koneksi;
    $sql = mysqli_query($koneksi, "SELECT * FROM $tabel WHERE id = '$id'");
    return $sql;
}

function hapus($tabel, $id)
{
  global $konek;

  $sql = mysqli_query($konek, "DELETE FROM $tabel WHERE id = '$id'");
  return $sql;
}
