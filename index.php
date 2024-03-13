<?php require_once("var_conn.php"); ?>
<html>
    <head>
        <link rel="stylesheet" href="css/index_style.css">
    </head>

    <body>
        <div id='visualizzazione'>
            <?php require_once("crea_tabella.php"); ?>
        </div>
        <br>
        <button id='btnPrec' onclick="prec10Record()">Pagina Precedente</button>
        <button id='btnNext' onclick="next10Record()">Prossima pagina</button>
        <br><br>
        <label for="nRighe">Righe da visualizzare per pagina:</label>
        <select name="nRighe" id="nRighe" onchange="nRigheCambiato()">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
        </select>
    </body>

    <script>
        function nRigheCambiato()
        {
            var selectedValue = document.getElementById("nRighe").value;
            //document.getElementById("nRigheHidden").innerHTML(selectedValue);
            //document.getElementById("numRecVis").innerHTML("Numero di record massimi visualizzabili: " + selectedValue);
        
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) 
            {
                document.getElementById('visualizzazione').innerHTML = this.responseText;
                verificaNext10Esistenti();
                verificaPrec10Esistenti();
            }
            };
            var primoRecord = document.getElementById("primoRecordHidden").value;
            var nRighe = selectedValue;
            xhttp.open("GET", "crea_tabella.php?primoRecord="+ primoRecord +"&nRighe="+nRighe, true);
            xhttp.send();
        }
        
        function next10Record()
        {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) 
            {
                document.getElementById('visualizzazione').innerHTML = this.responseText;
                verificaNext10Esistenti();
                verificaPrec10Esistenti();
            }
          };
          var primoRecord = document.getElementById("primoRecordHidden").value;
          var nRighe = document.getElementById("nRigheHidden").value;
          var primoRecordNuovo = Number(primoRecord) + Number(nRighe);
          xhttp.open("GET", "crea_tabella.php?primoRecord="+ primoRecordNuovo +"&nRighe="+nRighe, true);
          xhttp.send();
        }

        function verificaNext10Esistenti()
        {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) 
            {
                var resp = this.responseText;
                if(resp == "false")
                    document.getElementById("btnNext").style.visibility = "hidden";
                else
                    document.getElementById("btnNext").style.visibility = "visible";

            }
            };
            var primoRecord = document.getElementById("primoRecordHidden").value;
            var nRighe = document.getElementById("nRigheHidden").value;
            var primoRecordNuovo = Number(primoRecord) + Number(nRighe);
            xhttp.open("GET", "verifica_esistenza_elementi.php?primoRecord="+ primoRecordNuovo +"&nRighe="+nRighe, true);
            xhttp.send();
        }

        function prec10Record()
        {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) 
            {
                document.getElementById('visualizzazione').innerHTML = this.responseText;
                verificaPrec10Esistenti();
                verificaNext10Esistenti();
            }
          };
          var primoRecord = document.getElementById("primoRecordHidden").value;
          var nRighe = document.getElementById("nRigheHidden").value;
          var primoRecordNuovo = Number(primoRecord) - Number(nRighe);
          xhttp.open("GET", "crea_tabella.php?primoRecord="+ primoRecordNuovo +"&nRighe="+nRighe, true);
          xhttp.send();
        }

        function verificaPrec10Esistenti()
        {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) 
            {
                var resp = this.responseText;
                if(resp == "false")
                    document.getElementById("btnPrec").style.visibility = "hidden";
                else
                    document.getElementById("btnPrec").style.visibility = "visible";
            }
            };
            var primoRecord = document.getElementById("primoRecordHidden").value;
            var nRighe = document.getElementById("nRigheHidden").value;
            var primoRecordNuovo = Number(primoRecord) - Number(nRighe);
            if(primoRecordNuovo < 0 && primoRecord != 0)
            {
                primoRecordNuovo = nRighe;
                document.getElementById("primoRecordHidden").value = nRighe;
            }
            xhttp.open("GET", "verifica_esistenza_elementi.php?primoRecord="+ primoRecordNuovo +"&nRighe="+nRighe, true);
            xhttp.send();
        }
    </script>
</html>