require('../styles/Edit.css')

(function () {
    const input = document.getElementsByTagName('input');
    var newI = document.createElement('i');
    for (j = 0; j < input.length; j++) {
        if (input[j].type === "checkbox" || input[j].type === "radio") {
            input[j].style.display = "none";
            input[j].parentNode.parentNode.className = "check";
            input[j].parentNode.parentNode.parentNode.className = "conteneur";
            input[j].labels.disabled = "true";
            if (input[j].nextElementSibling.textContent === "0") {
                input[j].nextElementSibling.textContent = "C";
            }
            if (!input[j].checked) {
                input[j].value = 0;
                input[j].parentNode.className += " true_value";
            } else {
                input[j].type = "radio";
                input[j].parentNode.parentNode.style.backgroundColor = "red";
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
const array_voiture = [];
const btn_model = document.getElementById('btn-model')
const btn = document.getElementById("btn")

for (i = 0; i < check.length; i++) {
    j = 1;
    check[i].addEventListener('click', function (e) {
        e.preventDefault()
        if (!this.style.backgroundColor) {
            prixTotal.style.display = "flex";
            this.style.backgroundColor = "rgb(48, 255, 29)";
            this.style.opacity = "0.8";
            this.firstChild.checked = true;
            voiture = this.parentNode.parentNode.parentNode.parentNode.childNodes[2].childNodes[1].value
            array_place.push("Place n°:" + this.childNodes[2].innerText + "dans le voiture n°:" + voiture);
            btn_model.style.display = "block";
            Place_prise.value = (prix.value * j);
            j++;
            array_voiture.push(voiture)
        } else {
            this.style.backgroundColor = "";
            this.firstChild.checked = false;
            this.style.opacity = "1";
            Place_prise.value = Place_prise.value - prix.value;
            j--;
            Place_prise.placeholder -= this.lastChild.textContent;
            array_place.pop();
            array_voiture.pop(voiture)
        }
        place_total.value = array_place
        id_voiture.value = array_voiture

    })
}
(function () {
    const input = document.getElementsByTagName('input');
    for (i = 0; i < input.length; i++) {
        if (input[i].type === "number") {
            input[i].parentNode.style.display = "none";
        }
    }
}())
const schema = document.getElementsByClassName('schema');
for (i = 0; i < schema.length; i++) {
    schema[i].parentNode.classList.add('collection');
}
(function () {
    const conteneur = document.getElementsByClassName('conteneur');
    for (i = 0; i < conteneur.length; i++) {
        c = 0
        count = conteneur[i].children.length;
        for (k = 0; k < count; k++) {
            if (!conteneur[i].children[k].style.backgroundColor) {
                c++;
            }
        }
        newP = document.createElement('p')
        newP.innerText = "Place libre " + c
        conteneur[i].parentElement.parentElement.appendChild(newP)
    }
}())

const model = document.getElementById('model')
btn_model.addEventListener('click', function (event) {
    event.preventDefault();
    model.style.display = "block";
})
window.onclick = function (event) {
    if (event.target == model) {
        model.style.display = "none";
    }
}
