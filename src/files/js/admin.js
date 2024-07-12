//function changeToInput(td){                                         CHANGE TD TO INPUT
//    let value = td.innerHTML;
//    const input = document.createElement('input');
//    input.type = "text";
//    input.value = value;
//
//    input.addEventListener("blur", ()=>{
//        td.innerHTML = input.value;
//        td.onclick = function() { // Permet de retransformer en td
//            changeToInput(td);
//        };
//    })
//    td.innerHTML = '';
//    td.appendChild(input);
//    td.onclick = null;
//    input.focus();
//}

const produits = document.getElementById('produits');
const home = document.getElementById('home');
const tables = document.querySelector(".tableProduct");
const tableHome = document.querySelector(".tableHome");
const produitsSvgPath = document.querySelector(".pathProd");
const middleSvgPath = document.querySelector(".pathAdn");

produits.addEventListener("click", () => {
    tables.classList.toggle("active");
    const isActive = tables.classList.contains("active");

    // Modifier l'attribut "d" en fonction de l'état de la classe "active"
    produitsSvgPath.setAttribute("d", isActive ? "M5 12h14" : "M12 4.5v15m7.5-7.5h-15");
})

home.addEventListener("click", () => {
    tableHome.classList.toggle("active");
    const isActive = tableHome.classList.contains("active");

    // Modifier l'attribut "d" en fonction de l'état de la classe "active"
    middleSvgPath.setAttribute("d", isActive ? "M5 12h14" : "M12 4.5v15m7.5-7.5h-15");
})