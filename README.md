# Nom du projet

Contacts API

## Installation

1) Configurer le fichier app/Database.php

2) Importer la base de donnée testapi.sql qui se trouve dans le dossier racine

3) Lancer votre serveur apache ou se pointer à la racine et executer la commande :

```
php -S localhost:{port} index.php
```

## Token

```
f2c524e4987f3b19bf8e5204bc4f7622
```

## Contacts

1)  Lister les contacts:

GET /contacts

GET /contacts/{id}

OUTPUT Succeed

{"id":"1","civilite":"Mr","nom":"Anene","prenom":"Saddem","date_naissance":"1991-02-21","date_creation":"2016-11-06 17:05:39","date_modification":"2016-11-06 18:09:01"}

OUTPUT Error

{"success": 0,"message": "Contacts non trouvé"}

2) Inserer contact

POST /contacts?token={token}

OUTPUT Succeed

{"success": 1,"message": "Contact ajouté avec succés","id": "1"}

OUTPUT Error

{"success": 0,"message": "Les champs civilité, nom et prénom sont obligatoire."}

3) Modifier contact

PUT /contacts/{id}?token={token}

OUTPUT Succeed

{"success": 1,"message": "Contact modifié avec succés","id": "1"}

OUTPUT Error

{"success": 0,"message": "Contacts non trouvé"}

4) Supprimer contact

DELETE /contacts/{id}?token={token}

OUTPUT Succeed

{"success": 1,"message": "Contacts 1 Supprimé avec succes"}

OUTPUT Error

{"success": 0,"message": "Contacts non trouvé"}

## Adresses

1)  Lister les adresses:

GET /adresses

GET /adresses/{id}

OUTPUT JSON

{"id":"1","contact_id":"1","rue":"24 Rue de la marsa","code_postal":"1009","ville":"Tunis","date_creation":"2016-11-06 20:48:25","date_modification":"2016-11-06 20:48:25"}

2) Inserer adresse

POST /adresses?token={token}

3) Modifier adresse

PUT /adresses/{id}?token={token}

4) Supprimer adresse

DELETE /adresses/{id}?token={token}


**Les OUTPUT sont pareille pour les adresses

## XML

Pour vusualiser les données en xml il faut préciser le type de contenue avec "content_type=xml" exemple :

GET /adresses?token={token}&content_type=xml

GET /adresses/{id}?token={token}&content_type=xml

GET /contacts/{id}?token={token}&content_type=xml

GET /contacts?token={token}&content_type=xml

## Remarque

Un contact peut avoir plusieur adresse, vous devez selectionner un seul contact pour voir toute ses adresses.


## Architecture

1. index.php -> Fichier racine du projet

2. vendor/autoload.php -> Ce fichier est generé par Composer

3. app/Database.php -> Configuration de la base de donnée et traitement des requêtes

4. app/Api.php -> Traitement des verbes HTTP et encodage

## Tests

Postman (chrome extension)

## License

MIT