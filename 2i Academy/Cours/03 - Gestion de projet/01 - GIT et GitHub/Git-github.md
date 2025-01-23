# GIT & Github

## Commandes de base linux

Pour s'entraîner à utiliser les commandes linux utiles à GIT, on utilisera GitBASH. C'est un terminal calqué sur Bash, le terminal de linux.

Une règle de base est qu'on peut écrire l'argument d'une commande avec -lettre ou --mot.

- `ls` : Liste
    - `-a` : Afficher les fichiers masqués
- `cd` : Se déplacer dans l'arborescence
- `mkdir` : Créer un dossier
    - `mkdir -p` : Créer une arborescence complexe
- `touch` : Créer un nouveau fichier vide.
- `>`  : Détourner le contenu vers un fichier. Il sera créé s'il n'existe pas, ou écrasé s'il existe.
- `>>` : Ajouter le contenu vers un fichier existant.
- `cat` : Afficher le contenu d'un fichier dans le terminal. Sans argument, il  taper du contenu, et de pouvoir l'écrire dans un fichier grâce à > ou >>.
- `rm` : supprimer un fichier ou un dossier
- `cp` *`source destination`* : copier un fichier
    - `-r` : copie récursive
    - `-v` : Verbose = Permet de visualiser la progression de la copie dans le terminal
    - `-i` : Demande la confirmation avant de remplacer un fichier existant
    - `-n` : Interdit le remplacement d'un éventuel fichier existant dans la destination
- `mv` *`source destination`*: déplacer ou renommer un fichier
    - Mêmes options que `cp`
- `chmod` *`options mode cible`*: Permet de changer les permissions d'une cible 
- `chown` *`options user:group cible`* : Permet de changer le propriétaire d'un fichier
- `tar` *`options nom cible`* : Archiver la cible
    - `-c` : Créer l'archive
    - `-x` : Extraire
    - `-z` : Zipper/Compresser
    - `-v` : Verbose

## GIT

GIT est un outil de gestion de version. A chaque étape du projet, on crée un `commit` qui ajoute les modifications les plus récentes.

La particularité de ce système est qu'il est décentralisé. On est pas obligé d'être connecté en permanence au serveur, à condition de se synchroniser régulièrement pour s'assurer d'obtenir les mises à jours les plus récentes des collègues ou pour envoyer notre travail.

### Mais à quoi ça sert ?!

- **Historique des modifications** : Les commits successifs permettent d'avoir un historique des modifications sur nos fichiers. Il vaut mieux faire une multitude de petits commits, en s'assurant de bien les decrire afin que l'historique soit lisible.
- **Archive locales et distantes** : Tous les développeurs travaillant sur un projet ont des archives en local, petite sécurité en cas de problème sur le serveur.
- **Versions multiples** : Permet d'avoir de multiples verions, grâce aux **tags** et aux **branches**.
- **Suivi de projet** : Quand on commit, on doit réfléchir à ce qu'on a fait dans notre envoi et cela permet de savoir précisément comment on avance. Pour simplifier l'explication de notre commit, on doit se forcer à travailler sur un point à la fois, et d'éviter de s'éparpiller.
- **Déploiement de projet** : On peut utiliser GIT comme outil de déploiement, avec l'avantage de n'avoir à envoyer que les fichiers modifiés pour le déploiement d'une nouvelle version.
- **Filet de sécurité** : Si on commit régulièrement, on ne peut pas perdre de fichiers, même lorsqu'une partie du code est supprimée dans les versions récentes. On pourrait toujours aller le rechercher dans des versions précédentes.

### Mise en place

`git init` : Initialise un projet git et stocke l'historique des fichiers dans un dossier .git

Lorsqu'on utiliser GIT sur un nouvel ordinateur, on peut configurer notre utilisateur, afin de tracer les commits. On peut le faire en `--global` (pour tous les projets) ou pour le projet dans lequel on est situé.

```shell
git config --global user.name Antonin
git config --global user.email antonin.mingam@gmail.com
```

### Principe

