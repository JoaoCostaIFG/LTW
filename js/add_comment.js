'use strict'

function addComment(post_id, username) {
    let text = document.getElementsByName("comment_text")[0].value;
    if(text === ""){
        return;
    }
    var xhttp = new XMLHttpRequest();
    // console.log(text)
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //Trim is used because the reponse text comes with new lines behind
            if(xhttp.responseText.trim("\n") === "success"){
                appendComment(text, username);
            }
        }
    };

    xhttp.open("GET", "../actions/action_add_comment.php?" + encodeForAjax({post_id: post_id, comment_text: text}), true);
    xhttp.send();
}

function appendComment(text, username) {
    
    // Checks if there are 0 comments and if so removes the string
    let noCommentsText = document.getElementById('no-comments');
    if(noCommentsText)
        noCommentsText.remove();

    let date = new Date();
    let date_string = date.getUTCDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear();
    
    let comment = document.createElement('div');
    comment.setAttribute('class', 'petpost-comment');
    comment.innerHTML = '<p>' + escapeHtml(text) + '</p><p>' + date_string + ', ' + username +  '</p>';
    
    let element = document.getElementById("comments");
    element.appendChild(comment);
}

function encodeForAjax(data) {
    return Object.keys(data).map(function(k){
      return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');
}

let entityMap = {
    "&": "&amp;",
    "<": "&lt;",
    ">": "&gt;",
    '"': '&quot;',
    "'": '&#39;',
    "/": '&#x2F;'
  };

function escapeHtml(string) {
return String(string).replace(/[&<>"'\/]/g, function (s) {
    return entityMap[s];
});
}