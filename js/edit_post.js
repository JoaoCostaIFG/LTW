'use strict'

function edit_post() {
    if (typeof edit_post.toggle == 'undefined')
        edit_post.toggle = 1;

    let elems = document.getElementsByClassName("petpost-info nobullets")[0];
    let description = document.getElementsByClassName("petpost-description")[0];
    let petpost = document.getElementsByClassName("petpost-edit")[0];
    if (edit_post.toggle == 1) {
        elems.setAttribute("style", "display: none");
        description.setAttribute("style", "display: none");
        petpost.setAttribute("style", "display: initial")
        edit_post.toggle = 0;
    } else {
        elems.setAttribute("style", "display: inline-block");
        description.setAttribute("style", "display: inline-block");
        petpost.setAttribute("style", "display: none")
        edit_post.toggle = 1;
    }
}

function edit_photo(event) {
    let image = document.getElementById('petphoto');
    let url = URL.createObjectURL(event.target.files[0]);
    image.setAttribute("style", "background: url(" + url + ") no-repeat center /auto 100%");
}
