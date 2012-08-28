<?php

    for($i=0;$i<count($data->brand);$i++)
    {
        echo "<br><font color=red>".$data->rasp[$i]."</font>";
        echo "<br><font color=blue>".$data->str[$i]."</font>";
        echo "<br>".$data->brand[$i];
        echo " ".$data->model[$i];
        echo " ".$data->width[$i];
        echo " ".$data->radius[$i];
        echo " ".$data->loadIndex[$i];
        echo "<br>".$data->syn[$i];
        echo "<br>";
    }
    echo "<br>";
    print_r($data->nerasp);
?>
