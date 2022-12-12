<?php

    class Liaisons {
        public $id;
        public $element;
        public $text;

        static function readAll() {
            $sql= 'SELECT * FROM liaisons_entre_element';
            $pdo = connexion();
            $query = $pdo->prepare($sql);
            $query->execute();
            $tableau = $query->fetchAll(PDO::FETCH_CLASS,'Liaisons');
            return $tableau;
        }

        static function readOne($id) {
            $sql = "SELECT * FROM liaisons_entre_element WHERE id = :id";
            $pdo = connexion();
            $query = $pdo->prepare($sql);
            $query->bindValue(':id', $id, PDO::PARAM_STR);
            $query->execute();
            $tableau = $query->fetchObject('Liaisons');
            return $tableau;
        }
        
        static function readLiaison($element) {
            $sql = "SELECT * FROM liaisons_entre_element WHERE element = :element";
            $pdo = connexion();
            $query = $pdo->prepare($sql);
            $query->bindValue(':element', $element, PDO::PARAM_STR);
            $query->execute();
            $tableau = $query->fetchObject('Liaisons');
            return $tableau;    
        }

        static function readLiaisonsNotAlone($id, $liaison) {
            $sql = "SELECT * FROM element WHERE liaison = :liaison AND article = :id AND lier_a = 0";
            $pdo = connexion();
            $query = $pdo->prepare($sql);
            $query->bindValue(':liaison', $liaison, PDO::PARAM_STR);
            $query->bindValue(':id', $id, PDO::PARAM_STR);
            $query->execute();
            $tableau = $query->fetchAll(PDO::FETCH_CLASS, 'Liaisons');
            return $tableau;
        }

        static function readCountElement($id, $liaison) {
            $sql = "SELECT COUNT(*) AS 'count_element' FROM element WHERE liaison = :liaison AND article = :id AND lier_a = 0";
            $pdo = connexion();
            $query = $pdo->prepare($sql);
            $query->bindValue(':liaison', $liaison, PDO::PARAM_STR);
            $query->bindValue(':id', $id, PDO::PARAM_STR);
            $query->execute();
            $tableau = $query->fetchAll(PDO::FETCH_CLASS, 'Liaisons');
            return $tableau;
          }

          function update($element1, $element2) {
            $sql = 'UPDATE element SET lier_a = :lier_a WHERE id = :id;';
            $pdo = connexion();
            $query = $pdo->prepare($sql);
            $query->bindValue(':lier_a', $element1, PDO::PARAM_INT);
            $query->bindValue(':id', $element2, PDO::PARAM_STR);
            $query->execute();
          }
    }

?>