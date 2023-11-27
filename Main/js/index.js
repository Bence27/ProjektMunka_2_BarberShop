function scrollToElement(elementId) 
{
    if(window.innerWidth < 1660)
    {
        const element = document.getElementById(elementId);
        if (element) 
        {
            const elementY = element.getBoundingClientRect().top + window.scrollY;
            window.scrollTo({ top: elementY - window.innerHeight / 4.5, behavior: 'smooth' });
        }
    }
    else
    {
        const element = document.getElementById(elementId);
        if (element)
        {
            const elementY = element.getBoundingClientRect().top + window.scrollY;
            window.scrollTo({ top: elementY - window.innerHeight / 3.5, behavior: 'smooth' });
        }
    }
}


window.onload = function() 
{
    var rendelesLeadva = localStorage.getItem('rendeles_leadva');
    if (rendelesLeadva === 'true') 
    {
      // Nyisd meg a modal-t, ha a rendelés már megtörtént
      $('#visszamodal').modal('show');
  
      // Töröld a localStorage értékét a modal megnyitása után
      localStorage.removeItem('rendeles_leadva');
    }
};


function hamburgermenubezar()
{
    document.getElementById("hamburgermenu").setAttribute("aria-expanded", false);
    document.getElementById("hamburgermenu").classList.add("collapsed");
    document.getElementById("navbarNav2").classList.remove("show");
}


function navbetoltes()
{
    if(window.innerWidth <= 991)
    {
        document.getElementById("nagynav").setAttribute("style", "display:none;");
        document.getElementById("kisnav").removeAttribute("style");
    }
    else
    {
        document.getElementById("nagynav").removeAttribute("style");
        document.getElementById("kisnav").setAttribute("style", "display:none;");
    }
}
window.addEventListener("resize", navbetoltes);
window.addEventListener("load", navbetoltes);