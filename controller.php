<?php

/**
 * Add category controller
 */
function controller_add_category($nimetus) {
  if( $nimetus == '') {
    return false;
  }
  return model_add_category($nimetus);
}

/**
 * Add product controller
 */
function controller_add_product($nimetus, $kat_id, $kood, $hind, $kogus) {
  if ($nimetus == '' || $kat_id == '' || $kood == '' || $hind <= 0 || $kogus <= 0) {
    return false;
  }
  return model_add_product($nimetus, $kat_id, $kood, $hind, $kogus);
}

/**
 * Get category id controller
 */
function controller_category_id($category_name) {
  if ($category_name == '') {
    return false;
  }
  return model_category_id($category_name);
}

/**
 * Delete product controller
 */
function controller_delete_product($id) {
  if ($id <= 0) {
    return false;
  }
  return model_delete_product($id);
}

/**
 * Delete category controller
 */
function controller_delete_category($id) {
  if ($id <= 0) {
    return false;
  }
  return model_delete_category($id);
}

/**
 * Shopping cart controller
 */
function controller_buy($id) {
  if ($id <= 0) {
    return false;
  }
  return model_buy($id);
}

/**
 * Edit category controller
 */
function controller_edit_category($old_category_name, $new_category_name) {
  if ($old_category_name == '' || $new_category_name == '') {
    return false;
  }
  return model_edit_category($old_category_name, $new_category_name);
}

function controller_edit_product($old_code, $new_product_name, $new_category_name, $new_code, $new_quantity, $new_price) {
  if ($old_code == '' || $new_product_name == '' || $new_category_name == '' || $new_code == '' || $new_quantity == '' || $new_price == '') {
    return false;
  }
  return model_edit_product($old_code, $new_product_name, $new_category_name, $new_code, $new_quantity, $new_price);
}
