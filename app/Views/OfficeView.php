<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agence</title>
</head>

<body>
  <?php include 'Navbar.php' ?>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#dataTableProvince').DataTable();
      $('#dataTableOffice').DataTable();
    });
  </script>
  <div class="container-fluid">
    <div class="row">
      <div class="card col-md-8 pb-2">
        <div class="text-center mt-5">
          <h1 class="mb-5">Agence</h1>
          <hr>
          <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#officeInsert"><i class="fa fa-plus"></i><!-- &nbsp;Ajouter --></button>
          <div class="modal fade" id="officeInsert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title text-primary" id="exampleModalLabel">Ajout d'agence</h3>
                  <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="officeInsert" method="post">
                  <div class="modal-body">
                    <div class="row mb-3">
                      <div class="col-md-3">
                        <label class="col-form-label">Nom :</label>
                      </div>
                      <div class="col-md-9">
                        <input class="form-control" name="officename" maxlength="50" required>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-md-3">
                        <label class="col-form-label">Adresse :</label>
                      </div>
                      <div class="col-md-9">
                        <input class="form-control" name="officeaddress" maxlength="30">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <label class="col-form-label">Province :</label>
                      </div>
                      <div class="col-md-9">
                        <select class="form-select" name="provinceid">
                          <option selected hidden disabled>Choisir une province</option>
                          <?php foreach ($province as $row) : ?>
                            <option value="<?= $row['ProvinceID'] ?>"><?= $row['ProvinceName'] ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>&nbsp;Ajouter</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Fermer</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <table class="table table-bordered table-striped" id="dataTableOffice">
          <thead class="bg-dark text-light">
            <tr class="text-center">
              <th>Nom</th>
              <th>Adresse</th>
              <th>Province</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($office as $row) : ?>
              <tr>
                <td><?= $row['OfficeName'] ?></td>
                <td><?= $row['OfficeAddress'] ?></td>
                <td><?= $row['ProvinceName'] ?></td>
                <td class="text-center">
                  <button class="btn btn-warning text-light" data-bs-toggle="modal" data-bs-target="#officeUpdate<?= $row['OfficeID'] ?>"><i class="fa fa-pen"></i><!-- &nbsp;Modifier --></button>
                  <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#officeDelete<?= $row['OfficeID'] ?>"><i class="fa fa-trash"></i><!-- &nbsp;Supprimer --></button>
                </td>
              </tr>
              <div class="modal fade" id="officeUpdate<?= $row['OfficeID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h3 class="modal-title text-warning" id="exampleModalLabel">Modification d'agence</h3>
                      <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="officeUpdate/<?= $row['OfficeID'] ?>" method="post">
                      <div class="modal-body">
                        <div class="row mb-3">
                          <div class="col-md-3">
                            <label class="col-form-label">Nom :</label>
                          </div>
                          <div class="col-md-9">
                            <input class="form-control" name="officename" value="<?= $row['OfficeName'] ?>" maxlength="50" required>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <div class="col-md-3">
                            <label class="col-form-label">Adresse :</label>
                          </div>
                          <div class="col-md-9">
                            <input class="form-control" name="officeaddress" value="<?= $row['OfficeAddress'] ?>" maxlength="30">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3">
                            <label class="col-form-label">Province :</label>
                          </div>
                          <div class="col-md-9">
                            <select class="form-select" name="provinceid">
                              <option value="<?= $row['ProvinceID'] ?>" selected hidden><?= $row['ProvinceName'] ?></option>
                              <?php foreach ($province as $row2) : ?>
                                <option value="<?= $row2['ProvinceID'] ?>"><?= $row2['ProvinceName'] ?></option>
                              <?php endforeach ?>
                            </select>
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
              <div class="modal fade" id="officeDelete<?= $row['OfficeID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h3 class="modal-title text-danger" id="exampleModalLabel">Suppression de agence</h3>
                      <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <h5 class="text-center">Voulez-vous vraiment supprimer l'agence "<?= $row['OfficeName'] ?>" ?</h5>
                    </div>
                    <div class="modal-footer">
                      <a href="officeDelete/<?= $row['OfficeID'] ?>"><button class="btn btn-danger"><i class="fa fa-trash"></i>&nbsp;Supprimer</button></a>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Fermer</button>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
      <div class="card col-md-4 pb-2">
        <div class="text-center mt-5">
          <h1 class="mb-5">Province</h1>
          <hr>
          <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#provinceInsert"><i class="fa fa-plus"></i><!-- &nbsp;Ajouter --></button>
          <div class="modal fade" id="provinceInsert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title text-primary" id="exampleModalLabel">Ajout de province</h3>
                  <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="provinceInsert" method="post">
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-3">
                        <label class="col-form-label">Nom :</label>
                      </div>
                      <div class="col-md-9">
                        <input class="form-control" name="provincename" maxlength="15" required>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>&nbsp;Ajouter</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Fermer</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <table class="table table-bordered table-striped" id="dataTableProvince">
          <thead class="bg-dark text-light">
            <tr class="text-center">
              <th>Nom</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($province as $row) : ?>
              <tr>
                <td><?= $row['ProvinceName'] ?></td>
                <td class="text-center">
                  <button class="btn btn-warning text-light" data-bs-toggle="modal" data-bs-target="#provinceUpdate<?= $row['ProvinceID'] ?>"><i class="fa fa-pen"></i><!-- &nbsp;Modifier --></button>
                  <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#provinceDelete<?= $row['ProvinceID'] ?>"><i class="fa fa-trash"></i><!-- &nbsp;Supprimer --></button>
                </td>
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
                        <div class="row">
                          <div class="col-md-3">
                            <label class="col-form-label">Nom :</label>
                          </div>
                          <div class="col-md-9">
                            <input class="form-control" name="provincename" value="<?= $row['ProvinceName'] ?>" maxlength="15" required>
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
                      <a href="provinceDelete/<?= $row['ProvinceID'] ?>"><button class="btn btn-danger"><i class="fa fa-trash"></i>&nbsp;Supprimer</button></a>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Fermer</button>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>