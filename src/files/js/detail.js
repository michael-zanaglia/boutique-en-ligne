import fetchToPhp from "./functions/fetch";
document.addEventListener("DOMContentLoaded", function() {
    const minus = document.querySelector(".btn-minus");
    const plus = document.querySelector(".btn-plus");
    const countDisplay = document.querySelector(".count");
    // Il va me servir a regarder si le user est connecte ou non.
    const inpBoolean = document.querySelector(".using");
    const fav = document.querySelector(".fav");
    const id = document.querySelector(".id");
    const user = document.querySelector(".user");

    let stockTotal = document.querySelector(".stockTotal").textContent;
    let took = document.querySelector(".took");
    //const add = document.getElementById("adding");
    let want = 1;
    
    //const form = document.getElementById("form-add");

    const myImg = document.querySelector(".produit img").src;
    const produit = document.querySelector(".produit");

    produit.style.setProperty("--img-src", `url(${myImg})`);

    produit.addEventListener('mousemove', function (e) {
        const rect = produit.getBoundingClientRect();
        const mouseX = e.clientX;
        const mouseY = e.clientY;
        const relativePosX = mouseX - rect.left;
        const relativePosY = mouseY - rect.top;
        const X = (relativePosX * 100)/rect.width;
        const Y = (relativePosY * 100)/rect.height;
        produit.style.setProperty("--pos-x", `${relativePosX}px`);
        produit.style.setProperty("--pos-y", `${relativePosY}px`);
        produit.style.setProperty("--x", `${X}%`);
        produit.style.setProperty("--y", `${Y}%`);
    });

    function updateDisplay() {
        countDisplay.textContent = want;
        minus.disabled = want === 1;
        plus.disabled = want >= stockTotal;
        took.value = want;
    }

    console.log(minus, plus)
    
    if(inpBoolean.value !='f') {
       updateDisplay(); 
    }
    

    minus.addEventListener("click", (e) => {
        console.log("dd")
        e.preventDefault();
        if(inpBoolean.value !='f') {
            if (want > 1) {
                want -= 1;
                updateDisplay();
                
            }
        } else {
            alert("Connectez-vous avant de modifier la quantité.");
        }
    });
    
    plus.addEventListener("click", (e) => {
        e.preventDefault();
        if(inpBoolean.value !='f') {
            if(want < stockTotal){
                want += 1;
                updateDisplay(); 
            }
        } else {
            alert("Connectez-vous avant de modifier la quantité.");
        }
        
    });

    

    if(fav){
        let currentFill = fav.getAttribute("fill");
        let clicked = currentFill === '#FF0000'? true : false;
        fav.addEventListener("click", async ()=>{
            clicked = !clicked;
            if(clicked){
                fav.setAttribute("fill", "#FF0000"); 
            } else {
                fav.setAttribute("fill", "none"); 
            }
            const formdata = new FormData();
            formdata.append("id_product",  id.value);
            formdata.append("id_user", user.value);
            formdata.append("clicked", clicked);
            let response = fetchToPhp(formdata,"postRequest/addFav.php");
        })

    }


   //add.addEventListener("click", (e) =>{
   //    e.preventDefault();
   //})

   //form.addEventListener("submit", ()=> {
   //    alert('hello');
   //    forda = new FormData(form);
   //    console.log(forda);
   //})
    
});