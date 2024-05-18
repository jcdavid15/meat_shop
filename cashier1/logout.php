<?php 
    session_start();
    unset($_SESSION["cashier_id"]);
?>

<script>
    localStorage.removeItem("cashierDetails");
    window.location.href =  "../components/login.php";
</script>