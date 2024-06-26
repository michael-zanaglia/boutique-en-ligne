document.addEventListener('DOMContentLoaded', function(){
    const secDisplay = document.getElementById("secDisplay");
    let seconds = 5;
    const idInterval = setInterval(()=> {
        seconds--;
        secDisplay.innerHTML = "You will be redirected in " + seconds + " or you can click <a href='connexion.html'>here</a> !";

        if (seconds <= 0){
            clearInterval(idInterval);
            window.location.href = 'connexion.html';
        }

    }, 1000)
    
});