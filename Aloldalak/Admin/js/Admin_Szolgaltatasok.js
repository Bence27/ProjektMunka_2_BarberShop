async function SzolgaltatasBetolt()
{
    try 
    {
        var body=document.getElementsByClassName("tartalom")[0];
        removeAllChildNodes(body);

        var cimgombbody=$("div");
        cimgombbody.setAttribute("style","display:block");

        var cim=document.createElement("h3");
        cim.setAttribute("style","color:grey; display:flex; float:left");
        cim.innerHTML="Szolgáltatások";

        var br=$("br");

        var gomb=$("input");
        gomb.setAttribute("type","button");
        gomb.setAttribute("value","Új szolgáltatás hozzáadása");
        gomb.setAttribute("style","display:flex; float:right");
        gomb.setAttribute("onclick","Uj_Szolgaltatas_Hozzaad()")
        gomb.classList.add("mt-5", "mb-2", "btn", "btn-light", "ujadmingomb");

        var vonal=document.createElement("hr");
        vonal.setAttribute("style","color:grey; height:3px;width:100%");
        vonal.classList.add("mb-5");
        cimgombbody.appendChild(cim);
        cimgombbody.appendChild(gomb);
        body.appendChild(cimgombbody);
        body.appendChild(br);
        body.appendChild(vonal); 


        var table=document.createElement("table");
        table.classList.add("table");
        var thead=document.createElement("thead");
        var tr=document.createElement("tr");
        var headers=["Szolgáltatás", "Költség", "Idő", "aktív", ""];
        for(let i = 0; i < 5; i++)
        {
            var th=$("th");
            th.setAttribute("scope","col");
            th.setAttribute("style","color:orange");
            th.innerHTML=headers[i];
            tr.appendChild(th)
        }
        thead.appendChild(tr);

        
        let szolgaltatasok = await fetch("../../index.php/OsszesszolgaltatasLekeres");
        let data_szolgaltatasok = await szolgaltatasok.json();


        var tbody=$("tbody");
        if(data_szolgaltatasok[0] == 0)
        {
            var tr=$("tr");
            tr.classList.add("table-warning");
            var td=$("td");
            td.setAttribute("colspan", "4");
            td.setAttribute("style", "text-align:center");
            td.innerHTML="Nincs megjeleníthető adat";
            tr.appendChild(td);
            tbody.appendChild(tr);
        }
        else
        {
            for(let i=0;i<data_szolgaltatasok.length;i++)
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

                var td1=$("td");
                td1.innerHTML="<b style='color:orange'>" + data_szolgaltatasok[i].nev + "</b>";
                td1.classList.add("align-middle");

                var td2=$("td");
                if(data_szolgaltatasok[i].aktiv == 0)
                {
                    td2.innerHTML="<input type='checkbox' id='" + data_szolgaltatasok[i].id + "' value=" + data_szolgaltatasok[i].aktiv + " onclick='Szolgaltatas_Aktiv_Modosit(this.id, this.value)'>";
                }
                else
                {
                    td2.innerHTML="<input type='checkbox' checked id='" + data_szolgaltatasok[i].id + "' value=" + data_szolgaltatasok[i].aktiv + " onclick='Szolgaltatas_Aktiv_Modosit(this.id, this.value)'>";
                }
                td2.classList.add("align-middle");

                var td3=$("td");
                td3.innerHTML="<input type='number' value='" + data_szolgaltatasok[i].koltseg + "' disabled> <span> Ft</span>";
                td3.classList.add("align-middle");

                var td4=$("td");
                td4.innerHTML="<span>" + data_szolgaltatasok[i].ido + "</span>";
                td4.classList.add("align-middle");

                var td5=$("td");
                td5.innerHTML="<span style='cursor:pointer' id='" + data_szolgaltatasok[i].id + "' onclick='Szolgaltatas_Modosit(this.id)'>&#9998;</span> <span style='cursor:pointer' id='" + data_szolgaltatasok[i].id + "' title=" + data_szolgaltatasok[i].nev + " onclick='Szolgaltatas_torol(this.id, this.title)'>&#10060;</span>";
                td5.classList.add("align-middle");


                tr.appendChild(td1);
                tr.appendChild(td3);
                tr.appendChild(td4);
                tr.appendChild(td2);
                tr.appendChild(td5);
                tbody.appendChild(tr);
            }
        }

        table.appendChild(thead);
        table.appendChild(tbody);
        body.appendChild(table); 
    } 
    catch (error) 
    {
        console.log(error)    
    }
}


