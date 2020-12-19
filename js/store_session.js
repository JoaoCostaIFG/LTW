"use strict";

function saveForm() {
  if (typeof window.sessionStorage === "undefined") return;

  clearForm();
  saveValues("input");
  saveValues("select");

  return true;
}

function loadForm() {
  if (typeof window.sessionStorage === "undefined") return;

  setValues("input");
  setValues("select");
}

function saveValues(tag) {
  var inputs = document.querySelectorAll("form " + tag);

  for (var i = 0; i < inputs.length; i++) {
    if (
      inputs[i].name == "password" ||
      inputs[i].name == "password_r" ||
      inputs[i].name == "image"
    )
      continue;

    if (inputs[i].name && inputs[i].value) {
      window.sessionStorage.setItem(inputs[i].name, inputs[i].value);
    }
  }
}

function setValues(tag) {
  var inputs = document.querySelectorAll("form " + tag);

  for (var i = 0; i < inputs.length; i++) {
    if (
      inputs[i].name == "password" ||
      inputs[i].name == "password_r" ||
      inputs[i].name == "image" ||
      inputs[i].type == "submit"
    )
      continue;

    let val = window.sessionStorage.getItem(inputs[i].name);
    if (val) inputs[i].value = val;
  }
}

function clearForm() {
  if (typeof window.sessionStorage === "undefined") return;

  window.sessionStorage.clear();
}

// this are called automatically (script should be loaded with 'defer' option)
loadForm();
clearForm();
