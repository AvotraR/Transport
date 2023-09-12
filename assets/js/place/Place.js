const arrayP = []
const valeur = document.getElementById('valeur')
const place_prise = document.getElementById('place_prise')
const all_voiture = document.querySelector('.all_voiture')
const voitureId = document.getElementById('voitureId')
const numPlace = document.getElementById('numPlace')
const prixQt = document.getElementById('prixQt')
const prix = document.getElementById('prix')
const content_place = document.querySelectorAll('.content_place')
const desc = document.querySelectorAll('.desc')
const grid_content = document.getElementById('grid-content')
const array_place=[]
let j=1
let l=0
let selectedCar = 0

    //disabled place qui a une valeur 1
    document.querySelectorAll('.place').forEach((place)=>{
        if(place.value==1){
            place.disabled=true
            place.style.backgroundColor="red"
        }
    })

    //desactiver l'acces au place des voiture qui ne sont pas selectionner    
    function Desactiver(element){
        document.querySelectorAll('.place').forEach((place)=>{
                if(place.parentElement !== element){
                    place.disabled=true
                }
        })
    }
    function Activer(){
        document.querySelectorAll('.place').forEach((place)=>{
                if(!place.style.backgroundColor){
                    place.disabled=false
                }
        })
    }
    
    //Ajout nombre de place libre
    for(let i=0;i<content_place.length;i++){
        let c = 0
        count = content_place[i].children.length
        for(k=0;k<count;k++){
            if(content_place[i].children[k].value==0){
                //compter les nombres de place libre 
                c++;
            }
        }
        //creation d'un nouvelle element qui va contenir les nombres de place
        newP = document.createElement('div')
        newP.className='row'
        p = document.createElement('p')
        p.innerText="Place libre "+c
        newP.appendChild(p)
        for(j=2+i;j<desc.length+l;j++){
            desc[i].appendChild(newP)
        }
        l++
    }
    //designer place selectionner
    let pl = 1
    document.querySelectorAll('.place').forEach((place)=>{
        place.addEventListener('click',function coco(e){
            e.preventDefault()
                if(!place.style.backgroundColor){
                    place.style.backgroundColor="rgb(48, 255, 29)";
                    place.value=1
                    voitureId.value=place.parentElement.id
                    array_place.push(place.textContent);
                    prixQt.value=(prix.value*pl)
                    selectedCar++;
                    grid_content.style.display="flex";
                    Desactiver(place.parentElement) 
                    pl++;
                }else{
                    place.style.backgroundColor=""
                    place.value=0
                    prixQt.value=prixQt.value - prix.value;
                    pl--;
                    prixQt.placeholder=prixQt.value;
                    array_place.pop();
                    selectedCar--
                }
                if(selectedCar==0){
                    Activer()
                }
                place_prise.value=array_place   
        })
    })
