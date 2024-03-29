class menu {
    
    constructor(menu, crossMenu, menuMobile) {
        this.menu = document.getElementById(menu);
        this.crossMenu = document.getElementById(crossMenu);
        this.menuMobile = document.getElementById(menuMobile);

        if (this.crossMenu){
            this.crossMenu.addEventListener('click', (e)=>{
            e.preventDefault();
            this.menuClose();
            });
        }

        if (this.menuMobile){
            this.menuMobile.addEventListener('click', (e)=>{
            e.preventDefault();
            this.menuOpen();
            });
        }
    }

    //Fermeture du menu
    menuClose(e){
        this.menu.classList.remove('ouvre');
        this.menu.classList.add('ferme');
    }

    //Ouverture du menu
    menuOpen(){
        if(this.menu.classList.contains('ferme')){
            this.menu.classList.remove('ferme');
            this.menu.classList.add('ouvre');
        } else {
            this.menu.classList.add('ferme');
            this.menu.classList.remove('ouvre');
        }
    }
}

new menu ('menu', 'crossMenu', 'menuMobile');
