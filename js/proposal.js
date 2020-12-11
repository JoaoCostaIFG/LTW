'use strict'

function handle_proposal(action, post_id, user_id) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //Trim is used because the reponse text comes with new lines behind
            let acceptProposal = document.getElementById("acceptButton");
            let rejectProposal = document.getElementById("rejectButton");
            acceptProposal.remove();
            rejectProposal.remove();
            let processedText = document.getElementById("processedButtonText");
            if (action === "accept_proposal")
                processedText.innerHTML = "Your accepted this proposal";
            else if (action === "reject_proposal")
                processedText.innerHTML = "Your rejected this proposal";
        }
    };

    xhttp.open("post", "../actions/action_" + action + ".php", true);
    xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhttp.send(encodeForAjax({ post_id: post_id, user_id: user_id, csrf: document.querySelector("meta[name='csrf-token']").getAttribute("content")}));
}

function make_proposal(post_id, user_id) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //Trim is used because the reponse text comes with new lines behind
            let makeProposalButton = document.getElementById("makeProposalButton");
            makeProposalButton.remove();
            let proposalSent = document.getElementById("proposalSentText");
            proposalSent.innerHTML = "Your Proposal is Pending";
        }
    };

    xhttp.open("GET", "../actions/action_make_proposal.php?" +
        encodeForAjax({post_id: post_id, user_id: user_id}), true);
    xhttp.send();
}

function make_proposal_confirmation(post_id, user_id) {
    showConfirmationPrompt("Are you sure you want to make this adoption proposal?", "make_proposal(" + post_id + "," + user_id + ")");
}
