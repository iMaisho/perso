# SQL Avancé

## Les vues

Une vue est le résultat d'une requête que l'on peut stocker sous forme de tableau, afin d'effectuer de nouvelles requêtes sur cette dernière. Elle sera stockée sur le serveur, à côté des tables.

```SQL
CREATE OR REPLACE VIEW vue_personnes AS
SELECT
UCASE(nom) as nom,
prenom,
CONCAT_WS(' ',prenom, UCASE(nom)) as nom_complet,
YEAR(CURDATE()) - YEAR(date_naissance) as age
FROM personnes;
```

On peut les utiliser pour la sécurité/confidentialité en n'autorisant les SELECT que sur les vues.

Elle est modifiable dans certaines conditions, mais ce n'est pas très utile.

## Les conditions

### IF : Condition Unique

```SQL
IF(condition, valeur si vrai, valeur si faux)
```
```SQL
SELECT
nom,
IF(age < 18, 'mineur', 'majeur') AS statut
FROM personnes;
```

### CASE : Conditions multiples

```SQL
CASE
WHEN condition1 THEN valeur
WHEN condition2 THEN valeur
ELSE valeur par défaut
END
```

```SQL
SELECT nom,
CASE
    WHEN age BETWEEN 0 AND 5 THEN 'bébé'
    WHEN age BETWEEN 5 AND 13 THEN 'enfant'
    WHEN age BETWEEN 13 AND 18 THEN 'ado'
    ELSE
    'adulte'
END as tranche_age
FROM vue_personnes
GROUP BY tranche_age
ORDER BY
    CASE
        WHEN age BETWEEN 0 AND 5 THEN 1
        WHEN age BETWEEN 5 AND 13 THEN 2
        WHEN age BETWEEN 13 AND 18 THEN 3
        ELSE 4
    END
```

### COALESCE

Permet de spécifier une valeur lorsqu'une colonne est nulle. Très utile pour les regroupements avec `WITH ROLLUP`

**A RECHERCHER**

### Variables de session

Permet de créer une variable qui sera utilisable de requête en requête. Une session s'arrête lorsqu'on quitte notre connexion à la BDD.

```SQL 
SET @nom_variable1 := valeur,
@nom_variable2 := valeur;
```

```SQL
-- Permet de numéroter nos lignes, peu importe notre order by ou les trous dans notre ID
SET @rang := 0;
SELECT *, (@rang:= @rang +1) as rang FROM personnes;
```

### Sous-requête

Une requête peut remplacer une valeur, une table ou une liste de valeurs.

Si on en a régulièrement besoin, on peut se poser la question de mettre en place une vue.

#### Sous-requête non corrélée 

```SQL
SELECT
    YEAR(date_vente) as année,
    COUNT(*) as nb,
    COUNT(*)/(SELECT COUNT(*) FROM ventes)
    as ratio
FROM ventes
GROUP BY YEAR(date_vente)
```

Le résultat de `(SELECT COUNT(*) FROM ventes)` n'a pas de lien avec le reste de la requête. Il sera donc calculé une seule fois.

#### Sous requête corrélée

```SQL
SELECT
c.id_client,
c.nom,
c.prenom,
    ( SELECT MAX(commandes.date_commande) FROM commandes
    WHERE commandes.id_client=c.id_client
) as date_derniere_commande
FROM clients as c
```
Ici, la requête `SELECT MAX(commandes.date_commande) FROM commandes WHERE commandes.id_client=c.id_client` est corrélée au client et donc sera calculée pour chaque ligne de la requête.

C'est très lent, mais parfois c'est la seule possibilité.

#### (NOT) Exists

Permet d'utiliser un booléen sur le résultat ou non d'une requête pour afficher ou non la ligne

```SQL
SELECT
    clients.id_client,
    clients.nom,
    clients.prenom
FROM clients
WHERE
EXISTS(SELECT commandes.id_commande FROM commandes
WHERE commandes.id_client = clients.id_client);
```

### Union

L'union fusionne plusieurs requêtes en une seule, pour cela il faut respecter les règles suivantes :

- toutes les requêtes doivent retourner le même nombre de colonnes
- les types des colonnes doivent être compatibles
- les noms des colonnes sont déterminés par la première requête

Par exemple on pourrait avoir plusieurs tables d'évènements (Commades, Emission de facture, Appel Téléphonique) qui auraient en commun des choses comme la date ou le client.

On pourrait créer une table évènement par client qui ferait un historique des intéractions avec un client en particulier.

```SQL
SELECT
    id_client as id,
    nom,
    cp,
    'client' as categorie
FROM clients
UNION
SELECT
    id_vendeur,
    nom,
    cp,
    'vendeur'
FROM vendeurs
ORDER BY cp;
```

### ANY et ALL

ANY = Renvoie TRUE si égal à au moins une des valeurs
ALL = Renvoie TRUE si égal à toutes les valeurs

## Procédures stockées

On fait du traitement procédural à l'intérieur de SQL (qui lui, est déclaratif).

Certains disent que c'est une mauvaise idée, car on devrait traiter notre procédural au niveau de l'application, et ça peut être source de confusion (En cas de bug, devoir vérifier dans le code de l'appli ET dans les procédures stockées)

Ca peut quand même permettre d'avoir une sécurité renforcée.



