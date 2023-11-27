function removeAllChildNodes(parent)
{
    while (parent.firstChild) 
    {
        parent.removeChild(parent.firstChild);
    }
}


async function Admin_Betolt()
{
    try 
    {
        var body=document.getElementsByClassName("tartalom")[0];
        removeAllChildNodes(body);

        var cimgombbody=$("div");
        cimgombbody.setAttribute("style","display:block");

        var cim=document.createElement("h3");
        cim.setAttribute("style","color:grey; display:flex; float:left");
        cim.innerHTML="Adminok";

        var br=$("br");

        var gomb=$("input");
        gomb.setAttribute("type","button");
        gomb.setAttribute("value","Új Admin hozzáadása");
        gomb.setAttribute("style","display:flex; float:right");
        gomb.setAttribute("onclick","Uj_Admin_Hozzaad()")
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
        var headers=["Felhasználó név","Email-cím",""];
        for(let i=0;i<3;i++)
        {
            var th=$("th");
            th.setAttribute("scope","col");
            th.setAttribute("style","color:orange");
            th.innerHTML=headers[i];
            tr.appendChild(th)
        }
        thead.appendChild(tr);

        
        let rendelesek = await fetch("../../index.php/Admin_Leker");
        let data_admin = await rendelesek.json();


        var tbody=$("tbody");
        if(data_admin[0] == 0)
        {
            var tr=$("tr");
            tr.classList.add("table-warning");
            var td=$("td");
            td.setAttribute("colspan","4");
            td.setAttribute("style","text-align:center");
            td.innerHTML="Nincs megjeleníthető adat";
            tr.appendChild(td);
            tbody.appendChild(tr);
        }
        else
        {
            for(let i = 0; i < data_admin.length; i++)
            {
                if(i == 0||i % 2 == 0)
                {
                    var tr=$("tr");
                    tr.classList.add("table-secondary");
                }
                else
                {
                    var tr=$("tr"); 
                }
                var td1=$("td");
                td1.innerHTML="<b style='color:orange'>"+data_admin[i].fnev+"</b>";
                td1.classList.add("align-middle");

                var td2=$("td");
                td2.innerHTML="<span>"+data_admin[i].email+"</span>";
                td2.classList.add("align-middle");

                var td3=$("td");
                td3.innerHTML="<span style='cursor:pointer' id='" + data_admin[i].id + "' title='" + data_admin[i].fnev + "' onclick='Admin_torol(this.id, this.title)'>&#10060;</span>";
                td3.classList.add("align-middle");
                tr.appendChild(td1);
                tr.appendChild(td2);
                tr.appendChild(td3);
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


async function Uj_Admin_Hozzaad()
{
    var body=document.getElementsByClassName("tartalom")[0];
    removeAllChildNodes(body);
    var cim=document.createElement("h3");
    cim.setAttribute("style","color:grey; display:flex; float:left");
    cim.innerHTML="Új Admin felvétele";
    var vonal=document.createElement("hr");
    vonal.setAttribute("style","color:grey; height:3px;width:100%");
    vonal.classList.add("mb-2");
    body.appendChild(cim);
    body.appendChild(vonal);
    
    var div=$("div");
    div.classList.add("container-fluid");

    var label_nev=$("label");
    label_nev.setAttribute("style","display:block");
    label_nev.innerHTML="Felhasználó név";
    label_nev.classList.add("mb-2");
    var mezo_fnev=$("input");
    mezo_fnev.setAttribute("type","text");
    mezo_fnev.setAttribute("id","mezo_fnev");
    mezo_fnev.setAttribute("style","width:50%");
    mezo_fnev.classList.add("mb-4");

    var label_email=$("label");
    label_email.setAttribute("style","display:block");
    label_email.innerHTML="Email";
    label_email.classList.add("mb-2");
    var mezo_email=$("input");
    mezo_email.setAttribute("type","text");
    mezo_email.setAttribute("id","mezo_email");
    mezo_email.setAttribute("style","width:50%");
    mezo_email.classList.add("mb-4");

    var label_jelszo1=$("label");
    label_jelszo1.setAttribute("style","display:block");
    label_jelszo1.innerHTML="Jelszó";
    label_jelszo1.classList.add("mb-2");
    var mezo_jelszo1=$("input");
    mezo_jelszo1.setAttribute("type","password");
    mezo_jelszo1.setAttribute("id","mezo_jelszo1");
    mezo_jelszo1.setAttribute("style","width:50%");
    mezo_jelszo1.classList.add("mb-4");

    var label_jelszo2=$("label");
    label_jelszo2.setAttribute("style","display:block");
    label_jelszo2.innerHTML="Jelszó mégegyszer";
    label_jelszo2.classList.add("mb-2");
    var mezo_jelszo2=$("input");
    mezo_jelszo2.setAttribute("type","password");
    mezo_jelszo2.setAttribute("id","mezo_jelszo2");
    mezo_jelszo2.setAttribute("style","width:50%");
    mezo_jelszo2.classList.add("mb-4");

    div.appendChild(label_nev);
    div.appendChild(mezo_fnev);
    div.appendChild(label_email);
    div.appendChild(mezo_email);
    div.appendChild(label_jelszo1);
    div.appendChild(mezo_jelszo1);
    div.appendChild(label_jelszo2);
    div.appendChild(mezo_jelszo2);
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
    mentes.setAttribute("onclick","Uj_Admin_Mentes()");
    mentes.setAttribute("style","background-color:#f44336; border:2px solid #f44336; color:white;");
    mentes.classList.add("mt-5", "btn", "mentesmodosit");


    var colbal=$("div");
    colbal.classList.add("col-2");
    var megse=$("input");
    megse.setAttribute("type","button");
    megse.setAttribute("value","Mégse");
    megse.setAttribute("onclick","Admin_Betolt()");
    megse.classList.add("mt-5", "btn", "btn-light", "megsegomb");


    colbal.appendChild(megse);
    coljobb.appendChild(mentes);
    row.appendChild(coljobb);
    row.appendChild(colbal);
    divgomb.appendChild(row);
    body.appendChild(divgomb);

}


async function Uj_Admin_Mentes()
{
    var fnev=document.getElementById("mezo_fnev").value;
    var email=document.getElementById("mezo_email").value;
    var jelszo1=document.getElementById("mezo_jelszo1").value;
    var jelszo2=document.getElementById("mezo_jelszo2").value;
    
    try
    {
        let valasz = await fetch("../../index.php/regisztracioADMIN", {method : "POST",
        body : JSON.stringify(
        {
        "fnev": fnev,
        "email": email,
        "jelszo1":jelszo1,
        "jelszo2":jelszo2
        })});
        let data=valasz.json();
        Admin_Betolt();
    }
    catch (error) 
    {
        console.log(error)    
    }
}


async function Admin_torol(id, nev)
{
    let text = "Biztos, hogy ki szeretnéd törölni a " + nev + " nevű Admint?";
    if (confirm(text) == true) 
    {
      try
      {
          let valasz = await fetch("../../index.php/Admin_Torol", {method : "POST",
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