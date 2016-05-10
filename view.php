<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Kassa</title>
    <link rel="stylesheet" type="text/css" href="view.css">
  </head>
  <body>

    <!-- Main container -->
    <div id="main-container">

      <!-- Main title -->
      <div id="main-container-title">
        # Kassa
      </div>
      <!-- END main title -->

      <!-- Shopping cart -->
      <div id="active-container">
        <span id="order-header">Tooted:</span>
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
            <button type="submit" class="submit-btn" style="background-color: #CDDC39">
              Maksa
            </button>
            <button type="button" id="cancel-order-btn" class="cancel-button" style="background-color: #FF5C33">
              Tühista
            </button>
          </div>
        </form>
      </div>
      <!-- END shopping cart-->

      <!-- Category-product button main container -->
      <div id="product-category-base" class="product-category-base">
        <!-- Categories and products container -->

        <!-- Category button main div -->
        <div id="categories-div">
          <div class="cp-btn-container" style="display: inline-block">
            <button type="button" class="add-cp-btn" id="add-category-page" style="background-color: #CDDC39">
              <img class="logo-img" src="Plus-64.png" alt="Add Logo"/>
            </button>
          </div>
          <?php foreach(model_load_catergory() as $block): ?>
            <div class="cp-btn-container" style="display: inline-block";>
              <button type="button" class="category-btn" style="background-color: #CDDC39" onclick="configHideShow('cp-id-<?= $block['Id']; ?>')">
                <?= htmlspecialchars($block['Name']); ?>
              </button>
              <div class="del-edit-container">
                <form action="<?= $_SERVER['PHP_SELF'];?>" method="post">
                  <input type="hidden" name="action" value="delete-category">
                  <input type="hidden" name="id" value="<?= $block['Id']; ?>">
                  <button type="submit" class="del-cp-btn">x</button>
                </form>
                <button type="button" class="edit-cp-btn" onclick="configHideShow('c-edit-<?= $block['Id']; ?>')">e</button>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <!-- END category button main div -->

        <!-- Category edit divs -->
        <?php foreach(model_load_catergory() as $block): ?>
          <div class="c-edit-container" id="c-edit-<?= $block['Id']; ?>">
            <h1 id="adding-title"># Kategooria <?= $block['Name']; ?> muutmine</h1>
            <form id="editing-cat-form" action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
              <input type="hidden" name="action" value="edit-category">
              <table>
                <tbody>
                  <tr>
                    <th id="row-title">Uus nimetus:</th>
                    <td><input type="text" id="category-input" name="new-c-name" style="width: 200px"></td>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <div class="input-button-container">
                        <button type="button" id="small-menu-btn" onclick="configHideShow('categories-div')">
                          <img class="logo-img" src="Back-64.png" alt="Back Logo" />
                        </button>
                        <button type="submit" class="submit-btn" id="category-submit-btn" name="category-submit-btn" style="background-color: #CDDC39">
                          Salvesta
                        </button>
                        <button type="button" class="cancel-button" id="category-cancel-button"  style="background-color: #FF5C33" onclick="resetForm('editing-cat-form', 'c-edit-<?= $block['Id']; ?>')">
                          Tühista
                        </button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div>
        <?php endforeach; ?>
        <!-- END category edit divs -->

        <!-- From product divs back to category main div -->
        <?php foreach(model_load_catergory() as $block): ?>
          <div class="cp-btn-container" id="cp-id-<?= $block['Id']; ?>">
            <button type="button" class="add-cp-btn" style="background-color: #00bcd4" onclick="configHideShow('categories-div')">
              <img class="logo-img" src="Back-64.png" alt="Back Logo" />
            </button>
          </div>
          <div class="cp-btn-container" id="cp-id-<?= $block['Id'] ?>">
            <button type="button" class="add-cp-btn" style="background-color: #00bcd4" onclick="addProduct('<?= $block['Name']; ?>')">
              <img class="logo-img" src="Plus-64.png" alt="Add Logo" />
            </button>
          </div>
        <?php endforeach; ?>
        <!-- END from product divs back to category main div -->

          <!-- Products buttons -->
          <?php foreach(model_load_product() as $block): ?>
          <div class="cp-btn-container" id="cp-id-<?= $block['CatId']; ?>" >
            <button type="button" class="product-btn" id="pb-id-<?= $block['CatId'].'-'.$block['ProId']; ?>" style="background-color: #00bcd4" onclick="addToShoppingCart('<?= ($block['ProName']); ?>', '<?= ($block['ProCode']); ?>', <?= ($block['ProPrice']); ?>)">
              <?= htmlspecialchars($block['ProName']); ?>
              <span style="display: none"><?= htmlspecialchars($block['ProCode']); ?></span>
              <br>
              <?= htmlspecialchars($block['ProPrice'] . " €"); ?>
            </button>
            <div class="del-edit-container">
              <form action="<?= $_SERVER['PHP_SELF'];?>" method="post">
                <input type="hidden" name="action" value="delete-product">
                <input type="hidden" name="id" value="<?= $block['ProId']; ?>">
                <button type="submit" class="del-cp-btn">x</button>
              </form>
              <button type="button" class="edit-cp-btn" onclick="configHideShow('pe-id-<?= $block['CatId'].'-'.$block['ProId']; ?>')">e</button>
            </div>
          </div>
          <div id="pe-id-<?= $block['CatId'].'-'.$block['ProId']; ?>" style="display: none">
            <form class="p-edit" action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
              Vorm
            </form>
          </div>
        <?php endforeach; ?>
        <!-- END products buttons -->

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
                      <button type="button" id="small-menu-btn" onclick="configHideShow('categories-div')">
                        <img class="logo-img" src="Back-64.png" alt="Back Logo" />
                      </button>
                      <button type="submit" class="submit-btn" id="category-submit-btn" name="category-submit-btn" style="background-color: #CDDC39">
                        Salvesta
                      </button>
                      <button type="button" class="cancel-button" id="category-cancel-button"  style="background-color: #FF5C33" onclick="resetForm('adding-cat-form', 'categories-div')">
                        Tühista
                      </button>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </form>
        </div>
        <!-- END category adding form -->

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
                      <option value="<?= htmlspecialchars($block['Name']); ?>"><?= htmlspecialchars($block['Name']); ?></option>
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
                      <button type="button" id="small-menu-btn" onclick="configHideShow('categories-div')">
                        <
                      </button>
                      <button type="submit"class="submit-btn" id="product-submit-btn" value="submit-product" style="background-color:#CDDC39">
                        Salvesta
                      </button>
                      <button type="button" class="cancel-button" id="product-cancel-button" style="background-color:#FF5C33" onclick="resetForm('adding-protuct-form', 'categories-div')">
                        Tühista
                      </button>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </form>
        </div>
        <!-- END product adding form -->
      </div>
      <!-- END Category-product button main container -->

      <!-- Menu buttons -->
      <div id="menu-btn-container">
        <button type="button" id="small-menu-btn" style="height: 70px; width: 70px" onclick="configHideShow('categories-div')">
          <img class="logo-img" src="Home-64.png" alt="Home Logo"/>
        </button>
        <button type="button" id="small-menu-btn" style="height: 70px; width: 70px" onclick="configHideShow('categories-div')">
          <img class="logo-img" src="Search-64.png" alt="Search Logo"/>
        </button>
        <button type="button" id="small-menu-btn" style="height: 70px; width: 70px" onclick="configHideShow('categories-div')">
          <img class="logo-img" src="Database-64.png" alt="Search Logo"/>
        </button>
        <button type="button" id="small-menu-btn" style="height: 70px; width: 70px" onclick="configHideShow('categories-div')">
          <img class="logo-img" src="Settings-64.png" alt="Search Logo"/>
        </button>
        <button type="button" id="small-menu-btn" style="height: 70px; width: 70px" onclick="configHideShow('categories-div')">
          #
        </button>
        <button type="button" id="small-menu-btn" style="height: 70px; width: 70px" onclick="configHideShow('categories-div')">
          #
        </button>
        <button type="button" id="small-menu-btn" style="height: 70px; width: 70px" onclick="configHideShow('categories-div')">
          #
        </button>
      </div>
      <!-- END menu buttons -->
    </div>
    <!-- END main container -->
    <script type="text/javascript" src="cashregister.js"></script>
  </body>
</html>
