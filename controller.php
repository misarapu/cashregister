<?php

function controller_add_category($nimetus) {
  if( $nimetus == '') {
    return false;
  }
  return model_add_category($nimetus);
}

function controller_add_product($nimetus, $kat_id, $kood, $hind, $kogus) {
  if ($nimetus == '' || $kat_id == '' || $kood == '' || $hind == '' || $kogus == '') {
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
