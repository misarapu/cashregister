<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Kassa</title>
    <link rel="stylesheet" type="text/css" href="view.css">
  </head>
  <body>
    <div id="container">
      <div id="container-title">
        # Kassa
      </div>
      <div id="active-container">
        <span id="order-header">Tooted:</span>

        <!-- Active products -->
        <div id="order-list">
          <table width="100%">
            <thead>
              <tr style="text-align: left">
                <th width="50%">Toote nimetus:</th>
                <th width="20%">Kogus:</th>
                <th width="20%">Hind:</th>
                <th width="10%"></th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
        <div id="cost-container">
          <div id="cost-title">Summa:</div>
          <div id="cost-total">0.00 €</div>
        </div>
        <div id="active-button-container">
          <input type="button" name="buy-button" class="active-button" style="background-color: #99cc00" value="Maksa">
          <input type="button" name="cancel-button" class="active-button" style="background-color: #ff5c33" value="Tühista">
        </div>
      </div>

      <!-- Configuration container -->
      <div id="product-category-base" class="product-category-base">
        <!-- Categories and products container -->
        <div id="category-product-buttons-div">
          <?php foreach(model_load_catergory() as $block): ?>
            <form class="c-id-<?= $block['Id']; ?>" action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
              <input type="hidden" name="action" value="category-btn">
              <input type="hidden" name="id" value="<?= $block['Id']; ?>">
              <button type="submit" class="category-btn">
                <?= htmlspecialchars($block['Nimetus']); ?>
              </button>
            </form>
          <?php endforeach; ?>
          <?php foreach(model_load_product() as $block): ?>
            <form class="cp-id-<?= $block['CatId']; ?>" action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
              <input type="hidden" name="action" value="product-btn">
              <input type="hidden" name="id" value="<?= $block['Id']; ?>">
              <button type="submit" class="product-btn">
                <?= htmlspecialchars($block['Nimetus']); ?>
                <br>
                <?= htmlspecialchars($block['Hind'] . " €"); ?>
              </button>
            </form>
          <?php endforeach; ?>
        </div>
        <!-- Category adding form -->
        <div id="category-add-div">
          <h1 id="adding-title"># Kategooria lisamine</h1>
          <form id="adding-cat-form" method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="action" value="add-category">
            <table>
              <tbody>
                <tr>
                  <th id="row-title">Kategooria nimetus:</th>
                  <td><input type="text" id="category-input" name="category-input" style="width: 200px"></td>
                </tr>
                <tr>
                  <td colspan="2">
                    <div class="input-button-container">
                      <input type="submit" id="category-save-button" name="category-save-button" style="background-color: #99cc00" value="Salvesta">
                      <input type="button" id="category-cancel-button" style="background-color: #ff5c33" value="Tühista">
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </form>
        </div>
        <!-- Product adding form -->
        <div id="product-add-div">
          <h1 id="adding-title"># Toote lisamine</h1>
          <form id="adding-protuct-form" method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="action" value="add-product">
            <table>
              <tbody>
                <tr>
                  <th>Toote nimetus:</th>
                  <td><input id="product-name-input" name="product-name-input" type="text" style="width: 200px"></td>
                </tr>
                <tr>
                  <th>Toote kategooria:</th>
                  <td>
                    <select id="category-drop-list" name="category-drop-list" style="width: 204px">
                      <option disabled selected>Vali ...</option>
                      <?php foreach (model_load_catergory() as $block): ?>
                      <option value="<?= htmlspecialchars($block['Nimetus']); ?>"><?= htmlspecialchars($block['Nimetus']); ?></option>
                      <?php endforeach; ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <th>Toote kood:</th>
                  <td><input type="text" id="product-code-input" name="product-code-input" style="width: 200px"></td>
                </tr>
                <tr>
                  <th>Toote hind:</th>
                  <td><input type="number" id="product-price-input" name="product-price-input" value="0.00" step="0.01" min="0" style="width: 80px; text-align: right"></td>
                </tr>
                <tr>
                  <th>Toote kogus:</th>
                  <td><input type="number" id="product-quantity-input" name="product-quantity-input" value="0" min="0" style="width: 80px; text-align: right"></td>
                </tr>
                <tr>
                  <td colspan="2">
                    <div class="input-button-container">
                      <input type="submit" id="product-save-button" class="input-button" style="background-color: #99cc00" value="Salvesta">
                      <input type="button" class="input-button" style="background-color: #ff5c33" value="Tühista">
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </form>
        </div>
      </div>

      <div id="config-button-container">
        <input type="button" id="home" class="config-button" value="<< Pealeht">
        <input type="button" id="add-category-page" class="config-button" value="Lisa kategooria">
        <input type="button" id="add-product-page" class="config-button" value="Lisa toode">
        <input type="button" id="change-product-page" class="config-button" value="Muuda toodet">
        <input type="button" id="delete-product" class="config-button" value="Kustuta toode">
      </div>
    </div>

    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> -->
    <script type="text/javascript" src="cashregister.js"></script>
  </body>
</html>
