import fetchToPhp from "./functions/fetch";
document.addEventListener("DOMContentLoaded", function(){
    const form = document.getElementById("inscription");
    const checkbox = document.getElementById("check");
    const btn = document.getElementById("rgt");
    
    checkbox.addEventListener("change", (e) => {
        if(e.currentTarget.checked){
            btn.disabled = false;
            btn.style.backgroundColor = "#6DF9AD";
        } else {
            btn.disabled = true;
            btn.style.backgroundColor = "#a4a4a4";
        }
    });

    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const formdata = new FormData(form);
        let res = await fetchToPhp(formdata, "inscription.php");
        console.log(res);
    })


})