<?php 
include "db.php"; 

if (isset($_POST['save'])) {
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $image_url = $conn->real_escape_string($_POST['image_url']);
    $trailer_url = $conn->real_escape_string($_POST['trailer_url']);

    $query = "INSERT INTO movies (title, description, image_url, trailer_url) VALUES ('$title', '$description', '$image_url', '$trailer_url')";
    
    if ($conn->query($query)) {
        header("Location: index.php");
        exit();
    }
}

include "header.php"; 
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card card-custom p-4">
            <h2 class="mb-4 text-warning">Agregar Película</h2>
            
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label text-secondary">Título</label>
                    <input name="title" class="form-control bg-dark text-white border-secondary" placeholder="Ej: Interstellar" required>
                </div>
                <div class="mb-3">
                    <label class="form-label text-secondary">Descripción</label>
                    <textarea name="description" rows="3" class="form-control bg-dark text-white border-secondary" placeholder="De qué trata la película..."></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label text-secondary">URL de la Imagen (Póster)</label>
                    <input name="image_url" class="form-control bg-dark text-white border-secondary" placeholder="https://ejemplo.com/imagen.jpg">
                </div>
                <div class="mb-3">
                    <label class="form-label text-secondary">Trailer en YouTube</label>
                    <input name="trailer_url" class="form-control bg-dark text-white border-secondary" placeholder="https://youtube.com/watch?...">
                </div>

                <div class="d-flex gap-2 justify-content-end mt-4">
                    <a href="index.php" class="btn btn-outline-secondary btn-custom">Cancelar</a>
                    <button name="save" class="btn btn-success btn-custom px-4">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>