# PCache

PCache est un système de cache en php

# Installation

Téléchargé le git puis glisser le dans votre projet.
Inscriver cela dans votre code (Pour initialiser le PCache)

```php
require "pcache/phpcache.php";
```

(Il est possible de déplacé le fichier n'importe où tant qu'il est bien require)

___IMPORTANT: Verifier les permisions d'écriture du dossier pcache si un message apparait___

# Utilisation

Déclaration d'un nouvelle objet qui est la variable que vous voulez stocker

```php
$ni = new PCache($var_name, $expire_in_second);
```
Ensuite, on vérifie si la variable est dans le cache & qu'elle n'est pas obselette

```php
if($ni->isCache()) {
  //On en utilisé la variable stocké dans le cache
}else{
  //On définie alors la variable du cache par celle que l'on veut
}
```

__Définition d'une variable__

On définie notre variable (objet) en array, int, string etc ...
```php
$ni->setValue($value_in_array_or_string);
```

__Utilisation d'une variable dans le cache__

On prend notre variable (objet) dans le cache
```php
$ni->getValue();
```

# Exemple final

```php
require "pcache/phpcache.php"; // On a besoin de la classe :D

$ni = new PCache("nbr_inscrit", 20); // On travaille sur la variable nbr_inscrit sur un temps d'expiration de 20 secondes

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
```

Bonne chance !
