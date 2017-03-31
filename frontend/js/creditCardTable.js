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
  button.name = "DeleteCard[]"
  button.value = "-";
  button.setAttribute("class", "btn");
  button.setAttribute("onClick", "removeCard(this)");

  // insert elements into table
  creditCardCell.appendChild(creditCard);
  creditNumberCell.appendChild(creditNumber);
  buttonCell.appendChild(button);
}

function removeCard(el){
  el.parentNode.parentNode.style.display='none';
  // value true indicates to backend that this card should be deleted
  el.value='true';
}
