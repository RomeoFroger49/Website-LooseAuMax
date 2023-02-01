<?php 
require_once("header.php");
require_once("navbar.php");

?>

<body style="background-color:RGB(6,21,57) ;">

<?php 
// !sécurité pour ne pas acceder a la page sans etre connecter
  if($_SESSION){
// * card pour visualiser le profil enn bootstrap  
?>
<section class="vh-80">
  <div class="container py-5 h-80">
        <div class="card" style="border-radius: 15px;margin:15%">
          <div class="card-body p-4" >
            <div class="d-flex text-black">
              <div class="flex-shrink-0">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-profiles/avatar-1.webp" alt="Generic placeholder image" class="img-fluid"
                  style="width: 180px; border-radius: 10px;">
              </div>
              <div class="flex-grow-1 ms-3">
                <h5 class="mb-1">Pseudo : <?= $_SESSION["username"]?></h5>
                <p class="mb-2 pb-1" style="color: #2b2a2a;">ID Player : <?= $_SESSION["id"]?></p>
                <div class="d-flex justify-content-center rounded-3 p-2 mb-2"style="background-color: #efefef;text-align:center">
                  <div class="px-3" style="border:solid;border-color:white;border-radius: 15px;margin-right:10px">
                    <p class="small text-muted mb-1">Mail</p>
                    <p class="mb-0"><?= $_SESSION["AdresseMail"]?></p>
                  </div>
                  <div class="px-3" style="border:solid;border-color:white;border-radius: 15px;margin-right:10px">
                    <p class="small text-muted mb-1">Prenom-Nom</p>
                    <p class="mb-0"><?=$_SESSION["prenom"]?>-<?=$_SESSION["nom"] ?> </p>
                  </div>
                  <div class="px-3" style="border:solid;border-color:white;border-radius: 15px;margin-right:10px">
                    <p class="small text-muted mb-1">Porte-Monnaie</p>
                    <p class="mb-0"><?= $_SESSION['argent']?> €</p>
                  </div>
                </div>
                <div class="d-flex pt-1">
                  <button type="button" class="btn btn-outline-primary me-1 flex-grow-1" onclick="window.location.href = 'page_modifier.php';" style="background-color:white;color:black;border-color:black">Éditer le profil</button>
                  <button type="button" class="btn btn-outline-primary me-1 flex-grow-1" onclick="window.location.href = 'Valider.php';" style="background-color:white;color:black;border-color:black">Rafraîchir</button>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</section>
 
<?php 
// ! cas échéant 
;} else{ 
?>
  <div class="container" style="margin-top:7cm">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading">Vous n'êtes pas connecté !</h4>
                        <p>Vous devez être connecté pour accéder à cette page.</p>
                        <hr>
                        <p> <button onclick="window.location.href = '/Projet/Pages/login.php';" class="btn btn-primary" type="button" style="background-color:black; border-color:white">Connexion / Inscription</button></p>
                    </div>
                </div>
            </div>
        </div>
<?php ;}?>
</body>
