<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agent</title>
</head>

<body>
  <?php include 'Navbar.php' ?>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#dataTableOfficer').DataTable();
      $('#dataTableSaleNb').DataTable();
    });
  </script>
  <div class="container-fluid">
    <div class="row">
      <div class="card col-md-8 pb-2">
        <div class="text-center mt-5">
          <h1 class="mb-5">Agent</h1>
          <hr>
          <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#officerInsert"><i class="fa fa-plus"></i><!-- &nbsp;Ajouter --></button>
          <div class="modal fade" id="officerInsert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title text-primary" id="exampleModalLabel">Ajout d'agent</h3>
                  <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="officerInsert" method="post">
                  <div class="modal-body">
                    <div class="row mb-3">
                      <div class="col-md-3">
                        <label class="col-form-label">Nom :</label>
                      </div>
                      <div class="col-md-9">
                        <input class="form-control" name="officername" maxlength="60" required>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-md-3">
                        <label class="col-form-label">T&eacute;l&eacute;phone :</label>
                      </div>
                      <div class="col-md-9">
                        <input class="form-control" name="officerpnum" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'')" required>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-md-3">
                        <label class="col-form-label">Adresse :</label>
                      </div>
                      <div class="col-md-9">
                        <input class="form-control" name="officeraddress" maxlength="30">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-md-3">
                        <label class="col-form-label">Utilisateur :</label>
                      </div>
                      <div class="col-md-9">
                        <input class="form-control" name="officeruname" maxlength="20" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <label class="col-form-label">Mot de passe</label>
                      </div>
                      <div class="col-md-9">
                        <input type="password" class="form-control" name="officerpword" maxlength="20" required>
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
        <table class="table table-bordered table-striped" id="dataTableOfficer">
          <thead class="bg-dark text-light">
            <tr class="text-center">
              <th>Nom</th>
              <th>T&eacute;l&eacute;phone</th>
              <th>Adresse</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($officer as $row) : ?>
              <tr>
                <td><?= $row['OfficerName'] ?></td>
                <td><?= $row['OfficerPNum'] ?></td>
                <td><?= $row['OfficerAddress'] ?></td>
                <td class="text-center">
                  <button class="btn btn-warning text-light" data-bs-toggle="modal" data-bs-target="#officerUpdate<?= $row['OfficerID'] ?>"><i class="fa fa-pen"></i><!-- &nbsp;Modifier --></button>
                  <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#officerDelete<?= $row['OfficerID'] ?>"><i class="fa fa-user-times"></i><!-- &nbsp;Renvoyer --></button>
                </td>
              </tr>
              <div class="modal fade" id="officerUpdate<?= $row['OfficerID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h3 class="modal-title text-warning" id="exampleModalLabel">Modification d'agent</h3>
                      <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="officerUpdate/<?= $row['OfficerID'] ?>" method="post">
                      <div class="modal-body">
                        <div class="row mb-3">
                          <div class="col-md-3">
                            <label class="col-form-label">Nom :</label>
                          </div>
                          <div class="col-md-9">
                            <input class="form-control" name="officername" value="<?= $row['OfficerName'] ?>" maxlength="60" required>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <div class="col-md-3">
                            <label class="col-form-label">T&eacute;l&eacute;phone :</label>
                          </div>
                          <div class="col-md-9">
                            <input class="form-control" name="officerpnum" value="<?= $row['OfficerPNum'] ?>" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'')" required>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <div class="col-md-3">
                            <label class="col-form-label">Adresse :</label>
                          </div>
                          <div class="col-md-9">
                            <input class="form-control" name="officeraddress" value="<?= $row['OfficerAddress'] ?>" maxlength="30">
                          </div>
                        </div>
                        <div class="row mb-3">
                          <div class="col-md-3">
                            <label class="col-form-label">Utilisateur :</label>
                          </div>
                          <div class="col-md-9">
                            <input class="form-control" name="officeruname" value="<?= $row['OfficerUName'] ?>" maxlength="20" required>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3">
                            <label class="col-form-label">Mot de passe</label>
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
              <div class="modal fade" id="officerDelete<?= $row['OfficerID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h3 class="modal-title text-danger" id="exampleModalLabel">Renvoi d'agent</h3>
                      <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <h5 class="text-center">Voulez-vous vraiment renvoyer l'agent "<?= $row['OfficerName'] ?>" ?</h5>
                    </div>
                    <div class="modal-footer">
                      <a href="officerDelete/<?= $row['OfficerID'] ?>"><button class="btn btn-danger"><i class="fa fa-user-times"></i>&nbsp;Renvoyer</button></a>
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
        <h3 class="text-primary text-center my-5">Nombre de vente</h3>
        <hr>
        <table class="table table-bordered table-striped" id="dataTableSaleNb">
          <thead class="bg-primary text-light">
            <tr class="text-center">
              <th>Agent</th>
              <th>Vente</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($officer as $row) : ?>
              <tr>
                <td><?= $row['OfficerName'] ?></td>
                <td><?= $row['SaleNb'] ?></td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>