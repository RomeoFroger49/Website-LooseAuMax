<?php
require_once("header.php");

$Match = $bdd->prepare("SELECT p.Somme as somme, m.CoteV2 as V1 FROM Matchs m INNER JOIN Paris p ON m.MatchID = p.MatchID where p.ParisID = ?");
$Match->execute([($_SESSION['ParisID'])]);
$MatchNB = $Match->fetchAll();
if($MatchNB[0]['gain'] == 0){
    $somme = $MatchNB[0]['somme'];
    $V1 = $MatchNB[0]['V1'];
    
    $Paris = $bdd->prepare("UPDATE Paris SET Gain = :gain, EquipeMise = :equipe WHERE ParisID = :matchid");
    $Paris->execute([
        'gain' => ($V1* $somme),
        'equipe' => 'V2',
        'matchid' => $_SESSION['ParisID']
    ]);
    //! on enleve la somme du compte une fois qu'on est sur que le gain est calculé et enregistré
    $_SESSION['argent'] = $_SESSION['argent'] - $_SESSION['somme'];
    $Argent = $bdd-> prepare("UPDATE Utilisateur SET Argent = :argent WHERE id = :id");
    $Argent->execute([
        'argent' => $_SESSION['argent'],
        'id' => $_SESSION['id']
    ]);
}
$_SESSION['idMatch'] = null;
header('Location: Paris.php');

?>