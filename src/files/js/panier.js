import fetchToPhp from "./functions/fetch";
document.addEventListener("DOMContentLoaded", function() {
    const selects = document.querySelectorAll("select");
    const ids = document.querySelectorAll(".id-product");
    const buttons = document.querySelectorAll(".delete-case");
    const users = document.querySelectorAll(".user-name");
    const mainBtn = document.querySelector(".btn-vert");
    const form = document.getElementById("panierF");

    selects.forEach((select, index) => {
        let prevSelect = select.value;
        select.addEventListener("change", async ()=>{
            let id = ids[index].value;
            const formdata = new FormData();
            formdata.append('new', select.value)
            formdata.append('former', prevSelect)
            formdata.append('id', id)
            console.log(select.value);
            const result = await fetchToPhp(formdata, "postRequest/stock.php"); 
            if(result){
                window.location.reload();
                console.log('done');
            }
        })
    });

    buttons.forEach((btn, index)=>{
        btn.addEventListener("click", async () => { 
            let user = users[index].value; 
            let id = ids[index].value;
            let select = selects[index].value;
            const formbtn = new FormData();
            formbtn.append('user', user);
            formbtn.append('id', id);
            formbtn.append('quant', select);
            const result = await fetchToPhp(formbtn, "postRequest/delBasketArticle.php"); 
            if(result){
                window.location.reload();
                console.log('done');
            }
        });
    });

    form.addEventListener("submit", async (e) => {
        e.preventDefault(); // Empêche le comportement par défaut de soumission du formulaire pour tester
        const formD = new FormData(form);
        const result = await fetchToPhp(formD, "postRequest/addToOrder.php"); 
        if(result['success']){
            window.location.reload();
        }
    });
});