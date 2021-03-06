<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?= $title; ?> | SIPONTREN</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?= base_url() ?>/js/bootstrap-social/bootstrap-social.css">
    <link rel="stylesheet" href="<?= base_url() ?>/js/summernote/dist/summernote-bs4.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url() ?>/js/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/js/datatables.net-select-bs4/css/select.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/css/bootstrap-timepicker/css/bootstrap-timepicker.min.css">

    <link rel="stylesheet" href="<?= base_url() ?>/ionicons201/css/ionicons.min.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/css/components.css">

    <style>
        .ui-autocomplete {
            position: absolute;
            color: white;
            background-color: darkgreen;
            cursor: default;
            z-index: 1500 !important;
        }

        .ui-front {
            z-index: 1500 !important;
        }
    </style>
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>

            <!-- Topnav -->
            <?= $this->include('partial/topnav'); ?>

            <!-- Sidenav -->
            <?= $this->include('partial/sidenav'); ?>

            <!-- Main Content -->
            <div class="main-content">
                <?= $this->renderSection('content'); ?>
            </div>

            <!-- Footer -->
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; <?= date('Y'); ?> <div class="bullet"></div> Developed By Kejari Purwokerto</a>
                </div>
                <div class="footer-right">
                    1.0.1
                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

    <script src="<?= base_url() ?>/js/stisla.js"></script>
    <style>
        .ui-autocomplete {
            position: absolute;
            cursor: default;
            z-index: 1500 !important;
        }

        .ui-front {
            z-index: 1500 !important;
        }
    </style>
    <!-- JS Libraies -->
    <script src="<?= base_url() ?>/js/prism.js"></script>
    <script src="<?= base_url() ?>/js/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>/js/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>/js/datatables.net-select-bs4/js/select.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>/js/timepicker/bootstrap-timepicker.min.js"></script>

    <!-- Template JS File -->
    <script src="<?= base_url() ?>/js/scripts.js"></script>
    <script src="<?= base_url() ?>/js/custom.js"></script>

    <!-- Page Specific JS File -->
    <script src="<?= base_url() ?>/js/bootstrap-modal.js"></script>
    <script src="<?= base_url() ?>/js/modules-datatables.js"></script>
    <script src="<?= base_url(); ?>/js/forms-advanced-forms.js"></script>
    <script src="<?= base_url(); ?>/js/modules-sweetalert.js"></script>

</body>

</html>