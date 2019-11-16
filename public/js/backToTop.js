class backToTop {
    
    constructor(btnId) {
        this.backToTopBtn = document.getElementById(btnId);
        this.toggleBtn();
        window.addEventListener('scroll', (e)=> {
            this.toggleBtn();
        },false);
        
        if (this.backToTopBtn){
             this.backToTopBtn.addEventListener('click',(e)=> {
            e.preventDefault();
            this.goBackToTop();
             });
        }

    }
    
    //Affichage ou non du bouton en fonction de sa position dans la page
    toggleBtn() {
        if (window.pageYOffset<200) {
            this.backToTopBtn.classList.add('hidden');
        } else {
            this.backToTopBtn.classList.remove('hidden');
        }
    }
    
    //Remontée progressive en haut de la page
    goBackToTop() {
        window.scroll({
            top: 0, 
            left: 0, 
            behavior: 'smooth'
        });
    }
}

new backToTop('retourHtPage');