# Knowledge

## Introduction

**Knowledge based agents :** Un agent qui résonne en se basant sur des représentations interne de la connaissance.

> **Exemple :**
>
> - **P :** S'il n'a pas plu, Harry est allé voir Hagrid aujourd'hui
> - **Q :** Harry est allé voir Hagrid ou Dumbledore aujourd'hui, mais pas les deux
> - **R :** Harry est allé voir Dumbledore aujourd'hui
>
> La combinaison de Q & R nous indique que *"Harry n'est pas allé voir Hagrid aujourd'hui"*, qui devient notre affirmation **S**.
>
> En combinant P & S, on peut conclure qu'**il a plu aujourd'hui**.

**Sentence :** Une affirmation à propos du monde dans un langage de représentation de connaissance (*knowledge representation language*).

Il existe plusieurs types de logiques, on va commencer avec la logique de propositions.

---

## Propositional Logic

### Symboles

On utilise différents symboles pour communiquer des idées.

Pour commencer, on utilise des lettres capitales pour représenter nos *sentences* qu'on appelle *propositional symbols* (**P**, **Q**, **R**).

| Symbole | Nom             | Signification                                                                                              |
| :-----: | --------------- | ---------------------------------------------------------------------------------------------------------- |
|   `¬`   | Not             | Négation                                                                                                   |
|   `∧`   | And             | Conjonction                                                                                                |
|   `∨`   | Or              | Disjonction                                                                                                |
|   `→`   | Implication     | Si P = true alors Q = true. Si P = false on n'a pas d'information sur Q                                    |
|   `↔`   | Biconditional   | P ↔ Q veut dire que Q = true si et seulement si P = true, et inversement                                  |

### Définitions clés

**Modèle :** Un modèle assigne une valeur de vérité à chaque *propositional symbol*.

> *P : Il pleut* — *Q : On est Mardi*
>
> Un modèle de ce "monde" pourrait être `{P = true, Q = false}`

**Knowledge base (KB) :** Un set de sentences que notre modèle sait vraies.

**Entailment** (⊨) : α ⊨ β veut dire que dans **tous** les modèles pour lesquels α est vraie, β est aussi vraie.

> Entailment veut dire *implication* en français, mais c'est une implication **absolue**, pas logique.
> Par exemple, si α = *on est un mardi de janvier* alors β = *on est en janvier*, c'est une règle inébranlable.

