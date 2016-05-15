<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "poe_ladu";

$l = mysqli_connect($host, $user, $pass, $db);
mysqli_query($l, "SET CHARACTER SET UTF8") or die("Error, ei saa andmebaasi charsetti seatud");
if (!$l) {
    die('Could not connect: ' . mysqli_error($l));
}
/**
 * Model load category
 */
function model_load_catergory() {
    global $l;
    $query = 'SELECT Id, Nimetus FROM kategooriad ORDER BY Nimetus ASC';
    $stmt = mysqli_prepare($l, $query);
    mysqli_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $name);

    $blocks = array();
    while (mysqli_stmt_fetch($stmt)) {
        $blocks[] = array(
            'Id' => $id,
            'Name' => $name
        );
    }
    mysqli_stmt_close($stmt);
    return $blocks;
}

/**
 * Model load product
 */
function model_load_product() {
    global $l;
    $query = 'SELECT kategooriad.Id, kategooriad.Nimetus, kaubad.Id, kaubad.Nimetus, kaubad.Tootekood, kaubad.Hind, kaubad.Kogus
        	            FROM kategooriad
                        JOIN kaubad
                        ON kategooriad.Id = kaubad.Kategooria';
    $stmt = mysqli_prepare($l, $query);
    mysqli_execute($stmt);
    mysqli_stmt_bind_result($stmt, $catId, $catName, $proId, $proName, $proCode, $proPrice, $proQuantity);
    $blocks = array();
    while (mysqli_stmt_fetch($stmt)) {
        $blocks[] = array(
            'CatId' => $catId,
            'CatName' => $catName,
            'ProId' => $proId,
            'ProName' => $proName,
            'ProCode' => $proCode,
            'ProPrice' => $proPrice,
            'ProQuantity' => $proQuantity
        );
    }
    mysqli_stmt_close($stmt);
    return $blocks;
}

/**
 * Model add category
 */
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

/**
 * Model load product
 */
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

/**
 * Model load category id
 */
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

/**
 * Model delete product
 */
function model_delete_product($id) {
    global $l;
    $query = 'DELETE FROM kaubad WHERE Id=? LIMIT 1';
    $stmt = mysqli_prepare($l, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $delete = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    return $delete;
}

/**
 * Model delete category
 */
function model_delete_category($id) {
    global $l;
    $query = 'DELETE kategooriad, kaubad
              FROM kategooriad
              LEFT JOIN kaubad
              ON kategooriad.Id=kaubad.Kategooria
              WHERE kategooriad.Id=?';
    $stmt = mysqli_prepare($l, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $delete = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    return $delete;
}

/**
 * Model edit category
 */
function model_edit_category($old_category_name, $new_category_name) {
    global $l;
    $query = 'UPDATE kategooriad
              SET Nimetus=?
              WHERE Nimetus=?';
    $stmt = mysqli_prepare($l, $query);
    mysqli_stmt_bind_param($stmt, 'ss', $new_category_name, $old_category_name);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $edited;
}

/**
 * Model edit product
 */
function model_edit_product($old_code, $new_product_name, $new_category_name, $new_code, $new_quantity, $new_price) {
    global $l;
    $query = 'UPDATE kaubad
              SET Nimetus = ?, Kategooria = ?, Tootekood = ?, Kogus = ?, Hind = ?
              WHERE Tootekood = ?';
    $stmt = mysqli_prepare($l, $query);
    mysqli_stmt_bind_param($stmt, 'sisdis', $new_product_name, $new_category_name, $new_code, $new_quantity, $new_price, $old_code);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return true;
}

function model_buy($code, $name, $category_id, $quantity, $new_quantity, $price, $new_price, $sale_value, $total_price) {
    global $l;
    $query_update = 'UPDATE kaubad
              SET Kogus = ?
              WHERE Tootekood = ?';
    $stmt_update = mysqli_prepare($l, $query_update);
    mysqli_stmt_bind_param($stmt_update, 'is', $new_quantity, $code);
    mysqli_stmt_execute($stmt_update);
    mysqli_stmt_close($stmt_update);

    $query_insert =
    'INSERT INTO kassa_logi (Toote_nimetus, Toote_kood, Toote_kategooria, Toote_kogus,Toote_hind, Toote_muudetud_hind, Allahindlus_tootelt, Toote_koguse_hind)
            VALUES (?,?,?,?,?,?,?,?)';
    $stmt_insert = mysqli_prepare($l, $query_insert);
    mysqli_stmt_bind_param($stmt_insert, 'ssiidddd', $name, $code, $category_id, $quantity, $price, $new_price, $sale_value, $total_price);
    mysqli_stmt_execute($stmt_insert);
    mysqli_stmt_close($stmt);
    return true;
}

function model_product_attribute($code) {
    global $l;
    $query = 'SELECT Id, Nimetus, Kategooria, Tootekood, Kogus, Hind FROM kaubad WHERE Tootekood = ?';
    $stmt = mysqli_prepare($l, $query);
    mysqli_stmt_bind_param($stmt, 's', $code);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $name, $category, $code, $quantity, $price);
    $values = array();
    while (mysqli_stmt_fetch($stmt)) {
        $values[] = $id;
        $values[] = $name;
        $values[] = $category;
        $values[] = $code;
        $values[] = $quantity;
        $values[] = $price;
    }
    mysqli_stmt_close($stmt);
    return $values;
}

function model_search($str) {
    global $l;
    $query = "SELECT kategooriad.Nimetus, kaubad.Nimetus, kaubad.Tootekood, kaubad.Hind, kaubad.Kogus
        	  FROM kategooriad
              JOIN kaubad
              ON kategooriad.Id = kaubad.Kategooria
              WHERE kaubad.Nimetus
              LIKE '%$str%'";
    $stmt = mysqli_prepare($l, $query);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $catName, $proName, $proCode, $proPrice, $proQuantity);
    $search = array();
    while (mysqli_stmt_fetch($stmt)) {
        $search[0] = $proName;
        $search[1] = $catName;
        $search[2] = $proCode;
        $search[3] = $proQuantity;
        $search[4] = $proPrice;
        /*$search[] = array(
            'CatName' => $catName,
            'ProName' => $proName,
            'ProCode' => $proCode,
            'ProPrice' => $proPrice,
            'ProQuantity' => $proQuantity
        );*/
    }
    mysqli_stmt_close($stmt);
    return $search;
}

function model_load_product_table() {
    global $l;
    $query = 'SELECT Id, Nimetus, Kategooria, Tootekood, Kogus, Hind FROM kaubad ORDER BY Nimetus ASC';
    $stmt = mysqli_prepare($l, $query);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $product, $category, $code, $quantity, $price);
    $rows = array();
    while (mysqli_stmt_fetch($stmt)) {
        $rows[] = array(
            'Id' => $id,
            'Product' => $product,
            'Category' => $category,
            'Code' => $code,
            'Quantity' => $quantity,
            'Price' => $price
        );
    }
    mysqli_stmt_close($stmt);
    return $rows;
}
