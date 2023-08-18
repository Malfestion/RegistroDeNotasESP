<?php 
   session_start();
   include "db_conn.php";
   if (isset($_SESSION['username']) && isset($_SESSION['id'])) {   ?>

<!DOCTYPE html>
<html>
<head>
	<title>HOME</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
      <div class="container d-flex justify-content-center align-items-center"
      style="min-height: 100vh">
      	<?php if ($_SESSION['role'] == 'admin') {?>
      		<!-- For Admin -->
      		<div class="card" style="width: 18rem;">
			  <img src="img/admin-default.png" 
			       class="card-img-top" 
			       alt="admin image">
			  <div class="card-body text-center">
			    <h5 class="card-title">
			    	<?=$_SESSION['name']?>
			    </h5>
			    <a href="logout.php" class="btn btn-dark">Logout</a>
			  </div>
			</div>
			<div class="p-3">
				<?php include 'php/members.php';
                 if (mysqli_num_rows($res) > 0) {?>
                  
				<h1 class="display-4 fs-1">Notas</h1>
				
				
				
				<form action="" method="get">
					<input type="text" name="busqueda"><br>
					<input type="submit" name="enviar" value="Buscar"><br>
				 </form>

				 <?php
				 if(isset($_GET['enviar'])){
					$busqueda=$_GET['busqueda'];
					$consulta = $conn->query("SELECT * FROM notas WHERE id_estudiante LIKE '%$busqueda%'");
					
					while($row=$consulta->fetch_array()) {
						echo $row['id_estudiante'].'<br>';
					}

				}
				 ?>

				

				<table class="table" 
				       style="width: 32rem;">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Carné</th>
					  <th scope="col">Nombre</th>
				      <th scope="col">Area</th>
				      <th scope="col">Profesor</th>
					  <th scope="col">Nivel</th>
					  <th scope="col">Grupo</th>
					  <th scope="col">Periodo</th>
					  <th scope="col">Nota</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php 
				  	$i =1;
				  	while ($rows = mysqli_fetch_assoc($res)) {?>
				    <tr>
				      <th scope="row"><?=$i?></th>
				      <td><?=$rows['id_estudiante']?></td>
					  <td><?=$rows['nombre_estudiante']?></td>
				      <td><?=$rows['nombre_area']?></td>
				      <td><?=$rows['nombre_profesor']?></td>
					  <td><?=$rows['nombre_nivel']?></td>
					  <td><?=$rows['nombre_grupo']?></td>
					  <td><?=$rows['periodo']?></td>
					  <td><?=$rows['nota']?></td>
				    </tr>
				    <?php $i++; }?>
				  </tbody>
				</table>
				<?php }?>
			</div>
      	<?php }else { ?>
      		<!-- FORE USERS -->
      		<div class="card" style="width: 18rem;">
			  <img src="img/user-default.png" 
			       class="card-img-top" 
			       alt="admin image">
			  <div class="card-body text-center">
			    <h5 class="card-title">
			    	<?=$_SESSION['name']?>
			    </h5>
			    <a href="logout.php" class="btn btn-dark">Logout</a>
			  </div>
			</div>
      	<?php } ?>
      </div>
</body>
</html>
<?php }else{
	header("Location: login.php");
} ?>