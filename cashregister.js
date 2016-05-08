'use strict';

/*----------------------------------------------------------------------------*/
/*                              DISPLAYING MAIN DIVS                          */
/*----------------------------------------------------------------------------*/

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

/*Show homepage*/
document.getElementById('home').addEventListener('click', function(event) {
    configHideShow('categories-div');
});

/*Show catecory adding page*/
document.getElementById('add-category-page').addEventListener('click', function(event) {
  configHideShow('category-add-div');
});

/*Show product adding page*/
document.getElementById('add-product-page').addEventListener('click', function(event) {
  configHideShow('product-add-div');
});

function addProduct() {
  configHideShow('add-product-page');
}


/*----------------------------------------------------------------------------*/
/*                       PRODUCT ACTIONS, FUCTIONS ETC                        */
/*----------------------------------------------------------------------------*/

/**
 * Shopping cart function
 * @param {name}
 *        {price}
 */
 function addToShoppingCart(name, code, price) {

   /* Creating shopping cart elements */

   // Get elements
   var tableMain = document.getElementById('order-list');
   var tableBody = document.querySelector('#order-list tbody');
   var totalCostDiv = document.getElementById('cost-total');
   var cancelButton = document.getElementById('cancel-order-btn');
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
   // Set values, attributes and style
   nameIn.value = name;
   codeIn.value = code;
   quantityIn.value = '1';
   priceIn.value = parseFloat(price).toFixed(2);
   nameIn.setAttribute('type', 'text');
   nameIn.readOnly = true;
   codeIn.setAttribute('type', 'text');
   codeIn.readOnly = true;
   quantityIn.setAttribute('min', '1');
   quantityIn.setAttribute('type', 'number');
   priceIn.setAttribute('class', 'row-prices');
   priceIn.setAttribute('id', 'row-price');
   priceIn.setAttribute('type', 'number');
   priceIn.setAttribute('min', '0');
   priceIn.setAttribute('step', '0.01');
   deleteButton.textContent = 'x';
   deleteButton.setAttribute('class', 'active-del-btn')
   row.style.borderBottom = '1px dashed black';
   // Bind elements
   tableBody.appendChild(row);
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

   /* Calculating total cost */

   // Creating elements
   var rowPrice = document.getElementById('row-price');
   var rowPrices = document.getElementsByClassName('row-prices');
   // Initial total price
   var totalCost = parseFloat(totalCostDiv.textContent);
   totalCost = totalCost + parseFloat(price);
   totalCostDiv.textContent = parseFloat(Math.round(totalCost * 100) / 100).toFixed(2) + " €";
   // Quantity change listener - calculating row total price
   quantityIn.addEventListener('change', function(event) {
     priceIn.value = parseFloat(Math.round(price * quantityIn.value * 100) / 100).toFixed(2);
   });
   // Table change listenet - calculating present total cost
   tableBody.addEventListener('change', function(event) {
     var newTotalCost = 0;
     for (var i = 0; i < rowPrices.length; i++) {
       newTotalCost = newTotalCost + parseFloat(rowPrices[i].value);
     }
     totalCostDiv.textContent = parseFloat(newTotalCost).toFixed(2) + ' €';
   });

   /* Row delete button */

   deleteButton.addEventListener('click', function(event) {
     row.parentNode.removeChild(row);
     var newTotalCost = 0;
     for (var i = 0; i < rowPrices.length; i++) {
       newTotalCost = newTotalCost + parseFloat(rowPrices[i].value);
     }
     totalCostDiv.textContent = parseFloat(newTotalCost).toFixed(2) + ' €';
   });

   /* Cancel order */

   cancelButton.addEventListener('click', function(event) {
     var i = tableBody.rows.length;
     for(var i = 0; i < tableBody.rows.length; i++) {
       tableBody.deleteRow(i);
     }
     totalCostDiv.textContent = "0.00 €";
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
