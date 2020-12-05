'use strict'

/*
Makes a GET request to add a comment and adds that comment if the request is successful
adds a p with id comment-error if not successful 
Escapes html
*/

function addQuestion(post_id) {
    //Removes any previous error if it is there
    removeError();
    //Only text area in post
    let text = document.getElementsByName("question_text")[0].value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //Trim is used because the reponse text comes with new lines behind
            let response = xhttp.responseText.trim('\n');
            //Used to append before input
            let doc = new DOMParser().parseFromString(response, 'text/html').getElementsByClassName("petpost-question")[0];
            console.log(doc);
            let form = document.getElementById("question-input");
            let questions = document.getElementById("petpost-questions");
            questions.insertBefore(doc, form);
        }
    };

    xhttp.open("GET", "../actions/action_add_question.php?" + encodeForAjax({ post_id: post_id, question_text: text }), true);
    xhttp.send();
}

function removeError() {
    let questionError = document.getElementById('question-error');
    if (questionError) {
        questionError.remove();
    }
}

function encodeForAjax(data) {
    return Object.keys(data).map(function (k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');
}