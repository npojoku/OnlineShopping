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
  creditCard.name='CreditCard';
  creditCard.placeholder='Credit Card #';
  creditCard.setAttribute('class','form-control');

  // populate credit card number
  var creditNumber = document.createElement("input");
  creditNumber.type = "month";
  creditNumber.name='CreditExpDate';
  creditNumber.setAttribute('class','form-control');

  // populate delete button
  var button = document.createElement("input");
  button.type = "button";
  button.name = "CardId"
  button.setAttribute("class", "btn form-control");
  button.setAttribute("onClick", "removeCard(this)");

  //var hidden card id
  var cardId = document.createElement("input");
  cardId.type = "text";
  cardId.name="CardId";
  cardId.setAttribute('class','form-control');
  cardId.setAttribute('value','new');


  // insert elements into table
  creditCardCell.appendChild(creditCard);
  creditNumberCell.appendChild(creditNumber);
  buttonCell.appendChild(button);
  buttonCell.appendChild(cardId);
}

function removeCard(el){
  el.parentNode.parentNode.style.display='none';

  // negating id sets it for deletion
  var value = el.previousSibling.value;

  if(value === "new") return;

  var deleteId = parseInt(el.value) * -1;
  el.previousSibling.setAttribute("value",  String(deleteId));
}
