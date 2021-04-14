<?php 


    
function deletemapa($id){    
    
    include "includes/connect.php";

 if($id_cidade){
    while ($resultado_city = pg_fetch_array($id_cidade)) {
        $id_city = $resultado_city["cidade_id"];
        $end = $resultado_city["end_arquivo"];
    }
     $result = pg_query($dbconn, "DELETE FROM mapas where id = '" . $id . "';");
     if($result ){
        $deletcidade = pg_query($dbconn, "DELETE FROM cidades where id = '".$id_city ."'");
        if ($deletcidade) {
        
            return pg_query($deletcidade);
        } else {
            
        }
     }
 }
} 

?>