import fetchToPhp from "./functions/fetch.js"
document.addEventListener("DOMContentLoaded", function(){
    const container = document.querySelector(".flex-container");
    const filter = document.getElementById("filtre");
    const modal = document.getElementById("modal-bg");
    const categories = document.querySelectorAll(".selection");
    let selectedCategories = [];
    let budget = null;
    let orderBy = null;
    const slideValue = document.querySelector("span");
    const inputSlider = document.getElementById("inpSlide");
    const selectorElement = document.getElementById("orderBy");


    function printOnHTML(data){
        container.innerHTML = '';
        if(data){
            data.forEach(element => {
                let itemElement = document.createElement("div");
                itemElement.className = "cases";
                itemElement.innerHTML = `<a href='detail.php?id_product=${element['id']}'><img class='slider-item' src='data:image;base64,${element['image']}' alt='shop-img'></a>`;
                container.appendChild(itemElement);
            });  
        } else {
            let itemElement = document.createElement("div");
                itemElement.innerHTML = "Aucun Match...";
                container.appendChild(itemElement);
        }
        
    }

    function applyFilters(data) {
        let myList = data;

        if(selectedCategories.length > 0) {
            myList = data.filter(el => selectedCategories.includes(el.category_name));
        }

        if(budget !== null ) {
            myList = myList.filter(el => el.price <= budget);    
        } 

        if(orderBy !== null) {
            if(orderBy === 'asc'){
               myList = myList.sort((a, b) => a.name.localeCompare(b.name));  
            } else if(orderBy === 'asc'){
                myList = myList.sort((a, b) => b.name.localeCompare(a.name)); 
            }
            
        }
        printOnHTML(myList);
    }


    async function GetmyItems(){
        const data = await fetchToPhp(undefined, "postRequest/filterShop.php");
        printOnHTML(data);
        return data;
    } 

    

    GetmyItems().then(data => {
        let heighest = (Math.round(Math.max(...data.map(item => item.price))));

        inputSlider.addEventListener("input", ()=>{
            slideValue.textContent = inputSlider.value;
            slideValue.style.left = ((inputSlider.value*100)/heighest)+"%"; 
            slideValue.classList.add("show");
        })
        inputSlider.addEventListener("blur", ()=>{
            slideValue.classList.remove("show");
        })
        inputSlider.addEventListener("mouseup", ()=>{
            budget = parseInt(inputSlider.value);
            applyFilters(data);
        })

        selectorElement.addEventListener("change",()=>{
            orderBy = selectorElement.value;
            applyFilters(data);
        })

        categories.forEach(category => {
            category.addEventListener("click", () => {
                let name = category.textContent;

                if(name==='Tous'){
                    selectedCategories = [];
                    categories.forEach(cat => {
                        cat.classList.remove("active-mod");
                        cat.classList.add("unactive-mod");
                    })

                    category.classList.add("active-mod");
                    category.classList.remove("unactive-mod");
                    budget = null;
                    inputSlider.value = heighest/2;
                    slideValue.style.left = ((inputSlider.value*100)/heighest)+"%"; 
                    orderBy = null;

                } else {
                    if (category.classList.contains("unactive-mod")) {
                        selectedCategories.push(name);
                    } else {
                        selectedCategories = selectedCategories.filter(cat => cat !== name);
                    }

                    categories.forEach(cat => {
                        if(cat.textContent === 'Tous') {
                            cat.classList.remove("active-mod");
                            cat.classList.add("unactive-mod");
                        }
                    })

                    category.classList.toggle("active-mod");
                    category.classList.toggle("unactive-mod");
                }

                applyFilters(data);
                
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