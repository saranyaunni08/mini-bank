<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>MINI BANK | Admin</title>
      <!-- Bootstrap core CSS-->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

      <!-- Font Awesome 6.4.2 -->
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet" />
  
      <!-- DataTables CSS -->
      <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
  
      <!-- Custom styles -->
      <link href="css/sb-admin.css" rel="stylesheet" />
  </head>

  <body class="fixed-nav sticky-footer bg-dark" id="page-top">
    <!-- Navigation-->
    <nav
      class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top"
      id="mainNav"
    >
      <a class="navbar-brand" href={{ route('customers') }}>MINI BANK</a>
      <button
        class="navbar-toggler navbar-toggler-right"
        type="button"
        data-toggle="collapse"
        data-target="#navbarResponsive"
        aria-controls="navbarResponsive"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
          <li
            class="nav-item"
            data-toggle="tooltip"
            data-placement="right"
            title="Dashboard"
          >
            <a class="nav-link" href={{ route('dashboard') }}>
              <i class="fa fa-fw fa-dashboard"></i>
              <span class="nav-link-text">Dashboard</span>
            </a>
          </li>
        </ul>
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
          <li
            class="nav-item"
            data-toggle="tooltip"
            data-placement="right"
            title="Dashboard"
          >
            <a class="nav-link" href={{ route('dashboard') }}>
              <i class="fa fa-fw fa-dashboard"></i>
              <span class="nav-link-text">Dashboard</span>
            </a>
          </li>
          <li
            class="nav-item active"
            data-toggle="tooltip"
            data-placement="right"
            title="Dashboard"
          >
            <a class="nav-link" href="users.html">
              <i class="fa fa-fw fa-user"></i>
              <span class="nav-link-text">Customers</span>
            </a>
          </li>
        </ul>
        <ul class="navbar-nav sidenav-toggler">
          <li class="nav-item">
            <a class="nav-link text-center" id="sidenavToggler">
              <i class="fa fa-fw fa-angle-left"></i>
            </a>
          </li>
        </ul>
       
      </div>
    </nav>
    <div class="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item">
            <a href="customers.html">Customers</a>
          </li>
          <li class="breadcrumb-item active">Transactions</li>
        </ol>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header d-flex justify-content-between">
                <div>
                  <h5>Listing Transactions of <b>User 1</b></h5>
                  <p>Balance : $ 3000</p>
                </div>
                <div>
                  <a href="customers.html" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Customers</a>
                </div>
              </div>
              <div class="card-body">
                <table id="datatablesSimple">
                  <thead>
                      <tr>
                          <th>Type</th>
                          <th>Date</th>
                          <th>Amount</th>
                          <th>ip</th>                         
                      </tr>
                  </thead>            
                  <tbody>
                      <tr>
                          <td>Credited</td>
                          <td>18-Jun, 2023</td>
                          <td>$ 200</td>
                          <td>123.66.23.44</td>
                      </tr> 
                      <tr>
                        <td>Debited</td>
                        <td>12-Jun, 2023</td>
                        <td>$ 100</td>
                        <td>123.68.23.44</td>
                    </tr>                      
                  </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.container-fluid-->
      <!-- /.content-wrapper-->
      <footer class="sticky-footer">
        <div class="container">
          <div class="text-center">
            <small>Copyright © Your Website 2017</small>
          </div>
        </div>
      </footer>
      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
      </a>
      <!-- Logout Modal-->
      
      <!-- Bootstrap core JavaScript-->
       <!-- jQuery 3.6.4 -->
       <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

       <!-- Bootstrap 5.3.2 Bundle (JS + Popper) -->
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
 
       <!-- DataTables JS -->
       <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"></script>
 
       <!-- Custom scripts -->
       <script src="js/sb-admin.min.js"></script>
 
      <script>
        const datatablesSimple = document.getElementById('datatablesSimple');
        if (datatablesSimple) {
            new simpleDatatables.DataTable(datatablesSimple);
        }
      </script>
    </div>
  </body>
</html>
