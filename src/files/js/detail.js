document.addEventListener("DOMContentLoaded", function() {
    const minus = document.querySelector(".btn-minus");
    const plus = document.querySelector(".btn-plus");
    const countDisplay = document.querySelector(".count");
    let stockTotal = document.querySelector(".stockTotal").textContent;
    let took = document.querySelector(".took");
    const add = document.getElementById("adding");
    let want = 1;
    const form = document.getElementById("form-add");
    function updateDisplay() {
        countDisplay.textContent = want;
        minus.disabled = want === 1;
        plus.disabled = want >= stockTotal;
        took.value = want;
        console.log(took.value);
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

   //add.addEventListener("click", (e) =>{
   //    e.preventDefault();
   //})

   //form.addEventListener("submit", ()=> {
   //    alert('hello');
   //    forda = new FormData(form);
   //    console.log(forda);
   //})
    
});