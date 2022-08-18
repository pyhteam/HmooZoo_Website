<?php
require_once "config/database.php";
require_once "utili/hmoozooCommon.php";
require_once "utili/Pagination.class.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HmooZoo Official</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/templatemo-style.css">

    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link rel="manifest" href="img/site.webmanifest">

</head>

<body>
    <!-- Page Loader -->
    <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    <?php require_once "layout/header.php" ?>

    <div class="tm-hero d-flex justify-content-center align-items-center" data-parallax="scroll" data-image-src="img/The-Jesus-Film-Jesus-healing-Facebook.jpg">
        <form class="d-flex tm-search-form" action="/?page=tim-kiem" role="search">
            <input type="text" name="page" value="tim-kiem" class="form-control" hidden>
            <input class="form-control tm-search-input" type="search" placeholder="Nrhiav Videos" name="keySearch" aria-label="Search">
            <button class="btn btn-outline-success tm-search-btn" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>

    <div class="container-fluid tm-container-content tm-mt-60">
        <?php
        $page = isset($_GET['page']) ? $_GET['page'] : 'home';
        switch ($page) {
            case 'home':
                require_once "page/videos.php";
                break;
            case 'videos':
                require_once "page/videos.php";
                break;
            case 'details':
                require_once "page/details.php";
                break;
            case 'tim-kiem':
                require_once "page/search.php";
                break;
            default:
                require_once "page/videos.php";
                break;
        }

        ?>
    </div> <!-- container-fluid, tm-container-content -->

    <?php require_once "layout/footer.php" ?>

    <script src="js/plugins.js"></script>
    <script>
        $(window).on("load", function() {
            $('body').addClass('loaded');
        });
    </script>

</body>

</html>