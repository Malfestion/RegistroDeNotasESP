<?php

 include "db_conn.php";

/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 => 'id_estudiante',
    1 => 'nombre_estudiante', 
	2 => 'nombre_area',
	3 => 'estado_estudiante',
	4 => 'nombre_profesor',
    5 => 'nombre_nivel',
    6 => 'nombre_grupo', 
	7 => 'periodo',
	8 => 'nota',
    9 => 'edit',
    10 => 'delete'
);

// getting total number records without any search
$sql = "SELECT id_nota FROM notas";
$query=mysqli_query($conn, $sql) or die("ajax-grid-data-notas.php: get all data");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$sql = "SELECT * FROM notas
        JOIN estudiante ON (estudiante.id = notas.id_estudiante)
        JOIN area ON (area.id = notas.id_area) 
        JOIN profesor ON (profesor.id = notas.id_profesor)
        JOIN nivel ON (nivel.id = notas.id_nivel)   
        WHERE 1 = 1";

// getting records as per search parameters
if( !empty($requestData['columns'][0]['search']['value']) ){   //id
    $sql.=" AND id_estudiante LIKE '".$requestData['columns'][0]['search']['value']."%' ";
} if( !empty($requestData['columns'][1]['search']['value']) ){  //nombre
    $sql.=" AND nombre_estudiante LIKE '".$requestData['columns'][1]['search']['value']."%' ";
} if( !empty($requestData['columns'][2]['search']['value']) ){  //area
    $sql.=" AND nombre_area LIKE '".$requestData['columns'][2]['search']['value']."%' ";
} if( !empty($requestData['columns'][3]['search']['value']) ){  //estado
    $sql.=" AND estado_estudiante LIKE '".$requestData['columns'][3]['search']['value']."%' ";
} if( !empty($requestData['columns'][4]['search']['value']) ){  //profesor
    $sql.=" AND nombre_profesor LIKE '".$requestData['columns'][4]['search']['value']."%' ";
} if( !empty($requestData['columns'][5]['search']['value']) ){  //nivel
    $sql.=" AND nombre_nivel LIKE '".$requestData['columns'][5]['search']['value']."%' ";
} if( !empty($requestData['columns'][6]['search']['value']) ){  //grupo
	$sql.=" AND nombre_grupo LIKE '".$requestData['columns'][6]['search']['value']."%' ";
} if( !empty($requestData['columns'][7]['search']['value']) ){  //periodo
    $sql.=" AND periodo LIKE '%".$requestData['columns'][7]['search']['value']."%' ";
} if( !empty($requestData['columns'][8]['search']['value']) ){  //nota
    $sql.=" AND nota LIKE '".$requestData['columns'][8]['search']['value']."%' ";
}   
	
	$query=mysqli_query($conn, $sql) or die("ajax-grid-data-notas.php: get searchs");
	$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

	$sql.=" ORDER BY ";
	$col = 0;
	while (isset($requestData['order'][$col]['column'])) {
		switch ($columns[$requestData['order'][$col]['column']]) {
			case 'nivel':
				$sql.= "case `nivel` when 'Principiante 1' then '01' when 'Principiante 2' then '02' when 'Principiante 3' then '03' when 'Pre-Intermedio 1' then '04' when 'Pre-Intermedio 2' then '05' when 'Pre-Intermedio 3' then '06' when 'Intermedio 1' then '07' when 'Intermedio 2' then '08' when 'Intermedio 3' then '09' when 'Intermedio-Alto 1' then '10' when 'Intermedio-Alto 2' then '11' when 'Intermedio-Alto 3' then '12' when 'Avanzado' then '13' when 'Avanzado 1' then '14' when 'Avanzado 2' then '15' when 'Complementario' then '16' else `nivel` end ".$requestData['order'][$col]['dir'];
			break;
			default:
				$sql.= $columns[$requestData['order'][$col]['column']]." ".$requestData['order'][$col]['dir'];
		}
		$sql.= ", ";	//Next order
		$col++; 		//Next column
	}
	
	$sql= chop($sql, ", "); // Remove the extra comma
	$sql.=" LIMIT ".$requestData['start'].", ".$requestData['length'];
	$query=mysqli_query($conn, $sql) or die("ajax-grid-data-notas.php: get orders"."sql: ".$sql);
	
$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 

	$nestedData[] = $row["id_estudiante"];
    $nestedData[] = $row["nombre_estudiante"];
	$nestedData[] = $row["nombre_area"];
	$nestedData[] = $row["estado_estudiante"];
	$nestedData[] = $row["nombre_profesor"];
    $nestedData[] = $row["nombre_nivel"];
	$nestedData[] = $row["nombre_grupo"];
	$nestedData[] = $row["periodo"];
    $nestedData[] = $row["nota"];
	$nestedData[] = '<a href="update_nota.php?id='.$row['id_nota'].'"  data-toggle="tooltip" title="Editar datos" class="btn btn-sm btn-primary">Editar'.' </a>';
	$nestedData[] = '<a href="php/delete_nota.php?id='.$row['id_nota'].'"  data-toggle="tooltip" title="Eliminar datos" class="btn btn-sm btn-danger" onclick="return confirm(\'Realmente quiere eliminar esta entrada?\')">Eliminar'.' </a>';
	$data[] = $nestedData;
}

$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>
