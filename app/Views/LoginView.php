<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body class="bg-dark">
  <div class="container-fluid">
    <div class="card col-md-4 text-center mx-auto mt-5">
      <div class="card-header text-primary">
        <h1>CONNEXION</h1>
      </div>
      <form action="login" method="post">
        <div class="card-body my-3">
          <div class="col-md-9 mx-auto mb-3">
            <input class="form-control" name="officeruname" placeholder="Nom d'utilisateur">
          </div>
          <div class="col-md-9 mx-auto">
            <input type="password" class="form-control" name="officerpword" placeholder="Mot de passe">
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in-alt"></i>&nbsp;Se connecter</button>
        </div>
        <?php if (session()->getFlashdata('msg')) : ?>
          <div class="alert alert-warning">
            <?= session()->getFlashdata('msg') ?>
          </div>
        <?php endif; ?>
      </form>
    </div>
  </div>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>