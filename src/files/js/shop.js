import fetchToPhp from "./functions/fetch.js"
document.addEventListener("DOMContentLoaded", function(){
    const container = document.querySelector(".flex-container");
    const filter = document.getElementById("filtre");
    const modal = document.getElementById("modal-bg");
    const categories = document.querySelectorAll(".selection");

    async function GetmyItems(){
        const data = await fetchToPhp(undefined, "postRequest/filterShop.php");
        data.forEach(element => {
            let itemElement = document.createElement("div");
            itemElement.className = "cases";
            itemElement.innerHTML = `<a href='detail.php?id_product=${element['id']}'><img class='slider-item' src='data:image;base64,${element['image']}' alt='shop-img'></a>`;
            container.appendChild(itemElement);
        });
        return data;
    } 
    
    GetmyItems().then(data => {
        categories.forEach(category => {
            category.addEventListener("click", () => {
                category.style.backgroundColor = "#A7A7A7";
                category.style.color = "#F5F5F5";
                let name = category.textContent;
                console.log(name)
                let filteredList = data.filter(el => el.category === name);
                console.log(filteredList);
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