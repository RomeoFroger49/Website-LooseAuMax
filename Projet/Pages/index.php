<?php
require_once("header.php");
require_once("navbar.php");
$mise=0;

$Match = $bdd->query("SELECT  m.MatchID as idMatch ,L1.Diminutif as Equipe1, L2.Diminutif as Equipe2, m.CoteV1 as V1, m.CoteV2 as V2, m.CoteN as N FROM Matchs m INNER JOIN Ligue1 L1 ON m.Equipe1 = L1.EquipeID INNER JOIN Ligue1 L2 ON m.Equipe2 = L2.EquipeID");
$MatchNB = $Match->fetchAll();

if(isset($_GET['somme']) && $_GET['somme'] != 0){
    if($_SESSION ){
      if( $_GET['somme'] <= $_SESSION['argent']){
        $_SESSION['somme'] = $_GET['somme'];
        $_SESSION['idMatch'] = $_GET['idMatch'];
        $mise =$_GET['somme'];
//! creation d'un nouveau paris
        $Add = $bdd->prepare("INSERT INTO Paris(MatchID, UserID,Somme) VALUES (:matchid, :userid, :somme)");
        $Add->execute([
          'matchid' => $_SESSION['idMatch'],
          'userid' => $_SESSION['id'],
          'somme' => $_GET['somme']
        ]);
//! Ici, je récupère l'id du paris que j'ai créé juste avant donc le dernier paris créee 
        $Update = $bdd->query("SELECT last_insert_id() FROM Paris");
        $UpdateNB = $Update->fetchAll();
        $_SESSION['ParisID'] = $UpdateNB[0]['last_insert_id()']; 
     }
     else{
      echo "<script>alert('Vous n\'avez pas assez d\'argent')</script>";
      }
    }
    else{
      header("Location: login.php");die;
    }
   
}
//! script pour eviter pouvoir miser sur un match ou la somme n'est pas renseignée et determiné
?>
<script>
function myFunction($cote) {
  if(document.getElementById("somme").value == 0){
    alert("Vous devez entrer une somme");
    window.location.href = "index.php";
  }
  else{
   if($cote == 1){
    window.location.href = "ParisV1.php";
   }
   else if($cote == 2){
    window.location.href = "ParisV2.php";
   }
   else{ 
    window.location.href = "ParisN.php";
   }
  }
}
</script>

<body style="background-color:RGB(6,21,57) ;">

    <main role="main" ">
      <div class="album py-5 bg" >
        <div class="container" >
            <div  style="text-align:center;letter-spacing: 3px;color:aliceblue;padding-bottom:2cm;font-size:1cm">Paris du jour</div>
          <div class="row justify-content-center">
          <?php
for($i=0; $i < sizeof($MatchNB);$i++){
// ! card pour visualiser les match en fonction du nombre de matchs dans notre base de donnée qui en premier recueil la somme parié et qui ensuite m'envoie sur l'une des pages suivantes en fonction de la cote que je choisis: ParisV1.php, ParisV2.php, ParisN.php 
?>

            <div class="col-md-4">
              <div class="card mb-4 box-shadow" >
                <img class="card-img-top"  style="height: 225px; width: 100%; display: block;" src="/Projet/photo/AfficheMatch.jpeg" >                
                <div class="card-body">
                    <div class="d-flex text-center">
                        <p class="col-sm"><?= $MatchNB[$i]['Equipe1']?></p>
                        <p class="col-sm">VS</p>
                        <p class="col-sm"><?= $MatchNB[$i]['Equipe2']?></p>
                    </div>
                    <form method="GET">
                    <div class="row" >
                        <p >Mise : </p>
                        <div class="d-flex"> 
                        <input  type="number" id="somme" name="somme" value="<?= $mise ?>">
                        <input type="hidden" name="idMatch" value="<?= $MatchNB[$i]['idMatch'] ?>">
                        <input  type="submit"  value="€ valider">
                        </div>
                        <p style="padding-top:10px"> Puis choisir la cote :  </p>
                    </div>
                    <div class="d-flex justify-content-center">
                      <button type="button" onclick="myFunction(1);"  class="btn col-sm btn-outline-dark"> Victoire <?= $MatchNB[$i]['Equipe1']?> : <?= $MatchNB[$i]['V1']?></button>
                      <button type="button" onclick="myFunction(3);"  class="btn col-sm btn-outline-dark">Nul : <?= $MatchNB[$i]['N']?></button>
                      <button type="button" onclick="myFunction(2);"  class="btn col-sm btn-outline-dark">Victoire <?= $MatchNB[$i]['Equipe2']?> : <?= $MatchNB[$i]['V2']?></button>
                    </div>
                    </form>
                    
                    
                </div>
              </div>
            </div>
<?php 
}
?>
          </div>
        </div>
        </div>
            
    </main>

</body>
