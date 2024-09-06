<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NavBar</title>
  <link rel="stylesheet" href="assets/css/css/all.min.css">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/dataTables.bootstrap5.min.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="apartSelect">APART SHOP</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#content">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="content">
        <ul class="navbar-nav me-auto">
          <li class="nav-item"><a class="nav-link active" href="officeSelect"><i class="fa fa-list"></i>&nbsp;Agence</a></li>
          <li class="nav-item"><a class="nav-link active" href="siteSelect"><i class="fa fa-square-full"></i>&nbsp;Terrain</a></li>
          <li class="nav-item"><a class="nav-link active" href="apartSelect"><i class="fa fa-home"></i>&nbsp;Logement</a></li>
          <li class="nav-item"><a class="nav-link active" href="custSelect"><i class="fa fa-users"></i>&nbsp;Client</a></li>
          <?php
          if ($officername == "Admin") {
          ?>
            <li class="nav-item"><a class="nav-link active" href="officerSelect"><i class="fa fa-user-tie"></i>&nbsp;Agent</a></li>
            <li class="nav-item"><a class="nav-link active" href="saleSelect"><i class="fa fa-money-bill-wave"></i>&nbsp;Vente</a></li>
          <?php } ?>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link active" role="button" data-bs-toggle="modal" data-bs-target="#user"><i class="fa fa-user"></i>&nbsp;Utilisateur</a></li>
          <li class="nav-item"><a class="nav-link active" role="button" data-bs-toggle="modal" data-bs-target="#account"><i class="fa fa-user-circle"></i>&nbsp;Compte</a></li>
          <li class="nav-item"><a class="nav-link active" role="button" data-bs-toggle="modal" data-bs-target="#logout"><i class="fa fa-sign-out-alt"></i>&nbsp;Deconnexion</a></li>
        </ul>
      </div>
    </div>
  </nav><br><br>
  <div class="modal fade" id="user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title text-primary" id="exampleModalLabel">Utilisateur</h3>
          <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
          <h5>Utilisateur actuel :</h5>
          <h6><?= $officeruname ?></h6>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Fermer</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="account" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title text-warning" id="exampleModalLabel">Modification de compte</h3>
          <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="officerAccUpdate/<?= $officerid ?>" method="post">
          <div class="modal-body">
            <input type="hidden" name="empid" value="<?= $officerid ?>">
            <div class="row mb-3">
              <div class="col-md-3">
                <label>Utilisateur :</label>
              </div>
              <div class="col-md-9">
                <input class="form-control" name="officeruname" value="<?= $officeruname ?>" maxlength="20" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <label>Mot de passe</label>
              </div>
              <div class="col-md-9">
                <input type="password" class="form-control" name="officerpword" maxlength="20">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-warning text-light"><i class="fa fa-check"></i>&nbsp;Modifier</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Fermer</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="modal fade" id="logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title text-primary" id="exampleModalLabel">Deconnexion</h3>
          <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
          <h5>Voulez-vous vraiment deconnecter votre compte, <?= $officeruname ?> ?</h5>
        </div>
        <div class="modal-footer">
          <a href="logout"><button class="btn btn-primary"><i class="fa fa-sign-out-alt"></i>&nbsp;Se deconnecter</button></a>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Fermer</button>
        </div>
      </div>
    </div>
  </div>
  <script src="assets/js/jquery-3.5.1.js"></script>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/jquery.dataTables.min.js"></script>
  <script src="assets/js/dataTables.bootstrap5.min.js"></script>
</body>

</html>