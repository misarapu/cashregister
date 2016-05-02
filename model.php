<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "poe_ladu";

$l = mysqli_connect($host, $user, $pass, $db);
mysqli_query($l, "SET CHARACTER SET UTF8") or
    die("Error, ei saa andmebaasi charsetti seatud");

function model_load_catergory() {
  global $l;
  $query = 'SELECT Id, Nimetus FROM kategooriad ORDER BY Nimetus ASC';
  $stmt = mysqli_prepare($l, $query);
  mysqli_execute($stmt);
  mysqli_stmt_bind_result($stmt, $id, $nimetus);

  $blocks = array();
  while (mysqli_stmt_fetch($stmt)) {
    $blocks[] = array(
      'Id' => $id,
      'Nimetus' => $nimetus
    );
  }
  mysqli_stmt_close($stmt);
  return $blocks;
}

function model_load_product() {
  global $l;
  $query = 'SELECT Id, Nimetus, Kategooria, Hind FROM kaubad ORDER BY Nimetus ASC';
  $stmt = mysqli_prepare($l, $query);
  mysqli_execute($stmt);
  mysqli_stmt_bind_result($stmt, $id, $nimetus, $catId, $hind);
  $blocks = array();
  while (mysqli_stmt_fetch($stmt)) {
    $blocks[] = array(
      'Id' => $id,
      'Nimetus' => $nimetus,
      'CatId' => $catId,
      'Hind' => $hind
    );
  }
  mysqli_stmt_close($stmt);
  return $blocks;
}

function model_add_category($nimetus) {
  global $l;
  $query = 'INSERT INTO kategooriad (Nimetus) VALUES (?)';
  $stmt = mysqli_prepare($l, $query);
  mysqli_stmt_bind_param($stmt, 's', $nimetus);
  mysqli_stmt_execute($stmt);
  $id = mysqli_stmt_insert_id($stmt);
  mysqli_stmt_close($stmt);
  return $id;
}

function model_add_product($nimetus, $kat_id, $kood, $hind, $kogus) {
  global $l;
  $query = 'INSERT INTO kaubad (Nimetus, Kategooria, Tootekood, Hind, Kogus) VALUES (?,?,?,?,?)';
  $stmt = mysqli_prepare($l, $query);
  mysqli_stmt_bind_param($stmt, 'sisdi', $nimetus, $kat_id, $kood, $hind, $kogus);
  mysqli_stmt_execute($stmt);
  $id = mysqli_stmt_insert_id($stmt);
  mysqli_stmt_close($stmt);
  return $id;
}

function model_category_id($category_name) {
  global $l;
  $query = 'SELECT Id FROM kategooriad WHERE Nimetus = ?';
  $stmt = mysqli_prepare($l, $query);
  mysqli_stmt_bind_param($stmt, 's', $category_name);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $Id);
  $logIds = array();
  while (mysqli_stmt_fetch($stmt)) {
    $logIds[] = $Id;
  }
  mysqli_stmt_close($stmt);
  return $logIds[0];
}
