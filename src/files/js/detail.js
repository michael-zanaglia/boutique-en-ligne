import fetchToPhp from "./functions/fetch";
document.addEventListener("DOMContentLoaded", function() {
    const minus = document.querySelector(".btn-minus");
    const plus = document.querySelector(".btn-plus");
    const countDisplay = document.querySelector(".count");
    const fav = document.querySelector(".fav");
    const id = document.querySelector(".id");
    const user = document.querySelector(".user");

    let stockTotal = document.querySelector(".stockTotal").textContent;
    let took = document.querySelector(".took");
    //const add = document.getElementById("adding");
    let want = 1;
    let currentFill = fav.getAttribute("fill");
    let clicked = currentFill === '#FF0000'? true : false;
    //const form = document.getElementById("form-add");

    function updateDisplay() {
        countDisplay.textContent = want;
        minus.disabled = want === 1;
        plus.disabled = want >= stockTotal;
        took.value = want;
    }
    // Initial state
    updateDisplay();

    // Event listener for minus button
    minus.addEventListener("click", (e) => {
        e.preventDefault();
        if (want > 1) {
            want -= 1;
            updateDisplay();
            
        }
    });

    // Event listener for plus button
    plus.addEventListener("click", (e) => {
        e.preventDefault();
        if(want < stockTotal){
            want += 1;
            updateDisplay(); 
        }
        
    });

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

   //add.addEventListener("click", (e) =>{
   //    e.preventDefault();
   //})

   //form.addEventListener("submit", ()=> {
   //    alert('hello');
   //    forda = new FormData(form);
   //    console.log(forda);
   //})
    
});