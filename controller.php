<?php

function controller_add_category($nimetus) {
  if( $nimetus == '') {
    return false;
  }
  return model_add_category($nimetus);
}

function controller_add_product($nimetus, $kat_id, $kood, $hind, $kogus) {
  if ($nimetus == '' || $kat_id == '' || $kood == '' || $hind <= 0 || $kogus <= 0) {
    return false;
  }
  return model_add_product($nimetus, $kat_id, $kood, $hind, $kogus);
}

function controller_category_id($category_name) {
  if ($category_name == '') {
    return false;
  }
  return model_category_id($category_name);
}

function controller_delete_product($id) {
  if ($id <= 0) {
    return false;
  }
  return model_delete_product($id);
}

function controller_delete_category($id) {
  if ($id <= 0) {
    return false;
  }
  return model_delete_category($id);
}
