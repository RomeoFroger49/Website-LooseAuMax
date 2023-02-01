<?php
require_once("header.php");
//! test la présence d'un mdp non vide et d'un username non vide renseigné
if (isset($_POST['username']) && $_POST['username']!= "" && isset($_POST['mdp']) && $_POST['mdp']!= "" ) {
  //! sécurité qui compare chaque username de la bdd avec celui renseigné pour qu'il n'y ait pas de duplicata 
  $Testobj= $bdd -> query("SELECT Username FROM Utilisateur");  
  $Test = $Testobj->fetchAll();
  $cnt =0;
  for($i =0; $i <count($Test); $i++){
    if($Test[$i]['Username'] != $_POST['username']){
      $cnt +=1;    
  }
  //! si le nombre de pseudo == le compteur cela veut dire que le pseudo renseigné à passer tout les checkups et qu'il n'y a aucun duplicata 
  if($cnt == count($Test)){
    //! on renseigne les info pour la session et la bdd
    $UserObj = $bdd->prepare("INSERT INTO Utilisateur (Username,Prenom, Nom, AdresseMail, Mot_de_passe) VALUES (:username,:prenom, :nom, :mail, :mdp)");
        $UserObj->execute([
          'username' => $_POST['username'],
          'prenom' => $_POST['prenom'],
          'nom' => $_POST['nom'],
          'mail' => $_POST['mail'],
          'mdp' => ($_POST['mdp'])
        ]);
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['prenom'] = $_POST['prenom'];
        $_SESSION['nom'] = $_POST['nom'];
        $_SESSION['AdresseMail'] = $_POST['mail'];
        $_SESSION['mdp'] = md5($_POST['mdp']);
        $_SESSION['argent'] = 0;
        $userObj = $bdd->prepare("SELECT Admin,id FROM Utilisateur WHERE Username = :username");
        $userObj->execute([
          'username' => $_POST['username']
        ]);
        $user = $userObj->fetch();
        if($user){
          $_SESSION['admin'] = $user['Admin'];
          $_SESSION['id'] = $user['id'];
        }
        
        header('Location:index.php');die;
  }
  
}
  header('Location:create.php');die;
}


// ! form bootstrap formulaire de connexion
?>
  <section class="h-100 gradient-form" style="background-color:RGB(6,21,57);">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-xl-10">
          <div class="card rounded-3 text-black" style="border-style: double;border-color:black">
            <div class="row g-0">
              <div class="col-lg-6">
                <div class="card-body p-md-5 mx-md-4">
                  <div class="text-center">
                    <img src="/Projet/photo/photologo.jpeg" style="width: 40px; height:40px" alt="logo">
                    <h4 class="mt-1 mb-5 pb-1">We are DefaiteAuMax</h4>
                  </div>

                  <form action="" method="POST">
                    

                    <div class="form-outline mb-4">
                      <input type="text" id="form2Example11" class="form-control" name="username" placeholder="Identifiant"/>
                    </div>

                    <div class="form-outline mb-4">
                      <input type="password" id="form2Example22" class="form-control"name="mdp" placeholder="Mot de passe" />
                    </div>

                    <div class="form-outline mb-4">
                      <input type="text" id="form2Example11" class="form-control" name="prenom" placeholder="Prenom"/>
                    </div>

                    <div class="form-outline mb-4">
                      <input type="text" id="form2Example11" class="form-control" name="nom" placeholder="Nom"/>
                    </div> 
                    
                    <div class="form-outline mb-4">
                      <input type="text" id="form2Example11" class="form-control" name="mail" placeholder="Mail"/>
                    </div>

                    <div class="text-center pt-1 mb-5 pb-1">
                    <input type="submit" value="Créer" class="btn btn-dark btn-block fa-lg mb-3" >
                    </div>


                    <button type="button" class="btn btn-outline-dark" onclick="window.location.href = 'login.php';" style="margin-top:15px;">◁ Retour</button>


                  </form>

                </div>
              </div>
              <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
