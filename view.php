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
          <form action="<?= $_SERVER['PHP_SELF'];?>" method="post" name="buy-product">
            <input type="hidden" name="action" value="buy-product">
            <input type="hidden" name="id" value="<?= $block['Id']; ?>">
            <table width="100%">
              <thead>
                <tr style="text-align: left">
                  <th width="34%">Toote nimetus:</th>
                  <th width="25%">Kood:</th>
                  <th width="15%">Kogus:</th>
                  <th width="20%">Hind:</th>
                  <th width="6%"></th>
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
              <button type="submit" class="submit-btn">
                Maksa
              </button>
            <button type="button" id="cancel-order-btn" class="cancel-button">
              Tühista
            </button>
          </div>
        </form>
      </div>



      <!-- Configuration container -->
      <div id="product-category-base" class="product-category-base">
        <!-- Categories and products container -->

        <div id="categories-div">
          <div class="cp-btn-container" style="display: inline-block">
            <button type="button" class="add-cp-btn" id="add-category-page" style="background-color: #CDDC39">
              +
            </button>
          </div>
          <?php foreach(model_load_catergory() as $block): ?>
            <div class="cp-btn-container" style="display: inline-block";>
              <button type="button" class="category-btn" onclick="configHideShow('cp-id-<?= $block['Id']; ?>')">
                <?= htmlspecialchars($block['Nimetus']); ?>
              </button>
              <div class="del-edit-container">
                <form action="<?= $_SERVER['PHP_SELF'];?>" method="post">
                  <input type="hidden" name="action" value="delete-category">
                  <input type="hidden" name="id" value="<?= $block['Id']; ?>">
                  <button type="submit" class="del-cp-btn">x</button>
                </form>
                <button type="button" class="edit-cp-btn" onclick="configHideShow('pe-id-<?= $block['CatId'].'-'.$block['Id']; ?>')">e</button>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <?php foreach(model_load_product() as $block): ?>
          <div class="cp-btn-container" id="cp-id-<?= $block['CatId'] ?>">
            <button type="button" class="add-cp-btn" style="background-color: #00bcd4">
              +
            </button>
          </div>
          <div class="cp-btn-container" id="cp-id-<?= $block['CatId']; ?>" >
            <button type="button" class="product-btn" id="pb-id-<?= $block['CatId'].'-'.$block['Id']; ?>" onclick="addToShoppingCart('<?= ($block['Nimetus']); ?>', '<?= ($block['Kood']); ?>', <?= ($block['Hind']); ?>)">
              <?= htmlspecialchars($block['Nimetus']); ?>
              <span style="display: none"><?= htmlspecialchars($block['Kood']); ?></span>
              <br>
              <?= htmlspecialchars($block['Hind'] . " €"); ?>
            </button>
            <div class="del-edit-container">
              <form action="<?= $_SERVER['PHP_SELF'];?>" method="post">
                <input type="hidden" name="action" value="delete-product">
                <input type="hidden" name="id" value="<?= $block['Id']; ?>">
                <button type="submit" class="del-cp-btn">x</button>
              </form>
              <button type="button" class="edit-cp-btn" onclick="configHideShow('pe-id-<?= $block['CatId'].'-'.$block['Id']; ?>')">e</button>
            </div>
          </div>

          <div id="pe-id-<?= $block['CatId'].'-'.$block['Id']; ?>" style="display: none">
            <form class="p-edit" action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
              Vorm
            </form>
          </div>
        <?php endforeach; ?>
        <!-- Category adding form -->
        <div id="category-add-div">
          <h1 id="adding-title"># Kategooria lisamine</h1>
          <form id="adding-cat-form" action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
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
                      <button type="submit" class="submit-btn" id="category-submit-btn" name="category-submit-btn">
                        Salvesta
                      </button>
                      <button type="button" class="cancel-button" id="category-cancel-button"  onclick="resetForm('adding-cat-form', 'categories-div')">
                        Tühista
                      </button>
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
                      <button type="submit"class="submit-btn" id="product-submit-btn" value="submit-product">
                        Salvesta
                      </button>
                      <button type="button" class="cancel-button" id="product-cancel-button" onclick="resetForm('adding-protuct-form', 'categories-div')">
                        Tühista
                      </button>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </form>
        </div>
      </div>
      <div id="config-button-container">
        <button type="button" id="home" class="config-button">
          << Pealeht
        </button>
        <button type="button" id="add-product-page" class="config-button">
          Lisa toode
        </button>
        <button type="button" id="change-product-page" class="config-button">
          Muuda toodet
        </button>
        <button type="button" id="delete-product" class="config-button">
          Kustuta toode
        </button>
      </div>
    </div>

    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> -->
    <script type="text/javascript" src="cashregister.js"></script>
  </body>
</html>
