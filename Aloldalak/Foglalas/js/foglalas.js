var szolgID = 0;
function RemoveAllChild(body)
{
    while(body.hasChildNodes())
    {
        body.removeChild(body.lastChild);
    }
}


function removeFirstH3AndUl(body) 
{
    if (body && body.children.length >= 4) 
    {
        body.removeChild(body.children[0]); // Első gyermek: h3
        body.removeChild(body.children[0]); // Második gyermek: ul
    }
}


async function OsszesSzolgLekero()
{
    try
    {
        let valasz = await fetch("../../index.php/OsszesAktSzolg");
        let data = await valasz.json();
        RadiosLoad(data);
    }
    catch(exc)
    {
        console.log(exc);
    }
}


async function SzolgLekero(id)
{
    try
    {
        let valasz = await fetch("../../index.php/szolgaltatasLekeres", {method : "POST",
        body : JSON.stringify({
            "szolgID": id
            })
        });
        let data = await valasz.json();
        Szolgaltatas_valaszt(data);
    }
    catch(exc)
    {
        console.log(exc);
    }
}


function RadiosLoad(adatok)
{
    if(window.innerWidth <= 991)
    {
        var ide = document.getElementById("radiosPlace2");
    }
    else
    {
        var ide = document.getElementById("radiosPlace");
    }
    RemoveAllChild(ide);
    for(let elem of adatok)
    {

        var li = document.createElement("li");
        li.classList.add("list-group-item", "radiolista");

        var container = document.createElement("div");

        var sor = document.createElement("div");
        sor.classList.add("row", "w-100");

        var gombdiv = document.createElement("div");
        gombdiv.classList.add("col-2", "m-auto", "text-center");

        var radiogomb = document.createElement("input");
        radiogomb.setAttribute("type", "radio");
        radiogomb.classList.add("form-check-input");
        radiogomb.setAttribute("name", "radio");
        radiogomb.setAttribute("value", elem.idoegyseg);
        radiogomb.setAttribute("id", elem.id);
        radiogomb.setAttribute("onclick", "SzolgLekero(" + elem.id + ")");

        var szovegdiv = document.createElement("div");
        szovegdiv.classList.add("col-8");
        szovegdiv.setAttribute("style", "text-align:center");

        var szoveg = document.createElement("b");

        szoveg.innerHTML = elem.nev + "<br>" + elem.ido + " ";

        var ardiv = document.createElement("div");
        ardiv.classList.add("col-2", "m-auto");

        var ar = document.createElement("b");
        ar.innerHTML = (parseInt(elem.koltseg)).toLocaleString("hu-HU") + " Ft";

        gombdiv.appendChild(radiogomb);
        szovegdiv.appendChild(szoveg);
        ardiv.appendChild(ar);
        sor.appendChild(gombdiv);
        sor.appendChild(szovegdiv);
        sor.appendChild(ardiv);
        container.appendChild(sor);
        li.appendChild(container);
        ide.appendChild(li);
    }
}


function Szolgaltatas_valaszt(data)
{
    if(window.innerWidth <= 991)
    {
        document.getElementById("kiv_szolgaltatas2").innerHTML = data[0].nev;
        document.getElementById("ar2").innerHTML = (parseInt(data[0].koltseg)).toLocaleString("hu-HU") + " Ft";
    }
    else
    {
        document.getElementById("kiv_szolgaltatas").innerHTML = data[0].nev;
        document.getElementById("ar").innerHTML = (parseInt(data[0].koltseg)).toLocaleString("hu-HU") + " Ft";
    }

    document.getElementById("szolg_modal").innerHTML = data[0].nev;
    document.getElementById("ar_modal").innerHTML = (parseInt(data[0].koltseg)).toLocaleString("hu-HU") + " Ft";
    szolgID = data[0].id;
    
    Datum_kiv_betolt(0);
    window.scrollTo({ left: 0, top: document.body.scrollHeight, behavior: "smooth" });
    document.getElementById("but_folyt").setAttribute("disabled",true);
    RemoveAllChild(document.getElementsByClassName("idopont_card")[0])
}


