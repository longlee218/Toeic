<?php
require_once './MVC/Views/inc/master.php';
?>


<h1>Hello <?php print_r($_SESSION['auth']['username'])  ?></h1>

<button onclick="logout()">Logout</button>
<script>
    function logout(){
        $.ajax({
            method: 'POST',
            url: '/../Toeic/api/logout',
            success: () => {
                window.location.reload();
            }
        })
    }
</script>