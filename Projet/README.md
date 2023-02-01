DEFAITEAUMAX structure:

-navbar:
    -Logo raccourci index
    -raccourci pour profil/Paris/page de (de)connexion
    -uniquement pour l'admin lien page admin

-page d'acceuil:
    -paris visible avec côte
    -panel{  
        *côte relié à la table(win/draw/loose)
        *match
    }


-page de connexion:
    -nouveau compte(page supplémentaire)
    -connexion


-page de mes paris:
    -Paris en cours
    -paris finie (gain)

-page Paris (accessible uniquement pour parier):
    -côtes
    -choix de la mise
    -choix du résultat (uniquement V/N/D)

-page admin:
    -mise à jour des match
    -mise a jour des equipe
    -mise a jour des paris

    
-page profil:
    -Identifiants
    -Compte argent
    -Historique Paris


-page fermer session:
    -"deconnexion" -> session_destroy




    
        
fait:
    -interface utilisateur(login/logout/create)
    -css(almost)
    -insert table equipe
    -relié utilisateur avec Match via paris



point réussi : 
    -sécurité
    -impossible d'accéder aux pages importantes via l'url ou alors affiche la page pour les non connectés
    -empêche le duplicata de mdp
    -compare et renseigne les mdp sous forme md5 pour éviter d'etre renseigne du mdp via injection sql
    -boucle pour afficher les matchs en fonction du nombre tout en respectant le css pour l'affichage
    -boucle pour afficher les paris en fonction du nombre tout en respectant le css pour l'affichage
    -actualisation en direct pour la victoire/defaite/egalité et mise a jour du compte(argent)


point a améliorer:
    -css/bootstrap
    -page admin
    -ecriture du code trop brouillon pas assez organisé

difficulté:
    -système de mise a jour en direct
    -ne pas avoir de doublon pour les username
    -validation des paris pour savoir si c'est une win ou une loose ou une égalité