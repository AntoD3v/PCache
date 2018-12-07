<?php 

/*

Exemple de l'utilisation du système de cache


*/

require "pcache/phpcache.php";

//              name_cache_var   expire-cache in second
$ni = new PCache("nbr_inscrit", 20);

if($ni->isCache()) {

	//Utilisation du cache 

	echo "Cache use<br>";
	var_dump($ni->getValue());

}else{

	// On met des données dans le cache

	echo "Cache set<br>";

	$ni->setValue(array('hello' => "world", array(""))); // Fonctionne avec ArrayList


	// $ni->setValue("cc"); // Fonctionne avec string

}

?>