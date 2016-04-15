# laravel-cineme-api
[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Dans le cadre du développement de sa nouvelle application mobile destinée au grand public, le Cinéma UGC Nation souhaite exposer ses données et son intelligence métier à travers une API RESTfull sécurisée et entièrement documentée.

Elle pourra être utilisée dans le cadre du développement des applications Android, Iphone, windows phone ainsi que par certaines applications tierces de nos partenaires.

Elle devra exposer, aux applications autorisées les fonctionnalités suivantes :

- Données des films (lecture seule)
- Données des séances (lecture seule)
- Données des réductions (lecture seule)
- Données des utilisateurs (client du cinema), y compris abonnements et historique (lecture seule)
- Service d'abonnement aux différents forfaits proposés


Une application interne sera également branchée à cette API avec un accès privilégié permettant l'accès à des fonctionnalités supplémentaires :

- Gestion des Films (CRUD)
- Gestion des séances (CRUD)
- Gestion des réduction (CRUD)
- Gestion du personnel (CRUD)

En tant que prestataire expert technique et métier nous attendons de vous une approche exhaustive, permettant d'interfacer l'intégralité des données de notre système d'information, ainsi qu'un panel riche de fonctionnalités adaptées au métier du Cinéma, voici quelques exemples (liste non-exhaustive) :

- liste des prochaines séances (films, salles, etc...)
- planning du personnel (par jour, par personne, etc...)
- nombres d'entrées (par jour, par film, par distributeur, par genre, etc...)
- statistiques des abonnements (nombre d'abonnements par forfait, etc...)
