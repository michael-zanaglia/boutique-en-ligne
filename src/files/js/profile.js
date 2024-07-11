document.addEventListener("DOMContentLoaded", function(){
    //const radios = document.querySelectorAll('.radios');
    //radios.forEach(radio => {
    //    radio.addEventListener('click', () => {
    //        radios.forEach(otherRadio => {
    //            if (radio !== otherRadio){
    //                otherRadio.checked = false;
    //            }
    //        })
    //    })
    //})
    const caseOrder = document.querySelector(".order");
    const caseChangePwd = document.querySelector('.mdp');
    caseChangePwd.addEventListener('click', ()=>{
        window.location.href = "changePwd.php";
    })
    caseOrder.addEventListener('click', ()=>{
        window.location.href = "commande.php";
    })
})