<?php 
include "db.php"; 

$id = (int)$_GET['id']; // Forzado a entero por seguridad
$result = $conn->query("SELECT * FROM movies WHERE id=$id");
$row = $result->fetch_assoc();

if (!$row) {
    header("Location: index.php");
    exit();
}

if(isset($_POST['update'])){
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $image_url = $conn->real_escape_string($_POST['image_url']);
    $trailer_url = $conn->real_escape_string($_POST['trailer_url']);

    $conn->query("UPDATE movies SET 
        title='$title',
        description='$description',
        image_url='$image_url',
        trailer_url='$trailer_url'
        WHERE id=$id
    ");

    header("Location: index.php");
    exit();
}

include "header.php"; 
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card card-custom p-4">
            <h2 class="mb-4 text-primary">Editar Película</h2>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label text-secondary">Título</label>
                    <input name="title" value="<?= htmlspecialchars($row['title']) ?>" class="form-control bg-dark text-white border-secondary" required>
                </div>
                <div class="mb-3">
                    <label class="form-label text-secondary">Descripción</label>
                    <textarea name="description" rows="3" class="form-control bg-dark text-white border-secondary"><?= htmlspecialchars($row['description']) ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label text-secondary">URL Imagen</label>
                    <input name="image_url" value="<?= htmlspecialchars($row['image_url']) ?>" class="form-control bg-dark text-white border-secondary">
                </div>
                <div class="mb-3">
                    <label class="form-label text-secondary">Trailer YouTube</label>
                    <input name="trailer_url" value="<?= htmlspecialchars($row['trailer_url']) ?>" class="form-control bg-dark text-white border-secondary">
                </div>

                <div class="d-flex gap-2 justify-content-end mt-4">
                    <a href="index.php" class="btn btn-outline-secondary btn-custom">Cancelar</a>
                    <button class="btn btn-primary btn-custom px-4" name="update">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>