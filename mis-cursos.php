<?php include('header-link.php');
if (!isset($_SESSION['user_tipo'])) {
    header('Location:index.php?nt=0');
} else {
} ?>

<?php include('header.php'); ?>


<?php include('footer.php'); ?>