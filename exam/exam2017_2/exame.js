/*
1)
  a)
    R1: 0 1 0 1
    R2: 0 1 1 2
    R3: 0 1 1 1
    R4: 0 1 1 2
    R5: 0 1 0 2
    R6: 0 0 0 3

  b)
    cyan magenta magenta magenta
  
  c)
    cyan blue red red

2)
  a) Washing the [washing machine while watching the washing machine washing washing]
  b) Washing the washing m[ac]hine while watching the washing machine washing washing
  c) W[ashing the wash]ing machine while watching the washing machine washing washing
  d) [Washing the washing machine while watching the washing machine washing washing]
  e) Washing the washing machine while watching the washing machine [washing] washing
  f) Washing the [washing machine while watching the washing machine washing wa]shing
*/

// 3)
//  a)

let largeImg = document.querySelector("div#photos img.large");

let smallImages = document.querySelectorAll("div#photos ul li img");
for (let i = 0; i < smallImages.length; ++i) {
  let smallImg = smallImages[i];
  smallImg.addEventListener("click", function () {
    largeImg.src = "large/" + smallImg.getAttribute("src");
  });
}

//  b)
function newImgReq() {
  let req = new XMLHttpRequest();
  req.onreadystatechange = function () {
    // if is loaded
    if (req.readyState == 4) {
      let imageList = document.querySelector("div#photos ul");
      // imageList.innerHTML = "";
      while (imageList.childNodes.length > 0) imageList.childNodes[0].remove();

      let newImages = JSON.parse(req.responseText);
      for (let i = 0; i < newImages.length; ++i) {
        let newImg = document.createElement("img");
        newImg.src = newImages[i];

        let newLi = document.createElement("li");
        newLi.appendChild(newImg);

        imageList.appendChild(newLi);
      }
    }
  };

  req.open("GET", "getrandomimages.php", true);
  req.send();
}

document
  .querySelector("div#photos a.load")
  .addEventListener("click", newImgReq);

/*
4)
  a) //book/text()
  b) //book[@year > 1900]/text()
  c) //book[../@country = "England"]/@year
  d) //author[book/@type=" Novel "]/@name
*/
