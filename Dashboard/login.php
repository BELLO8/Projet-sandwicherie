<?php
$error = null;
if (!empty($_POST['user']) and !empty($_POST['password'])) {
	if ($_POST['user'] == 'Admin' && $_POST['password'] == 'Admin88') {
		session_start();
		$_SESSION['connecte'] = 1;
		$_SESSION['user'] = $_POST['user'];
		header('location:index.php');
		exit();
	} else {
		$error = "Identifiants incorrects";
	}
}
require 'auth.php';
if (est_connecte()) {
	header('location:index.php');
	exit();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background: linear-gradient(135deg, #f8fafc 0%, #e2eafc 100%);
        height: 100vh;
    }

    .login-container {
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card {
        box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
        border-radius: 1rem;
    }

    .card-title {
        font-weight: 600;
        font-size: 1.5rem;
        color: #2d3748;
    }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="card p-4" style="min-width:470px;">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Connexion</h2>
                <?php if ($error) : ?>
                <div class="alert alert-danger text-center" role="alert">
                    <?= $error; ?>
                </div>
                <?php endif; ?>
                <form action="" method="post" id="loginForm">
                    <div class="mb-3">
                        <label for="user" class="form-label">Nom d'utilisateur</label>
                        <input class="form-control" id="user" name="user" type="text" autofocus required>
                    </div>
                    <div class="mb-3 position-relative">
                        <label for="password" class="form-label">Mot de passe</label>
                        <div class="input-group">
                            <input class="form-control" id="password" name="password" type="password" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword" tabindex="-1"
                                style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                                <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.133 13.133 0 0 1 1.172 8z" />
                                    <path
                                        d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zm0 1a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" id="loginBtn" class="btn btn-primary">
                            <span id="loginBtnText">Se connecter</span>
                            <span id="loginBtnSpinner" class="spinner-border spinner-border-sm ms-2 d-none"
                                role="status" aria-hidden="true"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Loader sur le bouton de connexion
    const loginForm = document.getElementById('loginForm');
    const loginBtn = document.getElementById('loginBtn');
    const loginBtnText = document.getElementById('loginBtnText');
    const loginBtnSpinner = document.getElementById('loginBtnSpinner');

    loginForm.addEventListener('submit', function() {
        loginBtn.disabled = true;
        loginBtnText.textContent = 'Connexion...';
        loginBtnSpinner.classList.remove('d-none');
    });

    // Afficher/Masquer le mot de passe
    const passwordInput = document.getElementById('password');
    const togglePassword = document.getElementById('togglePassword');
    const eyeIcon = document.getElementById('eyeIcon');
    let passwordVisible = false;

    togglePassword.addEventListener('click', function() {
        passwordVisible = !passwordVisible;
        passwordInput.type = passwordVisible ? 'text' : 'password';
        eyeIcon.innerHTML = passwordVisible ?
            `<path d='M13.359 11.238l1.387 1.387a.5.5 0 0 1-.708.708l-1.387-1.387C11.12 12.332 9.88 13.5 8 13.5c-5 0-8-5.5-8-5.5a16.978 16.978 0 0 1 2.634-3.262l-1.387-1.387a.5.5 0 1 1 .708-.708l1.387 1.387C4.88 3.668 6.12 2.5 8 2.5c5 0 8 5.5 8 5.5a16.978 16.978 0 0 1-2.634 3.262zM8 4.5c-1.657 0-3.156.672-4.242 1.758A13.133 13.133 0 0 0 1.172 8c.058.087.122.183.195.288.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c1.657 0 3.156-.672 4.242-1.758A13.133 13.133 0 0 0 14.828 8c-.058-.087-.122-.183-.195-.288-.335-.48-.83-1.12-1.465-1.755C11.879 4.668 10.119 3.5 8 3.5z'/>` :
            `<path d='M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.133 13.133 0 0 1 1.172 8z'/><path d='M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zm0 1a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3z'/>`;
    });
    </script>
</body>

</html>