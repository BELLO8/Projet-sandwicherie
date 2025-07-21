<?php
require 'auth.php';
force_connexion();
require '../src/db.class.php';
$DB = new DB();
$success = false;
if (isset($_POST) and !empty($_POST)) {
    if (isset($_GET['id'])) {
        $cat = $_POST['categorie'];
        $id = (int)$_GET['id'];

        $DB->query('UPDATE category SET categorie = :categorie WHERE id= :id', array(
            'categorie' => $cat,
            'id' => $id
        ));
        $success = true;
    } else {
        echo 'aucune modification';
    }
}
?>

<?php include('includes/sidenav.php'); ?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <style>
    * {
        box-sizing: border-box;
    }

    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background: #f8fafc;
    }

    .main {
        background: #f8fafc;
        min-height: 100vh;
        padding: 20px;
    }

    .modern-breadcrumb {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 16px 24px;
        border-radius: 12px;
        margin-bottom: 30px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .modern-breadcrumb a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        transition: color 0.3s;
    }

    .modern-breadcrumb a:hover {
        color: white;
    }

    .page-header {
        font-size: 32px;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 40px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding: 20px 0;
        border-bottom: 2px solid #e2e8f0;
    }

    .section-title {
        font-size: 24px;
        font-weight: 600;
        color: #2d3748;
        margin: 0;
    }

    .modern-btn {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .modern-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        color: white;
        text-decoration: none;
    }

    .modern-btn.danger {
        background: linear-gradient(135deg, #ff6b6b, #ee5a52);
        box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
    }

    .modern-btn.danger:hover {
        box-shadow: 0 8px 25px rgba(255, 107, 107, 0.4);
    }

    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        margin-bottom: 50px;
    }

    .category-card {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .category-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #667eea, #764ba2);
    }

    .category-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .category-name {
        font-size: 18px;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 16px;
    }

    .category-actions {
        display: flex;
        gap: 12px;
    }

    .action-btn {
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .action-btn.edit {
        background: #e3f2fd;
        color: #1976d2;
    }

    .action-btn.edit:hover {
        background: #bbdefb;
        color: #1565c0;
    }

    .action-btn.delete {
        background: #ffebee;
        color: #d32f2f;
    }

    .action-btn.delete:hover {
        background: #ffcdd2;
        color: #c62828;
    }

    .slides-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 24px;
    }

    .slide-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .slide-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .slide-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        background: #f7fafc;
    }

    .slide-content {
        padding: 20px;
    }

    .slide-title {
        font-size: 16px;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 16px;
        line-height: 1.5;
    }

    .slide-actions {
        display: flex;
        gap: 12px;
        padding-top: 16px;
        border-top: 1px solid #e2e8f0;
    }

    .modal-content {
        border-radius: 16px;
        border: none;
        box-shadow: 0 20px 25px rgba(0, 0, 0, 0.15);
    }

    .modal-header {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border-radius: 16px 16px 0 0;
        padding: 20px 24px;
        border-bottom: none;
    }

    .modal-title {
        font-size: 20px;
        font-weight: 600;
        margin: 0;
    }

    .modal-body {
        padding: 30px;
    }

    .form-group {
        margin-bottom: 24px;
    }

    .form-group label {
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 8px;
        display: block;
    }

    .form-control {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 12px 16px;
        font-size: 14px;
        transition: all 0.3s;
        background: #fafafa;
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        background: white;
        outline: none;
    }

    .close {
        color: white;
        opacity: 0.8;
        font-size: 24px;
        font-weight: 300;
    }

    .close:hover {
        opacity: 1;
        color: white;
    }

    .alert-success {
        background: linear-gradient(135deg, #48bb78, #38a169);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 16px 20px;
        margin-bottom: 20px;
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .section-header {
            flex-direction: column;
            gap: 16px;
            align-items: flex-start;
        }

        .categories-grid {
            grid-template-columns: 1fr;
        }

        .slides-grid {
            grid-template-columns: 1fr;
        }

        .main {
            padding: 15px;
        }
    }
    </style>

    <!-- Breadcrumb moderne -->
    <div class="modern-breadcrumb">
        <div class="d-flex align-items-center">
            <i class="fa fa-home me-2"></i>
            <a href="#" class="me-2">Accueil</a>
            <span class="mx-2">/</span>
            <span>Catégories et Slides</span>
        </div>
    </div>

    <!-- Header principal -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Catégories & Slides</h1>
        </div>
    </div>

    <?php if ($success): ?>
    <div class="alert alert-success">
        ✅ Catégorie modifiée avec succès !
    </div>
    <?php endif; ?>

    <!-- Section Catégories -->
    <div class="section-header">
        <h2 class="section-title">📂 Gestion des Catégories</h2>
        <a href="#" data-toggle="modal" data-target="#addCategoryModal" class="modern-btn">
            <i class="fa fa-plus"></i>
            Ajouter une catégorie
        </a>
    </div>

    <!-- Modal Ajouter Catégorie -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">📂 Ajouter une catégorie</h2>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="addcat.php" method="post">
                        <div class="form-group">
                            <label>Nom de la catégorie</label>
                            <input class="form-control" name="categorie" placeholder="Entrer le nom de la catégorie"
                                required>
                        </div>
                        <button type="submit" class="modern-btn">
                            <i class="fa fa-check"></i>
                            Ajouter
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Grille des catégories -->
    <div class="categories-grid">
        <?php $categories = $DB->select('SELECT * FROM category'); ?>
        <?php foreach ($categories as $categorie): ?>
        <div class="category-card">
            <div class="category-name"><?= htmlentities($categorie->categorie); ?></div>
            <div class="category-actions">
                <a href="#" data-toggle="modal" data-target="#editcat<?= $categorie->id; ?>" class="action-btn edit">
                    <i class="fa fa-pencil"></i>
                    Modifier
                </a>
                <a class="action-btn delete"
                    onclick="confirmDelete(<?= $categorie->id; ?>, '<?= htmlentities($categorie->categorie); ?>')">
                    <i class="fa fa-trash"></i>
                    Supprimer
                </a>
            </div>

            <!-- Modal Modifier Catégorie -->
            <div class="modal fade" id="editcat<?= $categorie->id; ?>" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title">✏️ Modifier la catégorie</h2>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="cat.php?id=<?= $categorie->id; ?>" method="post">
                                <div class="form-group">
                                    <label>Nom de la catégorie</label>
                                    <input class="form-control" name="categorie"
                                        value="<?= htmlentities($categorie->categorie); ?>"
                                        placeholder="Entrer le nom de la catégorie" required>
                                </div>
                                <button type="submit" class="modern-btn">
                                    <i class="fa fa-check"></i>
                                    Modifier
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form de suppression caché -->
            <form id="delete-<?= $categorie->id; ?>" action="delcat.php?id=<?= $categorie->id; ?>" method="post"
                style="display: none;">
            </form>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Section Slides -->
    <div class="section-header">
        <h2 class="section-title">🎞️ Gestion des Slides</h2>
        <a href="#" data-toggle="modal" data-target="#addSlideModal" class="modern-btn">
            <i class="fa fa-plus"></i>
            Ajouter un slide
        </a>
    </div>

    <!-- Modal Ajouter Slide -->
    <div class="modal fade" id="addSlideModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">🎞️ Ajouter un slide</h2>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="addslide.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Texte du slide</label>
                            <input class="form-control" name="texte" placeholder="Entrer le texte du slide" required>
                        </div>
                        <div class="form-group">
                            <label>Image du slide</label>
                            <input type="file" name="photo" class="form-control" accept="image/*">
                        </div>
                        <button type="submit" class="modern-btn">
                            <i class="fa fa-check"></i>
                            Ajouter
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Grille des slides -->
    <div class="slides-grid">
        <?php $sliders = $DB->select('SELECT * FROM slider'); ?>
        <?php foreach ($sliders as $slider): ?>
        <div class="slide-card">
            <img src="upload/slider/<?= $slider->images; ?>" alt="Slide" class="slide-image">
            <div class="slide-content">
                <div class="slide-title"><?= ucfirst(htmlentities($slider->texte)); ?></div>
                <div class="slide-actions">
                    <a href="#" data-toggle="modal" data-target="#editslide<?= $slider->id; ?>" class="action-btn edit">
                        <i class="fa fa-pencil"></i>
                        Modifier
                    </a>
                    <a class="action-btn delete" onclick="confirmDeleteSlide(<?= $slider->id; ?>)">
                        <i class="fa fa-trash"></i>
                        Supprimer
                    </a>
                </div>
            </div>

            <!-- Modal Modifier Slide -->
            <div class="modal fade" id="editslide<?= $slider->id; ?>" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title">✏️ Modifier le slide</h2>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="editslide.php?id=<?= $slider->id; ?>" method="post"
                                enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Texte du slide</label>
                                    <input class="form-control" name="texte"
                                        value="<?= htmlentities($slider->texte); ?>"
                                        placeholder="Entrer le texte du slide" required>
                                </div>
                                <div class="form-group">
                                    <label>Image du slide</label>
                                    <input type="file" name="slider" class="form-control" accept="image/*">
                                    <small class="text-muted">Laisser vide pour conserver l'image actuelle</small>
                                </div>
                                <button type="submit" class="modern-btn">
                                    <i class="fa fa-check"></i>
                                    Modifier
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form de suppression slide caché -->
            <form id="delslide-<?= $slider->id; ?>" action="delslide.php?id=<?= $slider->id; ?>" method="post"
                style="display: none;">
            </form>
        </div>
        <?php endforeach; ?>
    </div>

</div>

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/chart.min.js"></script>
<script src="js/chart-data.js"></script>
<script src="js/easypiechart.js"></script>
<script src="js/easypiechart-data.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/custom.js"></script>
<script src="js/polyfill.js"></script>
<script src="js/popupmodal-min.js"></script>
<script src="../assets/js/owl.carousel.min.js"></script>

<script>
function confirmDelete(id, categoryName) {
    if (confirm('Êtes-vous sûr de vouloir supprimer la catégorie "' + categoryName + '" ?')) {
        document.getElementById('delete-' + id).submit();
    }
}

function confirmDeleteSlide(id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce slide ?')) {
        document.getElementById('delslide-' + id).submit();
    }
}

// Animation d'entrée des cartes
$(document).ready(function() {
    $('.category-card, .slide-card').each(function(index) {
        $(this).css('opacity', '0').css('transform', 'translateY(20px)');
        $(this).delay(index * 100).animate({
            opacity: 1
        }, 500, function() {
            $(this).css('transform', 'translateY(0)');
        });
    });
});
</script>

</body>

</html>