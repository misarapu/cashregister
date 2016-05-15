<?php
    require 'model.php';




    foreach (model_search($_POST['search_value']) as $value) {
        echo '
        <tr>
            <td><input type="text" name="table-product" value="' .  $value[0] . '"></td>
            <td><input type="text" name="table-category" value="' .  $value[1] . '"></td>
            <td><input type="text" name="table-code" value="' .  $value[2] . '"></td>
            <td><input type="number" name="table-quantity" value="' .  $value[3] . '"></td>
            <td><input type="number" name="table-price" value="' .  $value[4] . '"></td>
        </tr>
        ';
    }
