<?php
session_start();
require "assets/php/conexion.php";


date_default_timezone_set('America/Caracas');

$record_per_page=20;
$page = '';

if(isset($_POST['page'])){
    $page = $_POST['page'];
}else{
    $page = 1;  
}

$start_from = ($page - 1) * $record_per_page;

if(isset($_POST["action"])){

    if($_POST["action"]=="joder"){

        $Cedula_Login = $_POST["Cedula_Login"];
        $Contra_Login = $_POST["Contra_Login"];

        $pdo= $conectar->prepare ("SELECT * FROM admins where cedula = '$Cedula_Login' and contra = '$Contra_Login'");
        $pdo->execute();
        $result = $pdo->fetchColumn();

        if($result>0){
            $_SESSION['usuario']=$Cedula_Login;
            echo 'Continuar';

        }else{
            echo 'Error';
        }
    }



    if($_POST["action"]=="fetch_mecanicos"){
        $output = '
        <table class="table table-striped table-borderless" style="font-size:14px">
            <tr>
                <th>Cedula</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Telefono</th>
                <th>Direccion</th>
                <th>Estado</th>

            </tr>
        ';
        $query = "SELECT * FROM mecanicos LIMIT $start_from,$record_per_page";
        $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
        if($result){
            foreach($result as $row){
                $output .='
                    <tr>
                        <td>'.$row['cedula'].'</td>
                        <td>'.$row['nombre'].'</td>                        
                        <td>'.$row['correo'].'</td>                        
                        <td>'.$row['telefono'].'</td>                        
                        <td>'.$row['direccion'].'</td>   
                        <td>'.$row['estado'].'</td>                         
  
                    </tr>
                ';
            }

        }else{
            $output .='
                <tr>
                    <td colspan="6">No hay informacion</td>
                </tr> 
            ';
        }
        $output .='</table>';
        $page_query = "SELECT * FROM mecanicos  ";
        $page_result = $conectar->query($page_query);
        $total_record =$page_result->rowCount();
        $total_pages = ceil($total_record/$record_per_page);

        for($i=1; $i<=$total_pages; $i++){ 
            $output .= '<span class="pagination_link" style="cursor:pointer; padding:6px; border:1px solid #ccc;" id= "'.$i.'">'.$i.'</span>';
        }
        echo $output;
    }

    if($_POST["action"]=="fetch_clientess"){
        $output = '
        <table class="table table-striped table-borderless" style="font-size:14px">
            <tr>
                <th>Cedula</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Telefono</th>
                <th>Direccion</th>

            </tr>
        ';
        $query = "SELECT * FROM clientes LIMIT $start_from,$record_per_page";
        $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
        if($result){
            foreach($result as $row){
                $output .='
                    <tr>
                        <td>'.$row['cedula'].'</td>
                        <td>'.$row['nombre'].'</td>                        
                        <td>'.$row['correo'].'</td>                        
                        <td>'.$row['telefono'].'</td>                        
                        <td>'.$row['direccion'].'</td>     
                    </tr>
                ';
            }

        }else{
            $output .='
                <tr>
                    <td colspan="6">No hay informacion</td>
                </tr> 
            ';
        }
        $output .='</table>';
        $page_query = "SELECT * FROM clientes";
        $page_result = $conectar->query($page_query);
        $total_record =$page_result->rowCount();
        $total_pages = ceil($total_record/$record_per_page);

        for($i=1; $i<=$total_pages; $i++){ 
            $output .= '<span class="pagination_link" style="cursor:pointer; padding:6px; border:1px solid #ccc;" id= "'.$i.'">'.$i.'</span>';
        }
        echo $output;
    }

    if($_POST["action"]=="datos_vehiculos"){
        $modelo = $_POST["modelo"];             


        $output = '
        <table class="table table-striped table-borderless" style="font-size:14px">
            <tr>
                <th>Año</th>
                <th>Vin</th>
                <th>Matricula</th>
                <th>Tipo</th>

            </tr>
        ';
        $query = "SELECT * FROM vehiculos WHERE modelo = '$modelo' ORDER BY año DESC LIMIT $start_from,$record_per_page";
        $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
        if($result){
            foreach($result as $row){
                $output .='
                    <tr>
                        <td>'.$row['año'].'</td>                        
                        <td>'.$row['vin'].'</td>                        
                        <td>'.$row['matricula'].'</td>                        
                        <td>'.$row['tipo'].'</td>     
                    </tr>
                ';
            }

        }else{
            $output .='
                <tr>
                    <td colspan="6">No hay informacion</td>
                </tr> 
            ';
        }
        $output .='</table>';
        $page_query = "SELECT * FROM clientes";
        $page_result = $conectar->query($page_query);
        $total_record =$page_result->rowCount();
        $total_pages = ceil($total_record/$record_per_page);

        for($i=1; $i<=$total_pages; $i++){ 
            $output .= '<span class="pagination_link" style="cursor:pointer; padding:6px; border:1px solid #ccc;" id= "'.$i.'">'.$i.'</span>';
        }
        echo $output;
    }

    if($_POST["action"]=="crear_modelo"){
        $nombre_modelo = $_POST["nombre_modelo"];
        $marca = $_POST["marca"];
        $año_modelo = $_POST["año_modelo"];
        $vin_modelo = $_POST["vin_modelo"];
        $matricula_modelo = $_POST["matricula_modelo"];
        $tipo_modelo = $_POST["tipo_modelo"];

        
        try{
            $pdo= $conectar->prepare ("INSERT INTO vehiculos (marca,modelo,año,vin,matricula,tipo) 
            VALUES (?,?,?,?,?,?)");
                    $pdo->bindParam(1,$marca);
                    $pdo->bindParam(2,$nombre_modelo);
                    $pdo->bindParam(3,$año_modelo);
                    $pdo->bindParam(4,$vin_modelo);
                    $pdo->bindParam(5,$matricula_modelo);
                    $pdo->bindParam(6,$tipo_modelo);
            
            $pdo->execute(); 
            echo 'Se insertaron los datos correctamente';
        }
        catch(PDOException $error){
            echo 'Error';

        }

    }

    if($_POST["action"]=="crear_trabajo"){
        $cedula_cliente = $_POST["cedula_cliente"];
        $cedula_mecanico = $_POST["cedula_mecanico"];
        $desc_trabajo = $_POST["desc_trabajo"];
        $estado_trabajo = $_POST["estado_trabajo"];

        
        try{
            $pdo= $conectar->prepare ("INSERT INTO trabajos (cedula_cliente,cedula_tecnico,descripcion,estado) 
            VALUES (?,?,?,?)");
                    $pdo->bindParam(1,$cedula_cliente);
                    $pdo->bindParam(2,$cedula_mecanico);
                    $pdo->bindParam(3,$desc_trabajo);
                    $pdo->bindParam(4,$estado_trabajo);
            
            $pdo->execute(); 
            echo 'Se insertaron los datos correctamente';
        }
        catch(PDOException $error){
            echo 'Error';

        }

    }

    
    if($_POST["action"]=="actualizar_trabajo"){
        $id = $_POST["id"];
        $desc_trabajo = $_POST["desc_trabajo"];
        $estado_trabajo = $_POST["estado_trabajo"];

        
        try{
            $pdo= $conectar->prepare ("UPDATE trabajos SET descripcion='$desc_trabajo',estado='$estado_trabajo' WHERE id = '$id'");
            
            $pdo->execute(); 
            echo 'Se actualizaron los datos correctamente';
        }
        catch(PDOException $error){
            echo 'Error';

        }

    }

    if($_POST["action"]=="fetch_trabajos"){

        $output = '
        <table class="table table-striped table-borderless" style="font-size:14px">
            <tr><th></th>                <th></th>                <th></th>
            <th hidden>id</th>
    
            <th>Cliente</th>
                <th>Tecnico</th>
                <th>Descripcion</th>
                <th>Estado</th>                <th></th>                <th></th>                <th></th>

            </tr>
        ';
        $query = "SELECT * FROM trabajos LIMIT $start_from,$record_per_page";
        $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
        if($result){
            foreach($result as $row){
                $cedula_cliente = $row['cedula_cliente'];
                $cedula_tecnico = $row['cedula_tecnico'];

                $query_2 = "SELECT * FROM clientes WHERE cedula = '$cedula_cliente'";
                $result_2 = $conectar->query($query_2)->fetchAll(PDO::FETCH_BOTH);
                foreach($result_2 as $row_2){
                    $nombre_cliente = $row_2['nombre'];
                    $query_3 = "SELECT * FROM mecanicos WHERE cedula = '$cedula_tecnico'";
                    $result_3 = $conectar->query($query_3)->fetchAll(PDO::FETCH_BOTH);
                    foreach($result_3 as $row_3){
                        $nombre_trabajador = $row_3['nombre'];


                
                $output .='
                    <tr><td></td> <td></td> <td></td>
                        <td hidden>'.$row['id'].'</td>                        
                        <td>'.$row_2['nombre'].'</td>                        
                        <td>'.$row_3['nombre'].'</td>                        
                        <td>'.$row['descripcion'].'</td>                        
                        <td>'.$row['estado'].'</td>
                        <td>   
                        <a class="btn btn-primary btn-sm" href="editar_trabajo.php?editarid='.$row['id'].'"
                        >Editar</a>
                        </td>
                    </tr>
                ';
            } }    }

        }else{
            $output .='
                <tr>
                    <td colspan="6">No hay informacion</td>
                </tr> 
            ';
        }   
        $output .='</table>';
        $page_query = "SELECT * FROM clientes";
        $page_result = $conectar->query($page_query);
        $total_record =$page_result->rowCount();
        $total_pages = ceil($total_record/$record_per_page);

        for($i=1; $i<=$total_pages; $i++){ 
            $output .= '<span class="pagination_link" style="cursor:pointer; padding:6px; border:1px solid #ccc;" id= "'.$i.'">'.$i.'</span>';
        }
        echo $output;
    }
}

?>