async function Datum_kiv_betolt(i)
{
    if(window.innerWidth <= 991)
    {
        document.getElementById("datumokdiv2").removeAttribute("style");
    }
    else
    {
        document.getElementById("datumokdiv").removeAttribute("style");
    }

    if(i==35)
    {
        return;
    }

     today = new Date();


     dates = [];
     

    for (let i = 1; i < 36; i++) 
    {

        nextDate = new Date(today);
        nextDate.setDate(today.getDate() + i);
        nextDate.setHours(10, 0, 0, 0);
        dates.push(nextDate);
    }


    if(window.innerWidth <= 991)
    {
        var body=document.getElementById("datumok_div2");
    }
    else
    {
        var body=document.getElementById("datumok_div");
    }

    RemoveAllChild(body);
    const options = { weekday: 'short',localeMatcher: 'best fit' };
    var bal_nyil=document.createElement("span");
        bal_nyil.innerHTML="&#8249;"
        bal_nyil.classList.add("nyil");
        bal_nyil.setAttribute("style","font-size: 50px; cursor:pointer")
        if(i!=0)
        {
            bal_nyil.setAttribute("onclick","Datum_kiv_betolt("+(i-7)+")");
        }
        else
        {
            bal_nyil.setAttribute("onclick","Datum_kiv_betolt("+(i)+")");
        }
    body.appendChild(bal_nyil);
    let j
    if(i!=35)
    {
        j=i+7
    }
    else
    {
        j=i
    }
    for( k=i; k<j; k++)
    {
        var nap_rovidites = dates[k].toLocaleDateString('hu-HU', options);
        if(nap_rovidites!="V"&&nap_rovidites!="Szo")
        {
            var span=document.createElement("span");
            span.classList.add("kor");
            span.innerHTML=dates[k].getDate()+"</br>"+nap_rovidites;
            span.setAttribute("onclick","Idopont_Betolt(this.id)");
            span.setAttribute("id",dates[k])
            body.appendChild(span);
        }
    }
    var jobb_nyil=document.createElement("span");
        jobb_nyil.innerHTML="&#8250;"
        jobb_nyil.classList.add("nyil");
        jobb_nyil.setAttribute("style","font-size: 50px; cursor:pointer")
        if(i!=35)
        {
            jobb_nyil.setAttribute("onclick","Datum_kiv_betolt("+(i+7)+")")
        }
        else
        {
            jobb_nyil.setAttribute("onclick","Datum_kiv_betolt("+(i)+")")
        }
    body.appendChild(jobb_nyil);
}


async function Idopont_Betolt(id)
{
    KorSzinezo(id)
    if(window.innerWidth <= 991)
    {
        var divElement = document.getElementById("datumokdiv2");
        var body = document.getElementsByClassName("idopont_card2")[0];
    }
    else
    {
        var divElement = document.getElementById("datumokdiv");
        var body = document.getElementsByClassName("idopont_card")[0];
    }

    body.removeAttribute("style");
    var cim=document.createElement("h3");
    cim.classList.add("Honap_nap");

    endTime =new Date(id);
    endTime.setHours(18, 0, 0); 

    timeList = [];
    timeSkip = [];
    FinalList = [];
    const honapok = ["Január", "Február", "Március", "Április", "Május", "Június", "Július", "Augusztus", "Szeptember", "Október", "November", "December"];
    const monthIndex = endTime.getMonth();

    cim.innerHTML=honapok[monthIndex]+" "+endTime.getDate();
    cim.setAttribute("style","text-align:center");
    body.appendChild(cim);


    try
    {
        let valasz = await fetch("../../index.php/foglaltidopontok");
        let data = await valasz.json();
        //foglalt időpontok lekérése és tárolása
        for(let elem of data)
        {
            let kezdoIdopont = new Date(elem.kezdes);
            let zaroIdopont = new Date(elem.vege);
            let currentTime = new Date(kezdoIdopont);
            var aktDate = (kezdoIdopont.toISOString()).substring(0, 10);
            var [aktEv, aktHonap, aktNap] = aktDate.split("-");


            while (currentTime <= zaroIdopont && !timeSkip.includes(currentTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }))) 
            {
                timeSkip.push([currentTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }), aktEv, aktHonap, aktNap]);
                currentTime.setMinutes(currentTime.getMinutes() + 15);
            }
        }
        //foglalt időpontok lekérése és tárolása
    }
    catch(exc)
    {
        console.log(exc);
    }

    
    // 15 percesével generálja az időpontokat
    let currentTime = new Date(id);
    while (currentTime <= endTime) 
    {
        if(!timeSkip.some(entry => entry[0].includes(currentTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })) && entry[2].includes(monthIndex + 1) && entry[3].includes(endTime.getDate())))
        {
            timeList.push(currentTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }));
        }
        currentTime.setMinutes(currentTime.getMinutes() + 15);
    }


    var hossz = 0;
    var radio = document.getElementsByName("radio");
    for(let i = 0; i < radio.length; i++)
    {
        if(radio[i].checked)
        {
            hossz=radio[i].value;
        }
    }


    var ul=document.createElement("ul");
    ul.setAttribute("style", "padding:0");
    RemoveAllChild(ul);


    for(let i=0; i < timeList.length; i++)
    {
        var vizsgaltdatum = timeList[i];

        if (checkAvailability(timeList, vizsgaltdatum, hossz)) 
        {
            FinalList.push(vizsgaltdatum);
        }
    }


    for(let i=0; i < FinalList.length; i++)
    {
        var li=document.createElement("li");
        li.innerHTML=FinalList[i];
        li.classList.add("idopont", "w-75")
        li.setAttribute("id",i);
        li.setAttribute("onclick","IdopontKivalaszt("+i+")")
        ul.appendChild(li);
    }
    body.appendChild(ul);


    if (document.getElementById("idopontokdiv").childElementCount > 0 || document.getElementById("idopontokdiv2").childElementCount > 0) 
    {
      var rect = divElement.getBoundingClientRect();
    
      if (rect.top <= 0 && rect.bottom <= window.innerHeight) 
      {
        
      } 
      else 
      {
        // Az elem nem látható, tehát csak akkor görgetünk, ha szükséges
        divElement.scrollIntoView({ behavior: "smooth", block: "start" });
    
        // Ebben az esetben nem kell várni, mivel nem hozunk létre animációt
        var rectAfterScroll = divElement.getBoundingClientRect();
      }
    }
    removeFirstH3AndUl(body);
}


