<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Logement</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
  <?php include 'Navbar.php' ?>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#dataTableApart').DataTable();
    });
  </script>
  <div class="container-fluid card pb-2">
    <div class="text-center mt-5">
      <h1 class="mb-5">Logement</h1>
      <hr>
      <!-- <input id="cust">
      <select onchange="cust(event)">
        <option selected hidden disabled>Type de vente</option>
        <option value="Au comptant">Au comptant</option>
        <option value="&Agrave; cr&eacute;dit">&Agrave; cr&eacute;dit</option>
      </select>
      <script type="text/javascript">
        function cust(e) {
          document.getElementById('cust').value = e.target.value;
        }
      </script> -->
      <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#apartInsert"><i class="fa fa-plus"></i><!-- &nbsp;Ajouter --></button>
      <div class="modal fade" id="apartInsert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title text-primary" id="exampleModalLabel">Ajout de logement</h3>
              <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="apartInsert" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="row mb-3">
                  <div class="col-md-3">
                    <label class="col-form-label">Adresse :</label>
                  </div>
                  <div class="col-md-9">
                    <input class="form-control" name="apartaddress" maxlength="30" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-3">
                    <label class="col-form-label">Prix :</label>
                  </div>
                  <div class="col-md-9">
                    <div class="input-group">
                      <input type="number" class="form-control" name="apartprice" required>
                      <span class="input-group-text">Ar</span>
                    </div>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-3">
                    <label class="col-form-label">Image :</label>
                  </div>
                  <div class="col-md-9">
                    <input type="file" class="form-control" name="apartimg" accept=".jpg, .png, .jpeg">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <label class="col-form-label">Terrain :</label>
                  </div>
                  <div class="col-md-9">
                    <select class="form-select" name="siteid">
                      <option selected hidden disabled>Choisir un terrain</option>
                      <?php foreach ($site as $row) : ?>
                        <option value="<?= $row['SiteID'] ?>"><?= $row['SiteLocation'] ?></option>
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
    <table class="table table-bordered table-striped" id="dataTableApart">
      <thead class="bg-dark text-light">
        <tr class="text-center">
          <th>Adresse</th>
          <th>Prix</th>
          <th>Terrain</th>
          <th>Propri&eacute;taire</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($apart as $row) : ?>
          <tr>
            <td><?= $row['ApartAddress'] ?></td>
            <td><?= $row['ApartPrice'] ?> Ar</td>
            <td><?= $row['SiteLocation'] ?></td>
            <td><?= $row['CustName'] ?></td>
            <td class="text-center">
              <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#saleInsert<?= $row['ApartID'] ?>"><i class="fa fa-money-bill-wave"></i><!-- &nbsp;Vendre --></button>
              <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#apartImg<?= $row['ApartID'] ?>"><i class="fa fa-image"></i><!-- &nbsp;Image --></button>
              <button class="btn btn-warning text-light" data-bs-toggle="modal" data-bs-target="#apartUpdate<?= $row['ApartID'] ?>"><i class="fa fa-pen"></i><!-- &nbsp;Modifier --></button>
              <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#apartDelete<?= $row['ApartID'] ?>"><i class="fa fa-trash"></i><!-- &nbsp;Supprimer --></button>
            </td>
          </tr>
          <div class="modal fade" id="saleInsert<?= $row['ApartID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title text-success" id="exampleModalLabel">Vente de logement</h3>
                  <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="saleInsert/<?= $row['ApartID'] ?>" method="post">
                  <div class="modal-body" id="invoice">
                    <input type="hidden" name="officerid" value="<?= $officerid ?>">
                    <input type="hidden" name="saletotal" value="<?= $row['ApartPrice'] ?>">
                    <h3 class="text-center mb-5">APART SHOP</h3>
                    <div class="mb-3">
                      <label class="col-form-label">Date et heure : <?= date('d-m-Y H:i:s') ?></label>
                    </div>
                    <div class="mb-3">
                      <label class="col-form-label">Agence : <?= $row['OfficeName'] ?></label>
                    </div>
                    <div class="mb-5">
                      <label class="col-form-label">Province : <?= $row['ProvinceName'] ?></label>
                    </div>
                    <div class="row mb-3">
                      <div class="col-md-3">
                        <label class="col-form-label">Adresse :</label>
                      </div>
                      <div class="col-md-9">
                        <input class="form-control-plaintext" value="<?= $row['ApartAddress'] ?>" disabled>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-md-3">
                        <label class="col-form-label">Prix :</label>
                      </div>
                      <div class="col-md-9">
                        <input class="form-control-plaintext" value="<?= $row['ApartPrice'] ?> Ar" disabled>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-md-3">
                        <label class="col-form-label">Client :</label>
                      </div>
                      <div class="col-md-7">
                        <select class="form-select" name="custid">
                          <option selected hidden disabled>Choisir le client</option>
                          <?php foreach ($cust as $row2) : ?>
                            <option value="<?= $row2['CustID'] ?>"><?= $row2['CustName'] ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                      <div class="col-md-2">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#custQuiInsert">+</button>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-md-3">
                        <label class="col-form-label">Type :</label>
                      </div>
                      <div class="col-md-9">
                        <select class="form-select" name="saletype">
                          <option selected hidden disabled>Choisir le type de vente</option>
                          <option value="&Agrave; cr&eacute;dit">&Agrave; cr&eacute;dit</option>
                          <option value="Au comptant">Au comptant</option>
                        </select>
                      </div>
                    </div>
                    <div class="row mb-5">
                      <div class="col-md-3">
                        <label class="col-form-label">Agent :</label>
                      </div>
                      <div class="col-md-9">
                        <input class="form-control-plaintext" value="<?= $officername ?>" disabled>
                      </div>
                    </div>
                    <div>
                      <label class="col-form-label">Net &agrave; payer : <?= $row['ApartPrice'] ?> Ar</label>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="fa fa-money-bill-wave"></i>&nbsp;Vendre</button>
                    <button class="btn btn-dark" onclick="printDiv('invoice')"><i class="fa fa-print"></i>&nbsp;Imprimer</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Fermer</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="modal fade" id="apartImg<?= $row['ApartID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title" id="exampleModalLabel">Image de logement</h3>
                  <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                  <img src="<?= $row['ApartImg'] != null ? 'data:image/jpg;base64,' . $row['ApartImg'] : 'favicon.ico' ?>" alt="<?= $row['ApartImg'] != null ? $row['ApartAddress'] : 'Aucune image!' ?>">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Fermer</button>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="apartUpdate<?= $row['ApartID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title text-warning" id="exampleModalLabel">Modification de logement</h3>
                  <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="apartUpdate/<?= $row['ApartID'] ?>" method="post" enctype="multipart/form-data">
                  <div class="modal-body text-center">
                    <div class="row mb-3">
                      <div class="col-md-3">
                        <label class="col-form-label">Adresse :</label>
                      </div>
                      <div class="col-md-9">
                        <input class="form-control" name="apartaddress" value="<?= $row['ApartAddress'] ?>" maxlength="30" required>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-md-3">
                        <label class="col-form-label">Prix :</label>
                      </div>
                      <div class="col-md-9">
                        <div class="input-group">
                          <input type="number" class="form-control" name="apartprice" value="<?= $row['ApartPrice'] ?>">
                          <span class="input-group-text">Ar</span>
                        </div>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-md-3">
                        <label class="col-form-label">Image :</label>
                      </div>
                      <div class="col-md-9">
                        <input type="file" class="form-control" name="apartimg" accept=".jpg, .png, .jpeg">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-md-3">
                        <label class="col-form-label">Terrain :</label>
                      </div>
                      <div class="col-md-9">
                        <select class="form-select" name="siteid">
                          <?php foreach ($site as $row2) : ?>
                            <option value="<?= $row['SiteID'] ?>" selected hidden><?= $row['SiteLocation'] ?></option>
                            <option value="<?= $row2['SiteID'] ?>"><?= $row2['SiteLocation'] ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                    <img src="<?= $row['ApartImg'] != null ? 'data:image/jpg;base64,' . $row['ApartImg'] : 'favicon.ico' ?>" alt="<?= $row['ApartImg'] != null ? $row['ApartAddress'] : 'Aucune image!' ?>">
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-warning text-light"><i class="fa fa-check"></i>&nbsp;Modifier</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Fermer</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="modal fade" id="apartDelete<?= $row['ApartID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title text-danger" id="exampleModalLabel">Suppression de logement</h3>
                  <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <h5 class="text-center">Voulez-vous vraiment supprimer le logement &agrave; l'adresse "<?= $row['ApartAddress'] ?>" ?</h5>
                </div>
                <div class="modal-footer">
                  <a href="apartDelete/<?= $row['ApartID'] ?>"><button class="btn btn-danger"><i class="fa fa-trash"></i>&nbsp;Supprimer</button></a>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Fermer</button>
                </div>
              </div>
            </div>
          </div>
          <!-- <div hidden>
                <h3 class="text-center mb-5">APART SHOP</h3>
                <div class="mb-3">
                  <label class="col-form-label">Date et heure : <//?= date('d-m-Y H:i:s') ?></label>
                </div>
                <div class="mb-3">
                  <label class="col-form-label">Agence : <? //= $row['OfficeName'] 
                                                          ?></label>
                </div>
                <div class="mb-5">
                  <label class="col-form-label">Province : <? //= $row['ProvinceName'] 
                                                            ?></label>
                </div>
                <div class="mb-3">
                  <label class="col-form-label">Adresse : <? //= $row['ApartAddress'] 
                                                          ?></label>
                </div>
                <div class="mb-3">
                  <label class="col-form-label">Prix : <? //= $row['ApartPrice'] 
                                                        ?> Ar</label>
                </div>
                <div class="mb-3">
                  <label class="col-form-label">Client : <input id="custname"></label>
                </div>
                <div class="mb-3">
                  <label class="col-form-label">Type de vente : <input id="saletype"></label>
                </div>
                <div class="mb-5">
                  <label class="col-form-label">Agent : <? //= $officername 
                                                        ?></label>
                </div>
                <div class="mb-3">
                  <label class="col-form-label">Net &agrave; payer : <? //= $row['ApartPrice'] 
                                                                      ?> Ar</label>
                </div>
              </div> -->
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
  <script type="text/javascript">
    function printDiv(divName) {
      var printContent = document.getElementById(divName).innerHTML;
      var originalContent = document.body.innerHTML;
      document.body.innerHTML = printContent;
      window.print();
      document.body.innerHTML = originalContent;
      window.location.reload();
    }
    // function setCust(e) {
    //   document.getElementById('custname').value = e.target;
    // }
    // function setType(e) {
    //   document.getElementById('saletype').value = e.target.value;
    // }
  </script>
  <div class="modal fade" id="custQuiInsert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title text-primary" id="exampleModalLabel">Ajout de client</h3>
          <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="custQuiInsert" method="post">
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
</body>

</html>