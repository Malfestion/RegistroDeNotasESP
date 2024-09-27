<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'user')) {
    include "php/db_conn.php";
?>

<!DOCTYPE html>
<html lang="es">
<?php include "layout/head.php"; ?>
<body>
    <?php include "layout/header.php"; ?>

    <div class="container" style="margin-top: 80px; margin-bottom: 80px;">
        <h2>Agregar lista de estudiantes</h2>
        <br>
        <form action="php/subir_csv_estudiantes.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="file" class="form-label">Subir archivo CSV</label>
                <input class="form-control" type="file" name="file" id="file" accept=".csv" required>
            </div>
            <button type="submit" class="btn btn-primary" name="previsualizar">Previsualizar Estudiantes a subir</button>
        </form>

        
   

    </div>

    <?php include "layout/footer.php"; ?>
    <script type="text/javascript" src="js/maintainscroll.min.js"></script>
</body>
</html>

<?php } else {
    header("Location: login.php");
} ?>
