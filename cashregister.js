'use strict';

/*----------------------------------------------------------------------------*/
/*                            DISPLAYING DIVS                                 */
/*----------------------------------------------------------------------------*/

function addProduct(categoryName) {
     configHideShow('product-add-div');
     document.getElementById('category-drop-list').value = categoryName;
}

function addCategory(categoryName) {
    configHideShow('category-add-div');
    document.getElementById('category-input').value = categoryName;
}
/**
 * Configuration buttons displaying function
 * Kuvatakse soovitav div.
 * @param {String} div, mida soovitakse kuvada.
 */
function configHideShow(showDivId) {
    var divs = document.getElementById('product-category-base').children;
    for(var i = 0; i < divs.length; i++) {
        if(divs[i].id == showDivId){
            divs[i].style.display = 'block';
        } else {
            divs[i].style.display = 'none';
        }
    }
}

function removeEdit() {
    if (document.getElementById('category-edit-div')) {
        document.getElementById('product-category-base').removeChild(
            document.getElementById('category-edit-div')
        );
    }
    if (document.getElementById('product-edit-div')) {
        document.getElementById('product-category-base').removeChild(
            document.getElementById('product-edit-div')
        );
    }
}

function home() {
    removeEdit();
    configHideShow('categories-div');
}

//============================================================================================
function showProductEdit(oldProductName, oldCategoryName, oldCode, oldQuantity, oldPrice, action) {

    // Get elements
    var divMain = document.getElementById('product-category-base');
    // Create elements
    var divEdit = document.createElement('div');
    var title = document.createElement('h1');
    var form = document.createElement('form');
    var inputHidden = document.createElement('input');
    var inputOldName = document.createElement('input');
    var inputOldCategory = document.createElement('input');
    var inputOldCode = document.createElement('input');
    var inputOldQuantity = document.createElement('input');
    var inputOldPrice = document.createElement('input');
    var inputName = document.createElement('input');
    var inputCategory = document.createElement('select');
    var inputCode = document.createElement('input');
    var inputQuantity = document.createElement('input');
    var inputPrice = document.createElement('input');
    var table = document.createElement('table');
    var tbody = document.createElement('tbody');
    var trName = document.createElement('tr');
    var trCategory = document.createElement('tr');
    var trCode = document.createElement('tr');
    var trQuantity = document.createElement('tr');
    var trPrice = document.createElement('tr');
    var trButtons = document.createElement('tr');
    var thName = document.createElement('th');
    var thCategory = document.createElement('th');
    var thCode = document.createElement('th');
    var thQuantity = document.createElement('th');
    var thPrice = document.createElement('th');
    var tdInputName = document.createElement('td');
    var tdInputCategory = document.createElement('td');
    var tdInputCode = document.createElement('td');
    var tdInputQuantity = document.createElement('td');
    var tdInputPrice = document.createElement('td');
    var tdButtons = document.createElement('td');
    var divButtons = document.createElement('div');
    var buttonSave = document.createElement('button');
    var buttonCancel = document.createElement('button');

    // Set values, attributes and style
    divEdit.setAttribute('id', 'product-edit-div');
    title.textContent = "Muuda toode '" + oldProductName + "'";
    form.setAttribute('id', 'editing-pro-form');
    form.setAttribute('action', action);
    form.setAttribute('method', 'post');

    inputHidden.setAttribute('type', 'hidden');
    inputHidden.setAttribute('name', 'action');
    inputHidden.setAttribute('value', 'edit-product');
    inputOldName.setAttribute('type', 'hidden');
    inputOldName.setAttribute('name', 'old-p-name');
    inputOldName.setAttribute('value', oldProductName);
    inputOldCategory.setAttribute('type', 'hidden');
    inputOldCategory.setAttribute('name', 'old-p-category');
    inputOldCategory.setAttribute('value', oldCategoryName);
    inputOldCode.setAttribute('type', 'hidden');
    inputOldCode.setAttribute('name', 'old-p-code');
    inputOldCode.setAttribute('value', oldCode);
    inputOldQuantity.setAttribute('type', 'hidden');
    inputOldQuantity.setAttribute('name', 'old-p-quantity');
    inputOldQuantity.setAttribute('value', oldQuantity);
    inputOldPrice.setAttribute('type', 'hidden');
    inputOldPrice.setAttribute('name', 'old-p-price');
    inputOldPrice.setAttribute('value', oldPrice);

    thName.textContent = "Uus nimetus:";
    thCategory.textContent = "Uus kategooria:";
    thCode.textContent = "Uus kood:";
    thQuantity.textContent = "Uus kogus:";
    thPrice.textContent = "Uus hind:";

    inputName.setAttribute('type', 'text');
    inputName.setAttribute('name', 'new-p-name');
    inputName.setAttribute('value', oldProductName);
    inputName.style.width = '200px';
    inputCategory.setAttribute('name', 'new-p-category');
    inputCategory.style.width = '204px';
    inputCode.setAttribute('type', 'text');
    inputCode.setAttribute('name', 'new-p-code');
    inputCode.setAttribute('value', oldCode);
    inputCode.style.width = '200px';
    inputQuantity.setAttribute('type', 'number');
    inputQuantity.setAttribute('name', 'new-p-quantity');
    inputQuantity.setAttribute('value', oldQuantity);
    inputQuantity.style.width = '80px';
    inputQuantity.style.textAlign = 'right';
    inputQuantity.setAttribute('min', '0');
    inputPrice.setAttribute('type', 'number');
    inputPrice.setAttribute('name', 'new-p-price');
    inputPrice.setAttribute('value', oldPrice);
    inputPrice.style.width = '80px';
    inputPrice.style.textAlign = 'right';
    inputPrice.setAttribute('min', '0');
    inputPrice.setAttribute('step', '0.01');

    tdButtons.setAttribute('colspan', '2');
    divButtons.setAttribute('class', 'input-button-container');
    buttonSave.setAttribute('type', 'submit');
    buttonSave.setAttribute('class', 'submit-btn');
    buttonSave.setAttribute('id', 'p-edit-submit-btn');
    buttonSave.style.backgroundColor = "#CDDC39";
    buttonSave.textContent = "Salvesta";
    buttonCancel.setAttribute('type', 'button');
    buttonCancel.setAttribute('class', 'cancel-btn');
    buttonCancel.setAttribute('id', 'p-edit-cancel-btn');
    buttonCancel.style.backgroundColor = "#FF5C33";
    buttonCancel.textContent = "Tühista";
    // Bind elements
    divMain.appendChild(divEdit);
    divEdit.appendChild(title);
    divEdit.appendChild(form);
    form.appendChild(inputHidden);
    form.appendChild(inputOldName);
    form.appendChild(inputOldCategory);
    form.appendChild(inputOldCode);
    form.appendChild(inputOldQuantity);
    form.appendChild(inputOldPrice);
    form.appendChild(table);
    table.appendChild(tbody);
    tbody.appendChild(trName);
    tbody.appendChild(trCategory);
    tbody.appendChild(trCode);
    tbody.appendChild(trQuantity);
    tbody.appendChild(trPrice);
    tbody.appendChild(trButtons);
    trName.appendChild(thName);
    trName.appendChild(tdInputName);
    trCategory.appendChild(thCategory);
    trCategory.appendChild(tdInputCategory);
    trCode.appendChild(thCode);
    trCode.appendChild(tdInputCode);
    trQuantity.appendChild(thQuantity);
    trQuantity.appendChild(tdInputQuantity);
    trPrice.appendChild(thPrice);
    trPrice.appendChild(tdInputPrice);
    trButtons.appendChild(tdButtons);
    tdInputName.appendChild(inputName);
    tdInputCategory.appendChild(inputCategory);
    tdInputCode.appendChild(inputCode);
    tdInputQuantity.appendChild(inputQuantity);
    tdInputPrice.appendChild(inputPrice);
    tdButtons.appendChild(divButtons);
    divButtons.appendChild(buttonSave);
    divButtons.appendChild(buttonCancel);

    var optionsCategory = document.getElementsByClassName('category-option');
    var categoryArray = new Array(optionsCategory.length);
    for (var i = 0; i < optionsCategory.length; i++) {
        categoryArray[i] = document.createElement('option');
        categoryArray[i].value = optionsCategory[i].value;
        categoryArray[i].textContent = optionsCategory[i].textContent;
        if(categoryArray[i].value == oldCategoryName) {
            categoryArray[i].setAttribute('selected', 'true');
        }
        inputCategory.appendChild(categoryArray[i]);
    }
    categoryArray[0].setAttribute('disabled', 'true');

    configHideShow('product-edit-div');

    buttonSave.addEventListener('click', function(event) {
        //divMain.removeChild(divEdit);
        //configHideShow('categories-div');
    });

    buttonCancel.addEventListener('click', function(event) {
        divMain.removeChild(divEdit);
        configHideShow('categories-div');
    });

}


