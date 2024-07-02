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