function checkAvailability(timeList, startTime, steps) 
{
    var currentIndex = timeList.indexOf(startTime);
    var gyujto = 0;
    for (var i = 1; i <= steps; i++) 
    {
        var nextIndex = currentIndex + i;

        // Ellenőrzi, hogy van-e még időpont a tömbben
        if (nextIndex >= timeList.length) 
        {
            return false;
        }
        // Ellenőrzi, hogy az adott időpont szabad-e
        var timeDiff = calculateTimeDifference(startTime, timeList[nextIndex]);
        gyujto += parseInt(timeDiff);
        startTime = timeList[nextIndex];
    }


    if (gyujto !== steps * 15) 
    {
        return false;
    }
    else
    {
        return true;
    }
}


function calculateTimeDifference(time1, time2) 
{
    var time1Parts = time1.split(":");
    var time2Parts = time2.split(":");
    var hours1 = parseInt(time1Parts[0]);
    var minutes1 = parseInt(time1Parts[1]);
    var hours2 = parseInt(time2Parts[0]);
    var minutes2 = parseInt(time2Parts[1]);

    var totalMinutes1 = hours1 * 60 + minutes1;
    var totalMinutes2 = hours2 * 60 + minutes2;

    return totalMinutes2 - totalMinutes1;
}


async function KorSzinezo(id)
{
    for(let i=0;i<document.getElementsByClassName("kor").length;i++)
    {
        document.getElementsByClassName("kor")[i].removeAttribute("style");
    }
    kor=document.getElementById(id);
    kor.setAttribute("style","background-color:rgb(234, 151, 123)");

    if(window.innerWidth <= 991)
    {
        document.getElementById("but_folyt2").setAttribute("disabled",true);
    }
    else
    {
        document.getElementById("but_folyt").setAttribute("disabled",true);
    }

}


function IdopontKivalaszt(id)
{
    var hossz=0;
    var radio=document.getElementsByName("radio");
    for(let i=0;i<radio.length;i++)
    {
        if(radio[i].checked)
        {
            hossz=radio[i].value;
        }
    }
    IdopontSzinezoTorolo();
    document.getElementsByClassName("idopont")[id].setAttribute("style","background-color: darksalmon");
    for(let i=0;i<hossz;i++)
    {
        IdopontSzinezo(id);
        id++;
    }
    window.scrollTo({ left: 0, top: 0, behavior: "smooth" });
}


function IdopontSzinezo(id)
{
    for(let i = 0; i < document.getElementsByClassName("idopont").length; i++)
    {
        if(document.getElementsByClassName("idopont")[i].id == id)
        {
            document.getElementsByClassName("idopont")[i].setAttribute("name","kijelolt");
        }
    }

    if(window.innerWidth <= 991)
    {
        document.getElementById("but_folyt2").removeAttribute("disabled");
        for(let i = 0; i < document.getElementsByClassName("hidden-card-body").length; i++)
        {
            document.getElementsByClassName("hidden-card-body")[i].removeAttribute("style");
        }
    }
    else
    {
        document.getElementById("but_folyt").removeAttribute("disabled");
        for(let i = 0; i < document.getElementsByClassName("hidden-card-body").length; i++)
        {
            document.getElementsByClassName("hidden-card-body")[i].removeAttribute("style");
        }
    }
}


