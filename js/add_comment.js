'use strict'

/*
Makes a GET request to add a comment and adds that comment if the request is successful
adds a p with id comment-error if not successful 
Escapes html
*/

function addComment(post_id) {
    //Removes any previous error if it is there
    removeError();
    //Only text area in post
    let text = document.getElementsByName("comment_text")[0].value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //Trim is used because the reponse text comes with new lines behind
            let response = xhttp.responseText.trim('\n');
            let comments = document.getElementById("comments");
            comments.innerHTML += response;
        }
    };

    xhttp.open("GET", "../actions/action_add_comment.php?" + encodeForAjax({ post_id: post_id, comment_text: text }), true);
    xhttp.send();
}

function removeError() {
    let commentError = document.getElementById('comment-error');
    if (commentError) {
        commentError.remove();
    }
}
