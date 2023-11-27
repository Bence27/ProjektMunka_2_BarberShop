window.addEventListener("load",Vezerlopult_betolt);

function removeAllChildNodes(parent)
{
    while (parent.firstChild) 
    {
        parent.removeChild(parent.firstChild);
    }
}

function $(x)
{
    return document.createElement(x);
}


async function Vezerlopult_betolt()
{
    try 
    {
        var body=document.getElementsByClassName("tartalom")[0];
        removeAllChildNodes(body);
        var cim=document.createElement("h3");
        cim.setAttribute("style","color:grey");
        cim.innerHTML="Vezérlőpult";
        var vonal=document.createElement("hr");
        vonal.setAttribute("style","color:grey; height:3px");
        vonal.classList.add("mb-5");
        body.appendChild(cim);
        body.appendChild(vonal);

        var ujfoglalas_body=document.createElement("div");
        ujfoglalas_body.classList.add("container-fluid");
        var cim2=document.createElement("h3");
        cim2.setAttribute("style","color:grey");
        cim2.innerHTML="Új Foglalások:";
        ujfoglalas_body.appendChild(cim2);

        var table=document.createElement("table");
        table.classList.add("table", "mb-5");
        var thead=document.createElement("thead");
        var tr=document.createElement("tr");
        var headers=["Foglalás azonosító","Ügyfél adatok","Szolgáltatás","Státusz"];
        for(let i = 0; i < 4; i++)
        {
            var th=$("th");
            th.setAttribute("scope","col");
            th.setAttribute("style","color:orange");
            th.innerHTML=headers[i];
            tr.appendChild(th)
        }
        thead.appendChild(tr);

        
        let foglalasok = await fetch("../../index.php/foglalasokLekeres");
        let data_foglalasok = await foglalasok.json();


        var tbody=$("tbody");
        if(data_foglalasok[0] == 0)
        {
            var tr=$("tr");
            tr.classList.add("table-warning");
            var td=$("td");
            td.setAttribute("colspan","5");
            td.setAttribute("style","text-align:center");
            td.innerHTML="Nincs megjeleníthető foglalás";
            tr.appendChild(td);
            tbody.appendChild(tr);
        }
        else
        {
            for(let i=0; i<data_foglalasok.length; i++)
            {
                if(i == 0 || i % 2 == 0)
                {
                    var tr=$("tr");
                    tr.classList.add("table-secondary");
                }
                else
                {
                    var tr=$("tr"); 
                }
                

                let szolg_adatok = [];
                try
                {
                    let valasz = await fetch("../../index.php/szolgaltatasLekeres", {method : "POST",
                    body : JSON.stringify({
                        "szolgID": data_foglalasok[i].szolgID
                        })
                    });
                    szolg_adatok = await valasz.json();
                }
                catch(exc)
                {
                    console.log(exc);
                }
                

                const eredetiDatum = new Date(data_foglalasok[i].kezdes);
                const formazottDatum = eredetiDatum.toLocaleDateString('hu-HU');
                const formazottIdo = eredetiDatum.toLocaleTimeString('hu-HU', { hour: 'numeric', minute: 'numeric'});


                var td1=$("td");
                td1.innerHTML = "<h3 style='color: orange'>" + data_foglalasok[i].id + "</h3>" + "Kezdés <br>" + formazottDatum + " " + formazottIdo;
                td1.classList.add("align-middle");

                var td2=$("td");
                td2.innerHTML = data_foglalasok[i].nev + "<br>" + data_foglalasok[i].telszam + "<br>"+data_foglalasok[i].email;
                td2.classList.add("align-middle");

                var td3=$("td");
                td3.innerHTML = szolg_adatok[0].nev + "<br>" + szolg_adatok[0].ido + "<br>" + (parseInt(szolg_adatok[0].koltseg)).toLocaleString("hu-HU") + " Ft";
                td3.classList.add("align-middle");

                var td4=$("td");
                if(data_foglalasok[i].teljesitve == 0)
                {
                    td4.innerHTML="<select onchange=Teljesites_Rogzites(this.id) id="+data_foglalasok[i].id+"> <option> Függőben </option> <option> Teljesítve </option> </select> <br><br> <span style='cursor:pointer' id='"+data_foglalasok[i].id+"' onclick='Foglalas_Torol(this.id)'>&#10060;</span>";
                }
                else
                {
                    td4.innerHTML="<select disabled onchange=Teljesites_Rogzites(this.id) id="+data_foglalasok[i].id+"> <option> Függőben </option> <option selected> Teljesítve </option> </select> <br><br> <span style='cursor:pointer' id='"+data_foglalasok[i].id+"' onclick='Foglalas_Torol(this.id)'>&#10060;</span>";
                    tr.classList.remove("table-secondary");
                    tr.classList.add("table-success");
                }
                td4.classList.add("align-middle");
                tr.appendChild(td1);
                tr.appendChild(td2);
                tr.appendChild(td3);
                tr.appendChild(td4);
                tbody.appendChild(tr);

            }
        }

        
        table.appendChild(thead);
        table.appendChild(tbody);
        ujfoglalas_body.appendChild(table);
        body.appendChild(ujfoglalas_body);
    } 
    catch (error) 
    {
        console.log(error)    
    }
}

