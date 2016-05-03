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


/*----------------------------------------------------------------------------*/
/*                       PRODUCT ACTIONS, FUCTIONS ETC                        */
/*----------------------------------------------------------------------------*/

function searchFromTableColumn(keyword, tableSelector, colNumber) {
  var table = document.querySelector(tableSelector);
  var tr = table.getElementsByTagName('TR');
  for(var i = 0; i < tr.length; i++) {
    var td = tr[i].getElementsByTagName('TD');
    console.log(td[1].textContent);
    if (td[colNumber].textContent == keyword) {
      return keyword;
    } else {
      return -1;
    }
  }
}


/**
 * Shopping cart function
 * @param {name}
 *        {price}
 */
 function addToShoppingCart(name, code, price) {

   var tableMain = document.getElementById('order-list');
   var tableBody = document.querySelector('#order-list tbody');
   var totalCostDiv = document.getElementById('cost-total');
   var row = document.createElement('tr');
   var nameTd = document.createElement('td');
   var codeTd = document.createElement('td');
   var quantityTd = document.createElement('td');
   var priceTd = document.createElement('td');
 	 var deleteTd = document.createElement('td');
   var quantityIn = document.createElement('input')
   var deleteButton = document.createElement('button');

   nameTd.textContent = name;
   codeTd.textContent = code;
   priceTd.textContent = parseFloat(price).toFixed(2);
   priceTd.setAttribute('id', 'row-price');
   priceTd.setAttribute('class', 'row-prices');
   quantityIn.setAttribute('type', 'number');
   quantityIn.setAttribute('min', '1');
   quantityIn.value = '1';
   deleteButton.textContent = 'x';
   deleteButton.setAttribute('class', 'active-del-btn')

   quantityTd.appendChild(quantityIn);
   deleteTd.appendChild(deleteButton);
   row.appendChild(nameTd);
   row.appendChild(codeTd);
   row.appendChild(codeTd);
   row.appendChild(quantityTd);
   row.appendChild(priceTd);
   row.appendChild(deleteTd);
   row.style.borderBottom = '1px dashed black';
   tableBody.appendChild(row);

   var totalCost = parseFloat(totalCostDiv.textContent);
   var rowPrice = document.getElementById('row-price');
   var rowPrices = document.getElementsByClassName('row-prices');
   totalCost = totalCost + parseFloat(price);
   totalCostDiv.textContent = parseFloat(Math.round(totalCost * 100) / 100).toFixed(2) + " €";

   quantityIn.addEventListener('change', function(event) {
     priceTd.textContent = parseFloat(Math.round(price * quantityIn.value * 100) / 100).toFixed(2);
   });

   tableBody.addEventListener('change', function(event) {
     var newTotalCost = 0;
     for (var i = 0; i < rowPrices.length; i++) {
       newTotalCost = newTotalCost + parseFloat(rowPrices[i].textContent);
     }
     totalCostDiv.textContent = parseFloat(newTotalCost).toFixed(2) + ' €';
   });

   deleteButton.addEventListener('click', function(event) {
     row.parentNode.removeChild(row);
     var newTotalCost = 0;
     for (var i = 0; i < rowPrices.length; i++) {
       newTotalCost = newTotalCost + parseFloat(rowPrices[i].textContent);
     }
     totalCostDiv.textContent = parseFloat(newTotalCost).toFixed(2) + ' €';
   });
 }
