document.addEventListener("DOMContentLoaded", function() {
    let nbImg = document.querySelectorAll('.slider-item').length;
    const slider = document.querySelector('.slider');
    const pods = document.querySelectorAll(".pod");
    const caroussel = document.querySelector('.caroussel');
    let clientX = null;
    let grabbing = null;
    

    const idInterval = setInterval(() => {
        let width = slider.offsetWidth;
        slider.scrollLeft += width;
        if(slider.scrollLeft >= width*(nbImg-1)){
            slider.scrollLeft = 0;
        } 
    }, 4500);
    const observer = new IntersectionObserver((entries)=>{
        entries.forEach((entry) =>{
            //console.log(entry);
            if(entry.isIntersecting){
                entry.target.classList.add('showing');
            } else {
                entry.target.classList.remove('showing');
            }
        });
    });

    pods.forEach((pod)=>observer.observe(pod));


    caroussel.addEventListener("mousedown", (e)=>{
        grabbing = true;
        caroussel.classList.add("active");
        clientX = e.clientX;
        caroussel.style.cursor = 'grabbing';
    });
    caroussel.addEventListener("mouseup", ()=>{
        grabbing = false; 
        caroussel.style.cursor = 'grab';
        caroussel.classList.remove("active");
    });
    caroussel.addEventListener("mouseleave", ()=>{
        if (grabbing) {
            grabbing = false;
            caroussel.style.cursor = 'pointer';
            caroussel.classList.remove("active");
        }
    });
    caroussel.addEventListener("mousemove", (e)=>{
        if(grabbing){
            e.preventDefault();
            const x = e.clientX
            caroussel.scrollLeft -= (x-clientX)
            clientX = x;
            console.log(caroussel.scrollLeft)
        }
    });

})
