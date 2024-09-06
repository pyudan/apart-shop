<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vente</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
  <?php include 'Navbar.php' ?>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#dataTableSale').DataTable();
    });
  </script>
  <div class="container-fluid card pb-2">
    <h1 class="text-center my-5">Vente</h1>
    <hr>
    <table class="table table-bordered table-striped" id="dataTableSale">
      <thead class="bg-dark text-light">
        <tr class="text-center">
          <th>Date</th>
          <th>Logement</th>
          <th>Prix</th>
          <th>Client</th>
          <th>Type de vente</th>
          <th>Agent</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($sale as $row) : ?>
          <tr>
            <td><?= $row['SaleDate'] ?></td>
            <td><?= $row['ApartAddress'] ?></td>
            <td><?= $row['SaleTotal'] ?> Ar</td>
            <td><?= $row['CustName'] ?></td>
            <td><?= $row['SaleType'] ?></td>
            <td><?= $row['OfficerName'] ?></td>
            <td class="text-center">
              <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#saleView<?= $row['SaleID'] ?>"><i class="fa fa-file-invoice"></i><!-- &nbsp;Afficher --></button>
            </td>
          </tr>
          <div class="modal fade" id="saleView<?= $row['SaleID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title text-primary" id="exampleModalLabel">Vente de logement</h3>
                  <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="invoice">
                  <h3 class="text-center mb-5">APART SHOP</h3>
                  <div class="mb-3">
                    <label class="col-form-label">Date et heure : <?= $row['SaleDate'] ?></label>
                  </div>
                  <div class="mb-3">
                    <label class="col-form-label">Agence : <?= $row['OfficeName'] ?></label>
                  </div>
                  <div class="mb-5">
                    <label class="col-form-label">Province : <?= $row['ProvinceName'] ?></label>
                  </div>
                  <div class="mb-3">
                    <label class="col-form-label">Adresse : <?= $row['ApartAddress'] ?></label>
                  </div>
                  <div class="mb-3">
                    <label class="col-form-label">Prix : <?= $row['SaleTotal'] ?> Ar</label>
                  </div>
                  <div class="mb-3">
                    <label class="col-form-label">Client : <?= $row['CustName'] ?></label>
                  </div>
                  <div class="mb-3">
                    <label class="col-form-label">Type de vente : <?= $row['SaleType'] ?></label>
                  </div>
                  <div class="mb-5">
                    <label class="col-form-label">Agent : <?= $row['OfficerName'] ?></label>
                  </div>
                  <label class="col-form-label">Net &agrave; payer : <?= $row['SaleTotal'] ?> Ar</label>
                </div>
                <div class="modal-footer">
                  <button class="btn btn-dark" onclick="printDiv('invoice')"><i class="fa fa-print"></i>&nbsp;Imprimer</button>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Fermer</button>
                </div>
              </div>
            </div>
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
          </script>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</body>

</html>