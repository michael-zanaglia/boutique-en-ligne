export default async function fetchToPhp(formulaire = '', pagePhp){
    let options;
    if(formulaire!== ''){
        options = {
            method : 'POST',
            body : formulaire
        };  
    } else {
        options = {
            method : 'GET'
        }
    }
    
    try {
        const response = await fetch(pagePhp, options);
        if(!response.ok){
            console.log("erreur est survenue lors du fetch, ", response.status);
        }
        const data = await response.json();
        console.log("Réponse du serveur :", data);
        return data;
    } catch(err) {
        throw new Error(`Error : récupération des données, ${err.message}`);
    }
    
}