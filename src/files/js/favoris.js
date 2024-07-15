import fetchToPhp from "./functions/fetch";
document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById('form-fav');
    const btns = document.querySelectorAll(".btn-fav");
    if(form){
        let actionValue = '';
        btns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                actionValue = e.currentTarget.value;
                console.log(actionValue);
            });
        });

        form.addEventListener("submit", async (e)=>{
            e.preventDefault();
            const formdata = new FormData(form);
            formdata.append('action', actionValue);
            let result = await fetchToPhp(formdata, "postRequest/favGest.php");
            if(result['success']){
                window.location.reload();
            }
        })  
    }
    
    
})