On distingue 3 zones de travail :

- Dossier de travail : Le projet en cours, la version de travail actuelle, en local sur la machine.

`git add`

- Zone de transit

`git commit`

- Dépôt local : Contient les commits et l'historique des versions.

Un fichier peut avoir 4 états sur GIT :
- **Non tracé** : Le fichier n'est pas encore connu par GIT
- **Non modifié** : Le fichier dans l'historique est le même que celui dans le répertoire de travail
- **Modifié** : Les deux fichiers sont désynchronisés
- **Staged** : Le fichier est dans la zone de transit et est candidat au prochain commit.

*Quand on commit un fichier staged, il passe en non-modifié*

Si on a une bonne pratique, c'est à dire que l'on fait régulièrement des petits commits, on peut faire `git add .` pour ajouter tous les fichiers modifiés dans la zone de transit, puis un `git commit -m "un message de commit"`.

`git commit --all --message="un message de commit"` permet de faire ces deux étapes en une seule ligne, car `--all` remplace `git add .`

### Rédiger un message de commit

- Commencer par un verbe d'action
- Préférer la forme active `"ajoute la fonction ..."` plutôt que `"ajout de la fonction ..."`
- Titre court et précis (< 50 caractères)
- On peut ajouter une description, en utilisant deux options `-m` ou en n'utilisant pas d'option et en rédigeant le message avec `Vi`, l'éditeur de texte de GIT
- Mentionner les références (ticket, user story...)
- Indiquer le "pourquoi" dans le message.

### Utiliser Vi

Vi a deux modes d'exécution : le mode commande et le mode insertion.

Voir le pdf p.13 pour avoir les différentes commandes.

### Historique des commits

En utilisant `git log`, on peut voir nos différentes versions, branches etc.. 

Quelques options :
- `-n <nombre>` : Limite le nombre de commits affichés
- `--oneline` : Affiche chaque commit sur une seule ligne
- `--decorate` : Affiche les références (tags, branches..)
- `--stat` : Affiche des fichiers et actions du commit
- `--graph` : Affiche un graphe des branches
- `--author="<nom>"` : N'affiche que les commits d'un auteur spécifié
- `--grep="<text>"` : Recherche et affiche les messages de commits qui contiennent `<text>`
- `--before="<date>"`, `--after="<date>"`
: Recherche en fonction des dates de commit (--since et --until sont également possibles)
- `-- <fichier>` : Affiche les commits qui concernent un fichier particulier
- `-S "<text>" ` : Affiche les commits qui ont ajoutés ou supprimés `<text>`

### Quelques fonctions

- `git commit --amend -m "un message de commit"` : Modifier le dernier commit, pour ajouter un fichier ou changer le message de commit.
- `git restore [fichier]` : Récupérer le fichier dans l'historique actuel
    - On peut préciser `--source` pour choisir la version sur un commit plus ancien, en précisant son index ou son id.
- `git diff [fichier]` : Comparer un fichier dans l'espace de travail avec son équivalent dans la tête du dépôt
- `git diff master` : Comparer l'intégralité des fichiers
- `git rm --cached [fichier]` : Enlève le fichier de la zone de transit
- `git rm --cached -r .` : Vide la zone de transit
- `git revert [commit]` : Récupère le contenu d'une ancienne version, et le transforme en head du repo, tout en conservant le head précédent dans l'historique.

### Les branches

Les branches servent à avoir des historiques parallèles afin d'organiser notre travail. Ces branches pourront ensuite merge avec Master, pour réintégrer la branche principale.

On peut ainsi :
- Travailler sur une nouvelle feature
- Faire des tests
- Définir un point de sauvegarde pour un déploiement avant de faire un `git pull` sur le serveur de prod
- Marquer les différentes versions d'un projet

Et tout cela, sans casser la branche master ni la salir avec du code incomplet.

`git branch [nom]` : Nom unique, pas d'espace ni de caractères spéciaux

