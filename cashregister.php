<?php

session_start();

require 'model.php';
require 'controller.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $result = false;

  switch ($_POST['action']) {
    case 'add-category':
      $category_name = $_POST['category-input'];
      $result = controller_add_category($category_name);
      break;
    case 'add-product':
      $product_name = $_POST['product-name-input'];
      $category_id = controller_category_id($_POST['category-drop-list']);
      $product_code = $_POST['product-code-input'];
      $product_price = $_POST['product-price-input'];
      $product_quantity = $_POST['product-quantity-input'];
      $result = controller_add_product($product_name, $category_id, $product_code, $product_price, $product_quantity);
      break;
    case 'delete-category':
      $id = intval($_POST['id']);
      $result = controller_delete_category($id);
      break;
    case 'delete-product':
      $id = intval($_POST['id']);
      $result = controller_delete_product($id);
      break;
    case 'buy-product':
      $id = intval($_POST['id']);
      $result = controller_buy($id);
      break;
  }

  if ($result) {
    header('Location: '.$_SERVER['PHP_SELF']);
  } else {
    header('Content-type: text/plain; charset=utf-8');
    echo 'Päring ebaõnnetus!';
  }

  exit;
}

require 'view.php';
mysqli_close($l);
