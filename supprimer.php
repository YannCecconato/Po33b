<?php
include 'init.php';
// Instanciation des DAO
$voitureDAO = new VoitureDAO();
// Récupère l'ID dans l'URL ou à défaut dans le formulaire
$id = null;
$id = isset($_GET['id']) ? $_GET['id'] : $_POST['id'];
$submit = isset($_POST['submit']);

if ($submit) {
    // Formulaire soumi
    // Récupère les données du formulaire
    $marque = isset($_POST['marque']) ? $_POST['marque'] : '';
    $modele = isset($_POST['modele']) ? $_POST['modele'] : '';
    // NOTA : underscore interdits dans les id, class et name HTML
    $voiture = new Voiture(array(
        'id' => $id,
        'marque' => $marque,
        'modele' => $modele
    ));
    // Modifie l'enregistrement dans la BD
    $nb = $voitureDAO->delete($voiture);
    header('Location: index.php');
} else {
    // Formulaire non soumi
    // Récupère la voiture à modifier
    $voiture = $voitureDAO->find($id);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>classe_metier</title>
        <link rel="stylesheet" type="text/css" href="css/styles.css" />
    </head>
    <body>
        <h1>po33 - DAO avec voitures et Mise à jour</h1>
        <h2>Supprimer une voiture</h2>
        <form action = "#" method = "post">
            <p>Marque<br/><input type = "text" name = "marque" disabled value = "<?php echo $voiture->get_marque() ?>" /></p>
            <p>Modèle<br/><input type = "text" name = "modele" disabled value = "<?php echo $voiture->get_modele() ?>" /></p>
            <p><input type = "hidden" name = "id" value = "<?php echo $voiture->get_id(); ?>" /></p>
            <br/>
            <p><input type="submit" name="submit" value="Supprimer"></p>
        </form>
        <br/>
        <p>Retourner à la <a href="page2.php" >page d'accueil</a></p>
    </body>
</html>