function showUsedQuality (box) {

    var chboxs = document.getElementsByName("isUsed");
    var vis = "none";
    for(var i=0;i<chboxs.length;i++) {
        if(chboxs[i].checked){
         vis = "block";
            break;
        }
    }

    var boxDivs = document.getElementsByClassName(box);
    for(var i=0;i<boxDivs.length;i++) {
      boxDivs[i].style.display = vis;
        if(boxDivs[i].checked){
         vis = "block";
            break;
        }
    }
}
