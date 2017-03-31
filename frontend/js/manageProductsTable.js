function removeSoldProduct(el){
  el.parentNode.parentNode.style.display='none';

  // negating id sets it for deletion
  var value = el.previousSibling.previousSibling.value;

  if(parseInt(value)){
    var deleteId = parseInt(value) * -1;
    el.previousSibling.previousSibling.setAttribute("value",  String(deleteId));
  } else {
    el.previousSibling.previousSibling.setAttribute("value",  "delete");
  }

}
