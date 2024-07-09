import fetchToPhp from "./functions/fetch";
document.addEventListener("DOMContentLoaded", function() {
    const selects = document.querySelectorAll("select");
    const ids = document.querySelectorAll(".id-product");

    selects.forEach((select, index) => {
        let prevSelect = select.value;
        select.addEventListener("change", async ()=>{
            let id = ids[index].value;
            console.log("-----",id)
            const formdata = new FormData();
            formdata.append('new', select.value)
            formdata.append('former', prevSelect)
            formdata.append('id', id)
            console.log(select.value);
            const result = await fetchToPhp(formdata, "postRequest/stock.php"); 
            if(result){
                console.log("valide")
            }
        })
    });
});