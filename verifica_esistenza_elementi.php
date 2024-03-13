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
    if($primoRecord < 0)
    {
        echo "false";
    }
    else
    {
        $sql = "SELECT idColore, codiceColore FROM tColore LIMIT $nRighe OFFSET $primoRecord";
        $res = mysqli_query($con, $sql);
        $numRigheReali = mysqli_num_rows($res);
        if($numRigheReali != 0)
            echo "true";
        else
            echo "false";
    }
?>