(function(){
    const input = document.getElementsByTagName('input');
    var newI = document.createElement('i');
    for(j=0;j<input.length;j++){
        if(input[j].type==="checkbox" || input[j].type==="radio"){
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
                input[j].parentNode.parentNode.style.backgroundColor="rgb(48, 255, 29)";
            }
        }
    }
})();
var check = document.getElementsByClassName("true_value");
for(i=0;i<check.length;i++){
        var Place_prise = document.getElementById("Place_prise");
        var prixTotal = document.getElementById("prixTotal");
        var prix = document.getElementById("prix");
        j=1;
        check[i].addEventListener('click',function(e){
            if(!this.style.backgroundColor){
                this.style.backgroundColor="rgb(48, 255, 29)";
                this.firstChild.checked=true;                 
                j++;
                prixTotal.childNodes[3].value=(prix.value*j);
            }else{
                this.style.backgroundColor="";
                this.firstChild.checked=false;
                prixTotal.childNodes[3].value-=prix.value;
                Place_prise.placeholder-=this.lastChild.textContent;
                  
                j--;
            }
        })
    }
(function(){
    const select = document.getElementsByTagName('select');
    for(j=0;j<select.length;j++){
        select[j].parentNode.style.display="none";
    }
})();