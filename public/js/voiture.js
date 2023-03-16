var containerBillet = document.getElementById("container-billet");
var containerVoiture = document.getElementById("container-voiture");
var voit =document.getElementsByClassName("place");

var place = document.getElementsByClassName("pl");
function openV(){
    containerBillet.style.display="none";
    containerVoiture.style.display="flex";
}
function change(n){
    for(i=0;i<=place.length;i++){
        if(i==n){
            place[i-1].style.backgroundColor="red";
        }
    }
}    
for(i=0;i<voit.length;i++){
    console.log(voit[i].childNodes);
}