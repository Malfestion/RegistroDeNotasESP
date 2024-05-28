<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)

include "db_conn.php";

$request = $_REQUEST;
$col = array(
    0   => 'placa',
    1   => 'descripcion',
    2   => 'marca',
    3   => 'modelo',
    4   => 'serie',
    5   => 'categoria',
    6   => 'responsable',
    7   => 'observaciones',
    8   => 'edit',
	9   => 'delete'
    // Add other columns as needed
);

// Initialize query to get total records
$sql = "SELECT * FROM esp_inventario";
$query = mysqli_query($conn, $sql);
$totalData = mysqli_num_rows($query);
$totalFilter = $totalData;

// Initialize query to get filtered records
$sql = "SELECT * FROM esp_inventario WHERE 1=1";

// Add search functionality
if (!empty($request['search']['value'])) {
    $sql .= " AND (placa LIKE '%" . $request['search']['value'] . "%' ";
    $sql .= " OR descripcion LIKE '%" . $request['search']['value'] . "%' ";
    $sql .= " OR marca LIKE '%" . $request['search']['value'] . "%' ";
    $sql .= " OR modelo LIKE '%" . $request['search']['value'] . "%' ";
    $sql .= " OR serie LIKE '%" . $request['search']['value'] . "%' ";
    $sql .= " OR categoria LIKE '%" . $request['search']['value'] . "%' ";
    $sql .= " OR responsable LIKE '%" . $request['search']['value'] . "%' ";
    $sql .= " OR observaciones LIKE '%" . $request['search']['value'] . "%') ";
}

// Get total filtered records
$query = mysqli_query($conn, $sql);
$totalFiltered = mysqli_num_rows($query);

// Add sorting functionality
$sql .= " ORDER BY " . $col[$request['order'][0]['column']] . " " . $request['order'][0]['dir'] . " LIMIT " . $request['start'] . ", " . $request['length'];

// Fetch data
$query = mysqli_query($conn, $sql);

$data = array();
while ($row = mysqli_fetch_array($query)) {
    $subdata = array();
    $subdata[] = $row['placa'];
    $subdata[] = $row['descripcion'];
    $subdata[] = $row['marca'];
    $subdata[] = $row['modelo'];
    $subdata[] = $row['serie'];
    $subdata[] = $row['categoria'];
    $subdata[] = $row['responsable'];
    $subdata[] = $row['observaciones'];
    $subdata[] ='<a href="update_inventario.php?id='.$row['item_id'].'"  data-toggle="tooltip" title="Editar Estudiante" class="btn btn-sm btn-primary">Editar</a>';
    $subdata[] ='<a href="php/delete_inventario.php?id='.$row['item_id'].'"  data-toggle="tooltip" title="Borrar datos" class="btn btn-sm btn-danger" onclick="return confirm(\'Realmente quiere eliminar esta entrada?\')">Borrar</a>';
    // Add other columns as needed
    $data[] = $subdata;
}

// Prepare the JSON data
$json_data = array(
    "draw" => intval($request['draw']),
    "recordsTotal" => intval($totalData),
    "recordsFiltered" => intval($totalFiltered),
    "data" => $data
);

// Return the JSON data
header('Content-Type: application/json');
echo json_encode($json_data);
?>