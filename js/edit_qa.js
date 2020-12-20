"use strict";

function toggleAnsEdit(ans_id) {
  let toggleButton = document.getElementById("edit-ans-button" + ans_id);
  let inputField = document.getElementById("edit-ans-field" + ans_id);
  let confirmButton = document.getElementById("edit-ans-confirm" + ans_id);
  if (inputField.style.display == "none") {
    toggleButton.innerHTML = "Cancel edit";
    confirmButton.style.display = "initial";
    inputField.style.display = "initial";
  } else {
    toggleButton.innerHTML = "Edit";
    confirmButton.style.display = "none";
    inputField.style.display = "none";
  }
}

function edit_ans(ans_id) {
  let text = document.getElementById("edit-ans-field" + ans_id).value;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      // Trim is used because the reponse text comes with new lines behind
      let response = xhttp.responseText.trim("\n");
      let answer = document.getElementById("Answer" + ans_id);
      // Error
      if (response.substr(0, 2) === "<p") {
        console.log(response);
        return;
      }
      answer.innerHTML = response;
      toggleAnsEdit(ans_id);
    }
  };

  xhttp.open("post", "../actions/action_edit_ans.php", true);
  xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhttp.send(
    encodeForAjax({
      answer_id: ans_id,
      answer_text: text,
      csrf: document
        .querySelector("meta[name='csrf-token']")
        .getAttribute("content"),
    })
  );
}
