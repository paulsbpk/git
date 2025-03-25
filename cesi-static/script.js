document.addEventListener('DOMContentLoaded', () => {
    const nameInput = document.querySelector('#nom');  // Correction ID
    const scrollTopBtn = document.querySelector('#scrollTopBtn'); // Ajout de la définition

    const sidenav = document.getElementById("mySidenav");
    const openBtn = document.getElementById("openBtn");
    const closeBtn = document.getElementById("closeBtn");

    function openNav() {
        sidenav.classList.add("active");
    }

    function closeNav() {
        sidenav.classList.remove("active");
    }

    openBtn.addEventListener('click', openNav);
    closeBtn.addEventListener('click', closeNav);

    if (scrollTopBtn) {
        scrollTopBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    nameInput.addEventListener('input', () => {
        nameInput.value = nameInput.value.toUpperCase();
    });

    // Validation de l'email
    

    function escape(s){
        return '<script>console.log("'+s+'");<script>';
    }

    console.log(escape.toString());

});
