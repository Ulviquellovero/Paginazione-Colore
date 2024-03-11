<?php require_once("var_conn.php"); ?>
<html>
    <head>
        <link rel="stylesheet" href="css/index_style.css">
    </head>

    <body>
        <div id='visualizzazione'>
            <?php require_once("crea_tabella.php"); ?>
        </div>
        <button onclick="prec10Record()">Visualizza i 10 record precedenti</button>
        <button onclick="next10Record()">Visualizza i 10 record successivi</button>
    </body>

    <script>
        function next10Record()
        {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) 
            {
                document.getElementById('visualizzazione').innerHTML = this.responseText;
            }
          };
          var primoRecord = document.getElementById("primoRecordHidden").value;
          var nRighe = document.getElementById("nRigheHidden").value;
          var primoRecordNuovo = Number(primoRecord) + Number(nRighe);
          xhttp.open("GET", "crea_tabella.php?primoRecord="+ primoRecordNuovo +"&nRighe="+nRighe, true);
          xhttp.send();
        }

        function prec10Record()
        {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) 
            {
                document.getElementById('visualizzazione').innerHTML = this.responseText;
            }
          };
          var primoRecord = document.getElementById("primoRecordHidden").value;
          var nRighe = document.getElementById("nRigheHidden").value;
          var primoRecordNuovo = Number(primoRecord) - Number(nRighe);
          xhttp.open("GET", "crea_tabella.php?primoRecord="+ primoRecordNuovo +"&nRighe="+nRighe, true);
          xhttp.send();
        }
    </script>
</html>