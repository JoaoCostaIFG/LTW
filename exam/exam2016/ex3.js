/*
<form id="pin" method="post">
  <input type="text" name="username">
  <input type="text" name="pin">
  <input type="submit" value="Verify">
</form>
<div id="keypad">
  <a href="#">1</a> <a href="#">2</a> <a href="#">3</a> <br>
  <a href="#">4</a> <a href="#">5</a> <a href="#">6</a> <br>
  <a href="#">7</a> <a href="#">8</a> <a href="#">9</a> <br>
</div>
*/

// a)
let pinField = document.querySelector("form#pin input[name=pin]");
let nums = document.querySelectorAll("div#keypad a");
for (let i = 0; i < nums.length; ++i) {
  let num = nums[i].innerHTML;
  nums[i].addEventListener("click", function () {
    pinField.value += num;
  });
}

// b)
// formato: {"valid": "true"} ou {"valid": "false"}
let req = new XMLHttpRequest();
req.onreadystatechange = function () {
  if (req.readyState == 4) {
    // TODO JSON.parse passa "true" para bool true ?
    let ans = JSON.parse(req.responseText);
    if (ans["valid"] === "false") {
      let pinField = document.querySelector("form#pin input[name=pin]");
      pinField.setAttribute("style", "border-color:red;");
      pinField.setAttribute("value", "");
    }
    else {
      // nothing
    }
  }
};

req.open("POST", "verify_pin.php", true);
req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
req.send(
  encodeForAjax({
    username: document
      .querySelector("form#pin input[name=username]")
      .getAttribute("value"),
    pin: document
      .querySelector("form#pin input[name=pin]")
      .getAttribute("value"),
  })
);
