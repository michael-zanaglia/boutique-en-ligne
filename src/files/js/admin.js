function changeToInput(td){
    let value = td.innerHTML;
    const input = document.createElement('input');
    input.type = "text";
    input.value = value;

    input.addEventListener("blur", ()=>{
        td.innerHTML = input.value;
        td.onclick = function() { // Permet de retransformer en td
            changeToInput(td);
        };
    })
    td.innerHTML = '';
    td.appendChild(input);
    td.onclick = null;
    input.focus();
}

function goToDataBase(btn){
    let form = document.getElementById("tableForm");
    const formdata = new FormData(form); 
    let row = btn.closest("tr");
    let champs = row.getElementsByTagName("td");
    let listeChamps = [];
    Array.from(champs).forEach((cell) => {
        let inp = document.createElement("input");
        inp.type = "text";
        inp.value = cell.innerHTML;
        formdata.append()
    })
    console.log(listeChamps)
    //form.addEventListener("submit", (e) =>{
    //    //e.preventDefault();
    //   const formdata = new FormData(form);
    //   console.log(formdata, btn.value); 
    //})
}

