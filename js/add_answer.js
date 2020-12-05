'use strict'

function toggleAnswer(question_id) {
    // console.log(document.getElementById("answer-input" + question_id));
    let node = document.getElementById("answer-input" + question_id);
    if(node.style.display == "none"){
        node.style.display = "block";
    } else {
        node.style.display = "none";
    }
    // console.log(document.getElementById("answer-input" + question_id));
}
