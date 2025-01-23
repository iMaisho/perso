# Méthodes de gestion de projet


## Introduction

En fonction de la compléxité d'un projet, il devient vite nécéssaire de mettre en place un garde fou.

L'intérêt de la gestion de projet est de réduire l'incertitude en termes de Temps, de Ressources et de Scope, ou au moins de l'identifier et de la canaliser.

Essayer de garantir les délais et les coûts.


## La méthode historique : Waterfall

Cette méthode en cascade consiste en une succession d'étapes, qui découle chacune de l'étape précédente. A la fin de chaque étape, on doit donner un livrable au client.

### Les différentes phases de cette méthode
#### Phase 1 : Plannification (Quoi ?)

Dans cette phase, en partant de la demande du client on va définir avec lui ses besoins réels pour lui offrir une solution spécifique.

A l'issue de cette phase, **deux livrables** :

- **Spécifications fonctionnelles** : Ce document contient toutes les 
exigences du projet, y compris les besoins fonctionnels (ce que le système doit faire) et non fonctionnels (performance, sécurité, etc.)
Il sert de référence pour toutes les autres phases.

- **Cahier des charges** : Signé par les parties prenantes (client, prestataire et utilisateurs finaux) pour s'assurer que tous les besoins sont correctement compris et pris en compte

#### Phase 2 : Conception (Comment ?)

Durant cette phase, on va faire tous les choix techniques pour notre projet.

- Conception système
    - La stack technique
    - Les structures de données
    - L'architecture globale de la solution
- Conception détaillée
    - Les composants logiciels
    - Le découpage en modules
    - Les patterns utilisés

A l'issue de cette phrase, ***trois livrables*** :

- **Document de conception système** : décrit l'architecture globale du système, comment les différents modules interagiront entre eux, et les choix technologiques.

- **Document de conception détaillée** : présente les spécifications 
détaillées de chaque composant du système, y compris les schémas de 
base de données, les diagrammes d'interface utilisateur, les algorithmes et les flux de données.

- **Maquettes (Wireframes et/ou prototypes)** : Visuels ou prototypes des interfaces utilisateur (UI, IHM) pour valider le design avec le client.

#### Phase 3 : Implémentation

Codage de l'application selon le plan de conception, et mise en oeuvre de l'architecture serveur.

Si on a bien fait notre travail jusqu'à maintenant, on a pu anticiper tout un tas de problématiques, et donc cette partie peut aller bien plus vite.

A l'issue de cette phrase, ***trois livrables*** :

- **Code source :** Le code développé pour chaque module du projet. Ce 
livrable inclut les fonctionnalités programmées telles que définies dans la phase de conception.

- **Documentation technique** : Cette documentation explique comment le code est structuré, comment les développeurs peuvent l’étendre ou le modifier, ainsi que des guides d’installation et d’utilisation du logiciel.

- **Journal des versions (versioning)** : Ce livrable trace l’évolution du développement, avec les versions de chaque module et les changements apportés.

#### Phase 4 : Vérification

