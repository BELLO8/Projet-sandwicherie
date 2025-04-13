<?php
require 'auth.php';
force_connexion();
require '../src/db.class.php';
$DB = new DB();

// Configuration de la pagination
$items_per_page = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $items_per_page;

// Récupération des paramètres de recherche
$search_titre = isset($_GET['search_titre']) ? trim($_GET['search_titre']) : '';
$search_date = isset($_GET['search_date']) ? trim($_GET['search_date']) : '';

// Construction de la requête SQL avec filtres
$sql = "SELECT * FROM publications WHERE 1=1";
$params = [];

if ($search_titre) {
    $sql .= " AND titre LIKE ?";
    $params[] = "%$search_titre%";
}
if ($search_date) {
    $sql .= " AND DATE(date_creation) = ?";
    $params[] = $search_date;
}

// Comptage total des résultats
$count_sql = str_replace('SELECT *', 'SELECT COUNT(*) as count', $sql);
$total_items = $DB->select($count_sql, $params)[0]->count;
$total_pages = ceil($total_items / $items_per_page);

// Ajout de la pagination et du tri
$sql .= " ORDER BY date_creation DESC LIMIT $offset, $items_per_page";

// Récupération des publications
$publications = $DB->select($sql, $params);

include('includes/sidenav.php');
?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><em class="fa fa-home"></em></a></li>
            <li class="active">Publications</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Gestion des Publications</h2>
        </div>
    </div>

    <!-- Bouton Ajouter -->
    <div class="row mb-3">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPublicationModal">
                <i class="fa fa-plus"></i> Nouvelle Publication
            </button>
        </div>
    </div>

    <!-- Barre de recherche -->
    <div class="row" style="margin: 20px 0;">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Recherche</div>
                <div class="panel-body">
                    <form id="searchForm" method="GET" class="form-horizontal">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Titre</label>
                                    <input type="text" class="form-control" name="search_titre" id="search_titre"
                                        value="<?= htmlspecialchars($search_titre) ?>" placeholder="Rechercher par titre">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date de création</label>
                                    <input type="date" class="form-control" name="search_date" id="search_date"
                                        value="<?= htmlspecialchars($search_date) ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Rechercher</button>
                                <button type="reset" class="btn btn-default">Réinitialiser</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Liste des publications -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Liste des Publications</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <?php if (empty($publications)) : ?>
                            <p class="text-center text-muted">Aucune publication trouvée</p>
                        <?php else : ?>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Titre</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Date de création</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($publications as $publication) : ?>
                                        <tr>
                                            <td><?= htmlspecialchars($publication->titre) ?></td>
                                            <td><?= htmlspecialchars(substr($publication->description, 0, 100)) ?>...</td>
                                            <td>
                                                <?php if ($publication->image) : ?>
                                                    <img src="upload/publications/<?= htmlspecialchars($publication->image) ?>"
                                                        alt="<?= htmlspecialchars($publication->titre) ?>"
                                                        class="img-thumbnail" style="max-width: 100px;">
                                                <?php else : ?>
                                                    <span class="text-muted">Aucune image</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= date("d/m/Y H:i", strtotime($publication->date_creation)) ?></td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-sm"
                                                    data-toggle="modal"
                                                    data-target="#editPublicationModal<?= $publication->id ?>">
                                                    <i class="fa fa-edit"></i> Modifier
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    data-toggle="modal"
                                                    data-target="#deletePublicationModal<?= $publication->id ?>">
                                                    <i class="fa fa-trash"></i> Supprimer
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Modal Modification -->
                                        <div class="modal fade" id="editPublicationModal<?= $publication->id ?>" tabindex="-1" role="dialog">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Modifier la publication</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="publication_actions.php" method="POST" enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            <input type="hidden" name="action" value="update">
                                                            <input type="hidden" name="id" value="<?= $publication->id ?>">

                                                            <div class="form-group">
                                                                <label>Titre</label>
                                                                <input type="text" class="form-control" name="titre"
                                                                    value="<?= htmlspecialchars($publication->titre) ?>" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Description</label>
                                                                <textarea class="form-control" name="description" rows="5" required><?= htmlspecialchars($publication->description) ?></textarea>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Image</label>
                                                                <?php if ($publication->image) : ?>
                                                                    <div class="mb-2">
                                                                        <img src="upload/publications/<?= htmlspecialchars($publication->image) ?>"
                                                                            alt="Image actuelle" class="img-thumbnail" style="max-width: 200px;">
                                                                    </div>
                                                                <?php endif; ?>
                                                                <input type="file" class="form-control" name="image" accept="image/*">
                                                                <small class="form-text text-muted">Laissez vide pour conserver l'image actuelle</small>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Suppression -->
                                        <div class="modal fade" id="deletePublicationModal<?= $publication->id ?>" tabindex="-1" role="dialog">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Confirmer la suppression</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Êtes-vous sûr de vouloir supprimer cette publication ?</p>
                                                        <p><strong><?= htmlspecialchars($publication->titre) ?></strong></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="publication_actions.php" method="POST">
                                                            <input type="hidden" name="action" value="delete">
                                                            <input type="hidden" name="id" value="<?= $publication->id ?>">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                            <button type="submit" class="btn btn-danger">Supprimer</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            <?php if ($total_pages > 1): ?>
                                <nav aria-label="Page navigation" class="text-center">
                                    <ul class="pagination justify-content-center">
                                        <?php if ($page > 1): ?>
                                            <li class="page-item">
                                                <a class="page-link" href="?page=<?= $page - 1 ?><?= $search_titre ? '&search_titre=' . urlencode($search_titre) : '' ?><?= $search_date ? '&search_date=' . urlencode($search_date) : '' ?>">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                        <?php endif; ?>

                                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                            <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                                                <a class="page-link" href="?page=<?= $i ?><?= $search_titre ? '&search_titre=' . urlencode($search_titre) : '' ?><?= $search_date ? '&search_date=' . urlencode($search_date) : '' ?>">
                                                    <?= $i ?>
                                                </a>
                                            </li>
                                        <?php endfor; ?>

                                        <?php if ($page < $total_pages): ?>
                                            <li class="page-item">
                                                <a class="page-link" href="?page=<?= $page + 1 ?><?= $search_titre ? '&search_titre=' . urlencode($search_titre) : '' ?><?= $search_date ? '&search_date=' . urlencode($search_date) : '' ?>">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </nav>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ajout -->
