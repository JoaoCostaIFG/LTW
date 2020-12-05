'use strict'

function toggleAnswerInput(question_id) {
    // console.log(document.getElementById("answer-input" + question_id));
    let node = document.getElementById("answer-input" + question_id);
    if(node.style.display == "none"){
        node.style.display = "block";
    } else {
        node.style.display = "none";
    }
    // console.log(document.getElementById("answer-input" + question_id));
}

function hideAnswerButton(question_id){
    document.getElementById("answer-button" + question_id).style.display = "none";
}

function addAnswer(question_id){
    console.log("answer_text" + question_id);
    console.log(document.getElementsByName("answer_text" + question_id));
    let text = document.getElementsByName("answer_text" + question_id)[0].value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //Trim is used because the reponse text comes with new lines behind
            let response = xhttp.responseText.trim('\n');
            let questions = document.getElementById("QA" + question_id);
            questions.innerHTML += response;
            toggleAnswerInput(question_id);
            hideAnswerButton(question_id);
        }
    };
    
    xhttp.open("GET", "../actions/action_add_answer.php?" + encodeForAjax({ question_id: question_id, answer_text: text }), true);
    xhttp.send();
}
