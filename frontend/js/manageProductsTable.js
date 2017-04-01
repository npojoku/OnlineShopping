function removeSoldProduct(el){
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
