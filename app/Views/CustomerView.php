<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Client</title>
</head>

<body>
  <?php include 'Navbar.php' ?>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#dataTableCust').DataTable();
      $('#dataTableApart').DataTable();
    });
  </script>
  <div class="container-fluid">
    <div class="row">
      <div class="card col-md-8 pb-2">
        <div class="text-center mt-5">
          <h1 class="mb-5">Client</h1>
          <hr>
          <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#custInsert"><i class="fa fa-plus"></i><!-- &nbsp;Ajouter --></button>
          <div class="modal fade" id="custInsert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title text-primary" id="exampleModalLabel">Ajout de client</h3>
                  <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="custInsert" method="post">
                  <div class="modal-body">
                    <div class="row mb-3">
                      <div class="col-md-3">
                        <label class="col-form-label">Nom :</label>
                      </div>
                      <div class="col-md-9">
                        <input class="form-control" name="custname" maxlength="60" required>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-md-3">
                        <label class="col-form-label">T&eacute;l&eacute;phone :</label>
                      </div>
                      <div class="col-md-9">
                        <input class="form-control" name="custpnum" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'')" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <label class="col-form-label">Adresse :</label>
                      </div>
                      <div class="col-md-9">
                        <input class="form-control" name="custaddress" maxlength="30">
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
        <table class="table table-bordered table-striped" id="dataTableCust">
          <thead class="bg-dark text-light">
            <tr class="text-center">
              <th>Nom</th>
              <th>T&eacute;l&eacute;phone</th>
              <th>Adresse</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($cust as $row) : ?>
              <tr>
                <td><?= $row['CustName'] ?></td>
                <td><?= $row['CustPNum'] ?></td>
                <td><?= $row['CustAddress'] ?></td>
                <td class="text-center">
                  <button class="btn btn-warning text-light" data-bs-toggle="modal" data-bs-target="#custUpdate<?= $row['CustID'] ?>"><i class="fa fa-pen"></i><!-- &nbsp;Modifier --></button>
                  <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#custDelete<?= $row['CustID'] ?>"><i class="fa fa-user-times"></i><!-- &nbsp;Supprimer --></button>
                </td>
              </tr>
              <div class="modal fade" id="custUpdate<?= $row['CustID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h3 class="modal-title text-warning" id="exampleModalLabel">Modification de client</h3>
                      <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="custUpdate/<?= $row['CustID'] ?>" method="post">
                      <div class="modal-body">
                        <div class="row mb-3">
                          <div class="col-md-3">
                            <label class="col-form-label">Nom :</label>
                          </div>
                          <div class="col-md-9">
                            <input class="form-control" name="custname" value="<?= $row['CustName'] ?>" maxlength="60" required>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <div class="col-md-3">
                            <label class="col-form-label">T&eacute;l&eacute;phone :</label>
                          </div>
                          <div class="col-md-9">
                            <input class="form-control" name="custpnum" value="<?= $row['CustPNum'] ?>" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'')" required>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3">
                            <label class="col-form-label">Adresse :</label>
                          </div>
                          <div class="col-md-9">
                            <input class="form-control" name="custaddress" value="<?= $row['CustAddress'] ?>" maxlength="30">
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
              <div class="modal fade" id="custDelete<?= $row['CustID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h3 class="modal-title text-danger" id="exampleModalLabel">Suppression de client</h3>
                      <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <h5 class="text-center">Voulez-vous vraiment supprimer le client "<?= $row['CustName'] ?>" ?</h5>
                    </div>
                    <div class="modal-footer">
                      <a href="custDelete/<?= $row['CustID'] ?>"><button class="btn btn-danger"><i class="fa fa-user-times"></i>&nbsp;Supprimer</button></a>
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
        <h3 class="text-primary text-center my-5">Liste de propri&eacute;t&eacute;</h3>
        <hr>
        <table class="table table-bordered table-striped" id="dataTableApart">
          <thead class="bg-primary text-light">
            <tr class="text-center">
              <th>Logement</th>
              <th>Client</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($apart as $row) : ?>
              <tr>
                <td><?= $row['ApartAddress'] ?></td>
                <td><?= $row['CustName'] ?></td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>