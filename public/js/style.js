(function(){
    const input = document.getElementsByTagName('input');
    var newI = document.createElement('i');
    for(j=0;j<input.length;j++){
        if(input[j].type==="checkbox" || input[j].type==="radio"){
            input[j].style.display="none";
            input[j].parentNode.parentNode.className="check";
            input[j].parentNode.parentNode.parentNode.className="conteneur";
            input[j].labels.disabled="true";
            if(input[j].nextElementSibling.textContent==="0"){
                input[j].nextElementSibling.textContent="C";
            }
            if(!input[j].checked){
                input[j].value=0;
                input[j].parentNode.className+=" true_value";
            }else{
                input[j].type="radio";
                input[j].parentNode.parentNode.style.backgroundColor="red";
            }
        }
    }
})();
const check = document.getElementsByClassName("true_value");
const Place_prise = document.getElementById("Place_prise");
const prixTotal = document.getElementById("prixTotal");
const prix = document.getElementById("prix");
const id_voiture = document.getElementById("id_prise");
const place_total = document.getElementById("place_total");
const array_place = [];
for(i=0;i<check.length;i++){
        j=1;
        check[i].addEventListener('click',function(e){
            if(!this.style.backgroundColor){
                prixTotal.style.display="flex";
                this.style.backgroundColor="rgb(48, 255, 29)";
                this.style.opacity="0.8";
                this.firstChild.checked=true;   
                voiture=this.parentNode.parentNode.parentNode.parentNode.childNodes[2].childNodes[1].value
                array_place.push(this.childNodes[2].innerText);
                Place_prise.value=(prix.value*j);
                j++;
                id_voiture.value=voiture
            }else{
                this.style.backgroundColor="";
                this.firstChild.checked=false;
                this.style.opacity="1";
                Place_prise.value=Place_prise.value - prix.value;
                j--;
                Place_prise.placeholder-=this.lastChild.textContent;
                array_place.pop();
            }
            place_total.value=array_place;
            
        })
    }
(function(){
    const input = document.getElementsByTagName('input');
    for(i=0;i<input.length;i++){
            if(input[i].type==="number"){
                input[i].parentNode.style.display="none";
            }
    }
}())
const schema = document.getElementsByClassName('schema');
for(i=0;i<schema.length;i++){
            schema[i].parentNode.classList.add('collection');
            console.log(schema[i]);
}
