<?php
require 'auth.php';
force_connexion();
require '../src/db.class.php';
$DB = new DB();
?>

<?php include('includes/sidenav.php'); ?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Fast food et categories</li>
        </ol>
    </div>
    <!--row-->

    <div class="row">
        <div class="col-lg-12">
            <h2 class="">Liste des Fast Food par categories</h2>
        </div>
    </div>
    <a href="#" data-toggle="modal" data-target="#1" class="btn btn-sm btn-danger">
        Ajouter un Fast Food
    </a>

    <!-- Barre de recherche avancée -->
    <div class="row" style="margin: 20px 0;">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Recherche avancée</h3>
                </div>
                <div class="panel-body">
                    <form id="searchForm" method="GET" class="form-horizontal">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Nom du produit</label>
                                    <input type="text" class="form-control" name="search_nom" id="search_nom"
                                        placeholder="Nom du produit">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Catégorie</label>
                                    <select class="form-control" name="search_categorie" id="search_categorie">
                                        <option value="">Toutes les catégories</option>
                                        <?php
										$categories = $DB->select('SELECT * FROM category');
										foreach ($categories as $categorie):
										?>
                                        <option value="<?= $categorie->id ?>"><?= $categorie->categorie ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Prix minimum</label>
                                    <input type="number" class="form-control" name="search_prix_min"
                                        id="search_prix_min" placeholder="Prix minimum">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Prix maximum</label>
                                    <input type="number" class="form-control" name="search_prix_max"
                                        id="search_prix_max" placeholder="Prix maximum">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-search"></i> Rechercher
                                </button>
                                <button type="reset" class="btn btn-default">
                                    <i class="fa fa-refresh"></i> Réinitialiser
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="modal fade" id="1" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                        <div class="modal-body">
                            <form class="login_form " action="add.php" id="addfood" method="post"
                                enctype="multipart/form-data">

                                <h2>Ajout de Fast Food </h2>

                                <!-- Name input-->
                                <div class="form-group col-md-6">

                                    <label class="control-label">Categorie</label>

                                    <?php $categories = $DB->select('SELECT * FROM category'); ?>

                                    <select class="form-control" name="cat">
                                        <?php foreach ($categories as $categorie): ?>
                                        <option value="<?= $categorie->id; ?>">
                                            <?= $categorie->categorie; ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>

                                </div>

                                <div class="form-group col-md-6">
                                    <label class="control-label" for="name">Nom du fast food</label>

                                    <input id="name" name="nom" type="text" placeholder="nom du fast food"
                                        class="form-control" required>

                                </div>

                                <!-- Email input-->
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="details">Details</label>

                                    <input id="details" name="details" type="text" placeholder="Details"
                                        class="form-control" required>

                                </div>

                                <!-- Message body -->
                                <div class="form-group col-md-6">
                                    <label class=" control-label" for="message">Prix</label>

                                    <input name="prix" type="number" min="150" max="35000" class="form-control"
                                        required>

                                </div>

                                <div class="form-group">

                                    <label class="control-label">Choisissez une image</label>
                                    <input type="file" name="images" class="form-control custom-file-input"
                                        accept="image/*"
                                        style="padding: 10px; border: 2px dashed #ccc; border-radius: 5px; background-color: #f8f9fa; cursor: pointer;"
                                        onmouseover="this.style.borderColor='#007bff'"
                                        onmouseout="this.style.borderColor='#ccc'" />

                                </div>
                                <!-- Form actions -->
                                <input type="submit" class="btn btn-md" style="color:white;background-color:#ff0066"
                                    value="Ajouter le Fast Food">

                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Catégorie</th>
                            <th>Nom</th>
                            <th>Details</th>
                            <th>Prix</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
						// Build WHERE clause based on search parameters
						$where = [];
						$params = [];

						if (!empty($_GET['search_nom'])) {
							$where[] = "food.nom LIKE :nom";
							$params['nom'] = '%' . $_GET['search_nom'] . '%';
						}

						if (!empty($_GET['search_categorie'])) {
							$where[] = "food.cat_id = :cat_id";
							$params['cat_id'] = $_GET['search_categorie'];
						}

						if (!empty($_GET['search_prix_min'])) {
							$where[] = "food.prix >= :prix_min";
							$params['prix_min'] = $_GET['search_prix_min'];
						}

						if (!empty($_GET['search_prix_max'])) {
							$where[] = "food.prix <= :prix_max";
							$params['prix_max'] = $_GET['search_prix_max'];
						}

						$whereClause = !empty($where) ? ' WHERE ' . implode(' AND ', $where) : '';

						// Calculate offset based on page number
						$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
						$offset = ($page - 1) * 10;

						// Get total count of items
						$countQuery = 'SELECT COUNT(*) as count FROM food' . $whereClause;
						$total_items = $DB->select($countQuery, $params)[0]->count;
						$total_pages = ceil($total_items / 10);

						// Get paginated results
						$query = 'SELECT category.categorie, food.* FROM category 
                                INNER JOIN food ON food.cat_id = category.id'
							. $whereClause .
							' ORDER BY category.categorie 
                                LIMIT 10 OFFSET ' . $offset;

						$foods = $DB->select($query, $params);
						foreach ($foods as $food):
						?>
                        <tr>
                            <td>
                                <img src="upload/food/<?= $food->images ?>" height="50" width="50"
                                    class="img-thumbnail">
                            </td>
                            <td><?= $food->categorie ?></td>
                            <td><?= $food->nom ?></td>
                            <td><?= $food->details ?></td>
                            <td><?= $food->prix ?> Fr</td>

                            <td>
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#editModal<?= $food->id ?>">
                                    <i class="fa fa-edit"></i> Modifier
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="editModal<?= $food->id ?>" tabindex="-1" role="dialog"
                                    aria-labelledby="editModalLabel<?= $food->id ?>">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="editModalLabel<?= $food->id ?>">Modifier le
                                                    produit</h4>
                                            </div>
                                            <form action="editfood.php" method="POST" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" value="<?= $food->id ?>">
                                                    <div class="form-group">
                                                        <label>Nom</label>
                                                        <input type="text" class="form-control" name="nom"
                                                            value="<?= $food->nom ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Catégorie</label>
                                                        <select class="form-control" name="categorie" required>
                                                            <?php foreach ($categories as $category): ?>
                                                            <option value="<?= $category->id ?>"
                                                                <?= $food->cat_id == $category->id ? 'selected' : '' ?>>
                                                                <?= $category->categorie ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Prix</label>
                                                        <input type="number" class="form-control" name="prix"
                                                            value="<?= $food->prix ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Détails</label>
                                                        <textarea class="form-control" name="details"
                                                            rows="3"><?= $food->details ?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Image</label>
                                                        <div class="current-image">
                                                            <img src="upload/food/<?= $food->images ?>"
                                                                alt="Image actuelle"
                                                                style="max-width: 200px; margin-bottom: 10px;"
                                                                id="previewImage<?= $food->id ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="file" class="form-control custom-file-input"
                                                                name="image" id="imageInput<?= $food->id ?>"
                                                                accept="image/*"
                                                                onchange="previewImage(this, <?= $food->id ?>)"
                                                                style="padding: 10px; border: 2px dashed #ccc; border-radius: 5px; background-color: #f8f9fa; cursor: pointer;"
                                                                onmouseover="this.style.borderColor='#007bff'"
                                                                onmouseout="this.style.borderColor='#ccc'">
                                                        </div>
                                                        <script>
                                                        function previewImage(input, id) {
                                                            if (input.files && input.files[0]) {
                                                                var reader = new FileReader();

                                                                reader.onload = function(e) {
                                                                    document.getElementById('previewImage' + id)
                                                                        .src = e.target.result;
                                                                }

                                                                reader.readAsDataURL(input.files[0]);
                                                            }
                                                        }
                                                        </script>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Fermer</button>
                                                    <button type="submit" class="btn btn-primary">Enregistrer les
                                                        modifications</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                    data-target="#deleteModal<?= $food->id ?>">
                                    <i class="fa fa-trash"></i> Supprimer
                                </button>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal<?= $food->id ?>" tabindex="-1" role="dialog"
                                    aria-labelledby="deleteModalLabel<?= $food->id ?>">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="deleteModalLabel<?= $food->id ?>">
                                                    Confirmation de suppression</h4>
                                            </div>
                                            <div class="modal-body">
                                                Êtes-vous sûr de vouloir supprimer ce produit ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Annuler</button>
                                                <a href="del.php?id=<?= $food->id ?>" class="btn btn-danger">Confirmer
                                                    la suppression</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>

                        <?php if ($total_pages > 1): ?>
                        <tr>
                            <td colspan="6" class="text-center">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination">
                                        <?php if ($page > 1): ?>
                                        <li>
                                            <a href="?page=<?= $page - 1 ?><?= http_build_query(array_merge($_GET, ['page' => $page - 1])) ?>"
                                                aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                        <?php endif; ?>

                                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                        <li class="<?= $i === $page ? 'active' : '' ?>">
                                            <a
                                                href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>"><?= $i ?></a>
                                        </li>
                                        <?php endfor; ?>

                                        <?php if ($page < $total_pages): ?>
                                        <li>
                                            <a href="?<?= http_build_query(array_merge($_GET, ['page' => $page + 1])) ?>"
                                                aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                        <?php endif; ?>
                                    </ul>
                                </nav>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div><!-- /.col-->
    </div>

    <!--/.main-->
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/chart.min.js"></script>
    <script src="js/chart-data.js"></script>
    <script src="js/easypiechart.js"></script>
    <script src="js/easypiechart-data.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/custom.js"></script>
    <script src="../assets/js/owl.carousel.min.js"></script>
    <script>
    filterSelection("all")

    function filterSelection(c) {
        var x, i;
        x = document.getElementsByClassName("column");
        if (c == "all") c = "";


        for (i = 0; i < x.length; i++) {
            w3RemoveClass(x[i], "show");
            if (x[i].className.indexOf(c) > -1) w3AddClass(x[i],
                "show");
        }
    }
    // Show filtered elements
    function w3AddClass(element, name) {
        var i, arr1, arr2;
        arr1 = element.className.split(" ");
        arr2 = name.split(" ");
        for (i = 0; i < arr2.length; i++) {
            if (arr1.indexOf(arr2[i]) == -1) {
                element.className += " " + arr2[i];
            }
        }
    }
    // Hide elements that are not selected
    function w3RemoveClass(element, name) {
        var i, arr1, arr2;
        arr1 = element.className.split(" ");

        arr2 = name.split(" ");
        for (i = 0; i < arr2.length; i++) {
            while (arr1.indexOf(arr2[i]) > -1) {
                arr1.splice(arr1.indexOf(arr2[i]), 1);
            }
        }
        element.className = arr1.join(" ");
    }
    // Add active class to the current button (highlight it)
    var btnContainer = document.getElementById("myBtnContainer");
    var btns = btnContainer.getElementsByClassName("btn");
    for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace("active", "");
            this.className += " active";
        });
    }
    </script>

    </body>

    </html>
    </script>

    </body>

    </html>
    </script>

    </body>

    </html>
    </script>

    </body>

    </html>
    </script>

    </body>

    </html>
    </script>

    </body>

    </html>
    </script>

    </body>

    </html>
    </script>

    </body>

    </html>
    </script>

    </body>

    </html>
    </script>

    </body>

    </html>
    </script>

    </body>

    </html>
    </script>

    </body>

    </html>
    </script>

    </body>

    </html>
    </script>

    </body>

    </html>

    </body>

    </html>

    </body>

    </html>

    </body>

    </html>

    </body>

    </html>

    </body>

    </html>

    </body>

    </html>

    </body>

    </html>

    </body>

    </html>

    </body>

    </html>

    </body>

    </html>

    </body>

    </html>

    </body>

    </html>

    </body>

    </html>

    </body>

    </html>

    </body>

    </html>

    </body>

    </html>