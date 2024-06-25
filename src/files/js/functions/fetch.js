export default async function fetchToPhp(formulaire, pagePhp){

    let options = {
        method : 'POST',
        body : formulaire
    };

    try {
        const response = await fetch(pagePhp, options);
        if(!response.ok){
            console.log("erreur est survenue lors du fetch, ", response.status);
        }
        const data = response.json();
        return data;
    } catch(err) {
        throw new Error("Error : recuperation de la data, ", err);
    }
    
}