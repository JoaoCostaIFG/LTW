'use strict'

function favourite(post_id){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //Trim is used because the reponse text comes with new lines behind
            let response = xhttp.responseText.trim('\n');
            let star = document.getElementById("favourite-star");
            if (response === "added") {
                star.innerHTML = "&bigstar;";
            } else if (response === "removed") {
                star.innerHTML = "&star;";
            } else {
                //Error
            }
        }
    };

    xhttp.open("GET", "../actions/action_favourite.php?" + encodeForAjax({ post_id: post_id}), true);
    xhttp.send();
}

function encodeForAjax(data) {
    return Object.keys(data).map(function (k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');
}