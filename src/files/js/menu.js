import fetchToPhp from "./functions/fetch";
document.addEventListener("DOMContentLoaded", function(){
    const burger = document.querySelector(".burger");
    const menu = document.querySelector(".menu-burger");
    const cross = document.querySelector(".leave"); 

    const searchTool = document.querySelector(".search-bar");
    const computerForm =document.querySelector(".computerView");
    const forms = document.querySelectorAll(".form-search");

    function displaySearch(element){
        const elementCompletionBox = element.querySelector(".autocompletion");
        let elementForm = element.querySelector(".form-search");
        let input = element.querySelector(".inp");
        elementForm.classList.toggle("formShown");
        if(!elementForm.classList.contains("formShown")){
            elementCompletionBox.style.display = 'none';
            elementCompletionBox.innerHTML = '';
        } else {
            elementCompletionBox.style.display = 'block';
        }
        input.addEventListener("input", async (e)=>{
            if(e.target.value.length > 0){
                console.log("sup")
                elementCompletionBox.style.display = "block";
                const formdata = new FormData();
                formdata.append("input", e.target.value);
                let result = await fetchToPhp(formdata, "/boutique-en-ligne/src/files/postRequest/completion.php"); 
               
                elementCompletionBox.innerHTML = '';
                result.forEach(product => {
                    let p = document.createElement("p");
                    p.classList.add("result");
                    p.innerHTML = product['name'];
                    elementCompletionBox.appendChild(p);
                    p.addEventListener("click", ()=>{
                        window.location.href = "/boutique-en-ligne/src/files/detail.php?id_product="+product['id'];
                    })
                });
            } else {
                elementCompletionBox.style.display = "none";
            }
        })
        elementForm.addEventListener("click", (e) => {
            e.stopPropagation(); // Empêche la propagation du clic jusqu'à .search-bar
        });
    }


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
        forms.forEach(form => {
            let completionBox = form.querySelector(".autocompletion");
            if(form.classList.contains("formShown") && !form.contains(e.target) && e.target != searchTool && e.target != computerForm ){
                form.classList.remove("formShown");
                completionBox.style.display = 'none';
            }  
        })
        
    })

    searchTool.addEventListener("click", ()=>{ displaySearch(searchTool); });
    computerForm.addEventListener("click", ()=>{ displaySearch(computerForm); });

    //forms.forEach(form => {
    //    form.addEventListener("click", (e) => {
    //        e.stopPropagation(); // Empêche la propagation du clic jusqu'à .search-bar
    //    });
    //})

})
