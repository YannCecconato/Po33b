<?php

/**
 * Classe Voiture
 *
 * @author jef
 */
class Voiture {

  // Attributs
  private $id=0;
  private $marque="???";
  private $modele="???";

  // Constructeur

  function __construct(array $tableau = null) {
    if ($tableau != null) {
      $this->hydrater($tableau);
    }
  }

  // Getter et setter
  
  function get_id() {
    return $this->id;
  }

  function get_marque() {
    return $this->marque;
  }

  function get_modele() {
    return $this->modele;
  }

  function set_id($id) {
    $this->id = $id;
  }

  function set_marque($marque) {
    $this->marque = $marque;
  }

  function set_modele($modele) {
    $this->modele = $modele;
  }
 
  // Retourne la marque et le modèle
  function designation() {
    return $this->marque . " " . $this->modele;
  }

  /**
   * Hydrateur
   * Alimente les propriétés à partir d'un tableau
   * @param array $tableau
   */
  function hydrater(array $tableau) {
    foreach ($tableau as $cle => $valeur) {
      $methode = 'set_' . $cle;
      if (method_exists($this, $methode)) {
        $this->$methode($valeur);
      }
    }
  }

  function afficher() {
    $html = '<ul>';
    $html .= '<li>id=' . $this->get_id() . '</li>';
    $html .= '<li>marque=' . $this->get_marque() . '</li>';
    $html .= '<li>modele=' . $this->get_modele() . '</li>';
    $html .= '</ul>';
    return $html;
  }

}

// Classe Voiture
