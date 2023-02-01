<?php
require_once("header.php");
require_once("navbar.php");

 // ! recupérer les données du formulaire puis les injecter dans la base de donnés et changer info de session
 // ! faire du cas par cas car pas obliger de renseigner chaque form

if(isset($_POST['mdp']) && md5($_POST['mdp']) == $_SESSION['mdp']){
    $ObjUser= $bdd->prepare("UPDATE Utilisateur SET Prenom= :prenom WHERE id= :id");
    $ObjUser->execute([
        'prenom' => $_POST['prenom'],
        'id' => $_SESSION['id']
    ]);
    $_SESSION['prenom'] = $_POST['prenom'];

    $ObjUser= $bdd->prepare("UPDATE Utilisateur SET Nom= :nom WHERE id= :id");
    $ObjUser->execute([
        'nom' => $_POST['nom'],
        'id' => $_SESSION['id']
    ]);
    $_SESSION['nom'] = $_POST['nom'];

    $ObjUser= $bdd->prepare("UPDATE Utilisateur SET AdresseMail= :mail WHERE id= :id");
    $ObjUser->execute([
        'mail' => $_POST['mail'],
        'id' => $_SESSION['id']
    ]);
    $_SESSION['AdresseMail'] = $_POST['mail'];

    $info = $bdd->prepare("SELECT Argent FROM Utilisateur WHERE id = :id");
    $info->execute([
        'id' => $_SESSION['id']
    ]);
    $info = $info->fetch();
    $ObjUser = $bdd -> prepare("UPDATE Utilisateur SET Argent= :argent WHERE id= :id");
    $ObjUser->execute([
        'argent' => $info['Argent'] +$_POST['somme'],
        'id' => $_SESSION['id']
    ]);
    $_SESSION['argent'] = $_POST['somme']+ $info['Argent'];
    
    
    header('Location:Profile.php');die;

}


//! formulaire bootstrap préremplie pour la modification plus aisé 
?>
<body style="background-color:RGB(6,21,57)">
        <div class="container py-5 h-100"style="padding:15%;">
            <div action="" class="card p-4" style="border-radius: 1rem;margin-top:4cm" > 
                <form method="POST">
                    <button type="button" class="btn btn-outline-dark" onclick="window.location.href = 'Profile.php';" style="margin-top:15px;">◁ Retour</button>
                    <div class="form-group" style="margin-top:15px">
                        <label for="exampleInputName1">Prenom</label>
                        <input  class="form-control"  name="prenom" value="<?=$_SESSION["prenom"]?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputName1">Nom</label>
                        <input  class="form-control"  name="nom" value="<?=$_SESSION["nom"]?>">
                    </div>
                    <div class="form-group">
                    <label for="exampleInputEmail1">Adresse mail</label>
                        <input  class="form-control"  name="mail" value="<?=$_SESSION["AdresseMail"]?>">
                    </div>
                    <div class="form-group">
                    <label for="exampleInputEmail1">Somme argent à ajouter</label>
                        <input type="number" class="form-control" name="somme" value="<?=$_SESSION["argent"]?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Entrer votre mot de passe pour confirmer :</label>
                        <input type="password" class="form-control" name="mdp" >    
                    </div>
                    <button type="submit" class="btn btn-primary" style="margin-top:15px;background-color:RGB(34,37,41);border-color:RGB(34,37,41)">Confirmer</button>
                </form>
            </div>
        </div>


</body>

