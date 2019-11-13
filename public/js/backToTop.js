class backToTop {
    
    constructor(btnId) {
        var thisBackToTop = this;
        this.backToTopBtn = document.getElementById(btnId);
        this.toggleBtn();
        window.addEventListener('scroll', function(e) {
            thisBackToTop.toggleBtn();
        },false);
        
        this.backToTopBtn.addEventListener('click',function(e) {
			e.preventDefault();
            thisBackToTop.goBackToTop();
		});
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