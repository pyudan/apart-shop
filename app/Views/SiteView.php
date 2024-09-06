<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Terrain</title>
</head>

<body>
  <?php include 'Navbar.php' ?>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#dataTableSite').DataTable();
      $('#dataTableOffice').DataTable();
    });
  </script>
  <div class="container-fluid">
    <div class="row">
      <div class="card col-md-8 pb-2">
        <div class="text-center mt-5">
          <h1 class="mb-5">Terrain</h1>
          <hr>
          <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#siteInsert"><i class="fa fa-plus"></i><!-- &nbsp;Ajouter --></button>
          <div class="modal fade" id="siteInsert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title text-primary" id="exampleModalLabel">Ajout de terrain</h3>
                  <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="siteInsert" method="post">
                  <div class="modal-body">
                    <div class="row mb-3">
                      <div class="col-md-3">
                        <label class="col-form-label">Localisation :</label>
                      </div>
                      <div class="col-md-9">
                        <input class="form-control" name="sitelocation" maxlength="25" required>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-md-3">
                        <label class="col-form-label">Superficie :</label>
                      </div>
                      <div class="col-md-9">
                        <div class="input-group">
                          <input type="number" class="form-control" name="sitearea">
                          <span class="input-group-text">m<sup>2</sup></span>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <label class="col-form-label">Agence :</label>
                      </div>
                      <div class="col-md-9">
                        <select class="form-select" name="officeid">
                          <option selected hidden disabled>Choisir une agence</option>
                          <?php foreach ($office as $row) : ?>
                            <option value="<?= $row['OfficeID'] ?>"><?= $row['OfficeName'] ?></option>
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
        <table class="table table-bordered table-striped" id="dataTableSite">
          <thead class="bg-dark text-light">
            <tr class="text-center">
              <th>Localisation</th>
              <th>Superficie</th>
              <th>Agence</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($site as $row) : ?>
              <tr>
                <td><?= $row['SiteLocation'] ?></td>
                <td><?= $row['SiteArea'] ?> m<sup>2</sup></td>
                <td><?= $row['OfficeName'] ?></td>
                <td class="text-center">
                  <button class="btn btn-warning text-light" data-bs-toggle="modal" data-bs-target="#siteUpdate<?= $row['SiteID'] ?>"><i class="fa fa-pen"></i><!-- &nbsp;Modifier --></button>
                  <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#siteDelete<?= $row['SiteID'] ?>"><i class="fa fa-trash"></i><!-- &nbsp;Supprimer --></a>
                </td>
              </tr>
              <div class="modal fade" id="siteUpdate<?= $row['SiteID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h3 class="modal-title text-warning" id="exampleModalLabel">Modification de terrain</h3>
                      <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="siteUpdate/<?= $row['SiteID'] ?>" method="post">
                      <div class="modal-body">
                        <div class="row mb-3">
                          <div class="col-md-3">
                            <label class="col-form-label">Localisation :</label>
                          </div>
                          <div class="col-md-9">
                            <input class="form-control" name="sitelocation" value="<?= $row['SiteLocation'] ?>" maxlength="25" required>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <div class="col-md-3">
                            <label class="col-form-label">Superficie :</label>
                          </div>
                          <div class="col-md-9">
                            <div class="input-group">
                              <input type="number" class="form-control" name="sitearea" value="<?= $row['SiteArea'] ?>">
                              <span class="input-group-text">m<sup>2</sup></span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3">
                            <label class="col-form-label">Agence :</label>
                          </div>
                          <div class="col-md-9">
                            <select class="form-select" name="officeid">
                              <?php foreach ($office as $row2) : ?>
                                <option value="<?= $row['OfficeID'] ?>" selected hidden><?= $row['OfficeName'] ?></option>
                                <option value="<?= $row2['OfficeID'] ?>"><?= $row2['OfficeName'] ?></option>
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
              <div class="modal fade" id="siteDelete<?= $row['SiteID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h3 class="modal-title text-danger" id="exampleModalLabel">Suppression de terrain</h3>
                      <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <h5 class="text-center">Voulez-vous vraiment supprimer le terrain avec "<?= $row['SiteLocation'] ?>" ?</h5>
                    </div>
                    <div class="modal-footer">
                      <a href="siteDelete/<?= $row['SiteID'] ?>"><button class="btn btn-danger"><i class="fa fa-trash"></i>&nbsp;Supprimer</button></a>
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
        <h3 class="text-primary text-center my-5">Liste d'agence</h3>
        <hr>
        <table class="table table-bordered table-striped" id="dataTableOffice">
          <thead class="bg-primary text-light">
            <tr class="text-center">
              <th>Agence</th>
              <th>Adresse</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($office as $row) : ?>
              <tr>
                <td><?= $row['OfficeName'] ?></td>
                <td><?= $row['OfficeAddress'] ?></td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>