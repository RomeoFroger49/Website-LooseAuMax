<?php
require_once("header.php");

$ToutLesMatch = $bdd->query("SELECT Etat,ParisID,UserID FROM Paris");
$ToutLesMatch = $ToutLesMatch->fetchAll();
for($i=0;$i<count($ToutLesMatch);$i++){
    if($ToutLesMatch[$i]['Etat']==0){
        $Match = $bdd -> query("SELECT u.id as id, u.Argent as argent,p.EquipeMise as equipeG,p.Gain as gain,p.MatchID as MatchID, m.Score1 as score1, m.Score2 as score2 FROM Paris p INNER JOIN Matchs m ON m.MatchID=p.MatchID INNER JOIN Utilisateur u ON u.id=p.UserID WHERE p.ParisID = ".$ToutLesMatch[$i]['ParisID']."");
        $Match = $Match->fetchAll();
        if($Match[0]['score1']!=null && $Match[0]['score2']!=null){
            if($Match[0]['equipeG']=='V1'){
                if($Match[0]['score1']>$Match[0]['score2']){
                    $gain=$Match[0]['gain'];
                    $bdd->query("UPDATE Paris SET Verif = 1,Etat = 1,ArgentEnAttente = ".$gain." WHERE ParisID = ".$ToutLesMatch[$i]['ParisID']."");
                    $bdd->query("UPDATE Utilisateur SET Argent = Argent + ".$gain." WHERE id = ".$Match[0]['id']."");
                }else{
                    $bdd->query("UPDATE Paris SET Verif = 0,Etat = 1,ArgentEnAttente= 0 WHERE ParisID = ".$ToutLesMatch[$i]['ParisID']."");
                }
            }
            else if($Match[0]['equipeG']=='V2'){
                if($Match[0]['score1']<$Match[0]['score2']){
                    $gain=$Match[0]['gain'];
                    $bdd->query("UPDATE Paris SET Verif = 1,Etat = 1,ArgentEnAttente = ".$gain." WHERE ParisID = ".$ToutLesMatch[$i]['ParisID']."");
                    $bdd->query("UPDATE Utilisateur SET Argent = Argent + ".$gain." WHERE id = ".$Match[0]['id']."");
                }else{
                    $bdd->query("UPDATE Paris SET Verif = 0,Etat = 1,ArgentEnAttente= 0 WHERE ParisID = ".$ToutLesMatch[$i]['ParisID']."");
                }
            }
            else{
                if($Match[0]['score1']==$Match[0]['score2']){
                    $gain=$Match[0]['gain'];
                    $bdd->query("UPDATE Paris SET Verif = 1,Etat = 1,ArgentEnAttente = ".$gain." WHERE ParisID = ".$ToutLesMatch[$i]['ParisID']."");
                    $bdd->query("UPDATE Utilisateur SET Argent = Argent + ".$gain." WHERE id = ".$Match[0]['id']."");
                }else{
                    $bdd->query("UPDATE Paris SET Verif = 0,Etat = 1,ArgentEnAttente= 0 WHERE ParisID = ".$ToutLesMatch[$i]['ParisID']."");
                }
            }
        }
    }
}
header("Location:Paris.php");die;

?>