"use strict";

/*
Creates a confirmation prompt on a scpecific action

*/

function showConfirmationPrompt(message, callOnSuccess) {
    if (!document.getElementById("confirmationBar")) {
        let body = document.getElementsByTagName("body")[0];
        body.style.marginBottom = getComputedStyle(
            document.documentElement
        ).getPropertyValue("--bottom-bar-height");
        body.innerHTML +=
            '<section id="confirmationBar">' +
            "<p>" +
            message +
            "</p>" +
            '<div id="confirmationButtons">' +
            '<button id="rejectConfirmationButton" onclick="removeConfirmationBar()">No</button>' +
            '<button id="acceptConfirmationButton" onclick="' +
            callOnSuccess +
            ';removeConfirmationBar()">Yes</button>' +
            "</div>" +
            "</section>";
    }
}

function removeConfirmationBar() {
    let prompt = document.getElementById("confirmationBar");
    if (prompt) {
        prompt.remove();
        document.getElementsByTagName("body")[0].style.marginBottom = "initial";
    }
}
