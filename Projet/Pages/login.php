<?php
require_once("header.php");
// ? vérifie si l'utilisateur a remplie le formulaire de connexion
if (isset($_POST['username']) && $_POST['username']!= " " && isset($_POST['mdp']) && $_POST['mdp']!= " ") {
  $UserObj = $bdd->prepare('SELECT Username,Mot_de_passe,id,Nom,Prenom,AdresseMail,Admin,Argent FROM Utilisateur WHERE Username=?');
  $UserObj->execute([$_POST['username']]);
  $User=$UserObj->fetch();
  if ($User) {
    if(($_POST['mdp']) == $User['Mot_de_passe']){[
      $_SESSION['mdp'] = md5($User['Mot_de_passe']),
      $_SESSION['username'] = $User['Username'],
      $_SESSION['nom'] = $User['Nom'],
      $_SESSION['prenom'] = $User['Prenom'],
      $_SESSION['AdresseMail'] = $User['AdresseMail'],
      $_SESSION['id'] = $User['id'],
      $_SESSION['admin'] = $User['Admin'],
      $_SESSION['argent'] = $User['Argent']
    ];
    header('Location:index.php');die;
    }
  }

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


                    <div class="text-center pt-1 mb-5 pb-1">
                    <input type="submit" value="Connexion" class="btn btn-dark btn-block fa-lg mb-3" >
                    </div>

                    <div class="d-flex align-items-center justify-content-center pb-4">
                      <p class="mb-0 me-2">Don't have an account?</p>
                      <button type="button" onclick="window.location.href='create.php'" class="btn btn-outline-dark">Create new</button>
                    </div>

                    <button type="button" class="btn btn-outline-dark" onclick="window.location.href = 'index.php';" style="margin-top:15px;">🏠 Home</button>

                  </form>

                </div>
              </div>
              <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