function IdopontSzinezoTorolo()
{
    for(let i=0;i<document.getElementsByClassName("idopont").length;i++)
    {
        document.getElementsByClassName("idopont")[i].removeAttribute("style");
        document.getElementsByClassName("idopont")[i].removeAttribute("name");
    }
}


async function Modal_betolt()
{
    $('#Foglalas_Modal').modal('show');
    var idopont_nap=$("span").filter(function()
    {
        
        return $(this).css('background-color') === "rgb(234, 151, 123)";
    });
    var date=new Date(idopont_nap.attr("id"));

    var idopont_ora=$("li").filter(function()
    {
        return $(this).attr("name") === "kijelolt";
    });
    var idopont_Ora_Array = idopont_ora.map(function () 
    {
        return $(this).html();
    }).get();
    

    const honapok = ["Január", "Február", "Március", "Április", "Május", "Június", "Július", "Augusztus", "Szeptember", "Október", "November", "December"];
    var year = date.getFullYear();
    var month = date.getMonth() + 1; 
    var day = date.getDate();

    // Az utolsó elem kiválasztása
    var utolsoIdopont = idopont_Ora_Array[idopont_Ora_Array.length - 1];
    

    var [utolsoOra, utolsoPerc] = utolsoIdopont.split(":");
    var UO = (parseInt(utolsoOra, 10)); //UO = utolsó Óra
    var UP = (parseInt(utolsoPerc, 10) + 15); //UP = utolsó Perc
    // Formázott idő létrehozása
    if(UP % 60 == 0)
    {
        UO += 1;
        UP = "00";
        document.getElementById("idopont").innerHTML=year + " " + honapok[month-1] + " " + day +" "+ idopont_Ora_Array[0] +" - " + UO + ":" + UP;
    }
    else
    {
        document.getElementById("idopont").innerHTML=year + " " + honapok[month-1] + " " + day +" "+ idopont_Ora_Array[0] +" - " + UO + ":" + UP;
    }
}


async function FoglalasLead()
{
    var nev=document.getElementById("name").value;
    var tel=document.getElementById("tel").value;
    var email=document.getElementById("email").value;
    var idopont_nap=$("span").filter(function(){
        
        return $(this).css('background-color') === "rgb(234, 151, 123)";
    });
    var date=new Date(idopont_nap.attr("id"));

    var idopont_ora=$("li").filter(function(){
        
        return $(this).attr("name") === "kijelolt";
    });
    var idopont_Ora_Array = idopont_ora.map(function () {
        return $(this).html();
    }).get();
    

    var year = date.getFullYear();
    var month = date.getMonth() + 1; 
    var day = date.getDate();


    var kezdes=year+"-"+month+"-"+day+" "+idopont_Ora_Array[0]+":00";
    var vege=year+"-"+month+"-"+day+" "+idopont_Ora_Array[idopont_Ora_Array.length -1]+":00";
    
    if(nev==""&&email=="")
    {
        document.getElementsByClassName("alert-warning")[0].removeAttribute("style");
    }
    else
    {
        try
        {
            let valasz = await fetch("../../index.php/foglalasleadas", {method : "POST",
            body : JSON.stringify({
                "nev": nev,
                "tel": tel,
                "email": email,
                "kezdes":kezdes,
                "vege":vege,
                "szolgaltatas": szolgID
                })
            });
            let data = await valasz.json();
            leadasvisszaigazolas(data);
        }
        catch(exc)
        {
            console.log(exc);
        }
    }
    
}


/*Visszaigazoló Modal*/
function leadasvisszaigazolas(data)
{
    if(data == "Sikeres rendelés leadás!")
    {
        localStorage.setItem('rendeles_leadva', 'true');
        setTimeout(function()
        {
            processRedirectAndOperations();
        }, 500);
    }
}


async function processRedirectAndOperations() 
{
    // Várjuk meg az URL átirányítást
    await new Promise(resolve => 
    {
      window.location.href = 'http://localhost/Barber/index.php';
      resolve();
    });
  }
/*Visszaigazoló Modal*/


window.addEventListener("load", OsszesSzolgLekero);