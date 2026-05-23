<?php 
include "db.php"; 
include "header.php"; 
?>

<div class="row align-items-center mb-4">
    <div class="col-md-6">
        <h2 class="container-title text-start my-2">Catálogo de Películas</h2>
    </div>
    <div class="col-md-6 text-md-end">
        <span class="badge bg-warning text-dark px-3 py-2 fs-6">🎬 En cartelera</span>
    </div>
</div>

<div class="row">
<?php
$result = $conn->query("SELECT * FROM movies ORDER BY id DESC");

if ($result->num_rows == 0): ?>
    <div class="col-12 text-center my-5">
        <p class="text-secondary fs-4">No hay películas agregadas aún.</p>
    </div>
<?php 
endif;

while($row = $result->fetch_assoc()):
?>
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card card-custom h-100 text-white">

            <div class="position-relative">
                <img src="<?= htmlspecialchars($row['image_url'] ?: 'https://images.unsplash.com/photo-1594909122845-11baa439b7bf?q=80&w=500') ?>" class="card-img-top" alt="<?= htmlspecialchars($row['title']) ?>">
            </div>

            <div class="card-body d-flex flex-column">
                <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
                <p class="card-text text-secondary flex-grow-1">
                    <?= htmlspecialchars(substr($row['description'], 0, 110)) ?><?= strlen($row['description']) > 110 ? '...' : '' ?>
                </p>

                <div class="mt-auto d-flex gap-2 flex-wrap">
                    <a href="<?= htmlspecialchars($row['trailer_url']) ?>" target="_blank" class="btn btn-danger btn-sm btn-custom flex-fill">🎥 Trailer</a>
                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm btn-custom">Editar</a>
                    <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-outline-light btn-sm btn-custom" onclick="return confirm('¿Seguro que deseas eliminar esta película?')">Eliminar</a>
                </div>
            </div>

        </div>
    </div>
<?php endwhile; ?>
</div>

<?php include "footer.php"; ?>