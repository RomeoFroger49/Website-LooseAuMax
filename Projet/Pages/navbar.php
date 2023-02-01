<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">
            <img src="/Projet/photo/photologo.jpeg" width="50" height="50" class="d-inline-block align" alt="">
             DefaiteAuMax
        </a>
        

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="Profile.php">Profile</a>
            <li class="nav-item">
                <a href="Paris.php" class="nav-link">Mes Paris</a>
            </li>
            <?php 
            if($_SESSION){
                if($_SESSION['admin']== 1){
            ?>
             <li class="nav-item">
                <a href="Admin.php" class="nav-link">Admin</a>
            </li>
            <?php
                ;}
            ;}
            ?>
            </ul>
        </div>
        <?php 
        if($_SESSION){
        ?>
        <div  class="collapse navbar-collapse" id="navbarSupportedContent2" style="margin-right:-2cm">
            <button onclick="window.location.href = '/Projet/Pages/logout.php';" class="nav-item lien-login" type="button">Deconnexion</button>
        </div>
        <div class="collapse navbar-collapse">
            <?= $_SESSION["username"]?>
        </div>
        <?php
        ;} else{
        ?>
         <div  class="collapse navbar-collapse" id="navbarSupportedContent2">
         <button onclick="window.location.href = '/Projet/Pages/login.php';" class="nav-item lien-login" type="button">Connexion</button>
        </div>
        <?php ;}?>
</nav> 