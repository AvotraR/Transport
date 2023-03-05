var image = 0;
voirImage();//miantso ilay function
function voirImage(){
    var i;
    var tmp;
    var myMouv = document.getElementsByClassName("myMouv");
    for(i=0;i<myMouv.length;i++){
        myMouv[i].style.margin="30px";
        myMouv[i].style.opacity="0.1";

    }
    image++;
    if(image>myMouv.length){image = 1}
        myMouv[image-1].style.margin="2px";
        myMouv[image-1].style.opacity="1";
    setTimeout(voirImage,3000);
}