//============================================================================

function showCategoryEdit(oldCategoryName, action) {
    // Get elements
    var divMain = document.getElementById('product-category-base');
    // Create elements
    var divEdit = document.createElement('div');
    var title = document.createElement('h1');
    var form = document.createElement('form');
    var inputHidden = document.createElement('input');
    var inputOldName = document.createElement('input');
    var inputName = document.createElement('input');
    var table = document.createElement('table');
    var tbody = document.createElement('tbody');
    var trName = document.createElement('tr');
    var trButtons = document.createElement('tr');
    var thName = document.createElement('th');
    var tdInputName = document.createElement('td');
    var tdButtons = document.createElement('td');
    var divButtons = document.createElement('div');
    var buttonSave = document.createElement('button');
    var buttonCancel = document.createElement('button');
    // Set values, attributes and style
    divEdit.setAttribute('id', 'category-edit-div');
    title.textContent = "Muuda kategooria '" + oldCategoryName + "'";
    form.setAttribute('id', 'editing-cat-form');
    form.setAttribute('action', action);
    form.setAttribute('method', 'post');
    inputHidden.setAttribute('type', 'hidden');
    inputHidden.setAttribute('name', 'action');
    inputHidden.setAttribute('value', 'edit-category');
    inputOldName.setAttribute('type', 'hidden');
    inputOldName.setAttribute('name', 'old-c-name');
    inputOldName.setAttribute('value', oldCategoryName);
    thName.textContent = "Kategooria uus nimetus:";
    inputName.setAttribute('type', 'text');
    inputName.setAttribute('name', 'new-c-name');
    inputName.setAttribute('value', oldCategoryName);
    tdButtons.setAttribute('colspan', '2');
    divButtons.setAttribute('class', 'input-button-container');
    buttonSave.setAttribute('type', 'submit');
    buttonSave.setAttribute('class', 'submit-btn');
    buttonSave.setAttribute('id', 'c-edit-submit-btn');
    buttonSave.style.backgroundColor = "#CDDC39";
    buttonSave.textContent = "Salvesta";
    buttonCancel.setAttribute('type', 'button');
    buttonCancel.setAttribute('class', 'cancel-btn');
    buttonCancel.setAttribute('id', 'c-edit-cancel-btn');
    buttonCancel.style.backgroundColor = "#FF5C33";
    buttonCancel.textContent = "Tühista";
    // Bind elements
    divMain.appendChild(divEdit);
    divEdit.appendChild(title);
    divEdit.appendChild(form);
    form.appendChild(inputHidden);
    form.appendChild(inputOldName);
    form.appendChild(table);
    table.appendChild(tbody);
    tbody.appendChild(trName);
    tbody.appendChild(trButtons);
    trName.appendChild(thName);
    trName.appendChild(tdInputName);
    tdInputName.appendChild(inputName);
    trButtons.appendChild(tdButtons);
    tdButtons.appendChild(divButtons);
    divButtons.appendChild(buttonSave);
    divButtons.appendChild(buttonCancel);

    configHideShow('category-edit-div');

    buttonSave.addEventListener('click', function(event) {
        //divMain.removeChild(divEdit);
        //configHideShow('categories-div');
    });

    buttonCancel.addEventListener('click', function(event) {
        divMain.removeChild(divEdit);
        configHideShow('categories-div');
    });

}

