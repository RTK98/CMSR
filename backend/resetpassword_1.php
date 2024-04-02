<?php
include 'config.php';
include 'function.php';
?>
<script src="<?= SYSTEM_PATH ?>assets/js/sweetalert2.all.js"></script>
<link rel="stylesheet" href="<?= SYSTEM_PATH ?>assets/css/sweetalert2.min.css">
<script>
 
    Swal.fire({
        title: 'Success!',
        text: 'Password has been reset',
        icon: 'success',
        position: 'top-right',
        showConfirmButton: true
    }).then(() => {
//        window.location.href = 'login.php'; // Redirect to success page
    });
</script>