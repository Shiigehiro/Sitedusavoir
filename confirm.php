<?php

$id = $_GET['id'];

$token = $_GET['token'];

require './includes/identifiants.php';

$req = $bdd->prepare('SELECT * FROM membres WHERE membre_id = :id');

$req->execute(array('id'=> $id));

$user = $req->fetch();

session_start();

if($user AND $user['token'] == $token)
{
	session_start();

	$_SESSION['flash']['success'] =" votre compte a ete validee,Vous pouvez vous connecter maintenant";

	$req = $bdd->prepare('UPDATE membres SET token = NULL, membre_inscrit = NOW() WHERE membre_id = :id ');

	$req->execute(array('id' => $id));

    header('Location:connexion.php');
}

else
{
	header('Location:connexion.php');

	$_SESSION['flash']['danger'] = "Cet Token n'est plus valide !!";

}