async function Szolgaltatas_Aktiv_Modosit(id, aktiv)
{
    try
    {
        let valasz = await fetch("../../index.php/Szolgaltatas_Aktiv_Modosit", {method : "POST",
        body : JSON.stringify(
        {
            "id": id,
            "aktiv": aktiv
        })});
        let data=valasz.json();
        SzolgaltatasBetolt();
    }
    catch (error) 
    {
        console.log(error)    
    }
}


async function Szolgaltatas_torol(id, nev)
{
    let text = "Biztos, hogy ki akarod törölni a " + nev + " szolgáltatást?";
    if (confirm(text) == true) 
    {
      try
      {
          let valasz = await fetch("../../index.php/Szolgaltatas_Torol", {method : "POST",
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


async function Uj_Szolgaltatas_Hozzaad()
{
    var body=document.getElementsByClassName("tartalom")[0];
    removeAllChildNodes(body);

    var cim=document.createElement("h3");
    cim.setAttribute("style","color:grey; display:flex; float:left");
    cim.innerHTML="Szolgáltatás Felvétel";

    var vonal=document.createElement("hr");
    vonal.setAttribute("style","color:grey; height:3px;width:100%");
    vonal.classList.add("mb-2");
    body.appendChild(cim);
    body.appendChild(vonal);
    
    var div=$("div");
    div.classList.add("container-fluid");

    var label_nev=$("label");
    label_nev.setAttribute("style","display:block");
    label_nev.innerHTML="Név";
    label_nev.classList.add("mb-2");

    var mezo_nev=$("input");
    mezo_nev.setAttribute("type","text");
    mezo_nev.setAttribute("id","mezo_nev");
    mezo_nev.setAttribute("style","width:35%");
    mezo_nev.classList.add("mb-4");

    var label_koltseg=$("label");
    label_koltseg.setAttribute("style","display:block");
    label_koltseg.innerHTML="Költség";
    label_koltseg.classList.add("mb-2");

    var mezo_koltseg=$("input");
    mezo_koltseg.setAttribute("type","number");
    mezo_koltseg.setAttribute("value","0");
    mezo_koltseg.setAttribute("style","width:35%");
    mezo_koltseg.setAttribute("id","mezo_koltseg");
    mezo_koltseg.classList.add("mb-4");

    var label_Currency=$("span");
    label_Currency.innerHTML=" Ft";

    var KoltsegDiv = $("div");
    KoltsegDiv.appendChild(mezo_koltseg);
    KoltsegDiv.appendChild(label_Currency);

    var label_ido=$("label");
    label_ido.setAttribute("style","display:block");
    label_ido.innerHTML="Idő";
    label_ido.classList.add("mb-2");

    var mezo_ora=$("input");
    mezo_ora.setAttribute("type","number");
    mezo_ora.setAttribute("value","0");
    mezo_ora.setAttribute("style","width:15%");
    mezo_ora.setAttribute("id","mezo_ora");
    mezo_ora.classList.add("mb-4");

    var label_ora=$("span");
    label_ora.innerHTML=" Óra";

    var mezo_perc=$("input");
    mezo_perc.setAttribute("type","number");
    mezo_perc.setAttribute("value","0");
    mezo_perc.setAttribute("style","width:16%");
    mezo_perc.setAttribute("id","mezo_perc");
    mezo_perc.classList.add("mb-4", "ms-4");

    var label_perc=$("span");
    label_perc.innerHTML=" Perc";

    var IdoDiv = $("div");
    IdoDiv.appendChild(mezo_ora);
    IdoDiv.appendChild(label_ora);
    IdoDiv.appendChild(mezo_perc);
    IdoDiv.appendChild(label_perc);

    var label_aktiv=$("label");
    label_aktiv.setAttribute("style","display:block");
    label_aktiv.innerHTML="Aktív";
    label_aktiv.classList.add("mb-2");

    var mezo_aktiv=$("input");
    mezo_aktiv.setAttribute("type","checkbox");
    mezo_aktiv.setAttribute("value","0");
    mezo_aktiv.setAttribute("style","transform: scale(1.5);");
    mezo_aktiv.setAttribute("id","mezo_aktiv");
    mezo_aktiv.classList.add("mb-4", "ms-1");

    div.appendChild(label_nev);
    div.appendChild(mezo_nev);
    div.appendChild(label_koltseg);
    div.appendChild(KoltsegDiv);
    div.appendChild(label_ido);
    div.appendChild(IdoDiv);
    div.appendChild(label_aktiv);
    div.appendChild(mezo_aktiv);
    body.appendChild(div);


    var divgomb=$("div");
    divgomb.classList.add("container-fluid");

    var row=$("div");
    row.classList.add("row");

    var coljobb=$("div");
    coljobb.classList.add("col-2");
    var mentes=$("input");
    mentes.setAttribute("type","button");
    mentes.setAttribute("value","Mentés");
    mentes.setAttribute("onclick","Uj_Szolgaltatas_Mentes()");
    mentes.setAttribute("style","background-color:#f44336; border:2px solid #f44336; color:white;");
    mentes.classList.add("mt-5", "btn", "mentesmodosit");


    var colbal=$("div");
    colbal.classList.add("col-2");
    var megse=$("input");
    megse.setAttribute("type","button");
    megse.setAttribute("value","Mégse");
    megse.setAttribute("onclick","SzolgaltatasBetolt()");
    megse.classList.add("mt-5", "btn", "btn-light", "megsegomb");

    colbal.appendChild(megse);
    coljobb.appendChild(mentes);
    row.appendChild(coljobb);
    row.appendChild(colbal);
    divgomb.appendChild(row);
    body.appendChild(divgomb);

}


async function Uj_Szolgaltatas_Mentes()
{
    var nev = document.getElementById("mezo_nev").value;
    var koltseg = document.getElementById("mezo_koltseg").value;
    var ora = document.getElementById("mezo_ora").value;
    var perc = document.getElementById("mezo_perc").value;
    var aktiv = 0;
    if(document.getElementById("mezo_aktiv").checked)
    {
        aktiv = 1;
    }


    var ido = "";
    var idoegyseg = 0;

    if(ora != 0)
    {
        ido = ora + " óra " + perc + " perc";
        idoegyseg = ((ora * 60) + parseInt(perc)) / 15;
    }
    else
    {
        ido = perc + " perc";
        idoegyseg = parseInt(perc) / 15; 
    }

    try
    {
        let valasz = await fetch("../../index.php/Uj_Szolgaltatas_Mentes", {method : "POST",
        body : JSON.stringify(
        {
            "nev": nev,
            "koltseg": koltseg,
            "ido": ido,
            "idoegyseg": idoegyseg,
            "aktiv": aktiv
        })});
        let data=valasz.json();
        SzolgaltatasBetolt();
    }
    catch (error) 
    {
        console.log(error)    
    }
}


async function Szolgaltatas_Modosit(id)
{
    let valasz = await fetch("../../index.php/Szolgaltatas_Modosit_Betolt", {method : "POST",
        body : JSON.stringify(
        {
            "id": id
        })});
    let data=await valasz.json();

    var body=document.getElementsByClassName("tartalom")[0];
    removeAllChildNodes(body);

    var cim=document.createElement("h3");
    cim.setAttribute("style","color:grey; display:flex; float:left");
    cim.innerHTML="Szolgáltatás Módosítása";

    var vonal=document.createElement("hr");
    vonal.setAttribute("style","color:grey; height:3px;width:100%");
    vonal.classList.add("mb-2");

    body.appendChild(cim);
    body.appendChild(vonal);
    
    var div=$("div");
    div.classList.add("container-fluid");

    var label_nev=$("label");
    label_nev.setAttribute("style","display:block");
    label_nev.innerHTML="Név";
    label_nev.classList.add("mb-2");

    var mezo_nev=$("input");
    mezo_nev.setAttribute("type","text");
    mezo_nev.setAttribute("id","mezo_nev");
    mezo_nev.setAttribute("style","width:35%");
    mezo_nev.setAttribute("value", data[0].nev);
    mezo_nev.classList.add("mb-4");

    var label_koltseg=$("label");
    label_koltseg.setAttribute("style","display:block");
    label_koltseg.innerHTML="Költség";
    label_koltseg.classList.add("mb-2");

    var mezo_koltseg=$("input");
    mezo_koltseg.setAttribute("type","number");
    mezo_koltseg.setAttribute("value", data[0].koltseg);
    mezo_koltseg.setAttribute("style","width:35%");
    mezo_koltseg.setAttribute("id","mezo_koltseg");
    mezo_koltseg.classList.add("mb-4");

    var label_Currency=$("span");
    label_Currency.innerHTML=" Ft";

    var KoltsegDiv = $("div");
    KoltsegDiv.appendChild(mezo_koltseg);
    KoltsegDiv.appendChild(label_Currency);

    var label_ido=$("label");
    label_ido.setAttribute("style","display:block");
    label_ido.innerHTML="Idő";
    label_ido.classList.add("mb-2");

    var segedora = 0;
    var segedperc = 0;
    var idoegyben = parseInt(data[0].idoegyseg) * 15;
    if(idoegyben / 60 == 1)
    {
        segedora = 1;
        segedperc = 0;
    }
    else if(idoegyben / 60 > 1)
    {
        segedora = parseInt(idoegyben / 60);
        segedperc = idoegyben % 60;
    }
    else
    {
        segedperc = idoegyben;
    }

    var mezo_ora=$("input");
    mezo_ora.setAttribute("type","number");
    mezo_ora.setAttribute("value",segedora);
    mezo_ora.setAttribute("style","width:15%");
    mezo_ora.setAttribute("id","mezo_ora");
    mezo_ora.classList.add("mb-4");

    var label_ora=$("span");
    label_ora.innerHTML=" Óra";

    var mezo_perc=$("input");
    mezo_perc.setAttribute("type","number");
    mezo_perc.setAttribute("value",segedperc);
    mezo_perc.setAttribute("style","width:16%");
    mezo_perc.setAttribute("id","mezo_perc");
    mezo_perc.classList.add("mb-4", "ms-4");

    var label_perc=$("span");
    label_perc.innerHTML=" Perc";

    var IdoDiv = $("div");
    IdoDiv.appendChild(mezo_ora);
    IdoDiv.appendChild(label_ora);
    IdoDiv.appendChild(mezo_perc);
    IdoDiv.appendChild(label_perc);

    var label_aktiv=$("label");
    label_aktiv.setAttribute("style","display:block");
    label_aktiv.innerHTML="Aktív";
    label_aktiv.classList.add("mb-2");


    var mezo_aktiv=$("input");
    if(data[0].aktiv == 1)
    {
        mezo_aktiv.setAttribute("checked", true);
    }
    mezo_aktiv.setAttribute("type","checkbox");
    mezo_aktiv.setAttribute("value", data[0].aktiv);
    mezo_aktiv.setAttribute("style","transform: scale(1.5);");
    mezo_aktiv.setAttribute("id","mezo_aktiv");
    mezo_aktiv.classList.add("mb-4", "ms-1");


    div.appendChild(label_nev);
    div.appendChild(mezo_nev);
    div.appendChild(label_koltseg);
    div.appendChild(KoltsegDiv);
    div.appendChild(label_ido);
    div.appendChild(IdoDiv);
    div.appendChild(label_aktiv);
    div.appendChild(mezo_aktiv);
    body.appendChild(div);


    var divgomb=$("div");
    divgomb.classList.add("container-fluid");

    var row=$("div");
    row.classList.add("row");

    var coljobb=$("div");
    coljobb.classList.add("col-2");
    var mentes=$("input");
    mentes.setAttribute("type","button");
    mentes.setAttribute("value","Mentés");
    mentes.setAttribute("id",id);
    mentes.setAttribute("onclick","Szolgaltatas_Modosit_Mentes(this.id)");
    mentes.setAttribute("style","background-color:#f44336; border:2px solid #f44336; color:white;");
    mentes.classList.add("mt-5", "btn", "mentesmodosit");


    var colbal=$("div");
    colbal.classList.add("col-2");
    var megse=$("input");
    megse.setAttribute("type","button");
    megse.setAttribute("value","Mégse");
    megse.setAttribute("onclick","SzolgaltatasBetolt()");
    megse.classList.add("mt-5", "btn", "btn-light", "megsegomb");

    colbal.appendChild(megse);
    coljobb.appendChild(mentes);
    row.appendChild(coljobb);
    row.appendChild(colbal);
    divgomb.appendChild(row);
    body.appendChild(divgomb);
}


async function Szolgaltatas_Modosit_Mentes(id)
{
    var nev = document.getElementById("mezo_nev").value;
    var koltseg = document.getElementById("mezo_koltseg").value;
    var ora = document.getElementById("mezo_ora").value;
    var perc = document.getElementById("mezo_perc").value;
    var aktiv = 0;
    if(document.getElementById("mezo_aktiv").checked)
    {
        aktiv = 1;
    }


    var ido = "";
    var idoegyseg = 0;

    if(ora != 0)
    {
        ido = ora + " óra " + perc + " perc";
        idoegyseg = ((ora * 60) + parseInt(perc)) / 15;
    }
    else
    {
        ido = perc + " perc";
        idoegyseg = parseInt(perc) / 15; 
    }
    
    try
    {
        let valasz = await fetch("../../index.php/Szolgaltatas_Modosit_Mentes", {method : "POST",
        body : JSON.stringify(
        {
            "id":id,
            "nev": nev,
            "koltseg": koltseg,
            "ido": ido,
            "idoegyseg": idoegyseg,
            "aktiv": aktiv
        })});
        let data=valasz.json();
        SzolgaltatasBetolt();
    }
    catch (error) 
    {
        console.log(error)    
    }
}