<div class="modal fade" id="addPublicationModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nouvelle publication</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="publication_actions.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="action" value="create">

                    <div class="form-group">
                        <label>Titre</label>
                        <input type="text" class="form-control" name="titre" required>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description" rows="5" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control" name="image" accept="image/*" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/chart.min.js"></script>
<script src="js/chart-data.js"></script>
<script src="js/easypiechart.js"></script>
<script src="js/easypiechart-data.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/custom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        // Gestion de la recherche
        $('#searchForm').on('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const params = new URLSearchParams();

            for (const [key, value] of formData.entries()) {
                if (value) params.append(key, value);
            }

            window.location.href = '?' + params.toString();
        });

        // Réinitialisation du formulaire
        $('#searchForm button[type="reset"]').on('click', function() {
            window.location.href = 'publications.php';
        });

        // Afficher les messages de succès ou d'erreur
        <?php if (isset($_GET['success'])): ?>
            Swal.fire({
                title: 'Succès!',
                text: '<?= $_GET['success'] == 'create' ? 'Publication créée avec succès!' : ($_GET['success'] == 'update' ? 'Publication mise à jour avec succès!' : 'Publication supprimée avec succès!') ?>',
                icon: 'success',
                confirmButtonText: 'OK',
                timer: 3000,
                timerProgressBar: true
            });
        <?php endif; ?>

        <?php if (isset($_GET['error'])): ?>
            Swal.fire({
                title: 'Erreur!',
                text: 'Une erreur est survenue. Veuillez réessayer.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        <?php endif; ?>
    });
</script>

</body>

</html>