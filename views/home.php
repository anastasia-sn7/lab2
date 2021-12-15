<?php include "navbar.php"?>
<h1 class="text-center">Welcome to the website!</h1>
    <style>
        .center {
            text-align: center;
        }
    </style>
<?php if(isset($_SESSION['alert']['emailExists']) && ($_SESSION['alert']['emailExists'])):?>
    <script>
        alert("This email already exists");
    </script>
<?php endif;?>

<?php if(isset($_SESSION['alert']['registration']) && ($_SESSION['alert']['registration'])):?>
    <script>
        alert("You've successfully registered. Now you need to log in!");
    </script>
<?php endif;?>
    <form action="?controller&action=logout" method="post" enctype="multipart/form-data">
        <input type="submit" class="btn right" value="Logout">
    </form>

    <div class="container" style="background-color: #bfffc0">
        <br>
        <br>
        <br>
        <h2 class="text-center"> Control Panel</h2>
        <p class = "center" > <img src = "public/default/background.jpg" alt = "image" height="600"> </p>
        <div class="text-center">
            <br>
            <a class="btn btn-outline-success" href="?controller=users">List of all Users</a>
            <a class="btn btn-outline-success" href="?controller=roles">List of all Roles</a>
        </div>
    </div>

<?php
$_SESSION['alert']['emailExists']=false;
$_SESSION['alert']['registration']=false;
?>

</body>
</html>