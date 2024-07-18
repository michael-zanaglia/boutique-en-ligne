import fetchToPhp from "./functions/fetch";
document.addEventListener("DOMContentLoaded", function(){
    const burger = document.querySelector(".burger");
    const menu = document.querySelector(".menu-burger");
    const cross = document.querySelector(".leave"); 
    const searchTool = document.querySelector(".search-bar");
    const form = document.querySelector(".form-search");
    const input = document.querySelector(".inp");
    const completionBox = document.querySelector(".autocompletion");

    input.addEventListener("input", async (e)=>{
        if(e.target.value.length > 0){
            completionBox.style.display = "block";
            const formdata = new FormData();
            formdata.append("input", e.target.value);
            let result = await fetchToPhp(formdata, "/boutique-en-ligne/src/files/postRequest/completion.php"); 
           
            completionBox.innerHTML = '';
            result.forEach(product => {
                let p = document.createElement("p");
                p.classList.add("result");
                p.innerHTML = product['name'];
                completionBox.appendChild(p);
                p.addEventListener("click", ()=>{
                    window.location.href = "/boutique-en-ligne/src/files/detail.php?id_product="+product['id'];
                })
            });
        } else {
            completionBox.style.display = "none";
        }
    })

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
        if(form.classList.contains("formShown") && !form.contains(e.target) && e.target != searchTool){
            form.classList.remove("formShown");
            completionBox.style.display = 'none';
        }
    })

    searchTool.addEventListener("click", ()=>{
        form.classList.toggle("formShown");
        if(!form.classList.contains("formShown")){
            completionBox.style.display = 'none';
        } else {
            completionBox.style.display = 'block';
        }
       
    })
    form.addEventListener("click", (e) => {
        e.stopPropagation(); // Empêche la propagation du clic jusqu'à .search-bar
    });

})
