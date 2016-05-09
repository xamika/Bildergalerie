<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="../css/styles.css"/>
    <!-- Latest compiled and minified CSS Bootstrap -->
    <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css" type="text/css">
    <!-- Website Font style font-awesome -->
    <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../bower_components/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <!-- Latest compiled and minified JavaScript Bootstrap -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../js/javascript.js"></script>
    <title>Bilderdatenbank</title>
</head>
<body>
<?php echo getMenu(getValue(getValue('menu_eintraege')), getValue('menu_titel')); ?>


<div class="container-fluid text-center">
    <div class="row content">
        <div class="col-sm-2 sidenav">
            <!-- sidenav left -->
        </div>
        <div class="col-sm-8 text-left">
            <?php echo getValue('inhalt'); ?>
        </div>
        <div class="col-sm-2 sidenav">
            <!-- sidenav right -->
        </div>
    </div>
</div>

<footer class="container-fluid text-center">
    <span class="wb10">&copy; Copyright IET-gibb</span>
</footer>

</body>
</html>
