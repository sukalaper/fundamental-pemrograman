<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="shortcut icon" href="<?= base_url('assets/img/favicon.ico'); ?>">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
    <style type="text/css">
        body {
            font-family: Roboto;
            color: #4d4d4d;
            background: #fff;
            overflow-x: hidden;
        }

        .display-5 {
            font-size: 2.2rem;
            font-weight: 300;
            line-height: 1.2;
        }

        .display-6 {
            font-size: 1.5rem;
            font-weight: 300;
            line-height: 1.2;
        }

        .logo {
            width: 70px;
            height: 70px;
            position: absolute;
            margin-left: 45px;
        }

        @media print {

            .table th,
            .table td {
                border-color: #454d55 !important;
            }

            .table th {
                color: #fff !important;
                background-color: #343a40 !important;
                border-color: #454d55 !important;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <?= $content; ?>
    </div>

    <script src="<?= base_url('assets/js/jquery.min.js'); ?>"></script>
    <script>
        $(document).ready(function() {
            window.print();
            setTimeout(function() {
                window.close();
            }, 100);
        });
    </script>
</body>

</html>