<?php
session_start();
include('./admin/include/connexion.php');
$pdo = connexion();

   include('./admin/include/twig.php');
	$twig = init_twig();
   
	include('./admin/include/page.php');
	include('./admin/include/article.php');
	include('./admin/include/element.php');

   function object_to_array($data) {
		if (is_array($data) || is_object($data)) {
			$result = [];
			foreach ($data as $key => $value) {
				$result[$key] = (is_array($value) || is_object($value)) ? object_to_array($value) : $value;
			}
			return $result;
		}
		return $data;
	}



	$count_pages = Page::readCountPage();
	$count_page = object_to_array($count_pages);

	$pages_readAll = Page::readAll();
   foreach($pages_readAll as $page) {
      $page->articles = Article::readByPage($page->id);
   }
	$articles_readAll = Article::readAll();
	$elements_readAll = Element::readAll();
	$unique_article = Article::readArticleHeader($article_id);
	$unique_page = Page::readPageHeader($page_id);
	$elements_Article_read = Element::readArticle($article_id);
	$articles_page_read = Article::readPage($page_id, $article_id);
   

   $pdo = null;

   switch ($page) {
      case '' :

      break;


      default :
			$view = 'accueil.twig';
			$data = [
				'accueil' => 'active',
				'articles' => $articles_readAll,
				'pages' => $pages_readAll,
				'contenu_page' => $articles_page_read,
			];
	}

	echo $twig->render($view, $data);

if(isset($_POST['formconnexion'])) {
    $mailconnect = htmlspecialchars($_POST['mailconnect']);
    $mdpconnect = sha1($_POST['mdpconnect']);
    if(!empty($mailconnect) AND !empty($mdpconnect)) {
        $pdo = connexion();
       $requser = $pdo->prepare("SELECT * FROM membres WHERE mail = ? AND motdepasse = ?");
       $requser->execute(array($mailconnect, $mdpconnect));
       $userexist = $requser->rowCount();
       if($userexist == 1) {
          $userinfo = $requser->fetch();
          $_SESSION['id'] = $userinfo['id'];
          $_SESSION['pseudo'] = $userinfo['pseudo'];
          $_SESSION['mail'] = $userinfo['mail'];
          header("Location: admin/index.php");
       } else {
          $erreur = "Mauvais mail ou mot de passe !";
       }
    } else {
       $erreur = "Tous les champs doivent être complétés !";
    }
 }



?>
<!--<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div align="center">
        <h2>Connexion</h2>
        <br /><br />
        <form method="POST" action="">
            <input type="email" name="mailconnect" placeholder="Mail" />
            <input type="password" name="mdpconnect" placeholder="Mot de passe" />
            <br /><br />
            <input type="submit" name="formconnexion" value="Se connecter !" />
        </form>
        <?php
    //     if(isset($erreur)) {
      //      echo '<font color="red">'.$erreur."</font>";
        // }
         ?>
    </div>



</body>

</html>-->