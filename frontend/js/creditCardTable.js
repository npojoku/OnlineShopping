function addTableRow(el)
{
  var table = el.parentNode.parentNode.parentNode;

  // insert row
  var row = table.insertRow(1);

  // insert columns
  var creditCardCell = row.insertCell(0);
  var creditNumberCell = row.insertCell(1);
  var buttonCell = row.insertCell(2);

  // populate credit card column
  var creditCard = document.createElement("input");
  creditCard.type = "text";
  creditCard.name='CreditCard[]';
  creditCard.placeholder='Credit Card #';
  creditCard.setAttribute('class','form-control');

  // populate credit card number
  var creditNumber = document.createElement("input");
  creditNumber.type = "month";
  creditNumber.name='CreditExpDate[]';
  creditNumber.setAttribute('class','form-control');

  // populate delete button
  var button = document.createElement("input");
  button.type = "button";
  button.setAttribute("class", "btn form-control");
  button.setAttribute("onClick", "removeCard(this)");
  button.setAttribute('value', '-');

  //var hidden card id
  var cardId = document.createElement("input");
  cardId.type = "text";
  cardId.name="CardId[]";
  cardId.setAttribute('class','form-control');
  cardId.setAttribute('value','new');
  cardId.setAttribute('style', 'display:none');

  // insert elements into table
  creditCardCell.appendChild(creditCard);
  creditNumberCell.appendChild(creditNumber);
  buttonCell.appendChild(cardId);
  buttonCell.appendChild(button);
}

function removeCard(el){
  el.parentNode.parentNode.style.display='none';

  // negating id sets it for deletion
  var value = el.previousSibling.value;

  if(parseInt(value)){
    var deleteId = parseInt(value) * -1;
    el.previousSibling.setAttribute("value",  String(deleteId));
  } else {
    el.previousSibling.setAttribute("value",  "delete");
  }

}
