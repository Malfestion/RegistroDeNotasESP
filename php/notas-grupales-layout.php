<?php
$index = 0;
?>
<div class="d-flex">
    <div class="container">
        <?php
        //muestra los primeros 16 espacios en la primera columna
        while ($index < 16):
            $index++;
            ?>
            <div class="d-flex">
                <h5 style="margin-top: 14px;">
                    <?= $index ?>-
                </h5>
                <div class="mb-3  p-3 ">
                    <label for="estudiante-<?= $index ?>" class="form-label">ID:</label>
                    <select class="select2-single" id="estudiante-<?= $index ?>" name="estudiante-<?= $index ?>"
                        style="width: 120px;">
                        <option value=""></option>
                        <?php
                        $res_estudiante = mysqli_query($conn, "SELECT * FROM estudiante");
                        while ($row_estudiante = mysqli_fetch_array($res_estudiante)): ?>
                            <option value="<?= $row_estudiante['id'] ?>"><?= $row_estudiante['id'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="mb-3  p-3 d-flex">
                    <label for="nota-<?= $index ?>" class="form-label">Nota:&nbsp;&nbsp; </label>
                    <input type="number" class="form-control" id="nota-<?= $index ?>" name="nota-<?= $index ?>"
                        placeholder="0-100" maxlength="3" style="height: 30px; width: 90px;">
                </div>
                <div class="form-check" style="margin-top: 20px;">
                    <label class="form-check-label" for="flexCheckDefault">Continúa</label>
                    <input class="form-check-input" type="checkbox" value="SI" id="commitment-<?= $index ?>"
                        name="commitment-<?= $index ?>" checked>
                    </div>
            </div>
            <hr>
        <?php endwhile; ?>

    </div>
    <div class="container">
        <?php
        //muestra los ultimos espacios en la segunda columna
        while ($index < 31):
            $index++;
            ?>
            <div class="d-flex">
                <h5 style="margin-top: 14px;">
                    <?= $index ?>-
                </h5>
                <div class="mb-3  p-3 ">
                    <label for="estudiante-<?= $index ?>" class="form-label">ID:</label>
                    <select class="select2-single" id="estudiante-<?= $index ?>" name="estudiante-<?= $index ?>"
                        style="width: 120px;">
                        <option value=""></option>
                        <?php
                        $res_estudiante = mysqli_query($conn, "SELECT * FROM estudiante");
                        while ($row_estudiante = mysqli_fetch_array($res_estudiante)): ?>
                            <option value="<?= $row_estudiante['id'] ?>"><?= $row_estudiante['id'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="mb-3  p-3 d-flex">
                    <label for="nota-<?= $index ?>" class="form-label">Nota:&nbsp;&nbsp; </label>
                    <input type="number" class="form-control" id="nota-<?= $index ?>" name="nota-<?= $index ?>"
                        placeholder="0-100" maxlength="3" style="height: 30px; width: 90px;">
                </div>
                <div class="form-check" style="margin-top: 20px;">
                    <label class="form-check-label" for="flexCheckDefault">Continúa</label>
                    <input class="form-check-input" type="checkbox" value="SI" name="commitment-<?= $index ?>"
                        id="commitment-<?= $index ?>" checked>
                </div>
            </div>
            <hr>
        <?php endwhile; ?>
    </div>
</div>