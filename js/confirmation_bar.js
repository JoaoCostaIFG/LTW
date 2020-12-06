'use strict'

/*
Creates a confirmation prompt on a scpecific action

*/

function showConfirmationPrompt(message, callOnSuccess) {
    if(!document.getElementById("confirmationBar")){
        let body = document.getElementsByTagName("body")[0];
        body.innerHTML += "<section id=\"confirmationBar\">" +
                                "<p>" + message + "</p>" + 
                                "<button id=\"acceptConfirmationButton\" onclick=\"" + callOnSuccess + ";removeConfirmationBar()\">Yes</button>" + 
                                "<button id=\"rejectConfirmationButton\" onclick=\"removeConfirmationBar()\">No</button>" + 
                            "</section>";
    }
}

function removeConfirmationBar() {
    let prompt = document.getElementById("confirmationBar");
    if(prompt){
        prompt.remove();
    }
}