/*----------------------------------------------------------------------------*/
/*                             SHOPPING CART                                  */
/*----------------------------------------------------------------------------*/

/**
 * Shopping cart function
 * @param {name}
 *        {price}
 */
function addToShoppingCart(name, code, price, quantity) {



    // Create elements
    var row = document.createElement('tr');
    var nameTd = document.createElement('td');
    var codeTd = document.createElement('td');
    var quantityTd = document.createElement('td');
    var priceTd = document.createElement('td');
    var deleteTd = document.createElement('td');
    var nameIn = document.createElement('input');
    var codeIn = document.createElement('input');
    var quantityIn = document.createElement('input');
    var priceIn = document.createElement('input');
    var deleteButton = document.createElement('button');
    var inputHidden = document.createElement('input');

    // Set values, attributes and style
    nameIn.value = name;
    nameIn.setAttribute('type', 'text');
    nameIn.readOnly = true;
    codeIn.value = code;
    codeIn.readOnly = true;
    codeIn.setAttribute('type', 'text');
    codeIn.setAttribute('class', 'row-codes');
    quantityIn.setAttribute('min', '1');
    quantityIn.setAttribute('max', quantity);
    quantityIn.setAttribute('type', 'number');
    quantityIn.setAttribute('class', 'row-quantities');
    priceIn.value = parseFloat(price).toFixed(2);
    priceIn.setAttribute('class', 'row-prices');
    priceIn.setAttribute('id', 'row-price');
    priceIn.setAttribute('type', 'number');
    priceIn.setAttribute('min', '0');
    priceIn.setAttribute('step', '0.01');
    deleteButton.textContent = 'x';
    deleteButton.setAttribute('class', 'active-del-btn')
    row.style.borderBottom = '1px dashed black';
    inputHidden.setAttribute('type', 'hidden');
    inputHidden.setAttribute('name', 'product[]');
    inputHidden.setAttribute('class', 'hidden-product-input');

    // Get elements
    var tableMain = document.querySelector('#order-list table');
    var tableBody = document.querySelector('#order-list tbody');
    var totalCostDiv = document.getElementById('cost-total');
    var cancelButton = document.getElementById('cancel-order-btn');
    var rowSingles = tableBody.getElementsByTagName('tr');
    var rowCodes = tableBody.getElementsByClassName('row-codes');
    var rowQuantities = tableBody.getElementsByClassName('row-quantities');
    var rowPrices = tableBody.getElementsByClassName('row-prices');
    var inputHiddens = tableBody.getElementsByClassName('hidden-product-input');

    /* Calculating total cost */

    if (rowSingles.length == 0) {
        totalCostDiv.textContent = (0).toFixed(2) + " €";
    }

    tableBody.addEventListener('change', function(event) {
        var newTotalCost = 0;
        for (var i = 0; i < rowPrices.length; i++) {
            newTotalCost = newTotalCost + parseInt(rowQuantities[i].value) * parseFloat(rowPrices[i].value);
        }
        totalCostDiv.textContent = parseFloat(newTotalCost).toFixed(2) + ' €';
    });

    cancelButton.addEventListener('click', function(event) {
        for(var i = 0; i < tableBody.rows.length; i++) {
            tableBody.deleteRow(i);
        }
        totalCostDiv.textContent = "0.00 €";
    });

    /* Row delete button */
    deleteButton.addEventListener('click', function(event) {
        row.parentNode.removeChild(row);
        var newTotalCost = 0;
        for (var i = 0; i < rowPrices.length; i++) {
            newTotalCost = newTotalCost + parseInt(rowQuantities[i].value) * parseFloat(rowPrices[i].value);
        }
        totalCostDiv.textContent = parseFloat(newTotalCost).toFixed(2) + ' €';
    });


    // Bind elements
    row.appendChild(nameTd);
    row.appendChild(codeTd);
    row.appendChild(quantityTd);
    row.appendChild(priceTd);
    row.appendChild(deleteTd);
    nameTd.appendChild(nameIn);
    codeTd.appendChild(codeIn);
    quantityTd.appendChild(quantityIn);
    priceTd.appendChild(priceIn);
    deleteTd.appendChild(deleteButton);
    row.appendChild(inputHidden);

    /* Adding row to table */

    // Get elements

    if (rowCodes.length == 0) {
        quantityIn.value = 1;
        inputHidden.setAttribute('value', code + ':' + '1' + ':' + priceIn.value);
        tableBody.appendChild(row);
        totalCostDiv.textContent = (parseFloat(totalCostDiv.textContent) + price).toFixed(2) + " €";
    } else {
        var codeMatchCounter = 0;
        for (var i = 0; i < rowCodes.length; i++) {
            if (rowCodes[i].value == code) {
                codeMatchCounter += 1;
                var rowCols = rowSingles[i].getElementsByTagName('td');
                if (rowQuantities[i].value >= quantity) {
                    rowQuantities[i].value = quantity;
                    alert("Toote '" + name + "' kogus laos on " + quantity + "!");
                } else {
                    rowCols[2].firstChild.value = parseInt(rowCols[2].firstChild.value) + 1;
                    inputHiddens[i].setAttribute('value', code + ':' + rowCols[2].firstChild.value + ':' + rowCols[3].firstChild.value);
                    totalCostDiv.textContent = (parseFloat(totalCostDiv.textContent) + price).toFixed(2) + " €";
                }
            }
        }
        if (codeMatchCounter == 0) {
            quantityIn.value = 1;
            tableBody.appendChild(row);
            inputHidden.setAttribute('value', code + ':' + '1' + ':' + priceIn.value);
            totalCostDiv.textContent = (parseFloat(totalCostDiv.textContent) + price).toFixed(2) + " €";
        }
    }

    /* Quantity control */
    quantityIn.addEventListener('change', function(event) {
        if (quantityIn.value > quantity) {
            quantityIn.value = quantity;
            alert("Toodet " + name + " on laos " + quantity) + ".";
        } else {
            inputHidden.setAttribute('value', code + ':' + quantityIn.value + ':' + priceIn.value);
        }
    });

    priceIn.addEventListener('change', function(event) {
        inputHidden.setAttribute('value', code + ':' + quantityIn.value + ':' + priceIn.value);
    });

}

 /**
    * Resetting form fields
    * @param {form name}
    *        {return page}
    */
function resetForm(formId, returnPage) {
    document.getElementById(formId).reset();
    configHideShow(returnPage);
}

function ajax_search(){
    var hr = new XMLHttpRequest();
    var url = "ajax.php";
    var search_value = document.getElementById("search-value").value;
    var value = "search_value=" + search_value;
    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function() {
	    if(hr.readyState == 4 && hr.status == 200) {
		    var return_data = hr.responseText;
			document.getElementById("tbody-search").innerHTML = return_data;
	    }
    }
    hr.send(value);
    document.getElementById("tbody-search").innerHTML = "processing...";
}
