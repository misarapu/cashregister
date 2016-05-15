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
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                        <button type="submit" class="submit-btn" style="background-color: #CDDC39">
                            Maksa
                        </button>
                        <button type="button" id="cancel-order-btn" class="cancel-btn" style="background-color: #FF5C33">
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
                        <button type="button" class="add-cp-btn" id="add-category-page" style="background-color: #CDDC39" onclick="configHideShow('category-add-div')">
                            <img class="logo-img" src="./Icons/Plus-64.png" alt="Add Logo"/>
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
                                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                                    <button type="submit" class="del-cp-btn">
                                        <img class="logo-img" src="./Icons/Delete-64.png" alt="Add Logo"/>
                                    </button>
                                </form>
                                <button type="button" class="edit-cp-btn" onclick="showCategoryEdit('<?= $block['Name']; ?>', '<?= $_SERVER['PHP_SELF']; ?>')">
                                    <img class="logo-img" src="./Icons/Edit-64.png" alt="Add Logo"/>
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <!-- END category button main div -->

                <!-- From product divs back to category main div -->
                <?php foreach(model_load_catergory() as $block): ?>
                    <div class="cp-btn-container" id="cp-id-<?= $block['Id']; ?>">
                        <button type="button" class="add-cp-btn" style="background-color: #00bcd4" onclick="configHideShow('categories-div')">
                            <img class="logo-img" src="./Icons/Back-64.png" alt="Back Logo" />
                        </button>
                    </div>

                    <div class="cp-btn-container" id="cp-id-<?= $block['Id'] ?>">
                        <button type="button" class="add-cp-btn" style="background-color: #00bcd4" onclick="addProduct('<?= $block['Name']; ?>')">
                            <img class="logo-img" src="./Icons/Plus-64.png" alt="Add Logo" />
                        </button>
                    </div>
                <?php endforeach; ?>
                <!-- END from product divs back to category main div -->

                <!-- Products buttons -->
                <?php foreach(model_load_product() as $block): ?>
                    <div class="cp-btn-container" id="cp-id-<?= $block['CatId']; ?>" >
                        <button type="button" class="product-btn" id="pb-id-<?= $block['CatId'].'-'.$block['ProId']; ?>" style="background-color: #00bcd4" onclick="addToShoppingCart('<?= $block['ProName']; ?>', '<?= $block['ProCode']; ?>', <?= $block['ProPrice']; ?>, <?= $block['ProQuantity']; ?>)">
                            <?= htmlspecialchars($block['ProName']); ?>
                            <span style="display: none"><?= htmlspecialchars($block['ProCode']); ?></span>
                            <br>
                            <?= htmlspecialchars(number_format((float)$block['ProPrice'], 2, '.', '') . " €"); ?>
                        </button>
                        <div class="del-edit-container">
                            <form action="<?= $_SERVER['PHP_SELF'];?>" method="post">
                                <input type="hidden" name="action" value="delete-product">
                                <input type="hidden" name="id" value="<?= $block['ProId']; ?>">
                                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                                <button type="submit" class="del-cp-btn">
                                    <img class="logo-img" src="./Icons/Delete-64.png" alt="Add Logo"/>
                                </button>
                            </form>
                            <button type="button" class="edit-cp-btn" onclick="showProductEdit('<?= $block['ProName']; ?>', '<?= $block['CatName']; ?>', '<?= $block['ProCode']; ?>', '<?= $block['ProQuantity']; ?>', '<?= $block['ProPrice']; ?>', '<?= $_SERVER['PHP_SELF']; ?>')">
                                <img class="logo-img" src="./Icons/Edit-64.png" alt="Add Logo"/>
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
                <!-- END products buttons -->

                <!-- Category adding form -->
                <div id="category-add-div">
                    <h1 id="adding-title"># Kategooria lisamine</h1>
                    <form id="adding-cat-form" action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                        <input type="hidden" name="action" value="add-category">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                        <table>
                            <tbody>
                                <tr>
                                    <th id="row-title">Kategooria nimetus:</th>
                                    <td><input type="text" id="category-input" name="category-input" style="width: 200px"></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="input-button-container">
                                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                                            <button type="submit" class="submit-btn" id="category-submit-btn" name="category-submit-btn" style="background-color: #CDDC39">
                                                Salvesta
                                            </button>
                                            <button type="button" class="cancel-btn" id="category-cancel-btn"    style="background-color: #FF5C33" onclick="resetForm('adding-cat-form', 'categories-div')">
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
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
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
                                            <option class="category-option" disabled selected>Vali ...</option>
                                            <?php foreach (model_load_catergory() as $block): ?>
                                            <option class="category-option" value="<?= htmlspecialchars($block['Name']); ?>"><?= htmlspecialchars($block['Name']); ?></option>
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
                                            <button type="submit" class="submit-btn" id="product-submit-btn" value="submit-product" style="background-color:#CDDC39">
                                                Salvesta
                                            </button>
                                            <button type="button" class="cancel-btn" id="product-cancel-btn" style="background-color:#FF5C33" onclick="resetForm('adding-protuct-form', 'categories-div')">
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

                <!-- Search div -->
                <div id="search-div" style="display: none">
                    <h1>Otsing</h1>
                    <div id="div-search">
                            <input type="hidden" name="action" value="search">
                                <table>
                                    <tr>
                                        <td>Nimi/kood:</td>
                                        <td><input type="text" id="search-value" name="search-value" onkeypress="ajax_search();"></td>
                                        <td><button type="submit">Otsi</button></td>
                                        <td><button type="submit">Muuda</button></td>
                                    </tr>
                                </table>
                    </div>
                    <div id="div-products-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Toode</th>
                                    <th>Kategooria</th>
                                    <th>Kood</th>
                                    <th>Kogus</th>
                                    <th>Hind</th>
                                </tr>
                                <tbody id="tbody-search">
                                    <?php foreach (model_load_product_table() as $value): ?>
                                        <tr>
                                            <td><input type="text" name="table-product" value="<?= $value['Product']; ?>"></td>
                                            <td><input type="text" name="table-category" value="<?= $value['Category']; ?>"></td>
                                            <td><input type="text" name="table-code" value="<?= $value['Code']; ?>"></td>
                                            <td><input type="number" name="table-quantity" value="<?= $value['Quantity']; ?>"></td>
                                            <td><input type="number" name="table-price" value="<?= $value['Price']; ?>"></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </thead>
                        </table>
                    </div>
                </div>
                <!-- END search div -->

            </div>
            <!-- END category-product button main container -->

            <!-- Menu buttons -->
            <div id="menu-btn-container">
                <button type="button" class="small-menu-btn" style="height: 70px; width: 70px" onclick="home()">
                    <img class="logo-img" src="./Icons/Home-64.png" alt="Home Logo"/>
                </button>
                <button type="submit" class="small-menu-btn" style="height: 70px; width: 70px" onclick="configHideShow('search-div')">
                    <img class="logo-img" src="./Icons/Search-64.png" alt="Search Logo"/>
                </button>
                <button type="button" class="small-menu-btn" style="height: 70px; width: 70px" onclick="configHideShow('categories-div')">
                    <img class="logo-img" src="./Icons/Futures-64.png" alt="History Logo"/>
                </button>
                <button type="button" class="small-menu-btn" style="height: 70px; width: 70px" onclick="configHideShow('categories-div')">
                    <img class="logo-img" src="./Icons/Coins-64.png" alt="History Logo"/>
                </button>
                <a href="http://enos.itcollege.ee/phpmyadmin/" target="_blank">
                    <button type="button" class="small-menu-btn" style="height: 70px; width: 70px" onclick="configHideShow('categories-div')">
                        <img class="logo-img" src="./Icons/Database-64.png" alt="Database Logo"/>
                    </button>
                </a>
                <button type="button" class="small-menu-btn" style="height: 70px; width: 70px" onclick="configHideShow('categories-div')">
                    <img class="logo-img" src="./Icons/Settings-64.png" alt="Search Logo"/>
                </button>
                <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                    <input type="hidden" name="action" value="logout">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                    <button type="submit" class="small-menu-btn" style="height: 70px; width: 70px">
                        <img class="logo-img" src="./Icons/Logout_Rounded-64.png" alt="Logout Logo"/>
                    </button>
                </form>
            </div>
            <!-- END menu buttons -->
        </div>
        <!-- END main container -->
        <script type="text/javascript" src="cashregister.js"></script>
    </body>
</html>
