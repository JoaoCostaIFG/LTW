'use strict'

function rejectProposalFromDiv(div) {
    let buttons = div.getElementsByTagName("button");

    let acceptProposal = buttons[0];
    let rejectProposal = buttons[1];
    acceptProposal.remove();
    rejectProposal.remove();

    let processedText = div.getElementsByTagName("p")[0];
    processedText.innerHTML = "Your <b>rejected</b> this proposal";
}

function handle_proposal(id, action, post_id, user_id) {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //Trim is used because the reponse text comes with new lines behind
            let currDiv = document.getElementById("proposalButtons" + id);
            let buttons = currDiv.getElementsByTagName("button");

            let acceptProposal = buttons[0];
            let rejectProposal = buttons[1];
            acceptProposal.remove();
            rejectProposal.remove();
            let processedText = currDiv.getElementsByTagName("p")[0];
            if (action === "accept_proposal") {
                processedText.innerHTML = "Your <b>accepted</b> this proposal";
                let samePostButtons = document.getElementsByClassName("proposalButtonsFromPost" + post_id);
                for (let i = 0, len = samePostButtons.length; i < len; i++) {
                    if (samePostButtons[i].id != ("proposalButtons" + id))
                        rejectProposalFromDiv(samePostButtons[i]);
                }
            }
            else if (action === "reject_proposal")
                processedText.innerHTML = "Your <b>rejected</b> this proposal";
            let response = xhttp.responseText.trim('\n');
            console.log(response);
        }
    };

    xhttp.open("post", "../actions/action_" + action + ".php", true);
    xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhttp.send(encodeForAjax({post_id: post_id, user_id: user_id, csrf: document.querySelector("meta[name='csrf-token']").getAttribute("content")}));
}

function make_proposal(post_id, user_id) {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //Trim is used because the reponse text comes with new lines behind
            let makeProposalButton = document.getElementById("makeProposalButton");
            makeProposalButton.remove();
            let proposalSent = document.getElementById("proposalSentText");
            proposalSent.innerHTML = "Your Proposal is Pending";
        }
    };

    xhttp.open("post", "../actions/action_make_proposal.php", true);
    xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhttp.send(encodeForAjax({post_id: post_id, user_id: user_id, csrf: document.querySelector("meta[name='csrf-token']").getAttribute("content")}));
}

function make_proposal_confirmation(post_id, user_id) {
    showConfirmationPrompt("Are you sure you want to make this adoption proposal?", "make_proposal(" + post_id + "," + user_id + ")");
}
