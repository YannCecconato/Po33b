<?php

//
// Génère un PDF de la liste des voitures
//
include 'init.php';
include 'lib/fpdf/fpdf.php';

// Instanciation du DAO des voitures
$voitureDAO = new VoitureDAO();

$voitures = $voitureDAO->findAll();

// On dérive la classe mère pour définir entête et bas de page
class MON_PDF extends FPDF {

    function Header() {
        // Police Arial gras 15
        $this->SetFont('Arial', 'B', 15);
        // Titre
        $this->Cell(0, 10, 'po32', 'B', 0, 'C');
        // Saut de ligne
        $this->Ln(15);
    }

    function Footer() {
        // Positionnement à 1,5 cm du bas
        $this->SetY(-15);
        // Police Arial italique 8
        $this->SetFont('Arial', 'I', 8);
        // Numéro de page
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 'T', 0, 'C');
    }

}

// Instanciation de l'objet dérivé
$pdf = new MON_PDF();

// Metadonnées
$pdf->SetTitle('Exercice po32', true);
$pdf->SetAuthor('J.F. Ramiara', true);
$pdf->SetSubject('Liste des voitures avec DAO', true);

// Création d'une page
$pdf->AddPage();

// Définit l'alias du nombre de pages {nb}
$pdf->AliasNbPages();

// Titre de page
$pdf->SetFont('Times', '', 24);
$pdf->SetTextColor(0, 51, 255); // Bleu  #0033FF
$pdf->Cell(0, 20, utf8_decode("Liste des voitures avec DAO"), 0, 1, 'C');
$pdf->Ln(8);



// Boucle des lignes
$pdf->SetFont('Times', '', 12);
$pdf->SetTextColor(0, 0, 0); // Noir
foreach ($voitures as $voiture) {
    $id = $voiture->get_id();
    $marque = $voiture->get_marque();
    $modele = $voiture->get_modele();
    $pdf->SetFont('', '');
    $pdf->SetX(20);
    $pdf->Cell(0, 5, utf8_decode($id . ' ' . $marque . ' ' . $modele), 0, 1);
}

// Nb de personnes
$pdf->Ln(8);
$nb = count($voitures);
$pdf->SetFont('', '');
$pdf->Cell(0, 5, utf8_decode($nb . ' voiture(s)'), 0, 1);

// Génération du document PDF
$pdf->Output('outfile/voitures.pdf', 'f');
header('Location: index.php');
