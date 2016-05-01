<?php

  header('Content-Type: text/plain; charset=utf-8');

  /*Loome faili, kuhu salvestatakse kategooriate andmed.*/
  $cat_base = 'categories.txt';

  /*Kontrollitakse faili olemasolu. Juhul kui fail eksisteerib, loeme selle
  sisu uude muutujasse. Kui faili pole, loemu uude muutujasse tühja massiivi.*/
  if (file_exists($cat_base)) {
    $categories = file_get_contents($cat_base);
    $categories = json_decode($categories, true);
  } else {
    $categories = array();
  }

  /*Järgneva käivitame ainult POST päringu korral.*/
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    /*Kontrollime, kas inputis on sisend. Kui sisend leidub, määrame selle uude
    muutuja väärtuseks. Kui input on tühi, siis määrame muutuja väärtuseks tühja
    stringi.*/
    if (!empty($_POST['category-input'])) {
      $category_name = $_POST['category-input'];
    } else {
      $category_name = '';
    }

    /*Kontrollime, kas sisendväärtused on oodatud kujul. Vastasel juhul väljastame
    veateate*/
    if ($category_name == '') {
      header('HTTP/1.1 400 Bad Request');
      echo json_encode(array(
        'error' => 'Incorrect category name input'
      ));
      exit;
    }

    /*Lisame kirje faili ehk lisame massiivi uue indeksi koos vormi andmetega.*/
    $categories[] = array(
      'category_name' => $category_name
    );

    /*Serialiseerime muudetud massiivi JSON stringiks ja salvestame selle faili.*/
    $categories = json_encode($categories);
    file_put_contents($cat_base, $categories);
    echo $categories;

  } else { //SIIN LÕPPEB POST PÄRING
    echo json_encode($categories);
  }

 ?>
