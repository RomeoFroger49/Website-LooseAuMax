Pour mac:

try {
    $bdd = new PDO(
        'mysql:host=localhost;dbname=LooseAuMax;charset:utf8',
        'root',
        'root',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

pour windows:

try {
    $bdd = new PDO(
        'mysql:host=localhost;dbname=LooseAuMax;charset:utf8',
        'root',
        '',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );



Créer une nouvelle base de données dans votre Mysql nommé LooseAuMax
puis importer le fichier LooseAuMax.sql

pour commencer veuiller vous connecter en tant qu'admin avec les identifiants suivant: user:"Admin" password:"admin"
créer vous vos propres match et equipe et mettez vos Cote
ensuite vous pouvez vous créer un compte et jouer
pour les matchs en cours vous pouvez les modifier en tant qu'admin
pour rafraichir un match en cours que vous devez cliquer sur l'un des boutons rafrâichir présent sur la page