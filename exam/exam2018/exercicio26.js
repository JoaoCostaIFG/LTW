function encodeForAjax(data) {
    return Object.keys(data).map(function (k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');
}

function makeUsed()
{
    let used = this.className;
    if(used !== "used")
    {
        this.setAttribute("class","used");
        let text = document.getElementsByName("guess")[0];
        text.value = text.value + this.innerHTML;
    }
}

function checkVal(event)
{
    let parse = JSON.parse(event.target.responseText);
    if(parse["result"] == "correct")
    {
        let list = document.getElementsByTagName("ul")[0];
        list.innerHTML = "";
        for(let i=0; i< parse["word"].length;i++)
        {
            let newLi = document.createElement("li");
            newLi.innerHTML = parse["word"][i];
            list.appendChild(newLi);
        }

    }
    else{
        alert("You are wrong");
        
    }
    let text = document.getElementsByName("guess")[0];
    text.value = "";
}

function send()
{
    let text = document.getElementsByName("guess")[0].value;
    let request = new XMLHttpRequest();
    request.addEventListener("load", checkVal)
    request.open("post","is_guess_correct.php",true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.send(
        encodeForAjax({
            guess : text
        })
      );
}

let listItems = document.getElementsByTagName("li");

for(let i=0; i<listItems.length;i++)
    listItems[i].addEventListener("click", makeUsed.bind(listItems[i]));


let resetButton = document.getElementsByName("reset")[0];

resetButton.addEventListener("click",function() {
    for(let i=0; i<listItems.length;i++)
        listItems[i].setAttribute("class","");
    let text = document.getElementsByName("guess")[0];
    text.value = "";
});

let sendButton = document.getElementsByName("send")[0];

sendButton.addEventListener("click",send);

