<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sandwicherie chez David</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/css/owl.theme.default.min.css">
    <link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/dashboard"><span>Tableau de </span> Bord</a>
            </div>
        </div>
    </nav>

    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <div class="profile-sidebar">
            <div class="profile-userpic">
                <img src="/assets/images/logo1.png" class="img-responsive" alt="">
            </div>
            <div class="profile-usertitle">
                <div class="profile-usertitle-name"><?= $_SESSION['user'] ?? 'Admin' ?></div>
                <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="divider"></div>

        <ul class="nav menu">
            <li class="<?= ($_SERVER['REQUEST_URI'] === '/dashboard' ? 'active' : '') ?>">
                <a href="/dashboard"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a>
            </li>
            <li class="<?= ($_SERVER['REQUEST_URI'] === '/dashboard/publications' ? 'active' : '') ?>">
                <a href="/dashboard/publications"><em class="fa fa-image">&nbsp;</em> Publications</a>
            </li>
            <li class="<?= ($_SERVER['REQUEST_URI'] === '/dashboard/foods' ? 'active' : '') ?>">
                <a href="/dashboard/foods"><em class="fa fa-book">&nbsp;</em> Produits</a>
            </li>
            <li class="<?= ($_SERVER['REQUEST_URI'] === '/dashboard/commandes' ? 'active' : '') ?>">
                <a href="/dashboard/commandes"><em class="fa fa-shopping-bag">&nbsp;</em> Commandes</a>
            </li>
            <li class="<?= ($_SERVER['REQUEST_URI'] === '/dashboard/slides' ? 'active' : '') ?>">
                <a href="/dashboard/slides"><em class="fa fa-clipboard">&nbsp;</em> Slides</a>
            </li>
            <li>
                <a href="/dashboard/logout"><em class="fa fa-power-off">&nbsp;</em> Déconnexion</a>
            </li>
        </ul>
    </div>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="container mt-4">
            <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                L'opération a été effectuée avec succès.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php endif; ?>

            <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Une erreur est survenue lors de l'opération.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php endif; ?>

            <?php echo $content; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/owl.carousel.min.js"></script>
    <script src="/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>

</html>