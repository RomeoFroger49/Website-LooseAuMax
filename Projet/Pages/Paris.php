<?php 
require_once("header.php");
require_once("navbar.php");

?>

<body style="background-color:RGB(6,21,57) ;">

<?php 
// !sécurité pour ne pas acceder a la page sans etre connecter
  if($_SESSION){
?>
<main role="main" ">   
  <div class="album py-5 bg" >
    <div class="container" >
      <div  style="text-align:center;letter-spacing: 3px;color:aliceblue;padding-bottom:2cm;font-size:1cm">Paris en cours</div>

<?php
//! on récupère les paris en cours et terminés de l'utilisateur
    $Match = $bdd->query("SELECT p.Somme as somme, p.EquipeMise as equipe,p.Verif as verif ,p.Etat as etat, m.MatchID as idMatch, L1.Diminutif as Equipe1,p.Gain as gain, L2.Diminutif as Equipe2, m.CoteV1 as V1, m.CoteV2 as V2, m.CoteN as N FROM Matchs m INNER JOIN Ligue1 L1 ON m.Equipe1 = L1.EquipeID INNER JOIN Ligue1 L2 ON m.Equipe2 = L2.EquipeID INNER JOIN Paris p ON m.MatchID = p.MatchID where p.UserID = ".$_SESSION['id']." ");
    $MatchNB = $Match->fetchAll();
//! on affiche les paris en cours de l'utilisateur
    for($i = 0; $i < sizeof($MatchNB); $i++){
        if($MatchNB[$i]['etat'] == 0){
          
?>
          <div class="card mb-4 box-shadow" >              
              <div class="card-body">
                <div class="d-flex text-center">
                  <p class="col-sm" style="text-align:right"><?= $MatchNB[$i]['Equipe1']?></p>
                  <p class="col-sm">VS</p>
                  <p class="col-sm" style="text-align:left"><?= $MatchNB[$i]['Equipe2']?></p>

                  <p class="col-sm" style="text-align:right"> Gains potentiel :</p>
                  <p class="col-sm" style="text-align:left"> <?= $MatchNB[$i]['gain'] ?>€</p>
                </div>
            </div>
          </div>
<?php
          
        }
       }
?>
    </div>
    <div class="container">
      <div  style="text-align:center;letter-spacing: 3px;color:aliceblue;padding-bottom:2cm;font-size:1cm">Paris Gagnés</div>

<?php
//! on affiche les paris gagné de l'utilisateur
    for($i = 0; $i < sizeof($MatchNB); $i++){
        if($MatchNB[$i]['etat'] == 1 && $MatchNB[$i]['verif'] == 1){
?>
          <div class="card mb-4 box-shadow" >              
              <div class="card-body">
                <div class="d-flex text-center">
                  <p class="col-sm" style="text-align:right">V1 =<?= $MatchNB[$i]['Equipe1']?></p>
                  <p class="col-sm">VS</p>
                  <p class="col-sm" style="text-align:left">V2 =<?= $MatchNB[$i]['Equipe2']?></p>
                  <p  class="col-sm" style="text-align:right">L'équipe misée a gagné =<?= $MatchNB[$i]['equipe']?> </p>
                  <p class="col-sm" style="text-align:right"> Gains :</p>
                  <p class="col-sm" style="text-align:left"> <?= $MatchNB[$i]['gain'] ?>€</p>
                </div>
            </div>
          </div>

<?php
          }
        }
?>
    </div>
    <div class="container">
      <div  style="text-align:center;letter-spacing: 3px;color:aliceblue;padding-bottom:2cm;font-size:1cm">Paris Perdus</div>
<?php
//! on affiche les paris perdus de l'utilisateur
    for($i = 0; $i < sizeof($MatchNB); $i++){
        if($MatchNB[$i]['etat'] == 1 && $MatchNB[$i]['verif'] == 0){
?>
          <div class="card mb-4 box-shadow" >              
                <div class="card-body">
                  <div class="d-flex text-center">
                    <p class="col-sm" style="text-align:right">V1 = <?= $MatchNB[$i]['Equipe1']?></p>
                    <p class="col-sm">VS</p>
                    <p class="col-sm" style="text-align:left">V2 = <?= $MatchNB[$i]['Equipe2']?></p>
                    <p  class="col-sm" style="text-align:right">L'équipe misée a perdue =<?= $MatchNB[$i]['equipe']?></p>
                    <p class="col-sm" style="text-align:right"> Somme perdue :</p>
                    <p class="col-sm" style="text-align:left"> <?= $MatchNB[$i]['somme'] ?>€</p>
                  </div>
              </div>
            </div>
<?php
          }
        }
?>
    </div>
   <button type="button" value="Rafraîchir Porte-monnaie" onclick="window.location.href='Validé.php'" class="btn btn-primary btn-lg btn-block">Rafraîchir</button>
  </div>
</main>
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
