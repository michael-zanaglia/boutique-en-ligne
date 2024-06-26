import fetchToPhp from "./functions/fetch";
document.addEventListener("DOMContentLoaded", function(){
    const form = document.getElementById("inscription");
    const checkbox = document.getElementById("check");
    const btn = document.getElementById("rgt");
    const pElement = document.createElement("p");
    const divInscription = document.querySelector(".form-inscription");
    
    checkbox.addEventListener("change", (e) => {
        if(e.currentTarget.checked){
            btn.disabled = false;
            btn.style.backgroundColor = "#6DF9AD";
        } else {
            btn.disabled = true;
            btn.style.backgroundColor = "#A4A4A4";
        }
    });

    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const formdata = new FormData(form);
        let res = await fetchToPhp(formdata, "inscription.php");
        console.log(res['msg']);
        if (res["msg"] !== ""){
            pElement.textContent = res["msg"];
            divInscription.appendChild(pElement);
        } else {
            window.location.href = "redirection.html";
        }
    })


})