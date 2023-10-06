<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)
 include "db_conn.php";

/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 => 'id',
    1 => 'nombre_estudiante', 
	2 => 'correo_estudiante',
	3 => 'telefono_estudiante',
	4 => 'carrera_1',
    5 => 'carrera_2',
    6 => 'estado_estudiante', 
	7 => 'estado_fecha',
	8 => 'edit',
	9 => 'delete'
);

// getting total number records without any search
$sql = "SELECT id FROM estudiante";
$query=mysqli_query($conn, $sql) or die("ajax-grid-data-estudiantes.php: get all data");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$sql = "SELECT * FROM estudiante WHERE 1 = 1";

// getting records as per search parameters
if( !empty($requestData['columns'][0]['search']['value']) ){   //id
    $sql.=" AND id LIKE '".$requestData['columns'][0]['search']['value']."%' ";
} if( !empty($requestData['columns'][1]['search']['value']) ){  //nombre
    $sql.=" AND nombre_estudiante LIKE '%".$requestData['columns'][1]['search']['value']."%' ";
} if( !empty($requestData['columns'][2]['search']['value']) ){  //periodo
    $sql.=" AND correo_estudiante LIKE '".$requestData['columns'][2]['search']['value']."%' ";
} if( !empty($requestData['columns'][3]['search']['value']) ){  //nivel
    $sql.=" AND telefono_estudiante LIKE '".$requestData['columns'][3]['search']['value']."%' ";
} if( !empty($requestData['columns'][4]['search']['value']) ){  //grupo
    $sql.=" AND carrera_1 LIKE '".$requestData['columns'][4]['search']['value']."%' ";
} if( !empty($requestData['columns'][5]['search']['value']) ){  //area
    $sql.=" AND carrera_2 LIKE '".$requestData['columns'][5]['search']['value']."%' ";
} if( !empty($requestData['columns'][6]['search']['value']) ){  //nota
	$sql.=" AND estado_estudiante LIKE '".$requestData['columns'][6]['search']['value']."%' ";
} if( !empty($requestData['columns'][7]['search']['value']) ){  //profesor
    $sql.=" AND estado_fecha LIKE '%".$requestData['columns'][7]['search']['value']."%' ";
} 
	
	$query=mysqli_query($conn, $sql) or die("ajax-grid-data-estudiantes.php: get searchs");
	$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

	$sql.=" ORDER BY ";
	$col = 0;
	while (isset($requestData['order'][$col]['column'])) {
		switch ($columns[$requestData['order'][$col]['column']]) {
			case 'nivel':
				$sql.= "case `nivel` when 'Principiante 1' then '01' when 'Principiante 2' then '02' when 'Principiante 3' then '03' when 'Pre-Intermedio 1' then '04' when 'Pre-Intermedio 2' then '05' when 'Pre-Intermedio 3' then '06' when 'Intermedio 1' then '07' when 'Intermedio 2' then '08' when 'Intermedio 3' then '09' when 'Intermedio-Alto 1' then '10' when 'Intermedio-Alto 2' then '11' when 'Intermedio-Alto 3' then '12' when 'Avanzado' then '13' when 'Avanzado 1' then '14' when 'Avanzado 2' then '15' when 'Complementario' then '16' else `nivel` end ".$requestData['order'][$col]['dir'];
			break;
			case 'periodo':
				$sql.= "case `periodo` when 'I 2009' then '01' when 'II 2009' then '02' when 'III 2009' then '03' when 'IV 2009' then '04' when 'IV 2010' then '05' when 'I 2011' then '06' when 'II 2011' then '07' when 'III 2011' then '08' when 'IV 2011' then '09' when 'I 2012' then '10' when 'II 2012' then '11' when 'IV 2012' then '12' when 'I 2013' then '13' when 'II 2013' then '14' when 'IV 2013' then '15' when 'I 2014' then '16' when 'II 2014' then '17' when 'III 2014' then '18' when 'IV 2014' then '19' when 'I 2015' then '20' when 'II 2015' then '21' when 'IV 2015' then '22' when 'I 2016' then '23' when 'II 2016' then '24' when 'IV 2016' then '25' when 'I 2017' then '26' when 'II 2017' then '27' when 'III 2017' then '28' when 'IV 2017' then '29' when 'I 2018' then '30' when 'II 2018' then '31' when 'III 2018' then '32' when 'IV 2018' then '33' when 'I 2019' then '34' when 'II 2019' then '35' when 'III 2019' then '36' when 'IV 2019' then '37' when 'I 2020' then '38' when 'II 2020' then '39' when 'III 2020' then '40' when 'IV 2020' then '41' when 'I 2021' then '42' else `periodo` end ".$requestData['order'][$col]['dir'];
			break;
			default:
				$sql.= $columns[$requestData['order'][$col]['column']]." ".$requestData['order'][$col]['dir'];
		}
		$sql.= ", ";	//Next order
		$col++; 		//Next column
	}
	
	$sql= chop($sql, ", "); // Remove the extra comma
	$sql.=" LIMIT ".$requestData['start'].", ".$requestData['length'];
	$query=mysqli_query($conn, $sql) or die("ajax-grid-data-estudiantes.php: get orders"."sql: ".$sql);
	
$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 

	$nestedData[] = $row["id"];
    $nestedData[] = $row["nombre_estudiante"];
	$nestedData[] = $row["correo_estudiante"];
	$nestedData[] = $row["telefono_estudiante"];
	$nestedData[] = $row["carrera_1"];
    $nestedData[] = $row["carrera_2"];
	$nestedData[] = $row["estado_estudiante"];
	$nestedData[] = $row["estado_fecha"];
	$nestedData[] = '<a href="update_estudiante.php?id='.$row['id'].'"  data-toggle="tooltip" title="Editar Estudiante" class="btn btn-sm btn-primary">Editar</a>';
	$nestedData[] = '<a href="php/delete_estudiante.php?id='.$row['id'].'"  data-toggle="tooltip" title="Borrar datos" class="btn btn-sm btn-danger" onclick="return confirm(\'Realmente quiere eliminar esta entrada?\')">Borrar</a>';
	
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
