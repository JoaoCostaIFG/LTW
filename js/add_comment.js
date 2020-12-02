'use strict'

function addComment(post_id) {
    var xhttp = new XMLHttpRequest();
    let text = document.getElementsByName("comment_text")[0].value;
    // console.log(text)
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert("New comment: " + text);
        }
    };

    xhttp.open("GET", "../actions/action_add_comment.php?" + encodeForAjax({post_id: post_id, comment_text: text}), true);
    xhttp.send();
}

function encodeForAjax(data) {
    return Object.keys(data).map(function(k){
      return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');
  }