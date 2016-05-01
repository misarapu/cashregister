<?php

  header('Content-Type: text/plain; charset=utf-8');

  /*Loome faili, kuhu salvestatakse kategooriate andmed.*/
  $pro_base = 'products.txt';

  /*Kontrollitakse faili olemasolu. Juhul kui fail eksisteerib, loeme selle
  sisu uude muutujasse. Kui faili pole, loemu uude muutujasse tühja massiivi.*/
  if (file_exists($pro_base)) {
    $products = file_get_contents($pro_base);
    $products = json_decode($products, true);
  } else {
    $products = array();
  }

  /*Järgneva käivitame ainult POST päringu korral.*/
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    /*Kontrollime, kas input-des on sisendid. Kui sisendid leiduvad, määrame
    need uute muutujate väärtusteks. Kui input-d on tühjad, siis määrame
    muutujate väärtusteks vastavalt tühja stringi või 0.*/
    if (!empty($_POST['product-name-input'])) {
      $product_name = $_POST['product-name-input'];
    } else {
      $product_name = '';
    }
    if (!empty($_POST['category-drop-list'])) {
      $pro_cat_name = $_POST['category-drop-list'];
    } else {
      $pro_cat_name = '';
    }
    if (!empty($_POST['product-code-input'])) {
      $product_code = $_POST['product-code-input'];
    } else {
      $product_code = '';
    }
    if (!empty($_POST['product-price-input'])) {
      $product_price = floatval($_POST['product-price-input']);
    } else {
      $product_price = 0;
    }
    if (!empty($_POST['product-quantity-input'])) {
      $product_quantity = intval($_POST['product-quantity-input']);
    } else {
      $product_quantity = 1;
    }

    /*Kontrollime, kas sisendväärtused on oodatud kujul. Vastasel juhul väljastame
    veateate*/
    if ($product_name == '') {
      header('HTTP/1.1 400 Bad Request');
      echo json_encode(array(
        'error' => 'Incorrect category name input'
      ));
      exit;
    }

    /*Lisame kirje faili ehk lisame massiivi uue indeksi koos vormi andmetega.*/
    $categories[] = array(
      'product_name' => $product_name,
      'pro_cat_name' => $pro_cat_name,
      'product_code' => $product_code,
      'product_price' => $product_price,
      'product_quantity' => $product_quantity
    );

    /*Serialiseerime muudetud massiivi JSON stringiks ja salvestame selle faili.*/
    $products = json_encode($products);
    file_put_contents($pro_base, $products);
    echo $products;

  } else { //SIIN LÕPPEB POST PÄRING
    echo json_encode($products);
  }

 ?>