- `git switch [branche]`, `git checkout [branch]` : Aller sur une branche
- `git branch -d [branche]` : Supprimer une branche
- `git branch -D [branche]` : Forcer la suppression d'une branche non fusionnée
- `git branch` : Lister les branches d'un projet
- `git branch --move [ancien nom] [nouveau nom]` : Renommer une branche
- `git branch --copy [source] [nouvelle branche]` : Copier une branche
- `git merge [branche source]` : En étant sur la branche cible, permet de fusionner les deux branches

*Astuce : `git checkout -b [nom de la branche]` permet de créer une branche et de s'y rendre en une seule commande.*

Il existe deux types de fusions : fast forward / no fast forward

Fast forward va inclure l'historique de la branche au master, comme si la feature avait été créée sur master directement. Cette méthode est souvent préférée, car l'historique sera plus propre. Cependant ce n'est possible que s'il n'y a pas eu de nouveaux commits sur master pendant qu'on travallait sur la branche.

`git merge --no-ff` : No fast forward, l'historique sera stocké en parallèle.

`git merge --abort` : Annule la fusion en cas de conflit, si on est pas sûr de la résolution adéquate -> Besoin de communiquer.

### Rebase

`git rebase [nom de la branche]`

**On ne fait pas de rebase sur master.**

On va rebase sur notre branche pour modifier son historique et le mettre à jour, comme si l'on avait créé notre branche avec la version la plus récente de master.

Cela permet d'obtenir un historique plus propre en évitant les commits de fusion.

#### Quand l'utiliser ?

- Vous avez créé une branche mais vous vous êtes trompé, vous
voulez baser cette nouvelle branche sur une autre branche
- Vous travaillez sur une branche et vous voulez intégrer
les modications d'une autre branche sans faire de fusion
- Vous travaillez sur une branche depuis longtemps et vous voulez
résoudre les conits sur cette branche avant de faire un merge fast
forward sur la branche principale an de conserver un historique
propre sur cette dernière

#### Quand ne PAS l'utiliser ?

Dès lors que vous êtes sur une branche partagée par d'autres développeurs, rebase change les id des commits.

**PAS DE REBASE SUR UNE BRANCHE DISTANTE**

récupérer le Meme p.43

### Remisage (Stach)

Quand on travaille sur une branche et qu'on est pas prêt à faire un commit lorsqu'on nous demande de travailler sur autre chose en urgence, on a pas trop envie de faire un commit "sale". 

Dans ce cas, on met de côté notre travail le temps de changer de mission, puis quand on revient on peut les récupérer pour continuer à travailler.

Quand on les met de côté, les fichiers ou modifications disparaissent temporairement de notre espace de travail.

- `git stach` permet d'envoyer notre travail dans le stash
    - `git stash save [nom]` pour lui choisir un nom en l'envoyant
    - `-u` pour ajouter les fichiers non-tracés

- `git stach list` : Voir la liste des remisages
- `git stach pop` : Récupérer le dernier fichier et de le supprimer du stach
    - `git stach apply` : Récupèrer le dernier fichier sans le supprimer du stach
    - `git stach drop` : Supprimer le dernier fichier du stach sans le récupérer
    -  Pour ces 3 commandes, on peut préciser le nom ou le numéro du fichier que l'on souhaite récupérer

- `git stach clear` : Vider le stach

### Tags

Les tags nous permettent de donner un nom à un commit particulier dans l'historique.

Les noms de tags et de branche sont uniques sur le projet. Un nom de tag ne peut contenir ni espaces ni caractères spéciaux.

On peut les utiliser pour jalonner des versions fonctionnelles.

- `git tag v1` associe le tag "v1" au commit courant
- `git switch v1` Positionne l'historique au tag "v1"
- `git tag` Liste tous les tags
- `git tag -d v1` Supprime le tag "v1"
- `git tag v1 [commit]` associe le tag "v1" à un numéro de commit spécifique

### Github - Dépot distant

AJOUTER LE SCHEMA 

Le dépôt distant possède un historique, des branches et des tags comme un dépôt local.
Chaque développeur possède dans son dépôt local une copie du projet plus ou moins synchronisée avec le dépôt distant.

