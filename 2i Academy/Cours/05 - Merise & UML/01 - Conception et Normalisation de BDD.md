# Conception de BDD

Une base de données est une collection d'informations organisées afin d'être facilement consultables, gérables et mises à jour.

Une BDD est bien plus qu'un simple répertoire de données : C'est un système complexe qui permet de structurer, sécuriser et exploiter les données de manière efficace. La persistence et la cohérence de l'information sont les deux services primaires d'un système de gestion de base de données (SGBD ou DBMS en anglais.)

Il existe 3 types de bases de données :

- **Base de données hiérarchiques :**
    Modèle historique (DBase) qui revient avec NoSQL (MongoDB)
- **Base de données relationnelles :**
    Modèle dominant depuis des décennies
- **Base de données Graph ou réseau :**
    Cas d'utilisation très spécifique, répond au problème de modélisation d'un arbre, exercice où le modèle relationnel est peu performant

## Trois modèles, trois étapes

- Modèle conceptuel : 
    - Collecte des informations du domaine
    - Définition des dépendances fonctionnelles
    - Création du modèle conceptuel des données
        - définitions des entités
        - définition des associations
        - définition des cardinalités (liens entre les entités)

A cette étape on ne sait même pas encore si l'on a besoin d'une base de données pour conserver nos données

- Modèle logique :
    - Définition des tables et de leurs colonnes
    - Traduction des cardinalités en algèbre relationnel :
        - Définition des clefs primaires et étrangères

- Modèle physique :
    - Choix d'un SGBDR précis
    - Définition des types de données (dépendant du SGBDR)

## Qu'est ce qu'une information ?

On se base sur la notion de flux de données, c'est à dire qu'une information est basée sur sa transmission. L'information (en tout cas pertinente) n'existe que si elle passe d'un interlocuteur à un autre.

On peut se baser sur plusieurs sources pour définir les informations à stocker dans une BDDR :
- L’expression des besoins
- Le discours du client
- Les documents traités et produits
- Les statistiques produites, voulues ou rêvées
- Le cadre réglementaire et/ou législatif
- Les pratiques et les process au sein de l’organisation

## Créer une base de données
### Etablir la liste des données
- Utiliser des données **stables** dans le temps (Exemple : Remplacer l'âge par la date de naissance)
- Si une donnée peut être **calculée** grâce à d'autres données, il peut être plus intéressant de la calculer. En revanche, il peut être intéressant de les stocker dans une table à part pour les calculs complexes ou les grandes quantités de données, afin de gagner du temps et de simplifier les requêtes.

### Etablir un tableau des dépendances
Ce tableau liste les données, et liste ses liens avec d'autres données.
- Une seule croix = Donnée
- Plusieurs croix = Entité

On peut ensuite afficher ces données sous forme de graphe :

- Les sommets des arbres sont les identifiants des entités
- Une feuille orpheline est reliée aux autres sommets par une entité anonyme
- Les points noirs indiquent une cardinalité de n à n.

Une entité orpheline est soit une erreur, soit une information qui n'est pas associée à une entité mais à la relation entre deux entités. (Par exemple, la quantité dans une commande.)

### Les identifiants

- Identifiants sémantiques : Une colonne qui porte une information importante et qui est unique (Exemple : ISBN)

- Identifiants techniques (Auto-incrémentés)

### Looping : Visualiser ses BDD pour les concevoir

Cet outil permet de créer un graphe complet des informations et de leurs dépendances.

- MCD (Modèle conceptuel de données)
- UML (Langage de Modélisation Unifié) pour de la POO
- MLD (modèle logique de données)

On peut également générer nos scripts SQL pour la génération de notre base, dans le langage de notre choix.

## **Rechercher intégrité référentiel**

# Normalisation de BDD

Afin d'éviter la redondance, les incohérence et la perte d'informations, un certain nombre de règles tacites ont été créées pour régir la création d'une BDD.

On peut passer outre ces règles dans des situations très précises, quand c'est nécessaire. Dans la majorité des cas, il vaut mieux les respecter.

## Première forme normale (1NF)
- Données atomiques 
    - Non décomposables (ex : nom = Pierre Legrand)
    - Pas de listes (ex : hobbies = lecture, sport, voyages)
- Données stables dans le temps
- Pas de colonnes multiples avec la même sémantique (ex : hobby1, hobby2, hobby3)
- Toutes les valeurs d'une colonne sont de même type

## Les dépendances

### Dépendance fonctionnelle

**Définition** : il existe une Dépendance Fonctionnelle (DF) entre deux attributs A et B d’une relation R si à chaque valeur ai de A est toujours associée la même valeur bj de B.

**Pour simplifier** : Si je connais A, alors je connais B = A détermine B

En général, les colonnes d'un tableau sont en dépendance fonctionnelle de la clé primaire. Mais il peut y avoir des DF ailleurs.

### Dépendance transitive

Dépendance d'une colonne avec une colonne d'une autre table.

### Dépendance partielle

Lorsqu'on utilise une combinaison de clef étrangères en guise de clef primaire, certaines colonnes ne peuvent dépendre que d'une partie de la clef primaire.

Souvent c'est un indicateur qu'on pourrait séparer notre table en plusieurs tables.

## Deuxième forme normale (2NF)

On ajoute une condition à la première forme normale :

- Toutes les colonnes non clés dépendent entièrement de la clé primaire : **pas de dépendances fonctionnelles partielles**.

## Troisième forme normale (3NF)

On ajoute une condition à la deuxième forme normale :

- Aucune colonne non clef ne dépend transitivement de la clef primaire.

## Boyce Codd Normal Form (BCNF)

On ajoute une condition à la troisième forme normale :

- La clef primaire est une **super clef**, c'est à dire qu'elle détermine de façon unique toutes les colonnes de la table

## Quatrième forme normale (4NF)

On ajoute une condition à la troisième forme normale : 

- Ne contient aucune dépendance multivaluée non triviale. Une dépendance multivaluée existe lorsqu'une colonne dans une table peut être associée à plusieurs valeurs d'une autre colonne, indépendamment des autres colonnes.

## Cinquième forme normale (5NF)

On ajoute une condition à la quatrième forme normale :

- Ne contient aucune dépendance de jointure non triviale. Une dépendance de jointure existe lorsque si table était divisée en plusieurs parties, il serait possible de la reconstruire uniquement en effectuant des jointures sans perdre d'informations ni introduire d'incohérences.

## Sixième forme normale (6NF)

On ajoute une condition à la cinquième forme normale :

- La table ne contient aucune dépendance jointe non triviale, même dans des  situations très spécifiques.

Une dépendance jointe signifie que les données d'une table peuvent être décomposées en plusieurs tables plus petites, et ces tables peuvent être recomposées (reconstruites) par une jointure sans perte d'information.

La 6NF introduit le concept de représentation irréductible : chaque table ne contient qu’une seule relation atomique entre colonnes. Cela est particulièrement utile dans les bases temporelles pour gérer des relations qui évoluent dans le temps.

Lorsque l'on associe des valeurs à des périodes de temps grâce à des dates de début et de fin, on peut utiliser la valeur "NULL" en date de fin pour exprimer une période en cours.

