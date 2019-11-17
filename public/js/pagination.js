class pagination {
    
    constructor(buttonsContainer) {
        this.buttonsContainer = document.getElementById(buttonsContainer);
        if (this.buttonsContainer) {
            this.buttonsContainer.classList.remove('hidden');
            var buttons = this.buttonsContainer.querySelectorAll('button');
            for (var i=0;i<buttons.length;i++) {
                //initialisation à l'ouverture de la page
                if (i!=0) {
                    var contentPage = buttons[i].getAttribute('data-page');
                    if (document.getElementById(contentPage)) {
                        document.getElementById(contentPage).classList.add('hidden');
                    }
                }
                //comportement au clic sur le bouton
                buttons[i].addEventListener('click',(e)=>{
                    this.displayPage(e.target.getAttribute('data-page'));
                });
            }
        }
    }

    displayPage(contentPageToDisplay) {
        var buttons = this.buttonsContainer.querySelectorAll('button');
        for (var i=0;i<buttons.length;i++) {
            var contentPage = buttons[i].getAttribute('data-page');
            if (document.getElementById(contentPage)) {
                if (contentPage==contentPageToDisplay) {
                    document.getElementById(contentPage).classList.remove('hidden');
                } else {
                    document.getElementById(contentPage).classList.add('hidden');
                }
            }
        }
    }
}

new pagination ('pagination-buttons');
