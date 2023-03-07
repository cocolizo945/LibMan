<?php

    $con = new mysqli('sql9.freemysqlhosting.net','sql9599848','bEKiPhSLYt','sql9599848');
    $st_check=$con->prepare("select * from usuarios where usuario=? AND password =? ");
    $st_check ->bind_param("ss",$_POST["usuario"],$_POST["password"]);
    $st_check ->execute();
    $rs=$st_check ->get_result();
    
    if($rs->num_rows == 0){
       echo "invalid user";
    }else{
        echo "success";
    }
    
    
?>