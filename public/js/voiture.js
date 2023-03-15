var containerBillet = document.getElementById("container-billet");
var containerVoiture = document.getElementById("container-voiture");
var voit =document.getElementsByClassName("place");

var place = document.getElementsByClassName("pl");
function openV(){
    containerBillet.style.display="none";
    containerVoiture.style.display="flex";
}
if (voit.length>1){
    console.log(voit[1]);
}
function change(n){
    for(i=0;i<=place.length;i++){
        if(i==n){
            place[i-1].style.backgroundColor="red";
        }

    }
}