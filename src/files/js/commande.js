document.addEventListener("DOMContentLoaded", function(){
    const buttons = document.querySelectorAll(".slide-down");
    const infos = document.querySelectorAll(".info");

    buttons.forEach((btn,ind)=> {
        btn.addEventListener("click", ()=>{
            let mycase = infos[ind];
            mycase.classList.toggle("active");
            btn.classList.toggle("rotate");
        });
    });
})