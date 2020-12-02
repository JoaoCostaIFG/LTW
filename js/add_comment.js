'use strict'

function addComment(post_id, username) {
    let text = document.getElementsByName("comment_text")[0].value;
    if(text === ""){
        //TODO return error
        return;
    }
    var xhttp = new XMLHttpRequest();
    // console.log(text)
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            appendComment(text, username);
        }
    };

    xhttp.open("GET", "../actions/action_add_comment.php?" + encodeForAjax({post_id: post_id, comment_text: text}), true);
    xhttp.send();
}

function appendComment(text, username) {
    //TODO CHECK IF THERE ARE 0 COMMENTS AND CHANGE STRING
    let date = new Date();
    let date_string = date.getDay() + '/' + date.getMonth() + '/' + date.getYear();
    
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