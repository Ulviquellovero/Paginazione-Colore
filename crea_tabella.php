<?php
    require_once("var_conn.php");
    $nRighe = 10;
    $primoRecord = 0;
    if(isset($_REQUEST['nRighe']))
    {
        $nRighe = intval($_REQUEST['nRighe']);
    }
    if(isset($_REQUEST['primoRecord']))
    {
        $primoRecord = intval($_REQUEST['primoRecord']);
    }
    $sql = "SELECT idColore, codiceColore FROM tColore LIMIT $nRighe OFFSET $primoRecord";
    $res = mysqli_query($con, $sql);
    echo "<table>";
        echo "<tr>";
        echo "<th>Id Colore<th>";
        echo "<th>Colore<th>";
        echo "<th>Codice Colore<th>";
        echo "</tr>";
        $numRigheReali = mysqli_num_rows($res);
        while($row = mysqli_fetch_assoc($res))
        {
            echo "<tr>";
                echo "<th>".$row['idColore']."<th>";
                echo "<th class='bloccoColore' style='background-color: #".$row['codiceColore']."; color: rgba(255, 255, 255, 0);'><th>";
                echo "<th>".$row['codiceColore']."<th>";
            echo "</tr>";
        }
    echo "</table>";
    echo "<span id='numRecVis'>Numero di record massimi visualizzabili: $nRighe</span>";
    echo "<span id='sezRecVis'>Sezione di record vsualizzata: da ".($primoRecord + 1)." a ".($primoRecord + $numRigheReali)."</span>";
    echo "<input id='nRigheHidden' type='hidden' value='$nRighe'>";
    echo "<input id='primoRecordHidden' type='hidden' value='$primoRecord'>";
?>