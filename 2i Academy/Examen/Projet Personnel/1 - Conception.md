# Phase 1 : Spécification Initiale – Définir le "Quoi" et le "Pourquoi"﻿

## Exercice 1.1 : Le Pitch Élévateur (Elevator Pitch)﻿

Pour les sportifs débutants souhaitant optimiser leurs séances, ou les professionnels qui souhaitent tracker leurs performances (NOM) offre une nouvelle façon de faire du sport. Vous êtes un aventurier dans l'âme ? Lancez une séance libre, et ajoutez les exercices effectués en un instant grâce aux QR codes présents sur chaque machine. Vous êtes plannificateur et méthodique ? Programmez vos routines, séances et exercices, et ne ratez plus jamais une séance grâce à nos rappels et notre implémentation Pas à Pas dans votre montre connectée. Visualisez ensuite vos performances dans le temps et comparez les à celles de vos amis grâce à nos comptes-rendus statistiques.

## Exercice 1.2 : Les Personas Utilisateurs

### 🧑‍🎓 **Léo, 24 ans, étudiant en design d’intérieur**

- **Objectif** : Suivre un programme de remise en forme sans se prendre la tête.
- **Frustration** : Ne sait pas par où commencer, et n’a pas envie de réfléchir à quoi faire à chaque séance.
- **Compétence tech** : Bonne, mais pas passionné par les apps de sport trop compliquées.
- **Citation** : _"J’ai juste besoin qu’on me dise quoi faire, et que je puisse suivre ça facilement sans me poser 36 questions."_

---

### 🧔 **Olivier, 35 ans, chef de projet IT**

- **Objectif** : Optimiser le suivi de ses performances et garder une trace claire de sa progression.
- **Frustration** : Passe trop de temps à noter manuellement ses séances, perd parfois des données.
- **Compétence tech** : Excellente. Utilise déjà des outils, mais veut plus de fluidité.
- **Citation** : _"J’ai déjà mes routines, mais si je pouvais tout enregistrer en un scan rapide, ce serait parfait."_

---

### 🏋️ **Nora, 41 ans, coach sportive indépendante**

- **Objectif** : Disposer de données fiables et détaillées pour analyser ses propres entraînements et ajuster ses coachings.
- **Frustration** : Les outils existants sont trop généralistes ou pas assez précis dans les mesures.
- **Compétence tech** : Très bonne, équipée de montre connectée, appli de tracking, etc.
- **Citation** : _"Je veux des stats complètes et exploitables, pas juste des calories brûlées ou des cœurs rouges."_

## Exercice 1.3 : Les Scénarios Utilisateurs (User Stories) pour le MVP﻿

- En tant qu'**invité**, je veux **créer un compte utilisateur**
- En tant qu'**invité**, je veux **faire une séance d'essai avec compte rendu sans persistence des données**

---

- En tant qu'**utilisateur**, je veux **visualiser mes progrès de manière simple** afin de **voir que mes efforts portent leurs fruits**.
- En tant qu'**utilisateur**, je veux **synchroniser l’app avec ma montre connectée** afin de **voir mes consignes directement pendant l’effort**.

---

### 🧑‍🎓 **Persona 1 : Léo, le débutant qui veut être guidé**

- En tant qu'**utilisateur débutant**, je veux **choisir des programmes préconçus adaptés à mon niveau** afin de **ne pas me sentir perdu au démarrage**.
- En tant qu'**utilisateur débutant**, je veux **démarrer une séance guidée automatiquement** afin de **ne pas réfléchir à l’enchaînement des exercices**.
- En tant que qu'**utilisateur débutant**, je veux **recevoir des rappels pour mes séances** afin de **rester motivé et régulier**.
- En tant que qu'**utilisateur débutant**, je veux **voir une démonstration de chaque exercice** afin de **savoir comment bien l’exécuter**.
- En tant que qu'**utilisateur débutant**, je veux **pouvoir enregistrer ma séance en un clic** afin de **ne pas perdre de temps à remplir un formulaire**.

---

### 🧔 **Persona 2 : Romain, l’utilisateur confirmé pressé**

- En tant que **utilisateur confirmé**, je veux **créer mes propres routines d’entraînement** afin de **reproduire mes séances préférées facilement**.
- En tant que **utilisateur confirmé**, je veux **ajouter des exercices manuellement ou par QR code** afin de **gagner du temps pendant la séance**.
- En tant que **utilisateur confirmé**, je veux **modifier rapidement les charges et les répétitions** afin de **m’adapter sur le moment**.
- En tant que **utilisateur confirmé**, je veux **dupliquer une ancienne séance** afin de **gagner du temps dans la planification**.

---

### 🏋️ **Persona 3 : Nora, la coach professionnelle**

- En tant que **professionnelle**, je veux **suivre mes performances avec précision (charge, durée, repos, données santé)** afin de **pouvoir optimiser mes entraînements**.
- En tant que **professionnelle**, je veux **exporter mes données au format CSV ou PDF** afin de **les analyser en détail ou les partager avec des clients**.
- En tant que **professionnelle**, je veux **configurer des routines avancées avec tempos, circuits et superset** afin de **gérer des entraînements complexes**.
- En tant que **professionnelle**, je veux **créer et tester des programmes personnalisés** afin de **les utiliser ensuite avec mes clients**.
- En tant que **professionnelle**, je veux **avoir accès aux données des comptes de mes clients**.

# Phase 2 : Conception Fonctionnelle – Détailler le "Comment" (Fonctionnel)

## Exercice 2.1 : Diagramme des Cas d'Utilisation (Use Case Diagram)

Voir projet StarUML

## Exercice 2.2 : Maquettes Filaires (Wireframes) des Écrans Principaux

Voir projet Figma

## Exercice 2.3 : Modèle Conceptuel de Données (MCD) ou Diagramme de Classes simplifié

Voir projet StarUML

# Phase 3 : Conception Technique et Architecture – Choisir les Outils et l'Organisation

## Exercice 3.1 : Choix de la Pile Technologique (Tech Stack)

Pour Uplifted, application de Tracking de performances sportives

Front-end : React Native (Application mobile cross-plateforme)
Back-end : Elixir (Originale, connue et robuste)
SGBDR : PostgreSQL (Intégration à Elixir)
ORM : Ecto (intégré à Phoenix)
Versioning : Git / Github
CI/CD : Github Actions

## Exercice 3.2 : Diagramme d'Architecture de Haut Niveau