- **Tests unitaire** : Test d'une fonction isolée
- **Tests d'intégration** : Test d'une fonction en collaboration avec les autres
- **Tests fonctionnel** : Test de l'application à l'extérieur du code, via l'interface.
- **Tests de comportement (*ou d'acceptance*)** : Vérification que notre produit fini est conforme à ce qui avait été prévu en phase 1. 

A la fin de cette phase, **3 livrables** :

- **Plan de test** : détaille les stratégies de test, y compris les tests unitaires, d'intégration, de système et les tests d'acceptation par l'utilisateur (UAT). Il décrit également les scénarios de test et les critères d’acceptation. Inclus les jeux de données pour les tests
- **Rapports de test** : Résultats des tests effectués sur le système. Ce rapport liste les bugs ou anomalies détectés, les actions correctives,et les résultats finaux après correction.
- **Validation d'acceptation** : document signé par le client ou les utilisateurs finaux confirmant que le système répond aux exigences définies et est prêt pour le déploiement. Généralement donne lieu à une facturation partielle.


#### Phase 5 : Livraison

- Installation de l'architecture technique de production
- Déploiement de la solution
- Formation des utilisateurs

A la fin de cette phase, **4 livrables** :

- **Version déployée du logiciel** : Le logiciel final, compilé et installé sur l'infrastructure de production.
- **Manuel utilisateur** : Un document fournissant des instructions pour utiliser le système, destiné aux utilisateurs finaux.
- **Documentation de formation** : Guides ou supports de formation pour 
accompagner les utilisateurs dans la prise en main du système.
- **Plan de déploiement** : Un document qui décrit les étapes de déploiement,  les dates, et les équipes responsables du déploiement. Il inclut également des informations sur les procédures de sauvegarde et de basculement en cas d'échec ainsi que le plan de migration des données.


#### Phase 6 : Maintenance

- **Maintenance corrective** : Correction des bugs
- **Maintenance préventive** : Optimisation, refactoring, amélioration de la qualité du code
- **Maintenance évolutive** : Nouvelles fonctionnalités
- **Maintenance adaptative** : Mise en conformité avec les nouvelles 
technos, les nouvelles obligations juridiques, les changements 
externes (ex : RGPD, Cloud, passage à la norme SEPA)

Cette phase n'ayant pas vraiment de fin, il n'y a pas nécessairement de livrables. Mais à chaque fois qu'une action importante est menée, on peut proposer **3 livrables** :

- **Journal des incidents et correctifs** : Un document répertoriant tous 
les incidents signalés après le déploiement et les actions correctives 
apportées.
- **Mises à jour logicielles** : Les nouvelles versions du logiciel, corrigées ou améliorées selon les besoins des utilisateurs ou pour résoudre des bugs.
- **Rapports de maintenance** : Rapports périodiques sur les interventions 
effectuées pour la correction des bugs, les mises à jour du système, ou les modifications apportées en réponse aux changements des besoins du client.

### Le diagramme de Gantt

Le temps en abscisse, les tâches en ordonnées. 
Les tâches sont dépendantes les unes des autres
Les tâches sont associées à des ressurces humaines, matérielles, financières..

Le but est de disperser ces tâches sur la durée qui nous est allouée afin de prévoir notre allocation des ressources, et nos besoins.

- Planifier les tâches à exécuter
- Offrir une vue d'ensemble du projet
- Communiquer sur la planification du projet
- Identifier les dépendances entre les tâches
- Suivre l'avancement du projet

https://www.onlinegantt.com/#/gantt

### Avantages 

- Le projet est bien documenté
- Il est possible d'accueillir de nouveaux membres voire de changer l'équipe de dev sans mettre en péril le projet
- Il est facile de suivre l'avancement du projet
- La méthode est très simple, inutile de former les équipes
- Contrôle rigoureux à chaque phase 

### Inconvénients

- Rigidité, il n'est pas prévu de revenir en arrière
- Tests tardifs
- Manque d'interaction avec le client après la première phase
- Pas du tout adapté aux projets évolutifs. On suppose que le client sait ce qu'il veut et que les besoins n'évolueront pas


### Quand l'utiliser ?

- **Clarté des exigences dès le début** : Les projets avec des spécifications claires et stables qui n’évolueront pas 
pendant le développement.
- **Risque de modification limité** : Les projets où il est essentiel de suivre un plan bien défini et où les changements 
imprévus sont coûteux et difficiles à intégrer.
- **Livrables bien définis à chaque phase** : Les projets nécessitant des livrables spécifiques et formalisés à chaque 
étape du cycle de vie.
- **Délais et budgets fixes** : Les projets où le respect des échéances et du budget est critique.
- **Industries ou contextes réglementés** : Les projets soumis à des règles strictes nécessitant une documentation 
formelle à chaque étape.
- **Périmètre connu et maîtrisé**: Les projets "classiques" sur lesquels on peut se baser sur des expériences passées
- **Périmètre restreint** : Les projets de petite ou moyenne importance où les éventuels petits retards seront épongés 
par une surcharge de travail

## Le premier patch à Waterfall : Le cycle en V

Méthode formalisée dans les années 80, pour répondre aux critique de la méthode Waterfall, notamment l'arrivée tardive de la phase de tests.

On fait notre cascade, mais on écrit les tests à chaque étape. Puis, lorsqu'on est arrivé au bout de la réalisation, on exécute nos tests en remontant la cascade.

### Les différentes phases de cette méthode
#### Phase 1 : Le cadrage

**Objectif** : Recueillir les besoins du client ou des utilisateurs finaux  
et les documenter clairement.


**Activités** :
- Réunions avec les parties prenantes pour comprendre les attentes et besoins.
- Rédaction d’un cahier des charges fonctionnel qui décrit ce que le système doit 
accomplir, sans entrer dans les détails techniques.
- Validation des exigences avec le client pour s’assurer que tout est bien compris.
 
**Résultat** : Un document de spécifications des besoins qui servira de référence  pour la suite du projet


#### Phase 2 : Les spécifications fonctionnelles

**Objectif** : Traduire les exigences du client en fonctionnalités détaillées,  exprimant comment le système va répondre aux besoins.

 **Activités** :
- Décomposition des besoins en fonctionnalités précises et mesurables.
- Documentation des interactions entre le système et les utilisateurs (interfaces utilisateur, flux de données).
- Établir des critères d’acceptation pour chaque fonctionnalité (comment tester que chaque besoin est satisfait).

**Résultat** : Un document de spécifications fonctionnelles, définissant les fonctionnalités exactes que le système doit fournir.


#### Phase 3 : La conception globale

**Objectif** : Définir l'architecture globale du système, c’est-à-dire comment les différents composants interagiront entre eux.
 
**Activités** :
- Définir les principales composantes du système (base de données, interfaces, modules fonctionnels).
- Identification des dépendances entre ces composants.
- Choix des technologies, langages de programmation et outils qui seront utilisés.
- Rédaction d’un plan d’architecture avec des schémas et des diagrammes (UML, par exemple).

**Résultat** : Un plan d'architecture générale qui sert de cadre pour le développement détaillé.


#### Phase 4 : La conception détaillée

 **Objectif** : Détailler la conception de chaque composant ou module du système.

 **Activités** :
- Spécification technique de chaque composant (structure des bases de données, algorithmes à utiliser, protocoles de communication).
- Définir les interfaces entre les composants et les méthodes d’intégration.
- Élaboration des diagrammes détaillés (schémas de bases de données, organigrammes, etc.).
- Planification des tests unitaires pour chaque module.

**Résultat** : Un document de conception détaillée qui spécifie comment chaque fonctionnalité sera implémentée techniquement.

#### Phase 5 : La réalisation

**Objectif** : Développer le système selon les spécifications et la conception définies.

**Activités** :
- Codage de chaque composant du système en suivant les instructions de la conception détaillée.
- Développement des interfaces utilisateur et des interactions avec les bases de données.
- Tests unitaires sur chaque composant développé (vérifier que chaque module fonctionne correctement isolément).
- Intégration progressive des composants entre eux (assurer la compatibilité entre les modules).

**Résultat** : Un système complet, mais qui n’a pas encore été entièrement testé dans son ensemble.

#### Phase 6 : Les tests unitaires

**Objectif** : Vérifier que chaque module du système fonctionne individuellement.

**Activités** :
- Exécution de tests automatisés ou manuels pour chaque composant.
- Validation que chaque fonction ou module respecte les spécifications 
techniques définies dans la phase de conception détaillée.
 
**Résultat** : Rapport de test et du taux de couverture

#### Phase 7 : Les tests d'intégration

**Objectif** : Vérifier que les différents modules fonctionnent ensemble correctement après intégration.

**Activités** :
- Tester les interactions entre les modules (communication, échanges de données).
- Identifier et corriger les problèmes d’interfaçage ou d’incompatibilité  
entre les composants.
- Effectuer des tests de performance pour vérifier la stabilité du système intégré.

**Résultat** : Un système global intégré, où les modules interagissent correctement entre eux. Un rapport de test module par module

#### Phase 8 : Les tests de Validation

**Objectif** : Vérifier que le système complet respecte les spécifications fonctionnelles 
définies au début du projet.

**Activités** :
- Exécuter des scénarios de tests basés sur les exigences fonctionnelles  
(vérifier que chaque fonctionnalité définie dans les spécifications  
fonctionne correctement).
- Tester le système dans des conditions proches de la réalité  
(charge de travail, données réelles).
 
**Résultat** : Un système validé relativement aux spécifications fonctionnelles et un rapport de test

#### Phase 9 : Le test d'acceptation

**Objectif** : Valider que le système correspond aux attentes du client  
et aux exigences des utilisateurs finaux.

**Activités** :
- Faire tester le système par le client ou des utilisateurs finaux. Éventuellement exécuter les 
tests de comportement automatisés 
- Valider que les critères d'acceptation définis dans la phase des spécifications des besoins  
sont respectés.
- Identifier d’éventuels ajustements ou corrections de dernière minute  
avant la mise en production.

**Résultat** : Un système accepté par le client et prêt pour la mise en production et un rapport de test

#### Maintenance

**Objectif** : Corriger les défauts éventuels et faire évoluer le système  
en fonction des nouveaux besoins.

**Activités** :
- Maintenance corrective : Correction des bugs découverts après la mise en production.
- Maintenance évolutive : Ajout de nouvelles fonctionnalités en réponse aux nouveaux besoins 
des utilisateurs ou aux évolutions technologiques.
- Maintenance préventive : Optimisation des performances, gestion des risques futurs  
ou mise à jour des technologies.

**Résultat** : Un système stable, évolutif, et maintenu en bon état de fonctionnement tout au 
long de son cycle de vie.

### Avantages

- Traçabilité des exigences
- Gestion des risques grâce aux tests systématiques pour valider chaque étape

### Inconvénients

- Pas beaucoup plus souple que le modèle Waterfall
- Peu adaptable quand les spécifications changent 

### Quand l'utiliser ?

- Projets critiques avec des exigences strictes : Défense, médical, Aérospatial...

- Projets avec des réglementations strictes : Industrie nucléaire, secteurs pharmaceutique ou financier...

- Projets nécessitant une grande traçabilité : Industrie automobile, architecture et génie civil...

- Projets nécessitant des tests rigoureux et une validation formelle : Informatique industrielle, secteur ferroviaire...

## Les premières méthodes itératives

PMI, RUP, MSF, PRINCE2 sont des méthodes qui bouclent. Elles permettent donc de travailler avec plus d'adaptabilité.

**Rational Unified Process** (RUP) est la première méthode qui constate que les étapes n'étaient pas successives, mais parallèlisées. Par exemple, en codant, on fait de la conception et des tests..

Les étapes principales existent toujours, mais au cours de chaque étape on peut intégrer un peu d'autres étapes, car cela peut être pertinent.

Les activités sont réparties tout au long du cycle de vie du projet.
En début de projet, l'analyse, la spécification et la conception sont prédominantes.
En fin de projet, l'accent est mis sur l'implémentation et le déploiement
Les tests sont présents tout au long du cycle de vie


## La méthode moderne : Agile

Même si l'évolution des méthodes de gestion se dirigeaient déjà vers l'agilité dans les années 90, c'est en 2001 qu'est rédigé le **Manifeste Agile**

Il s'agit de l'établissement des **valeurs et principes** qui établissent la philosophie Agile.


**4 valeurs principales** :

>1. **Les individus et leurs interactions plutôt que les processus et les outils.** 
L'importance est donnée aux personnes qui font le travail et à la qualité de leur communication, plutôt qu'à suivre 
strictement des processus prédéfinis ou à se reposer sur des outils.
>2. **Un logiciel fonctionnel plutôt qu’une documentation exhaustive.** 
L'accent est mis sur la création d'un logiciel qui fonctionne réellement, même s'il est partiellement complet, plutôt que sur 
la production de documents détaillés qui décrivent ce que le logiciel devrait faire.
>3. **La collaboration avec les clients plutôt que la négociation de contrats.** 
Il est plus important de travailler en étroite collaboration avec les clients et de comprendre leurs besoins en temps réel 
que de se concentrer sur les termes d'un contrat fixe.
>4. **L'adaptation au changement plutôt que le suivi d’un plan.** 
La flexibilité pour s'adapter aux besoins changeants est privilégiée par rapport à l'adhésion rigide à un plan établi au 
départ, car les besoins évoluent souvent pendant le développement.


Même si les éléments à droite ont de la valeur, nous reconnaissons davantage de valeur dans les éléments à gauche.

**12 principes** :

>- Notre principale priorité est de satisfaire le client en livrant rapidement et 
régulièrement des solutions qui apportent de la valeur.
>- Accueillez chaleureusement les changements de besoins, même tardifs dans le 
développement. Les processus agiles tirent parti du changement pour renforcer 
l’avantage concurrentiel du client.
>- Livrez souvent des solutions opérationnelles, à une fréquence allant de quelques 
semaines à quelques mois, avec une préférence pour les échelles de temps les 
plus courtes.
>- Les personnes en charge du métier ou des affaires et les personnes en charge 
de la réalisation doivent travailler ensemble chaque jour, tout au long du projet.
>- Construisez les projets à partir de personnes motivées.  Donnez-leur l’environnement et le soutien dont elles ont besoin  et faites-leur confiance pour mener à bien le travail.
>- La conversation en face à face est la méthode la plus efficace  et la plus économique pour donner des informations à une équipe de réalisation, et pour échanger des informations à l’intérieur de l’équipe.
>- La disponibilité de solutions opérationnelles est la principale mesure d’avancement.
>- Les processus agiles encouragent à respecter un rythme soutenable lors de la 
réalisation. Les commanditaires, les réalisateurs et les utilisateurs devraient 
pouvoir maintenir indéfiniment un rythme constant
>- Porter continuellement attention à l’excellence technique et à la 
qualité de la conception renforce l’agilité.
>- La simplicité – l’art de maximiser la quantité de travail qu’on ne fait 
pas – est essentielle.
>- Les meilleures architectures, les meilleures spécifications de besoins, 
et les meilleures conceptions émergent d’équipes auto-organisées.
>- À intervalles réguliers, l’équipe réfléchit aux façons de devenir plus 
efficace, puis modifie son comportement et l’ajuste en conséquence.

### Avantages

- **Flexibilité et adaptabilité** : L'un des atouts majeurs de l'agilité est sa capacité à s'adapter rapidement aux 
changements. Les équipes peuvent ajuster leurs priorités et le périmètre du projet en fonction des besoins des clients 
ou des changements du marché.
- **Livraison rapide de la valeur** : L'agilité encourage des cycles de développement courts (itérations ou sprints), 
permettant de livrer des fonctionnalités utiles plus rapidement. Cela permet aux clients de bénéficier plus tôt des 
résultats, même si le produit final n'est pas encore complet.
- **Amélioration continue** : Grâce à des rétrospectives régulières à la fin de chaque sprint, les équipes peuvent identifier 
des axes d'amélioration et ajuster leur manière de travailler en continu. Cela favorise l'apprentissage et l'optimisation 
des processus.
- **Collaboration accrue avec les parties prenantes** : L'agilité met l'accent sur la communication et la collaboration 
fréquentes entre l'équipe de développement et les parties prenantes (clients, utilisateurs finaux, etc.). Cela permet de 
s'assurer que le produit final correspond aux attentes et aux besoins réels.
- **Réduction des risques** : Les itérations fréquentes permettent d'identifier rapidement les problèmes ou les obstacles 
potentiels. Ainsi, les risques sont gérés et atténués au fil du projet, plutôt que d'attendre la fin pour découvrir 
d'éventuels échecs
- **Transparence et visibilité** : Grâce aux revues régulières de produit et aux réunions de suivi, les parties prenantes 
ont une vision claire de l'avancement du projet à chaque étape. Cela améliore la confiance et l'engagement.
- **Engagement et motivation des équipes** : L'agilité favorise l'autonomie des équipes en leur donnant la 
responsabilité de prendre des décisions et de trouver des solutions. Cela peut accroître l'engagement et la 
motivation des membres de l'équipe, en les rendant plus investis dans la réussite du projet.
- **Meilleure gestion des priorités** : Avec l'agilité, les fonctionnalités sont priorisées en fonction de leur valeur pour 
le client ou l'utilisateur final. Cela garantit que l'équipe se concentre d'abord sur les aspects les plus importants 
du projet.
- **Réduction du gaspillage** : En se concentrant sur les livrables essentiels et en évitant les tâches inutiles ou non 
prioritaires, l'agilité permet d'optimiser l'utilisation des ressources et de réduire le gaspillage en temps et en 
effort.
- **Augmentation de la satisfaction des clients** : Grâce à la collaboration étroite et à la livraison rapide de 
fonctionnalités utiles, les clients ont davantage l'impression que leurs besoins sont pris en compte tout au long du 
processus, ce qui améliore leur satisfaction.

### Les limites de ce modèle

- **Manque de structure et de prévisibilité** : Les projets agiles n'ont pas toujours un plan détaillé à 
long terme. Cela peut poser problème pour les projets nécessitant une grande prévisibilité ou une 
planification rigoureuse.
- **Dépendance à la communication et à la collaboration** : L'agilité repose sur des interactions 
fréquentes entre les membres de l'équipe et les parties prenantes. Si la communication est mauvaise 
ou que l'équipe est géographiquement dispersée, cela peut limiter l'efficacité de l'approche.
- **Inadapté aux grands projets complexes** : Bien que l'agilité soit efficace pour les petites équipes 
travaillant sur des projets flexibles, elle peut ne pas bien s'adapter aux grands projets complexes 
où une coordination entre plusieurs équipes est nécessaire.
- **Difficulté à mesurer les performances à long terme** : L'accent mis sur les livrables à court terme 
peut rendre difficile l'évaluation des performances globales du projet ou de son alignement avec les 
objectifs stratégiques à long terme.
- **Problèmes avec les clients non impliqués** : Le succès de l'approche agile dépend de 
l'implication active des parties prenantes, notamment les clients. Si ces derniers ne sont pas 
disponibles ou engagés, cela peut créer des retards ou des malentendus.
- **Surcharge pour les équipes** : L’agilité demande une itération continue et une forte réactivité, 
ce qui peut épuiser les équipes si elles ne bénéficient pas de temps de récupération suffisant 
ou si elles doivent faire face à des changements fréquents sans pause.
- **Résistance au changement** : Certaines entreprises ou équipes peuvent être réticentes à 
abandonner les méthodes traditionnelles (comme le modèle en cascade) au profit de l'agilité, 
ce qui peut générer des conflits internes.
- **Limites pour les projets réglementés** : Dans certains secteurs, comme l'aérospatial ou les 
industries très réglementées, l'agilité peut être difficile à appliquer car ces projets 
nécessitent une documentation très rigoureuse et une gestion des risques stricte.

### L'agilité dans le concret : SCRUM

Scrum est un cadre de gestion de projet agile utilisé principalement dans le développement de logiciels, mais applicable à d'autres domaines également. Il favorise une approche itérative et incrémentale pour créer des produits complexes. Scrum repose sur la collaboration, la transparence et l'adaptabilité pour répondre rapidement aux changements.

#### Les rôles
Scrum définit trois rôles clés qui interagissent pour maximiser la valeur délivrée par l'équipe :

- **Product Owner (PO)** : Représente les parties prenantes et les utilisateurs finaux. Il est responsable de la gestion du Product Backlog et de la priorisation des fonctionnalités. Le PO s'assure que l’équipe développe les fonctionnalités les plus précieuses.

- **Scrum Master** : Il est le facilitateur et le coach de l’équipe. Le Scrum Master veille à ce que Scrum soit compris et appliqué correctement, et élimine les obstacles (impediments) qui freinent l’équipe. Il protège l’équipe des distractions extérieures.

- **Équipe de développement (Development Team)** : C’est un groupe multifonctionnel responsable de la réalisation du travail. L’équipe est autonome, organisant son propre travail pour atteindre les objectifs du Sprint. L’équipe peut inclure des développeurs, des testeurs, des designers, etc.

#### Les artefacts
Les artefacts sont des éléments clés qui représentent le travail et les résultats du processus Scrum.

- **Product Backlog** : Une liste ordonnée de tout ce qui pourrait être nécessaire dans le produit, tenue à jour par le Product Owner. Chaque élément est appelé User Story. Le Product Backlog est évolutif et peut changer en fonction des besoins du produit.

- **Sprint Backlog** : C’est une sous-liste du Product Backlog, représentant les éléments que l’équipe s’engage à terminer durant un Sprint. L’équipe de développement le crée lors de la planification du Sprint.

- **Increment** : Le produit développé à la fin de chaque Sprint, qui doit être "potentiellement livrable", c'est-à-dire dans un état qui peut être utilisé ou mis en production. Un Increment est la somme de tous les éléments du Product Backlog terminés durant un Sprint.


#### Les événements
Scrum se compose de plusieurs événements (ou cérémonies) qui structurent le travail sur le projet.

- **Sprint** : Un Sprint est un cycle de travail de durée fixe (généralement de 2 à 4 semaines). Chaque Sprint commence par la planification du Sprint et se termine par une revue et une rétrospective. Le but est de produire un Increment du produit. Le Sprint est le cœur de Scrum.

- **Sprint Planning (Planification du Sprint)** : C'est la réunion où l’équipe décide quel travail sera effectué pendant le Sprint. Elle est composée de trois parties :

    - *Pourquoi* ? – Le Product Owner explique les objectifs du Sprint.

    - *Quoi* ? – L’équipe de développement sélectionne les items du Product Backlog à inclure dans le Sprint.

    - *Comment* ? – L’équipe discute et planifie la manière dont les éléments seront livrés.

- **Daily Scrum (Réunion quotidienne)** : Une réunion courte (15 minutes) tous les jours durant le Sprint. L’équipe se synchronise et discute des progrès, des obstacles et des ajustements nécessaires. Chaque membre répond à trois questions : Qu’ai-je fait hier ? Qu’est-ce que je vais faire aujourd’hui ? Quels obstacles ai-je rencontrés ?

- **Sprint Review (Revue du Sprint)** : À la fin du Sprint, l’équipe présente l'Increment aux parties prenantes. Le Product Owner explique quels éléments du Product Backlog ont été achevés. Cette réunion est aussi l’occasion de recueillir des retours pour ajuster la direction du projet.

- **Sprint Retrospective (Rétrospective du Sprint)** : Après la revue du Sprint, l’équipe se réunit pour discuter de ce qui a bien fonctionné, ce qui peut être amélioré, et comment s'améliorer pour le Sprint suivant. L’objectif est d’optimiser les processus et la collaboration.

#### Les principes fondamentaux
- **Transparence** : Les processus et les décisions doivent être visibles pour tous les participants. Cela inclut la visibilité du travail effectué, des priorités et des obstacles. Les artefacts (Product Backlog, Sprint Backlog, etc.) sont partagés et consultés par toute l’équipe.

- **Inspection** : Scrum encourage l'inspection régulière de l'état du travail. Les événements comme le Daily Scrum, la Revue de Sprint et la Rétrospective permettent d’évaluer les progrès et d'ajuster les priorités si nécessaire.

- **Adaptation** : Si des écarts sont détectés lors des inspections, des ajustements doivent être faits rapidement. Cela permet à l’équipe de s’adapter aux changements en cours de Sprint et d’atteindre ses objectifs plus efficacement.

#### Le processus Scrum en détail
- Le Product Backlog est continuellement mis à jour par le Product Owner, selon les retours, les priorités des parties prenantes, et les changements du marché.

- Au début de chaque Sprint, l’équipe choisit des éléments du Product Backlog à réaliser, en les détaillant davantage dans le Sprint Backlog.

- Le Sprint commence, et l’équipe se réunit tous les jours lors du Daily Scrum pour assurer la synchronisation.

- À la fin du Sprint, l’équipe présente l’Increment au Product Owner et aux parties prenantes pendant la Sprint Review. Cela permet de recueillir des retours pour ajuster le travail à venir.

- Lors de la Sprint Retrospective, l’équipe discute de son fonctionnement et décide des améliorations possibles.

#### Avantages :
- **Flexibilité et adaptabilité** : Scrum permet de répondre rapidement aux changements, tout en livrant des résultats à chaque Sprint.

- **Collaboration et transparence** : Scrum favorise une communication constante et une prise de décision partagée.

- **Amélioration continue** : Grâce à la rétrospective, Scrum pousse l’équipe à toujours chercher des moyens de s’améliorer.

#### Défis :
- **Discipline et engagement** : Scrum nécessite une forte discipline pour respecter les événements, rôles et artefacts. Les équipes doivent aussi être prêtes à accepter des changements fréquents.

- **Dépendance à la collaboration** : Scrum repose fortement sur la collaboration entre les membres de l’équipe et avec les parties prenantes.

- **Risque de surcharge** : Si le Product Owner ne gère pas bien le Product Backlog ou si les priorités changent trop fréquemment, cela peut entraîner une surcharge de travail.

#### Les users stories

Les user stories sont des descriptions simples et concises des besoins ou fonctionnalités d'un produit du point de vue de l'utilisateur. Elles servent à exprimer ce que l'utilisateur veut accomplir avec une fonctionnalité, en se concentrant sur le "quoi" plutôt que le "comment". Une user story suit généralement le format : "En tant qu'utilisateur, je veux [fonctionnalité] afin de [objectif ou bénéfice]."
Elles sont rédigées sous la forme *"En tant que xx je veux yy afin de z"*

Le principe INVEST est un acronyme qui permet de garantir la qualité des user stories. Il signifie :

- **Indépendantes** : Les stories doivent pouvoir être développées de manière autonome, sans dépendance avec d'autres.
- **Négociables** : Elles doivent être flexibles et permettre une discussion entre l'équipe et les parties prenantes pour affiner la solution.
- **Valables** : Chaque story doit apporter de la valeur à l'utilisateur ou au projet.
- **Estimables** : Elles doivent être suffisamment claires pour pouvoir être évaluées en termes d'effort et de temps.
- **Small (petites)** : Les stories doivent être assez petites pour être réalisées en quelques jours ou une à deux semaines.
- **Testables** : Il doit être possible de tester la fonctionnalité pour vérifier qu'elle répond bien aux critères d'acceptation.

En appliquant INVEST, l'équipe de développement peut créer des user stories efficaces, claires et prêtes à être développées.

A cette user story, on associe des critères d'acceptation en amont : une liste de besoins qui doivent être cochés pour pouvoir déterminer lorsque la user story est traitée.

#### Definition of Ready (DoR)

Les critères pour qu'une user story sois prête à être intégrée dans un sprint.
Cela permet de :
- Assurer que chaque élément est bien préparé et priorisé avant d'être intégré
au sprint.
- Réduire les risques d'interruption, d'incompréhension ou de besoin de
clarication pendant le développement.
- Améliorer l'efficacité et la fluidité du sprint en évitant des révisions et des
ajustements inutiles.

Chaque équipe dénit ses propres critères mais il y en a qui sont très fréquents.

Par exemple : 
>- **Clarté de la user story** : La user story est formulée clairement avec les besoins utilisateur.
>- **Critères d'acceptation** : Chaque user story doit avoir des critères d’acceptation précis et mesurables.
>- **Priorisation** : La user story est priorisée dans le backlog et alignée avec les objectifs du sprint ou du produit.
>- **Estimation** : La user story a été estimée en termes de temps ou de points de complexité.
>- **Dépendances identiées** : Toutes les dépendances avec d'autres stories, équipes ou composants ont été identifiées et gérées.
>- **Ressources disponibles** : Les ressources nécessaires, comme des informations techniques ou des accès,
sont disponibles.
>- **Designs ou maquettes disponibles** : Si la user story nécessite des designs ou des maquettes,
ceux-ci sont prêts.
>- **Pas de blocages** : Aucune question ou condition non résolue n’empêche la réalisation de la story.


**Affinage du backlog** : Lors des sessions de refinement, l'équipe et le Product Owner passent en revue les user stories pour les préparer à être "ready".

**Validation avant sprint** : Avant de démarrer un sprint, les user stories
doivent respecter la DoR. Si elles ne sont pas prêtes, elles sont
retravaillées ou dépriorisées.

**Adaptation continue** : Les équipes Agile ajustent souvent leur DoR en
fonction des leçons apprises, en ajoutant ou supprimant des critères
selon les besoins du projet.

#### Definition of Done (DoD)

Les critères pour qu'une user story soit considérée comme terminée.
- Établit un niveau de qualité attendu.
- Alignement de l'équipe, chacun sait ce qu'il doit faire pour terminer une
story.
- Vérification et validation pour éviter de revenir sur un travail à moitié fait.

Chaque équipe définit ses propres critères en accord avec le PO, il est donc impossible de comparer deux équipes agiles car elles n'ont pas forcément la même DoD.

Par exemple :
> - Code et tests :
>    - Le code est écrit et passé en revue par un pair.
>    - Tous les tests unitaires sont passés avec succès.
>    - Le code respecte les conventions de l’équipe.
>    - Le code est intégré sans conit dans la branche principale.
> - Autres critères :
>    - La documentation utilisateur est mise à jour si nécessaire.
>    - Les documents techniques sont complétés pour la maintenance future.
>    - Les tests d'acceptation ont été passés et validés par le Product Owner.
>    - La fonctionnalité est validée dans l'environnement de préproduction.
>    - Les critères de performance sont respectés (ex. le temps de chargement).
>    - Aucun défaut critique ou bloquant n'est identié.

#### Estimation de l'effort

Évaluer l'effort nécessaire pour réaliser les user stories. Cela permet de jauger l'objectif du sprint, en se basant sur l'effort réalisé sur les sprints précédents.

L’idée est de prévoir le travail requis pour chaque élément du backlog, mais sans précision absolue : les estimations visent à obtenir une approximation utile, et non une prédiction exacte.

Avec le temps, sur un projet donné les estimations deviennent de plus en plus stables à condition que l'équipe ne change pas

Pour cela, on définit une échelle arbitraire, propre à l'équipe. 

Par exemple, avec des points de story (1 2 3 5 8 13 21), des tailles de tee shirt (XS S M L XL XXL) ou une quantité d'heures idéale (nombre d'heures nécessaires sans être dérangé et en supposant que tout ce passe bien)

Une valeur numérique est quand même plus pratique, car on peut estimer le nombre de points ou d'heures idéales qu'on peut fournir par sprint.

Cette métrique mesure:
- La complexité
- Le volume de travail
- L'incertitude
Une estimation est toujours relative et contextuelle, on ne peut comparerles estimations de deux équipes ni les estimations d'une même équipe à deuxinstants ou sur deux projets différents

Une estimation très élevée indique souvent un degré d'incertitude qui rend la User Story difficilement réalisable. Il faut afner, réduire l'incertitude et y revenir

#### Planning Pojer

- On prend une User Story et on en discute ensemble
- Chacun vote pour une estimation avec une carte qu'il masque (story point, taille de tee shirt ou autre)
- On révèle les cartes et on discute des différences d'estimation
- On refait un tour jusqu'à l'unanimité
- Si une seule personne n'est pas d'accord avec le reste du groupe, la majorité l'emporte
- Le plus important ici c'est la discussion, pas le résultat
## Outils de gestion

### MOSCOW

Must Should Could Won't : Permet de répartir les tâches afin de définir un ordre de priorité

