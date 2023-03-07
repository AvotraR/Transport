var image = 0;
voirImage();//miantso ilay function
function voirImage(){
    var i;
    var tmp;
    var myCard = document.getElementsByClassName("myCard");
    for(i=0;i<myCard.length;i++){
        myCard[i].style.margin="30px";
        myCard[i].style.opacity="0.1";

    }
    image++;
    if(image>myCard.length){image = 1}
        myCard[image-1].style.margin="2px";
        myCard[image-1].style.opacity="1";
    setTimeout(voirImage,3000);
}
