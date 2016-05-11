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
    case 'edit-category':
      $old_category_name = $_POST['old-c-name'];
      $new_category_name = $_POST['new-c-name'];
      $return = controller_edit_category($old_category_name, $new_category_name);
      break;
    case 'edit-product':
      $old_code = $_POST['old-p-code'];
      $new_product_name = $_POST['new-p-name'];
      $new_category_name = intval(controller_category_id($_POST['new-p-category']));
      $new_code = $_POST['new-p-code'];
      $new_quantity = intval($_POST['new-p-quantity']);
      $new_price = $_POST['new-p-price'];
      $return = controller_edit_product($old_code, $new_product_name, $new_category_name, $new_code, $new_quantity, $new_price);
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