async function Foglalas_Torol(id)
{
    let text = "Biztos Hogy Ki akarod törölni a "+id+" azonosítóval rendelkező foglalást?";
    if (confirm(text) == true) 
    {
      try
      {
          let valasz = await fetch("../../index.php/Foglalas_Torol", {method : "POST",
          body : JSON.stringify(
          {
          "id": id
          })});
          let data=valasz.json();
          location.reload();
      }
      catch (error) 
      {
          console.log(error)    
      }
    }
}


async function Teljesites_Rogzites(id)
{
    var select=document.getElementById(id);
    select.disabled=true;
    try
    {
        let valasz = await fetch("../../index.php/Teljesites_Rogzites", {method : "POST",
        body : JSON.stringify(
        {
            "id": id
        })});
        let data=valasz.json();
        location.reload();
    }
    catch (error) 
    {
        console.log(error)    
    }
}


/*Bejelentkezés, regelés stb */

function kiirreg(adatok)
{
    let ide = document.getElementById("ideuzi");
    let uzenetdoboz = document.createElement("div");
    let gomb = document.createElement("button");
    let gombszoveg = document.createElement("span");
    let uzenet = document.createElement("span");

    if(adatok == "Jelszóváltás sikeres!" || adatok == "Sikeres bejelentkezés" || adatok == "Új jelszavát elküldtük az emailcímére!" || adatok == "Sikeres kijelentkezés!")
    {
        uzenetdoboz.classList.add("alert", "alert-success", "alert-dismissible", "fade", "show");
    }
    else
    {
        uzenetdoboz.classList.add("alert", "alert-warning", "alert-dismissible", "fade", "show");
    }
    uzenetdoboz.setAttribute("role", "alert");

    gomb.setAttribute("type", "button");
    gomb.setAttribute("data-bs-dismiss", "alert");
    gomb.setAttribute("aria-label", "Close");
    gomb.classList.add("btn-close");

    gombszoveg.setAttribute("aria-hidden", true);

    uzenet.innerHTML = adatok;

    gomb.appendChild(gombszoveg);
    uzenetdoboz.appendChild(uzenet);
    uzenetdoboz.appendChild(gomb);
    ide.appendChild(uzenetdoboz);
}


async function Bejelentkezes()
{
    try
    {
        let valasz = await fetch("../../index.php/bejelentkezesADMIN", {method : "POST",
        body : JSON.stringify(
        {
        "fnev": document.getElementById("belepofnev").value,
        "jelszo": document.getElementById("belepojelszo").value,
        "token":document.getElementById("csrf_token").value})});
        let data = await valasz.json();
        kiirreg(data);
    }
    catch(exc)
    {
        console.log(exc);
    } 
}

async function Jelszomodosito()
{
    var token = document.getElementById("csrf_token").value;
    try
    {
        let valasz = await fetch("../../index.php/jelmodADMIN", {method : "POST",
        body : JSON.stringify(
        {
        "jelszo": document.getElementById("jelszomod1").value,
        "jelszo2": document.getElementById("jelszomod2").value,
        "token":token})});
        let data = await valasz.json();
        kiirreg(data);
    }
    catch(exc)
    {
        console.log(exc);
    } 
}


async function Ujjelszo()
{
    var token = document.getElementById("csrf_token").value;
    try
    {
        let valasz = await fetch("../../index.php/ujjelszoADMIN", {method : "POST",
        body : JSON.stringify({"email": document.getElementById("elfelejtettemail").value, "token":token})});
        let data = await valasz.json();
        kiirreg(data);
    }
    catch(exc)
    {
        console.log(exc);
    } 
}


async function Kijelentkezes()
{
    try
    {
        let valasz = await fetch("../../index.php/kijelentkezesADMIN");
        let data = await valasz.json();
        kiirreg(data);
    }
    catch(exc)
    {
        console.log(exc);
    } 
}

if(document.getElementById("bejelentkezve").value == "Bejelentkezés")
{
    document.getElementById("belepes").addEventListener("click", function() {Bejelentkezes(); setTimeout(function(){ location.reload(); }, 1500);});
    document.getElementById("ujjelszogomb").addEventListener("click", Ujjelszo);
}
else
{
    document.getElementById("jelszomodosito").addEventListener("click", Jelszomodosito);
document.getElementById("kijelentkezes").addEventListener("click", function() {Kijelentkezes(); setTimeout(function(){ location.reload(); }, 1500);});
}

/*Bejelentkezés, regelés stb VÉGE*/


for(let i = 0; i < document.getElementsByClassName("modal").length; i++)
{
    document.getElementsByClassName("modal")[i].addEventListener("show.bs.modal", function()
    {
        document.getElementById("oldal").setAttribute("style", "overflow-y:hidden;");
    });
    document.getElementsByClassName("modal")[i].addEventListener("hidden.bs.modal", function()
    {
        document.getElementById("oldal").removeAttribute("style");
    });
}