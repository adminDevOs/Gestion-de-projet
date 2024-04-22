<?php
class Evenement {
    private $nom;
    private $date;
    private $lieu;
    private $participants = array();

    public function __construct($nom, $date, $lieu) {
        $this->nom = $nom;
        $this->date = $date;
        $this->lieu = $lieu;
    }

    public function ajouterParticipant($participant) {
        $this->participants[] = $participant;
    }

    public function listerParticipants() {
        return $this->participants;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getDate() {
        return $this->date;
    }

    public function getLieu() {
        return $this->lieu;
    }
}

class Billet {
    private $evenement;
    private $participant;

    public function __construct($evenement, $participant) {
        $this->evenement = $evenement;
        $this->participant = $participant;
    }

    public function getParticipant() {
        return $this->participant;
    }
}

class Participant {
    private $nom;
    private $email;

    public function __construct($nom, $email) {
        $this->nom = $nom;
        $this->email = $email;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getEmail() {
        return $this->email;
    }
}

// Définition d'un tableau d'objets représentant des événements
$evenements = array(
    new Evenement("Conférence sur l'Intelligence Artificielle", "2024-05-15", "Centre des Congrès"),
    new Evenement("Concert Symphonique", "2024-06-20", "Salle de Concert Principal"),
    new Evenement("Conférence sur le système DevOps", "2024-05-15", "Centre des Congrès"),
    new Evenement("Concert des Étoiles", "2024-07-10", "Galaxie Nova"),
);

// Ajout des participants
$participants = array(
    new Participant("Makhlouf Abdelkader", "makhlouf@example.com"),
    new Participant("Michel Balamin", "michel@example.com"),
    new Participant("Sylvie Marchand", "sylvie@example.com"),
);

foreach ($participants as $participant) {
    $evenements[0]->ajouterParticipant($participant);
}

// Interface procédurale

function creerEvenement() {
    global $evenements;
    $nom = readline("Nom de l'événement : ");
    $date = readline("Date de l'événement (YYYY-MM-DD) : ");
    $lieu = readline("Lieu de l'événement : ");
    $evenement = new Evenement($nom, $date, $lieu);
    $evenements[] = $evenement;
    echo "Événement créé avec succès.\n";
}

function supprimerEvenement() {
    global $evenements;
    if (empty($evenements)) {
        echo "Aucun événement disponible.\n";
        return;
    }
    echo "Choisissez un événement à supprimer :\n";
    foreach ($evenements as $key => $evenement) {
        echo ($key + 1) . ". " . $evenement->getNom() . " (" . $evenement->getDate() . ") - Lieu: " . $evenement->getLieu() . "\n";
    }
    $choix = intval(readline("Votre choix : "));
    if ($choix < 1 || $choix > count($evenements)) {
        echo "Choix invalide.\n";
        return;
    }
    unset($evenements[$choix - 1]);
    echo "Événement supprimé avec succès.\n";
}

function afficherTableauEvenements() {
    global $evenements;
    if (empty($evenements)) {
        echo "Aucun événement disponible.\n";
        return;
    }
    echo "Tableau des événements :\n";
    echo "+---------------------------------------------+\n";
    echo "|   Nom            |   Date       |   Lieu    |\n";
    echo "+---------------------------------------------+\n";
    foreach ($evenements as $evenement) {
        printf("|   %-15s |   %-10s |   %-10s |\n", $evenement->getNom(), $evenement->getDate(), $evenement->getLieu());
    }
    echo "+---------------------------------------------+\n";
}

function voirTousEvenements() {
    global $evenements;
    if (empty($evenements)) {
        echo "Aucun événement disponible.\n";
        return;
    }
    echo "Liste des événements :\n";
    foreach ($evenements as $key => $evenement) {
        echo ($key + 1) . ". " . $evenement->getNom() . " (" . $evenement->getDate() . ") - Lieu: " . $evenement->getLieu() . "\n";
    }
}

// Exécutez les fonctions ici
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des événements</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        form {
            margin-bottom: 20px;
        }
        input[type="text"],
        input[type="date"] {
            width: calc(100% - 16px);
            padding: 8px;
            margin: 8px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            width: calc(100% - 16px);
            padding: 10px;
            margin: 8px;
            border: none;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gestion des événements</h1>
        <?php afficherTableauEvenements(); ?>
        
        <form action="" method="post">
            <label for="nom">Nom de l'événement :</label>
            <input type="text" id="nom" name="nom" required><br>
            <label for="date">Date de l'événement :</label>
            <input type="date" id="date" name="date" required><br>
            <label for="lieu">Lieu de l'événement :</label>
            <input type="text" id="lieu" name="lieu" required><br>
            <input type="submit" value="Créer un événement">
        </form>

        <form action="" method="post">
            <label for="supprimer">Supprimer un événement :</label>
            <select id="supprimer" name="supprimer">
                <?php foreach ($evenements as $key => $evenement) : ?>
                <option value="<?php echo $key; ?>"><?php echo $evenement->getNom(); ?> (<?php echo $evenement->getDate(); ?>) - Lieu: <?php echo $evenement->getLieu(); ?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit" value="Supprimer">
        </form>
    </div>
</body>
</html>
