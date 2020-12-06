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

    xhttp.open("GET", "../actions/action_" + action + ".php?" +
        encodeForAjax({post_id: post_id, user_id: user_id}), true);
    xhttp.send();
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
