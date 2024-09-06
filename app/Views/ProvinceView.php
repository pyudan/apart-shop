<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Province</title>
  <link rel="stylesheet" href="assets/css/bootstrap.css">
</head>

<body>
  <?php include 'Navbar.php' ?>
  <div class="container-fluid">
    <div class="col-md-4 mx-auto mt-5">
      <div class="text-center">
        <h1 class="mb-5">Province</h1><hr>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#provinceInsert">Ajouter</button>
      </div>
      <div class="modal fade" id="provinceInsert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title text-primary" id="exampleModalLabel">Ajout de province</h3>
              <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="provinceInsert" method="post">
              <div class="modal-body">
                <div class="row mb-3">
                  <div class="col-md-3">
                    <label class="col-form-label">Nom :</label>
                  </div>
                  <div class="col-md-9">
                    <input class="form-control" name="provincename">
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Ajouter</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <table class="table table-bordered table-responsive">
        <thead class="bg-primary text-light">
          <tr class="text-center">
            <th>Nom</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($province as $row) : ?>
            <tr>
              <td><?= $row['ProvinceName'] ?></td>
              <td class="text-center"><button class="btn btn-warning text-light" data-bs-toggle="modal" data-bs-target="#provinceUpdate<?= $row['ProvinceID'] ?>">Modifier</button></td>
              <td class="text-center"><button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#provinceDelete<?= $row['ProvinceID'] ?>">Supprimer</a></td>
            </tr>
            <div class="modal fade" id="provinceUpdate<?= $row['ProvinceID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="modal-title text-warning" id="exampleModalLabel">Modification de province</h3>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="provinceUpdate/<?= $row['ProvinceID'] ?>" method="post">
                    <div class="modal-body">
                      <div class="row mb-3">
                        <div class="col-md-3">
                          <label class="col-form-label">Nom :</label>
                        </div>
                        <div class="col-md-9">
                          <input class="form-control" name="provincename" value="<?= $row['ProvinceName'] ?>">
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-warning text-light">Modifier</button>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="modal fade" id="provinceDelete<?= $row['ProvinceID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="modal-title text-danger" id="exampleModalLabel">Suppression de province</h3>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <h5 class="text-center">Voulez-vous vraiment supprimer le province "<?= $row['ProvinceName'] ?>" ?</h5>
                  </div>
                  <div class="modal-footer">
                    <a href="provinceDelete/<?= $row['ProvinceID'] ?>"><button class="btn btn-danger">Supprimer</button></a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
  <script src="assets/js/bootstrap.js"></script>
</body>

</html>