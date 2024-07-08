document.addEventListener("DOMContentLoaded", function(){
    const burger = document.querySelector(".burger");
    const menu = document.querySelector(".menu-burger");
    const cross = document.querySelector(".leave"); 


    function openMenu(){
        menu.classList.add("open");
        document.body.classList.add('no-scroll');
    }

    function closeMenu(){
        document.body.classList.remove('no-scroll');
        menu.classList.remove("open");
    }

    burger.addEventListener("click", ()=>{openMenu()})
    //burger.addEventListener("touchend", ()=>{openMenu()})
    cross.addEventListener("click", () => {closeMenu()})
    //cross.addEventListener("touchend", () => {closeMenu()})

    window.addEventListener("click", (e) => {
        if(menu.classList.contains("open") && !menu.contains(e.target) && e.target !== burger){
            menu.classList.remove("open");
        }
    })
})
