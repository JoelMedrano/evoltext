<?php
session_start();

/*=============================================
Capturar las rutas de la URL
=============================================*/
$routesArray = explode("/", $_SERVER['REQUEST_URI']);
$routesArray = array_filter($routesArray);

/*=============================================
Limpiar la Url de variables GET
=============================================*/
foreach ($routesArray as $key => $value) {

    $value = explode("?", $value)[0];
    $routesArray[$key] = $value;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="google" content="notranslate">
    <!-- Title -->
    <title> Evoltext </title>

    <!------------->
    <!-- LINKS -->
    <!------------->
    <!-- Favicon -->
    <link rel="icon" href="views/assets/img/brand/favicon.png" type="image/x-icon" />
    <!-- Icons css -->
    <link href="views/assets/css/icons.css" rel="stylesheet">
    <!--  bootstrap css-->
    <link id="style" href="views/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <!-- style css -->
    <link href="views/assets/css/style.css" rel="stylesheet">
    <link href="views/assets/css/style-dark.css" rel="stylesheet">
    <link href="views/assets/css/style-transparent.css" rel="stylesheet">
    <!---Skinmodes css-->
    <link href="views/assets/css/skin-modes.css" rel="stylesheet" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="views/assets/custom/template/template.css">
    <!-- Material Preloader -->
    <link rel="stylesheet" href="views/assets/plugins/material-preloader/material-preloader.css">

    <!------------->
    <!-- SCRIPTS -->
    <!------------->
    <!-- JQuery min js -->
    <script src="views/assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap js -->
    <script src="views/assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="views/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- Internal Chart.Bundle js-->
    <script src="views/assets/plugins/chart.js/Chart.bundle.min.js"></script>
    <!-- Moment js -->
    <script src="views/assets/plugins/moment/moment.js"></script>
    <!-- INTERNAL Apexchart js -->
    <script src="views/assets/js/apexcharts.js"></script>
    <!--Internal Sparkline js -->
    <script src="views/assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!-- Moment js -->
    <script src="views/assets/plugins/raphael/raphael.min.js"></script>
    <!-- Eva-icons js -->
    <script src="views/assets/js/eva-icons.min.js"></script>
    <!-- Sticky js -->
    <script src="views/assets/js/sticky.js"></script>
    <!--Internal  index js -->
    <script src="views/assets/js/index.js"></script>
    <!-- Chart-circle js -->
    <script src="views/assets/js/circle-progress.min.js"></script>
    <!-- Internal Data tables -->
    <script src="views/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="views/assets/plugins/datatable/js/dataTables.bootstrap5.js"></script>
    <script src="views/assets/plugins/datatable/dataTables.responsive.min.js"></script>
    <script src="views/assets/plugins/datatable/responsive.bootstrap5.min.js"></script>
    <!-- INTERNAL Select2 js -->
    <script src="views/assets/plugins/select2/js/select2.full.min.js"></script>
    <script src="views/assets/js/select2.js"></script>
    <!-- Material Preloader -->
    <!-- https://www.jqueryscript.net/loading/Google-Inbox-Style-Linear-Preloader-Plugin-with-jQuery-CSS3.html -->
    <script src="views/assets/plugins/material-preloader/material-preloader.js"></script>
    <!-- Sweet Alert -->
    <!-- https://sweetalert2.github.io/ -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script src="views/assets/custom/alerts/alerts.js"></script>

</head>

<body id="mainBody" class="ltr main-body app sidebar-mini">

    <!-- Loader -->
    <div id="global-loader">
        <img src="views/assets/img/loader.svg" class="loader-img" alt="Loader">
    </div>
    <!-- /Loader -->

    <?php include "pages/login/login.php"
    ?>

    <!-- Page -->
    <div class="page">

        <div class="main-content app-content">
            <!-- main-header -->
            <?php //include "modules/navbar.php" 
            ?>

            <!-- main-sidebar -->
            <?php //include "modules/sidebar.php" 
            ?>

            <!-- main-content -->
            <?php //include "pages/home/dashboard1.php" 
            ?>

            <?php //include "pages/404/404.php"
            ?>

        </div>

        <!-- Footer opened -->
        <?php //include "modules/footer.php"
        ?>

    </div>
    <!-- End Page -->

    <!-- Back-to-top -->
    <a href="#top" id="back-to-top"><i class="las la-arrow-up"></i></a>

    <!------------->
    <!-- SCRIPTS -->
    <!------------->
    <!--Internal  Perfect-scrollbar js -->
    <script src="views/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="views/assets/plugins/perfect-scrollbar/p-scroll.js"></script>
    <!-- right-sidebar js -->
    <script src="views/assets/plugins/sidebar/sidebar.js"></script>
    <script src="views/assets/plugins/sidebar/sidebar-custom.js"></script>
    <!-- Sidebar js -->
    <script src="views/assets/plugins/side-menu/sidemenu.js"></script>
    <!-- custom js -->
    <script src="views/assets/js/custom.js"></script>
    <!-- Theme Color js -->
    <script src="views/assets/js/themecolor.js"></script>

    <script src="views/assets/custom/forms/forms.js"></script>

</body>

</html>