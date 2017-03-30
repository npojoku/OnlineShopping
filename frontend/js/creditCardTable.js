// if user clicks card remove, hide from display
$(document).ready(function () {
     $('.cardBtnRemove').click(function () {
       // hide table entry
        $(this).closest('tr').style.display ="none";
    });

    $('.cardBtn').on('click', function () {
        // if user clicks a button add new entry with next id number
        addTableRow();
    });


});


function removeCard(el){
  el.parentNode.parentNode.style.display='none';
  // value true indicates to backend that this card should be deleted
  el.value='true';
}

function addTableRow(el)
{
  var table = el.parentNode.parentNode.parentNode;

  // insert row
  table.insertRow(0);
  //
  // // insert columns
  // var creditCardCell = row.insertCell(0);
  // var creditNumberCell = row.insertCell(1);
  // var buttonCell = row.insertCell(1);

  // populate credit card column

}
