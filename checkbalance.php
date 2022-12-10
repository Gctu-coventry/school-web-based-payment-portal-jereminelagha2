<?php

include_once 'config/Database.php';
include_once 'models/Acc.php';


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GCB Ecommerce</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="myassets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="myassets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="myassets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="myassets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="myassets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="myassets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="myassets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="myassets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
          <a class="sidebar-brand brand-logo" href="index.php"><img src="myassets/images/logo.svg" alt="logo" /></a>
          <a class="sidebar-brand brand-logo-mini" href="index.php"><img src="myassets/images/logo-mini.svg" alt="logo" /></a>
        </div>
        <ul class="nav">
          <li class="nav-item profile">
            <div class="profile-desc">
              <div class="profile-pic">
                <div class="count-indicator">
                  <img class="img-xs rounded-circle " src="myassets/images/faces/face15.jpg" alt="">
                  <span class="count bg-success"></span>
                </div>
                <div class="profile-name">
                  <h5 class="mb-0 font-weight-normal">Joel Amannor-Konadu</h5>
                  <span>Gold Member</span>
                </div>
              </div>
              <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
              <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
                <a href="#" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-settings text-primary"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-onepassword  text-info"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-calendar-today text-success"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
                  </div>
                </a>
              </div>
            </div>
          </li>
          <li class="nav-item nav-category">
            <span class="nav-link">Navigation</span>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="index.php">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="payments.php">
              <span class="menu-icon">
                <i class="mdi mdi-laptop"></i>
              </span>
              <span class="menu-title">Make Payment</span>
             
            </a>
            
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="checkbalance.php">
              <span class="menu-icon">
                <i class="mdi mdi-playlist-play"></i>
              </span>
              <span class="menu-title">Balance Enquiry</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="transactionhistory.php">
              <span class="menu-icon">
                <i class="mdi mdi-table-large"></i>
              </span>
              <span class="menu-title">Transaction History</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="pages/charts/chartjs.html">
              <span class="menu-icon">
                <i class="mdi mdi-chart-bar"></i>
              </span>
              <span class="menu-title">Refund Transaction</span>
            </a>
          </li>
         
        </ul>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar p-0 fixed-top d-flex flex-row">
          <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
            <a class="navbar-brand brand-logo-mini" href="index.html"><img src="myassets/images/logo-mini.svg" alt="logo" /></a>
          </div>
          <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
            </button>
           
            <ul class="navbar-nav navbar-nav-right">
              
              <li class="nav-item dropdown">
                <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                  <div class="navbar-profile">
                    <img class="img-xs rounded-circle" src="myassets/images/faces/face15.jpg" alt="">
                    <p class="mb-0 d-none d-sm-block navbar-profile-name">Joel Amannor-Konadu</p>
                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                  <h6 class="p-3 mb-0">Profile</h6>
                  <div class="dropdown-divider"></div>
             
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-logout text-danger"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Log out</p>
                    </div>
                  </a>
                 
                </div>
              </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-format-line-spacing"></span>
            </button>
          </div>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
          <div class="row justify-content-center">
            
          <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Enter Account Number</h4>
                   
                    
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Account Number</span>
                        </div>
                        <input type="text" value="101111334401" class="form-control" placeholder="Account Number" aria-label="fromacc" aria-describedby="basic-addon1">
                      </div>
                    </div>
                   
                    <div class="form-group">
                    <button type="button" class="btn btn-success btn-icon-text">
                            <i class="mdi mdi-file-check btn-icon-prepend"></i> Check Balance </button>
                          <button type="button" class="btn btn-dark btn-icon-text"> Clear <i class="mdi mdi-file-check btn-icon-append"></i>
                          </button>
                          <div class="form-group"></div>
                          <div class="form-group"></div>
                          <div class="form-group"></div>
                          <div class="form-group"></div>
                          <h2 >GHS 0.00</h2>
                  </div>
</div>
                </div>
              
          
          
           

          </div>
         

          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © gcbecommerce</span>
             
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="myassets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="myassets/vendors/chart.js/Chart.min.js"></script>
    <script src="myassets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="myassets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="myassets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="myassets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="myassets/js/off-canvas.js"></script>
    <script src="myassets/js/hoverable-collapse.js"></script>
    <script src="myassets/js/misc.js"></script>
    <script src="myassets/js/settings.js"></script>
    <script src="myassets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="myassets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>
<script>
$(document).ready(function(){
  $("#viewtsn").click(function(){
    $.ajax({
url: "http://localhost/ecommerce/api/acc/transactionhistory.php?account_number=1511000001",
type: "POST",
dataType: "text",
success:function(data)
{
  $.each(data, function(key,value)){
    tsndata += '<tr>';
    tsndata += '<td>' + value.id +'</td>';
    tsndata += '<td>' + value.tsn_date +'</td>';
    tsndata += '<td>' + value.account_number+'</td>';
    tsndata += '<td>' + value.amount +'</td>';
    tsndata += '<tr>';
  }
$('#tsntable').append(tsndata);

},
      error: function () {
        alert("ajax completed ");
      }

    });
  });
});
</script>
<script>

  function fetch()
  {
    var tsndata = '';
   
  }

  </script>

 