**Inference :** La capacité à créer de nouvelles phrases à partir des anciennes (cf. l'exemple avec Harry).

---

### Exemple complet

**Sentences :**

- **P :** On est mardi
- **Q :** Il pleut
- **R :** Harry va courir

**KB (Knowledge Base) :**

- `(P ∧ ¬Q) → R` — Si on est Mardi et qu'il ne pleut pas, alors Harry va courir.
- `P` (= true est implicite)
- `¬Q`

**Inference :** → `R`

---

### Principe de base de l'algorithme d'inférence

On cherche à obtenir de l'information sur une requête **α**.

La question à laquelle doit répondre l'algorithme, c'est : **Est-ce que KB ⊨ α ?** C'est-à-dire, à partir des informations qu'on a, peut-on conclure sur la véracité de α ?

#### Model Checking

Pour déterminer si KB ⊨ α :

1. Énumère tous les modèles possibles
2. Si dans **tous** les modèles où KB = true, α = true, alors KB ⊨ α
3. Sinon, KB ¬⊨ α

> **Exemple :**
>
> **Sentences :** P (On est mardi), Q (Il pleut), R (Harry va courir)
>
> **KB :** `(P ∧ ¬Q) → R`, `P`, `¬Q`
>
> **Query :** `R`

|   P   |   Q   |   R   |   KB    |
| :---: | :---: | :---: | :-----: |
| false | false | false | false   |
| false | false | true  | false   |
| false | true  | false | false   |
| false | true  | true  | false   |
| true  | false | false | false   |
| **true** | **false** | **true** | **true** |
| true  | true  | false | false   |
| true  | true  | true  | false   |

La seule ligne qui correspond à notre KB est la 6ᵉ, et dans ce cas R est true. On peut donc affirmer que **KB ⊨ R**.

---

### Exemple de code — Situation de départ (Harry)

> - **P :** S'il n'a pas plu, Harry est allé voir Hagrid aujourd'hui
> - **Q :** Harry est allé voir Hagrid ou Dumbledore aujourd'hui, mais pas les deux
> - **R :** Harry est allé voir Dumbledore aujourd'hui

On utilise une implémentation custom de nos symboles de logique :

```python
rain = Symbol("rain")             # Il pleut.
hagrid = Symbol("hagrid")         # Harry est allé voir Hagrid.
dumbledore = Symbol("dumbledore") # Harry est allé voir Dumbledore.

knowledge = And(
    Implication(Not(rain), hagrid),
    Or(hagrid, dumbledore),
    Not(And(hagrid, dumbledore)),
    dumbledore
)

# A partir de notre KB, peut-on savoir s'il pleut ?
model_check(knowledge, rain)
```

**Implémentation de l'algorithme de model checking :**

```python
def model_check(knowledge, query):
    def check_all(knowledge, query, symbols, model):
        """Fonction récursive qui vérifie si knowledge ⊨ query, dans un modèle donné"""

        # Si on a assigné une valeur à tous nos symboles
        if not symbols:

            # Si knowledge = true, alors query doit aussi être true
            if knowledge.evaluate(model):
                return query.evaluate(model)
            # Si knowledge != true, on se fiche de la valeur de query
            return True

        else:

            # On choisit l'un des symboles qui restent
            remaining = symbols.copy()
            p = remaining.pop()

            # On crée un modèle ou ce symbole est true
            model_true = model.copy()
            model_true[p] = True

            # On crée un modèle où ce symbole est faux
            model_false = model.copy()
            model_false[p] = False

            # S'assure que l'implication fonctionne dans les deux modèles
            return (
                check_all(knowledge, query, remaining, model_true)
                and check_all(knowledge, query, remaining, model_false)
            )

    # Récupère tous les symboles qui sont dans la KB et dans la query
    symbols = set.union(knowledge.symbols(), query.symbols())

    # Vérifie que knowledge ⊨ query
    return check_all(knowledge, query, symbols, dict())
```

Cela revient à générer notre tableau vu plus tôt, à ignorer les lignes qui ne collent pas à notre KB, et à vérifier la valeur de notre query dans toutes les lignes restantes pour voir si on a une relation **knowledge ⊨ query**.

|   rain   |  hagrid  | dumbledore |   KB    |
| :------: | :------: | :--------: | :-----: |
|  false   |  false   |   false    |  false  |
|  false   |  false   |    true    |  false  |
|  false   |   true   |   false    |  false  |
|  false   |   true   |    true    |  false  |
|   true   |  false   |   false    |  false  |
| **true** | **false** |  **true**  | **true** |
|   true   |   true   |   false    |  false  |
|   true   |   true   |    true    |  false  |

---

### Exemple de code — Cluedo simplifié

On part avec 3 personnes, 3 salles et 3 armes. Une personne, une salle et une arme sont sélectionnées aléatoirement pour définir le crime de la partie.

**Sentences :** mustard, plum, scarlet, ballroom, kitchen, library, knife, revolver, wrench

**KB :**

- `(mustard ∨ plum ∨ scarlet)`
- `(ballroom ∨ kitchen ∨ library)`
- `(knife ∨ revolver ∨ wrench)`

Au fur et à mesure de la partie, les joueurs obtiennent des informations de manière asymétrique :

- On peut vérifier une carte et avoir un indice clair : `¬plum`
- Un autre joueur peut vérifier une des cartes de sa proposition, ce qui nous informe qu'au moins un des éléments est faux : `¬mustard ∨ ¬library ∨ ¬revolver`

```python
mustard = Symbol("mustard")
plum = Symbol("plum")
scarlet = Symbol("scarlet")
characters = [mustard, plum, scarlet]

ballroom = Symbol("ballroom")
kitchen = Symbol("kitchen")
library = Symbol("library")
rooms = [ballroom, kitchen, library]

knife = Symbol("knife")
revolver = Symbol("revolver")
wrench = Symbol("wrench")
weapons = [knife, revolver, wrench]

symbols = characters + rooms + weapons


def check_knowledge(knowledge):
    for symbol in symbols:
        if model_check(knowledge, symbol):
            termcolor.cprint(f"{symbol}: YES", "green")
        elif not model_check(knowledge, Not(symbol)):
            print(f"{symbol}: MAYBE")


knowledge = And(
    Or(mustard, plum, scarlet),
    Or(ballroom, kitchen, library),
    Or(knife, revolver, wrench)
)

# On peut ajouter des clauses au And de notre KB grâce à la méthode add
knowledge.add(Not(mustard))

check_knowledge(knowledge)
```

En ajoutant suffisamment de clauses au cours de la partie, l'algorithme pourra inférer le contenu de l'enveloppe dès que possible.

---

### Exemple — Les 4 maisons

> - Gilderoy, Minerva, Pomona & Horace appartiennent chacun à une maison différente (Griffondor, Serpentard, Poufsouffle, Serdaigle)
> - Gilderoy est à Griffondor ou à Serdaigle
> - Pomona n'est pas à Serpentard
> - Minerva est à Griffondor.

**Symboles :** GilderoyGriffondor, GilderoySerpentard, GilderoyPoufsouffle, GilderoySerdaigle, MinervaGriffondor, etc.

**KB :**

- `PomonaSerpentard → ¬PomonaPoufsouffle` (et pareil pour toutes les personnes / maisons)
- `PomonaSerpentard → ¬GilderoySerpentard` (et pareil — ces sentences représentent la 1ʳᵉ affirmation)
- `GilderoyGriffondor ∨ GilderoySerdaigle`
- `¬PomonaSerpentard`
- `MinervaGriffondor`

**Implémentation Python :**

```python
people = ["Gilderoy", "Minerva", "Pomona", "Horace"]
houses = ["Griffondor", "Serpentard", "Poufsouffle", "Serdaigle"]

symbols = []
knowledge = And()

for person in people:
    for house in houses:
        symbols.append(Symbol(f"{person}{house}"))

# Chaque personne est dans une maison
for person in people:
    knowledge.add(Or(
        Symbol(f"{person}Griffondor"),
        Symbol(f"{person}Serpentard"),
        Symbol(f"{person}Poufsouffle"),
        Symbol(f"{person}Serdaigle")
    ))

# Chaque personne est dans une seule maison
for person in people:
    for house1 in houses:
        for house2 in houses:
            if house1 != house2:
                knowledge.add(
                    Implication(
                        Symbol(f"{person}{house1}"),
                        Not(Symbol(f"{person}{house2}"))
                    )
                )

# Chaque personne est dans une maison différente
for house in houses:
    for person1 in people:
        for person2 in people:
            if person1 != person2:
                knowledge.add(
                    Implication(
                        Symbol(f"{person1}{house}"),
                        Not(Symbol(f"{person2}{house}"))
                    )
                )

knowledge.add(Or(Symbol("GilderoyGriffondor"), Symbol("GilderoySerdaigle")))
knowledge.add(Not(Symbol("PomonaSerpentard")))
knowledge.add(Symbol("MinervaGriffondor"))

for symbol in symbols:
    if model_check(knowledge, symbol):
        print(symbol)
```

---

### Inference Rules

Des règles qui, à partir de connaissances définies dans notre KB (au-dessus de la ligne), permettent de générer de nouvelles connaissances (en dessous de la ligne).

---

#### Modus Ponens

> Si il pleut, Harry reste à l'intérieur. Il pleut. → **Harry est à l'intérieur.**

$$
\frac{\alpha \to \beta, \quad \alpha}{\beta}
$$

---

#### And Elimination

> Harry est ami avec Ron et Hermione. → **Harry est ami avec Hermione.**

$$
\frac{\alpha \wedge \beta}{\beta}
$$

---

#### Double Negation Elimination

> Ce n'est pas vrai que Harry n'a pas passé le test. → **Harry a passé le test.**

$$
\frac{\lnot(\lnot\alpha)}{\alpha}
$$

---

#### Implication Elimination

> Si il pleut, alors Harry reste à l'intérieur. → **Il ne pleut pas ou Harry est à l'intérieur.**

$$
\frac{\alpha \to \beta}{\lnot\alpha \vee \beta}
$$

---

#### Biconditional Elimination

> Harry reste à l'intérieur si et seulement si il pleut. → **S'il pleut, Harry est à l'intérieur, et si Harry est à l'intérieur, il pleut.**

$$
\frac{\alpha \leftrightarrow \beta}{(\alpha \to \beta) \wedge (\beta \to \alpha)}
$$

---

#### De Morgan's Law

> Ce n'est pas vrai qu'à la fois Harry et Ron ont réussi le test. → **Harry n'a pas réussi ou Ron n'a pas réussi.**

$$
\frac{\lnot(\alpha \wedge \beta)}{\lnot\alpha \vee \lnot\beta}
$$

> Ce n'est pas vrai que Harry ou Ron a réussi le test. → **Harry n'a pas réussi et Ron n'a pas réussi.**

$$
\frac{\lnot(\alpha \vee \beta)}{\lnot\alpha \wedge \lnot\beta}
$$

---

#### Distributive Law

$$
\frac{\alpha \wedge (\beta \vee \gamma)}{(\alpha \wedge \beta) \vee (\alpha \wedge \gamma)}
$$

$$
\frac{\alpha \vee (\beta \wedge \gamma)}{(\alpha \vee \beta) \wedge (\alpha \vee \gamma)}
$$

---

#### Unit Resolution Rule

$$
\frac{\alpha \vee \beta, \quad \lnot\alpha}{\beta}
$$

Forme généralisée :

$$
\frac{\alpha \vee \beta_1 \vee \beta_2 \vee \ldots \vee \beta_n, \quad \lnot\alpha}{\beta_1 \vee \beta_2 \vee \ldots \vee \beta_n}
$$

Avec deux clauses :

$$
\frac{\alpha \vee \beta, \quad \lnot\alpha \vee \gamma}{\beta \vee \gamma}
$$

Forme généralisée :

$$
\frac{\alpha \vee \beta_1 \vee \ldots \vee \beta_n, \quad \lnot\alpha \vee \gamma_1 \vee \ldots \vee \gamma_n}{\beta_1 \vee \ldots \vee \beta_n \vee \gamma_1 \vee \ldots \vee \gamma_n}
$$

---

### Theorem Proving

Si on se base sur les *search problems*, on peut traiter nos connaissances comme tel :

| Concept                  | Équivalent                                      |
| ------------------------ | ----------------------------------------------- |
| Initial state            | KB de départ                                    |
| Actions                  | Inference Rules                                 |
| Transition Model         | KB après inférence                              |
| Goal test                | Vérifier l'affirmation qu'on cherche à prouver  |
| Path cost function       | Nombre d'étapes dans la preuve                  |

---

### Conjunctive Normal Form (CNF)

**Clause :** Une disjonction de littéraux (`P`, `Q`, `¬R`, … connectés par `∨`).

La **forme normale conjonctive** est une phrase logique qui est une **conjonction de clauses** (des disjonctions de littéraux reliées par des `∧`).

> **Exemple :** `(A ∨ B ∨ C) ∧ (D ∨ ¬E) ∧ (F ∨ G)`

**Convertir en CNF :**

1. Éliminer les biconditions : `(α ↔ β)` → `(α → β) ∧ (β → α)`
2. Éliminer les implications : `(α → β)` → `¬α ∨ β`
3. Passer les `¬` à l'intérieur des clauses : `¬(α ∧ β)` → `¬α ∨ ¬β`
4. Utiliser la loi de distribution pour réorganiser les `∨` et `∧`

> **Exemple de conversion :**
>
> ```
> (P ∨ Q) → R
>       ↓  élimination implication
> ¬(P ∨ Q) ∨ R
>       ↓  De Morgan
> (¬P ∧ ¬Q) ∨ R
>       ↓  distribution
> (¬P ∨ R) ∧ (¬Q ∨ R)
> ```

#### Factoring

```
P ∨ Q ∨ S
¬P ∨ R ∨ S
───────────
Q ∨ S ∨ R ∨ S  →  Q ∨ R ∨ S  (suppression du S redondant)
```

#### Empty Clause

```
P
¬P
───
()   ← contradiction → résultat = false
```

---

### Inference by Resolution

Pour déterminer si **KB ⊨ α** :

1. Vérifier si `(KB ∧ ¬α)` est une contradiction
   - Si **oui** → KB ⊨ α
   - Si **non** → il n'y a pas d'implication

**Procédure :**

1. Convertir `(KB ∧ ¬α)` en CNF
2. Utiliser la résolution pour produire de nouvelles clauses
3. Si on produit la **clause vide** `()` → contradiction → **KB ⊨ α**
4. Si on ne peut plus produire de nouvelles clauses → pas d'implication

> **Exemple :** Est-ce que `(A ∨ B) ∧ (¬B ∨ C) ∧ (¬C)` implique `A` ?
>
> On ajoute `¬A` à notre KB :
>
> ```
> (A ∨ B) ∧ (¬B ∨ C) ∧ (¬C) ∧ (¬A)
>
> Résolution de (¬B ∨ C) et (¬C)  →  (¬B)
> Résolution de (A ∨ B) et (¬B)   →  (A)
> Résolution de (¬A) et (A)        →  ()   ← contradiction !
> ```
>
> Donc : `((A ∨ B) ∧ (¬B ∨ C) ∧ (¬C)) ⊨ A` ✓

---

## First Order Logic

La *Propositional Logic* peut montrer ses limites dans certains cas, comme dans l'exemple avec les 4 personnes et les 4 maisons, qui nous forçait à avoir **16 symboles** et un très grand nombre de phrases dans notre KB.

La **First Order Logic** nous permet de simplifier cela en ayant deux types de symboles :

| Type                  | Exemples                                                          | Rôle                                               |
| --------------------- | ----------------------------------------------------------------- | -------------------------------------------------- |
| Symboles constants    | Minerva, Pomona, Griffondor, Serpentard…                          | Représentent des **objets**                        |
| Predicate symbols     | `Person()`, `House()`, `BelongsTo()`                              | Fonctions `fn(object) → bool` qui lient les objets |

### Exemples de sentences en FOL

```
Person(Minerva)                        → Minerva est une personne
House(Griffondor)                      → Griffondor est une maison
¬House(Minerva)                        → Minerva n'est pas une maison
BelongsTo(Minerva, Griffondor)         → Minerva appartient à Griffondor
```

---

### Universal Quantification — ∀

`∀` veut dire *"c'est vrai pour toutes les valeurs de"*.

```
∀x. BelongsTo(x, Griffondor) → ¬BelongsTo(x, Poufsouffle)
```

> Pour toutes les valeurs de x, si x appartient à Griffondor, alors x n'appartient pas à Poufsouffle.

---

### Existential Quantification — ∃

`∃` veut dire *"il existe au moins une valeur de x pour laquelle c'est vrai"*.

```
∃x. House(x) ∧ BelongsTo(Minerva, x)
```

> Il existe au moins un objet x qui est une maison et à laquelle Minerva appartient.

---

### Combinaison — chaque personne appartient à une maison

```
∀x. Person(x) → (∃y. House(y) ∧ BelongsTo(x, y))
```

> Pour toute personne x, il existe une maison y à laquelle elle appartient.