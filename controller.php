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

function controller_product_quantity($code) {
    if ($code == '') {
        return false;
    }
    return model_product_quantity($code);
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
function controller_buy($code, $new_quantity) {
    if ($code == '' || $new_quantity < 0) {
        echo "negatiivne";
        return false;
    }
    return model_buy($code, $new_quantity);
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

/**
 * Edit product controller
 */
function controller_edit_product($old_code, $new_product_name, $new_category_name, $new_code, $new_quantity, $new_price) {
    if ($old_code == '' || $new_product_name == '' || $new_category_name == '' || $new_code == '' || $new_quantity == '' || $new_price == '') {
        return false;
    }
    return model_edit_product($old_code, $new_product_name, $new_category_name, $new_code, $new_quantity, $new_price);
}
