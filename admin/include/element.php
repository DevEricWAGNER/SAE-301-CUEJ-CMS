<?php

class Element {

    public $id;
    public $balise;
    public $content;
    public $classCSS;
    public $img_alt;
    public $img_src;
    public $position;

    static function readAll() {
        $sql= 'SELECT * FROM element';
        $pdo = connexion();
        $query = $pdo->prepare($sql);
        $query->execute();
        $tableau = $query->fetchAll(PDO::FETCH_CLASS,'Element');
        return $tableau;
    }

    function modifier($b, $c, $css, $i_a, $i_s, $p) {
        $this->balise = $b;
        $this->content = $c;
        $this->classCSS = $css;
        $this->img_alt = $i_a;
        $this->img_src = $i_s;
        $this->position = $p;
    }

    function chargePOST() {
        if (isset($_POST['balise'])) {
          $this->balise = $_POST['balise'];
        } else {
          $this->balise = '';
        }
        if (isset($_POST['content'])) {
          $this->content = $_POST['content'];
        } else {
          $this->content = '';
        }
        if (isset($_POST['classCSS'])) {
          $this->classCSS = $_POST['classCSS'];
        } else {
          $this->classCSS = '';
        }
        if (isset($_POST['alt'])) {
          $this->img_alt = $_POST['alt'];
        } else {
          $this->img_alt = '';
        }
        if (isset($_POST['src'])) {
          $this->img_src = $_POST['src'];
        } else {
          $this->img_src = '';
        }
        if (isset($_POST['position'])) {
          $this->position = $_POST['position'];
        } else {
          $this->position = '';
        }
        if (isset($_POST['article'])) {
          $this->article = $_POST['article'];
        } else {
          $this->article = '';
        }
      }
    function chargePOST_balise($balise) {
        if (isset($balise)) {
          $this->balise = $balise;
        } else {
          $this->balise = '';
        }
        if (isset($_POST['content'])) {
          $chaine = $_POST['content'];
          $chainemodifie_inter = str_replace(' ?',' ?',$chaine);
          $chainemodifie_excla = str_replace(' !',' !',$chainemodifie_inter);
          $chainemodifie_guillemet_ouvre = str_replace('« ','« ',$chainemodifie_excla);
          $chainemodifie_guillemet_ferme = str_replace(' »',' »',$chainemodifie_guillemet_ouvre);
          $chainemodifie_double_point = str_replace(' :',' :',$chainemodifie_guillemet_ferme);
          $chainemodifie_finale = str_replace(' %',' %',$chainemodifie_double_point);
          $this->content = $chainemodifie_finale;
        } else {
          $this->content = '';
        }
        if (isset($_POST['classCSS'])) {
          $this->classCSS = $_POST['classCSS'];
        } else {
          $this->classCSS = '';
        }
        if (isset($_POST['alt'])) {
          $this->img_alt = $_POST['alt'];
        } else {
          $this->img_alt = '';
        }
        if (isset($_POST['src'])) {
          $this->img_src = $_POST['src'];
        } else {
          $this->img_src = '';
        }
        if (isset($_POST['position'])) {
          $this->position = $_POST['position'];
        } else {
          $this->position = '';
        }
        if (isset($_POST['article'])) {
          $this->article = $_POST['article'];
        } else {
          $this->article = '';
        }
        if (isset($_POST['liaison'])) {
          $this->liaison = $_POST['liaison'];
        } else {
          $this->liaison = '';
        }
      }

      function create() {
        $sql = 'INSERT INTO `element` (`balise`, `classCSS`, `content`, `img_alt`, `img_src`, `position`, `article`, `liaison`) VALUES (:balise, :classCSS, :content, :img_alt, :img_src, :position, :article, :liaison);';
        $pdo = connexion();
        $query = $pdo->prepare($sql);
        $query->bindValue(':balise', $this->balise, PDO::PARAM_STR);
        $query->bindValue(':classCSS', $this->classCSS, PDO::PARAM_STR);
        $query->bindValue(':content', $this->content, PDO::PARAM_STR);
        $query->bindValue(':img_alt', $this->img_alt, PDO::PARAM_STR);
        $query->bindValue(':img_src', $this->img_src, PDO::PARAM_STR);
        $query->bindValue(':position', $this->position, PDO::PARAM_STR);
        $query->bindValue(':article', $this->article, PDO::PARAM_STR);
        $query->bindValue(':liaison', $this->liaison, PDO::PARAM_STR);
        $query->execute();
        $this->id = $pdo->lastInsertId();
      }

      function delete($id) {
        $sql = "DELETE FROM element WHERE id = :id";
        $pdo = connexion();
        $query = $pdo->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_STR);
        $query->execute();
      }


      static function readArticle($id) {
        $sql= 'SELECT * FROM element WHERE element.article = :article_id ORDER BY position';
        $pdo = connexion();
        $query = $pdo->prepare($sql);
        $query->bindValue(':article_id', $id, PDO::PARAM_INT);
        $query->execute();
        $tableau = $query->fetchAll(PDO::FETCH_CLASS,'Element');
        return $tableau;
    }

    static function readOne($id) {
      $sql = "SELECT article.article_name, article.id AS 'article_id', element.* FROM element INNER JOIN article ON element.article = article.id WHERE element.id = :element_id";
      $pdo = connexion();
      $query = $pdo->prepare($sql);
      $query->bindValue(':element_id', $id, PDO::PARAM_STR);
      $query->execute();
      $tableau = $query->fetchAll(PDO::FETCH_CLASS, 'Element');
      return $tableau;
    }

    function update($id) {
      $sql = 'UPDATE element SET content = :content WHERE id = :id;';
      $pdo = connexion();
      $query = $pdo->prepare($sql);
      $query->bindValue(':id', $id, PDO::PARAM_INT);
      $query->bindValue(':content', $this->content, PDO::PARAM_STR);
      $query->execute();
    }
}

?>