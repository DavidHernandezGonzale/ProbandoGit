<?php   

 function insertar_datos($id,$created_time,$ad_id,$ad_name,$adset_id,$adset_name,$campaign_id,$campaign_name,$form_id,$form_name,$is_organic,$platform,$nombre_completo,$número_de_teléfono,$ciudad,$estado){
    
    global $conexión;
    $insertar = "INSERT INTO prospectos_informacion (id,created_time,ad_id,ad_name,adset_id,adset_name,campaign_id,campaign_name,form_id,form_name,is_organic,platform,nombre_completo,número_de_teléfono,ciudad,estado) VALUES ('$id','$created_time','$ad_id','$ad_name','$adset_id','$adset_name','$campaign_id','$campaign_name','$form_id','$form_name','$is_organic','$platform','$nombre_completo','$número_de_teléfono','$ciudad','$estado')";
    $ejecutar = mysqli_query($conexión,$insertar);
    return $ejecutar;
}
?>