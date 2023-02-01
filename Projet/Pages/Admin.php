<?php 
require_once("header.php");
// !sécurité pour ne pas acceder a la page sans etre connecter en tant qu'admin
  if($_SESSION && $_SESSION["admin"] == 1){
    require_once("navbar.php");

?>
<body style="background-color:RGB(6,21,57) ;">
  <main role="main" ">   
    <div class="album py-5 bg" >
      <div class="container" >
<?php
// ! fomrulaire pour renseigner le score d'un match
    $Match = $bdd->query("SELECT m.Score1 as score1,m.Score2 as score2,m.MatchID as idMatch, L1.Diminutif as Equipe1, L2.Diminutif as Equipe2, m.CoteV1 as V1, m.CoteV2 as V2, m.CoteN as N FROM Matchs m INNER JOIN Ligue1 L1 ON m.Equipe1 = L1.EquipeID INNER JOIN Ligue1 L2 ON m.Equipe2 = L2.EquipeID ");
    $MatchNB = $Match->fetchAll();
    for($i=0; $i < sizeof($MatchNB); $i++){
      if($MatchNB[$i]['score1'] == null && $MatchNB[$i]['score2'] == null){
        if(isset($_GET['Score1']) && $_GET['Score1']!=null && isset($_GET['Score2']) && $_GET['Score2']!=null){
          $Score1 = $_GET['Score1'];
          $Score2 = $_GET['Score2'];
          $idMatch = $_GET['idMatch'];
          $bdd->query("UPDATE Matchs SET Score1 = $Score1, Score2 = $Score2 WHERE MatchID = $idMatch");
          header('Location:Admin.php');
        }

?>
        <div  style="text-align:center;letter-spacing: 3px;color:white;">Renseigner Score</div>
          <div class="card mb-4 box-shadow" >              
              <div class="card-body">
                <div class="d-flex text-center">
                  <p class="col-sm" style="text-align:right"><?= $MatchNB[$i]['Equipe1']?></p>
                  <p class="col-sm">VS</p>
                  <p class="col-sm" style="text-align:left"><?= $MatchNB[$i]['Equipe2']?></p>
                  <form method="GET">
                  <input type="hidden" name="idMatch" value="<?= $MatchNB[$i]['idMatch'] ?>">
                  <div class="d-flex">
                  <p style="padding-right:10px;"> Score :</p>
                  <input type="Number" name="Score1" >
                  <input type="Number" name="Score2" >
                  <button type="submit" class="btn btn-primary" >Valider</button>
                  </form>
                  </div>
                </div>
            </div>
          </div>
<?php
        }
    }
// ! fomrulaire pour créer un nouveau match dans Ligue1
    if(isset($_GET['equipe1']) && isset($_GET['CoteV2']) && isset($_GET['CoteN']) && isset($_GET['equipe2']) && isset($_GET['CoteV1'])){
      $equipe1 = $_GET['equipe1'];
      $equipe2 = $_GET['equipe2'];
      $coteV1 = $_GET['CoteV1'];
      $coteV2 = $_GET['CoteV2'];
      $coteN = $_GET['CoteN'];
      $bdd->query("INSERT INTO Matchs (Equipe1,Equipe2,CoteV1,CoteV2,CoteN) VALUES ($equipe1,$equipe2,$coteV1,$coteV2,$coteN)");
      header('Location:Admin.php');
    }
    
?>

      <div class="container">
            <div action="" class="card p-4" style="border-radius: 1rem;margin-top:4cm" > 
                <form method="GET">
                    <div  style="text-align:center;letter-spacing: 3px;color:Black;font-size:1cm">Nouveau Match</div>
                    <div class="form-group">
                    <label>Choisir equipe 1:</label>
                    <select name="equipe1" id="pet-select">
                        <option value="">--Choisir une equipe--</option>
<?php
// ! affichage des equipes de Ligue1 dans le select
                        $Equipe = $bdd->query("SELECT * FROM Ligue1");
                        $EquipeNB = $Equipe->fetchAll();
                        for($i=0; $i < sizeof($EquipeNB); $i++){
?>
                        <option value="<?= $EquipeNB[$i]['EquipeID']?>"><?= $EquipeNB[$i]['Diminutif']?></option>
<?php
                        }
?>
                    </select>
                    </div>
                    <div class="form-group">
                    <label>Choisir equipe 2:</label>
                    <select name="equipe2" id="pet-select">
                        <option value="">--Choisir une equipe--</option>
<?php
                        $Equipe = $bdd->query("SELECT * FROM Ligue1");
                        $EquipeNB = $Equipe->fetchAll();
                        for($i=0; $i < sizeof($EquipeNB); $i++){
?>
                        <option value="<?= $EquipeNB[$i]['EquipeID']?>"><?= $EquipeNB[$i]['Diminutif']?></option>
<?php
                        }
?>
                    </select>
                    </div>
                    <div class="form-group" style="margin-top:15px">
                        <label for="exampleInputName1">Cote Victoire equipe 1:</label>
                        <input  type="number" class="form-control"  name="CoteV1">
                    </div>
                    <div class="form-group" style="margin-top:15px">
                        <label for="exampleInputName1">Cote Nul:</label>
                        <input  type="number" class="form-control"  name="CoteN">
                    </div>
                    <div class="form-group" style="margin-top:15px">
                        <label for="exampleInputName1">Cote Victoire equipe 2:</label>
                        <input  type="number" class="form-control"  name="CoteV2">
                    </div>
                    <button type="submit" class="btn btn-primary" style="margin-top:15px;background-color:RGB(34,37,41);border-color:RGB(34,37,41)">Créer</button>
                </form>
            </div>
      </div>
<?php
// ! fomrulaire pour créer une nouvelle equipe dans Ligue1
    if(isset($_GET['nomEquipe']) && isset($_GET['surnomEquipe'])){
      $bdd->query("INSERT INTO Ligue1 (Equipe,Diminutif) VALUES ('$_GET[nomEquipe]',UPPER('$_GET[surnomEquipe]'))");
    }
?>
      <div class="container">
      <div action="" class="card p-4" style="border-radius: 1rem;margin-top:4cm" > 
                <form method="GET">
                <div  style="text-align:center;letter-spacing: 3px;color:Black;font-size:1cm">Nouvelle Equipe</div>
                    <div class="form-group" style="margin-top:15px">
                        <label for="exampleInputName1">Nom de l'équipe :</label>
                        <input  type="text" class="form-control"  name="nomEquipe">
                    </div>
                    <div class="form-group" style="margin-top:15px">
                        <label for="exampleInputName1">Surnom :</label>
                        <input  type="text" class="form-control"  name="surnomEquipe">
                    </div>
                    <button type="submit" class="btn btn-primary" style="margin-top:15px;background-color:RGB(34,37,41);border-color:RGB(34,37,41)">Créer</button>
                </form>
            </div>
      </div>
      </div>
  </main>
</body>
<?php
;}else{
    header("Location:index.php");die;
}
?>