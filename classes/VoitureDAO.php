<?php

/**
* Classe DAO VoitureDAO
*
* @author jef
*/
class VoitureDAO extends DAO {
    
    /**
    * Constructeur
    */
    function __construct() {
        parent::__construct();
    }
    
    /**
    * Lecture d'une voiture par son ID
    * @param type $id_voiture
    * @return \Voiture
    * @throws Exception
    */
    function find($id_voiture) {
        $sql = "SELECT * FROM voiture WHERE id=:id_voiture";
        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute(array(":id_voiture" => $id_voiture));
            $row = $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        $voiture = new Voiture($row);
        // Retourne l'objet métier
        return $voiture;
    }
    
    // function find()
    
    /**
    * Lecture de toutes les voitures
    * @return array
    * @throws Exception
    */
    function findAll() {
        $sql = "SELECT * FROM voiture";
        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute();
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        $voitures = array();
        foreach ($rows as $row) {
            $voitures[] = new Voiture($row);
        }
        // Retourne un tableau d'objets "voiture"
        return $voitures;
    }
    
    // function findAll()

    function insert(Voiture $voiture) {
        $sql = "INSERT INTO voiture (marque, modele) ";
        $sql .="VALUES (:marque, :modele)";
        $params = array(
        ":marque" => $voiture->get_marque(),
        ":modele" => $voiture->get_modele()
        );
        $sth = $this->executer($sql, $params); // On passe par la méthode de la classe mère
        $nb = $sth->rowcount();
        return $nb; // Retourne le nombre de mise à jour
        }
    
    function update(Voiture $voiture) {
        $sql = "UPDATE voiture SET marque=:marque, modele=:modele WHERE id=:id_voiture";
        $params = array(
            ":id_voiture" => $voiture->get_id(),
            ":marque" => $voiture->get_marque(),
            ":modele" => $voiture->get_modele()
        );
        $sth = $this->executer($sql, $params); // On passe par la méthode de la classe mère
        $nb = $sth->rowcount();
        return $nb;
    }
    
    function delete($voiture) {
        $sql = "DELETE FROM voiture WHERE id=:id";
        $params = array(
            ":id" => $voiture->get_id()
        );
        $sth = $this->executer($sql, $params); // On passe par la méthode de la classe mère
        $nb = $sth->rowcount();
        return $nb; // Retourne le nombre de mise à jour
    }
    
}

// Class VoitureDAO