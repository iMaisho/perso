# Docker

Docker est une plateforme logicielle permettant de créer, déployer et exécuter des applications dans des conteneurs.
Les conteneurs sont des fichiers qui encapsulent le code et les dépendances d'une application, garantissant une exécution cohérente dans différents environnements.
Docker utilise des images comme modèles pour créer des conteneurs et le Docker Engine pour les gérer.

Cela permet par exemple, d'envoyer une version de travail de l'application avec ses plugins et outils, leurs versions et leurs paramètres à un collègue sans qu'il n'ai quoi que ce soit à installer ou configurer sur sa machine.

En gros, ça permet de partager son environnement de travail pour pouvoir travailler sur le projet sans avoir à passer par une phase d'installation ou de configuration de sa machine.

Les tests peuvent être exécutés dans des environnements isolés et reproductibles, garantissant que les résultats des tests sont cohérents. On peut également faire des tests risqués, par exemple qui détruisent la base de donnée, en totale isolation. Il suffira de réinstaller le fichier docker pour récupérer une version de travail fonctionnelle.

## Cas d'utilisation :

- Micro services :
    - Isolation des services : Chaque microservice peut être exécuté dans son propre conteneur, avec ses propres dépendances et configurations, facilitant la gestion et le déploiement de microservices.

    - Scalabilité : Les conteneurs peuvent être facilement mis à l'échelle pour répondre à la demande, en démarrant ou arrêtant des instances de conteneurs en fonction des besoins pour chaque micro-service.

- Développement multiplateforme :

    - Vu que Docker intègre une virtualisation allégée de linux, il nous permet d'installer des applications disponibles sur linux seulement sur d'autres machines.
    - Les applications conteneurisées peuvent être exécutées de manière cohérente sur différentes plateformes, y compris les environnements de développement, de test et de production, ainsi que sur différents fournisseurs de cloud.

- Isolation des applications legacy :

    - Les applications anciennes peuvent être conteneurisées pour être isolées des nouvelles applications et des systèmes d'exploitation sous-jacents, facilitant leur gestion et leur migration vers de nouvelles infrastructures.

En résumé : 
- Isolation
- Fiabilité
- Déploiement
- Gain de temps
- Journalisation de la stack technique

## Différences entre virtualisation et conteneur

La virtualisation consiste à un installer un logiciel appelé machine virtuelle qui simule un ordinateur complet, avec ses propres logiciels, son OS et son matériel virtuel (relié au matériel réel pour pouvoir l'utiliser)

C'est très lourd car on simule une machine complète, mais ça a l'avantage d'offrir une meilleure isolation car il n'y a aucun lien avec le système d'exploitation hôte.

La conteneurisation s'appuie sur l'OS hôte pour et ne contient que les éléments importants....

# REVOIR (1h30) POUR CLARIFIER

Avoir un conteneur unique pour l'application serait moins optimisé que d'utiliser une machine virtuelle, mais l'intérêt est de multiplier les conteneurs en simulant un seul micro-service à la fois.

Un conteneur est jetable, on doit pouvoir recréer le conteneur rapidement et sans perte de données

Une image est un fichier qui permet de générer un nouveau conteneur. C'est l'équivalent d'une classe, qui permet d'instancier un objet.

## Persistance des fichiers

Par défaut, tous les fichiers créés à l'intérieur d'un conteneur sont stockés sur une couche de conteneur accessible en écriture. 

Cela signifie que :
- Les données ne persistent pas lorsque le conteneur n'existe plus, et il peut être difficile d'extraire les données du conteneur si un autre processus en a besoin.

- La couche inscriptible d'un conteneur est étroitement liée à la machine hôte sur laquelle le conteneur s'exécute. Il n'est pas facile de déplacer les données ailleurs.

- L'écriture dans la couche inscriptible d'un conteneur nécessite un pilote de stockage pour gérer le système de fichiers. Le pilote de stockage fournit un système de fichiers d'union, en utilisant le noyau Linux. Cette abstraction supplémentaire réduit les performances par rapport à l'utilisation de volumes de données, qui écrivent
directement dans le système de fichiers hôte.

## Les images

Une image est un modèle qui permet à Docker d'instancier un conteneur.

Docker Hub est une plateforme qui permet de trouver ou d'uploader des images, grâce à un simple compte.

Une image est composée de couches successives, qui représentent chacune une instruction. Chacune des couche est mise dans le cache, donc si on génère un conteneur à partir d'une image qui est elle même basée sur une autre image déjà instanciée, son execution sera plus rapide.

Pour créer une image, on part d'une image existante que l'on instancie, puis on modifie ce conteneur et on crée une image à partir de ce conteneur modifié. Toutes les modifications seront ajoutées dans une seule couche de la nouvelle image. Cette méthode n'est pas optimale.

La meilleure méthode est d'utiliser un Dockerfile (attention au D majuscule), dans lequel on inscrit toutes nos instructions, puis on vient créer une image à partir de ce Dockerfile, dans laquelle chacune des instructions seront dans une couche. On peut facilement le partager avec ses collègues.

## Docker Compose

Il s'agit d'un logiciel installé de base sur Docker qui permet de scripter la création de plusieurs conteneurs. Vu qu'on cherche à diviser notre application en micro-services, on cherche à créer un conteneur par service. Cet outil nous permet de les créer en un seul fichier.

Il s'agit d'un fichier texte au format yaml, qui est très lisible car basé sur les indentations.