`git clone` : Copie les fichiers d'un dépôt distant en local. On récupère également les fichiers .git, contenant les commits etc...

`git push` : Envoie les fichiers du dépôt local sur le dépôt distant. Nécéssite les autorisations, on ne peut pas push sur les dépôts d'autres personnes. Si on souhaite proposer nos modifications, on peut utiliser les pull requests, qui proposent au propriétaire du projet de pull nos modifications.

`git pull` : récupérer les données distantes (fichiers et .git) d'une branche qui existe en local

`git fetch` : Récupérer les données .git des branches qui n'existent pas en local. Les fichiers d'une branche ne seront téléchargés qu'au moment où on checkout dessus.

Si on a déjà un projet, et que l'on souhaite l'uploader sur un repo github, ne pas ajouter de fichier README et .gitignore

**Il faut toujours faire un pull avant un push, afin de s'assurer de gérer les conflits en amont.**

Une méthode équivalente à un pull serait de faire un fetch suivi d'un rebase, pour avoir un historique plus propre.

### gitignore

Certains fichier ou répertoires n'ont pas vocation à être versionnés, d'autres ne doivent surtout pas apparaitre dans un dépôt distant surtout s'il est public pour des questions de sécurité.

- Le répertoires des dépendances  (node_modules par exemple)
- Les fichiers système de votre OS (.DS_Store, desktop.ini, Thumbs.db...)
- Les fichiers contenant des informations sensibles
- Le dossier de configuration provenant de votre IDE
- Le répertoire de build
- Les logs et les fichiers temporaires
- Les fichiers compilés et les archives

Pour pouvoir les ignorer, on crée un fichier `.gitignore `à la racine du projet dans lequel on va référencer, largement ou précisément.

*Un outil pour générer un `.gitignore` en précisant notre environnement de travail :*
 https://www.toptal.com/developers/gitignore/

 ### Connexion SSH (Secure Shell)

- Plus sécurisée que le mot de passe
- Plus simple
- Facilite l'automatisation (pas besoin de saisie de mot de passe)
- Accès multi comptes
- Ne passe pas par HTTPS

Cette clef authentifie une machine. On peut ensuite configurer certains services, **par exemple Github**, pour se connecter facilement sans avoir à rentrer de mot de passe.

#### Création de la clef

```shell
ssh-keygen -t ed25519 -C "your_email@example.com"
```

`ssh-keygen` : C'est l'outil utilisé pour générer des clés SSH.

`-t ed25519` : Cette option spécifie le type d'algorithme de la clé à générer.

ed25519 est un algorithme de signature numérique qui est plus moderne et plus sécurisé que l'algorithme RSA, qui est plus ancien et potentiellement vulnérable aux attaques. Il est également plus rapide et produit des clés plus petites, ce qui le rend très populaire pour la génération de clés SSH.


`-C "your_email@example.com"` : Cette option permet d'ajouter un commentaire à la clé générée. En général, ce commentaire est une adresse e-mail ou une note qui peut aider à identifier la clé plus tard. Par exemple, cela peut être l'adresse e-mail de l'utilisateur qui génère la clé. Ce commentaire est surtout utilisé pour faciliter l'identification de la clé, notamment lorsque vous avez plusieurs clés publiques dans un fichier (habituellement ~/.ssh/authorized_keys).

#### Stockage de la clef en local

```shell
 eval "$(ssh-agent -s)" ssh-add ~/.ssh/id_ed25519
```

La clef sera stockée en local dans `~/.ssh`

#### Copie de la clé pour utilisation en ligne

```shell
clip < ~/.ssh/id_ed25519.pub
```
`clip` est le presse-papier sur Windows. Cette ligne de commande permet donc d'aller chercher notre clé pour la copier et la coller où l'on a besoin.

## Workflows

Choisir un workflow et s'y fier est important pour faciliter le travail en collaboration. La taille de l'équipe, le niveau de compétence des gens qui la compose et le type de projet définissent un type de workflow plus adapté. 

