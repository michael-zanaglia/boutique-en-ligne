import fetchToPhp from "./functions/fetch.js"
document.addEventListener("DOMContentLoaded", function(){
    const container = document.querySelector(".flex-container");
    const filter = document.getElementById("filtre");
    const modal = document.getElementById("modal-bg");
    const categories = document.querySelectorAll(".selection");
    let selectedCategories = [];


    function printOnHTML(data){
        container.innerHTML = '';
        data.forEach(element => {
            let itemElement = document.createElement("div");
            itemElement.className = "cases";
            itemElement.innerHTML = `<a href='detail.php?id_product=${element['id']}'><img class='slider-item' src='data:image;base64,${element['image']}' alt='shop-img'></a>`;
            container.appendChild(itemElement);
        });
    }

    async function GetmyItems(){
        const data = await fetchToPhp(undefined, "postRequest/filterShop.php");
        printOnHTML(data);
        return data;
    } 
    
    GetmyItems().then(data => {
        let heighest = (Math.round(Math.max(...data.map(item => item.price))));
        categories.forEach(category => {
            category.addEventListener("click", () => {
                categories.forEach(cat => {
                    if(cat.textContent === 'Tous' && cat.textContent !== category.textContent) {
                        cat.classList.remove("active-mod");
                        cat.classList.add("unactive-mod");
                    } else if(category.textContent === 'Tous' && cat.textContent != category.textContent){
                        cat.classList.remove("active-mod");
                        cat.classList.add("unactive-mod");
                    }
                })
                let name = category.textContent;
        
                category.classList.toggle("active-mod");
                category.classList.toggle("unactive-mod");

                if(category.classList.contains("unactive-mod")){
                    selectedCategories.filter(cat => cat !== name);
                } else {
                    if(!selectedCategories.includes(name)){
                        selectedCategories.push(name);
                    }
                }

                if(!selectedCategories.includes("Tous")){
                    let filteredList = data.filter(el => selectedCategories.includes(el.category_name));
                    printOnHTML(filteredList);
                } else if(selectedCategories.length === 0){
                    printOnHTML(data); 
                } else {
                    selectedCategories = [];
                    printOnHTML(data); 
                }
                
            });
        });
    });




    filter.addEventListener("click", ()=>{
        modal.style.display = "block";
        document.querySelector("body").style.overflow = "hidden";
    })

    window.addEventListener("click",(e)=>{
        if(e.target == modal){
            modal.style.display = "none";
            document.querySelector("body").style.overflow = "visible";
        }
    })
})