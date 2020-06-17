var nombrePointsElt = document.getElementById("nbrePoints");
var typeQuestionElt = document.getElementById("typeQuestion");
var addResponseBtn = document.getElementById("ajoutReponse");
var responseContainer = document.getElementById("champReponse");
var questionCreateForm = document.getElementById("questionCreateForm");
var textarea = document.getElementsByTagName("textarea");
var errorInputCreate = document.getElementById("errorInputCreate");
var id = 0;

function createResponseInput(id, type) {
    responseContainer.innerHTML += `<div id="reponseContainer${id}" class="d-flex justify-content-between flex-row align-items-center mx-0 my-1">
    <label for="reponse${id}" class="col-sm-2 text-secondary font-weight-bold col-form-label pl-0" style="font-size:0.9em;"> Réponse ${id} </label>
    <div class="col-sm-7">
        <input type="text" name="reponse${id}" id="reponse${id}" class="form-control rounded-0" style="box-shadow: 1px 1px #48d1cc; background-color:#f5f5f5;" placeholder="" aria-describedby="helpId">
        <small class="text-danger"><?php if(isset($errorCreate['reponse${id}'])){ echo $errorCreate['reponse${id}']; } ?></small>
    </div>
    <div class="col-sm-1 m-auto">
        <input type="${type}" name="reponseCheck" id="reponseCheck${id}" value="">
    </div>
    <div class="col-sm-1 m-auto">
        <img src="http://localhost/Projet-Quizz/assets/images/Icônes/ic-supprimer.png" id="btn_supprimer${id}" alt="supprimer" style="cursor: pointer;">
    </div>
</div>`;
}


function createResponseTextInput() {
    responseContainer.innerHTML += `<div class="d-flex justify-content-start flex-row align-items-start mx-0 my-1">
    <label for="reponse" class="col-sm-2 text-secondary font-weight-bold col-form-label pl-0" style="font-size:0.9em;"> Réponse </label>
    <div class="col-sm-7 mr-5">
        <input type="text" name="reponse" id="reponse" class="form-control rounded-0" style="box-shadow: 1px 1px #48d1cc; background-color:#f5f5f5;" placeholder="" aria-describedby="helpId">
        <small class="text-danger"><?php if(isset($errorCreate['reponse'])){ echo $errorCreate['reponse']; } ?></small>
    </div>
</div>`;
}


function validate() {
    if (document.getElementById('reponse1')) {
        var saisie1 = document.getElementById('reponse1').value;
        document.getElementById('reponseCheck1').value = saisie1;
    }

    if (document.getElementById('reponse2')) {
        var saisie2 = document.getElementById('reponse2').value;
        document.getElementById('reponseCheck2').value = saisie2;
    }

    if (document.getElementById('reponse3')) {
        var saisie3 = document.getElementById('reponse3').value;
        document.getElementById('reponseCheck3').value = saisie3;
    }

}


// Error, Champs vides
const inputs = document.getElementsByTagName("input");
questionCreateForm.addEventListener("submit", function(event) {
    let valid = true;
    var typeValue = typeQuestionElt.options[typeQuestionElt.selectedIndex].value;
    //console.log(inputs);
    if (inputs.length <= 0) {
        valid = false;
        errorInputCreate.innerText = "Veuillez créer des champs !!!";
    } else {
        if (typeValue === "cs" || typeValue === "cm") {
            if (inputs.length > 0 && inputs.length <= 2) {
                valid = false;
                errorInputCreate.innerText = "Veuillez créer 3 champs !!!";
            } else {
                errorInputCreate.innerText = "";
                var count = 0;
                for (var input of inputs) {
                    if (input.type === "radio" || input.type === "checkbox") {
                        if (input.checked === false) {
                            count += 0;
                        } else {
                            count += 1;
                        }
                    }
                    input.addEventListener("keyup", function() {
                        input.nextElementSibling.innerText = "";
                        input.style.boxShadow = "1px 1px #48d1cc";
                    });
                    if (input.type === "text") {
                        if (!input.value.trim()) {
                            valid = false;
                            input.nextElementSibling.innerText = "Champ Obligatoire";
                            input.style.boxShadow = "1px 1px red";
                        }
                    }

                }
                if (count <= 0) {
                    valid = false;
                    errorInputCreate.innerText = "Veuillez checker au moins une réponse";
                }
            }
        } else {
            if (!inputs[0].value.trim()) {
                valid = false;
                inputs[0].nextElementSibling.innerText = "Champ Obligatoire";
                inputs[0].style.boxShadow = "1px 1px red";
            }
        }
    }

    if (!textarea[0].value.trim()) {
        valid = false;
        textarea[0].nextElementSibling.innerText = "Champ Obligatoire";
        textarea[0].style.boxShadow = "1px 1px red";
    }

    if (valid === false) {
        event.preventDefault();
        return false;
    }
});

textarea[0].addEventListener("keydown", function() {
    textarea[0].nextElementSibling.innerText = "";
    textarea[0].style.boxShadow = "1px 1px #48d1cc";
});



function resetElts() {
    responseContainer.innerHTML = "";
    responseContainer.innerText = "";
    id = 0;
    addResponseBtn.style.display = "block";
}

function increment() {
    id = id + 1;
}

function decrement() {
    id = id - 1;
}

function stopCreateResponseInput() {
    if (id >= 3) {
        addResponseBtn.style.display = "none";
    }
}

// Fonction 
function updateResponseZone() {
    addResponseBtn.addEventListener("click", function(event) {
        increment();
        stopCreateResponseInput();
        var typeValue = typeQuestionElt.options[typeQuestionElt.selectedIndex].value;
        switch (typeValue) {
            case "cm":
                createResponseInput(id, "checkbox");
                break;
            case "cs":
                createResponseInput(id, "radio");
                break;
            case "text":
                createResponseTextInput();
                addResponseBtn.style.display = "none";
                break;
            default:
                createResponseInput(id, "checkbox");
                break;
        }
        if (document.getElementById(`btn_supprimer${id}`)) {
            document.getElementById(`btn_supprimer${id}`).addEventListener("click", function(e) {
                e.target.parentNode.parentNode.remove();
                decrement();
            })
        }


    });



}



// Creation des champs reponses
typeQuestionElt.addEventListener("change", function(e) {
    resetElts();
});
addResponseBtn.addEventListener("click", updateResponseZone());

// Suppression champ de reponse