C'est une balance à trouver entre simplicité/rapidité et sécurité.

### Trunk Based

La méthode "par défaut". L'idée est d'avoir un tronc principal unique et stable. 

On peut créer des branches parallèles pour faire des tests ou pour des fonctionnalités, mais elles sont fusionnées au tronc dès qu'elles sont prêtes, généralement après quelques heures ou jours.

Les développeurs mergent plusieurs fois par jour sur le tronc, ce qui permet de détecter rapidement les conflits ou les problèmes de compatibilité et de les résoudre sans attendre.

Pour les fonctionnalités nécessitant plusieurs jours de développement, les équipes utilisent des "feature flags" (drapeaux de fonctionnalité) pour activer ou désactiver la fonctionnalité en production sans devoir la retirer du code.
Cela permet de fusionner du code non finalisé dans main sans le rendre visible aux 
utilisateurs finaux.

L’automatisation des tests est cruciale pour garantir que chaque changement fusionné dans main est stable et prêt pour le déploiement. Les pipelines CI/CD automatisés permettent de tester et de déployer chaque modification 
rapidement et de manière fiable.

Pour les développeurs expérimentés et rigoureux, car c'est dangereux.


#### Avantages

- Conflits de fusion réduits.
- Déploiements rapides et continus.
- Simplicité et transparence.
- Feedback rapide

#### Inconvénients

- Nécessite une discipline rigoureuse.
- Plus vulnérable aux bugs, erreurs et catastrophes.
- Gestion complexe des fonctionnalités longues.
- Forte dépendance aux tests automatisés pour assurer la stabilité du tronc.
- Peu adapté aux grandes équipes sans outils devops très robustes
- Les feature flags (maintenance, tests, migration BD)

### Github Flow

Comme pour la Trunk Based, il n'y a qu'une branche principale qui récupère toutes les features et à partir de laquelle on fera nos déploiement.

La différence majeure est que les développeurs ne peuvent pas merger "sauvagement". Ils doivent proposer leur travail grâce à des Pull Requests, ce qui force à la communication et à la vérification par des pairs.

#### Avantages
- Simplicité et agilité.
- Automatisation et CI/CD sur une seule branche.
- Formalisation de la validation avec le Pull Request.
- Adapté aux projets open source et aux équipes hétérogènes

#### Inconvénients

- Pas adapté si on doit maintenir différentes versions du code en production.
- Plus vulnérable aux bugs, erreurs et catastrophes.
- Difficulté avec les grosses features qui restent longtemps sans être fusionnées.
- Forte dépendance aux tests automatisés pour assurer la stabilité de la branche main

### Git Flow
Branches principales :
- Branche `main` : branche principale qui contient le code prêt pour le déploiement

- Branche `develop` : branche contenant les dernières modifications prêtes pour la prochaine version. Les nouvelles fonctionnalités et les correctifs y sont fusionnés avant de passer en production.

Branches de support :
- Branches de fonctionnalité (`feature/*`) : Pour travailler sur de nouvelles 
fonctionnalités.
- Branches de version (`release/*`) : Pour préparer une nouvelle version en production.
- Branches de correctif (`hotfix/*`) : Pour les correctifs urgents en production.

#### Avantages

- Structure claire : Facilite le suivi du statut des développements  et des branches de fonctionnalités.
- Développement isolé : Garde les fonctionnalités et les correctifs séparés jusqu’à ce qu’ils soient stables et prêts à être fusionnés.
- Processus de version : Permet un processus structuré avec des tests approfondis.
- Support des correctifs : Permet des corrections rapides en production sans perturber le développement en cours.

#### Inconvénients

- Complexité excessive pour les petits projets ou les équipes agiles
- Mise en production lente
- Complique le pipeline CI/CD (intégration et déploiement continu)
- Risque de divergence entre main et develop et donc fusion délicate
- Correctifs appliqués sur les branches main et develop (double travail de fusion)
- Historique peu lisible