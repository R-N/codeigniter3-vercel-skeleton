<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>ERROR</title>
    <meta name="author" content="Hung Nguyen - dev@nguyenanhung.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link type="text/css" media="all" href="https://hungna.github.io/assets/themes/sailor/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link type="text/css" media="all" href="https://hungna.github.io/assets/themes/sailor/assets/css/style.css" rel="stylesheet" />
    <link type="text/css" media="all" href="https://hungna.github.io/assets/themes/sailor/assets/css/responsive.css" rel="stylesheet" />
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300italic,800italic,800,700italic,700,600italic,600,400italic,300' rel='stylesheet' type='text/css' />
    <link rel="shortcut icon" href="https://hungna.github.io/assets/themes/sailor/assets/img/favicon.png" />
    <style type="text/css">
::selection { background-color: #E13300; color: white; }
::-moz-selection { background-color: #E13300; color: white; }

body {
    background-color: #fff;
    margin: 40px;
    font: 13px/20px normal Helvetica, Arial, sans-serif;
    color: #4F5155;
}

a {
    color: #003399;
    background-color: transparent;
    font-weight: normal;
}
h1 {
    color: #444;
    background-color: transparent;
    border-bottom: 1px solid #D0D0D0;
    font-size: 19px;
    font-weight: normal;
    margin: 0 0 14px 0;
    padding: 14px 15px 10px 15px;
}
code {
    font-family: Consolas, Monaco, Courier New, Courier, monospace;
    font-size: 12px;
    background-color: #f9f9f9;
    border: 1px solid #D0D0D0;
    color: #002166;
    display: block;
    margin: 14px 0 14px 0;
    padding: 12px 10px 12px 10px;
}
#container {
    margin: 10px;
    border: 1px solid #D0D0D0;
    box-shadow: 0 0 8px #D0D0D0;
}

p {
    margin: 12px 15px 12px 15px;
}
    </style>
</head>
<body>
<!-- Header -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1>ERROR</h1>
                <h2><?= $heading; ?></h2>
                <p><?= $message; ?></p>
            </div>
        </div>
    </div>
</section>
<!-- end Header -->

<!-- Illustration -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="illustration">
                    <div class="boat"></div>
                    <div class="water1"></div>
                    <div class="water2"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end Illustration -->

<!-- Button -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <a href="<?= config_item('base_url'); ?>">
                    <div class="btn btn-action">Take me out of here</div>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- end Button -->

<!-- Footer -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <p>&copy; Powered by <a href="<?= config_item('base_url'); ?>" title="Nguyen An Hung"><strong>Nguyen An Hung</strong></a> All Rights Reserved.</p>
            </div>
        </div>
    </div>
</section>
<!-- end Footer -->

<!-- Scripts -->
<script src="https://hungna.github.io/assets/themes/sailor/assets/js/jquery-1.11.2.min.js" type="text/javascript"></script>
<script src="https://hungna.github.io/assets/themes/sailor/assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>