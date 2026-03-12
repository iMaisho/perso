# Introduction

UX : Ensemble des sensations liées à votre produit.

1. **Utilisabilité / Intuitivité**  
Facilité avec laquelle un utilisateur peut accomplir ses tâches. Simple à apprendre / efficace à utiliser / mémorable.  
Le but est de comprendre les besoins et d'y répondre, pour créer de la loyauté.  
*Exemple Snap vs WhatsApp* : Snap est perçu comme plus instantané/temps réel, WhatsApp comme plus sérieux. Donc même un même utilisateur séparera naturellement ses usages.

2. **Accessibilité**  
Utilisable par le plus grand nombre, y compris personnes handicapées (visuel, auditif, moteur, cognitif).  
Exemples : contraste adapté, attributs `alt` sur les images, navigation clavier.

3. **Désirabilité**  
Liée au design, au ton de la marque et à l'aspect émotionnel. Incite l'utilisateur à utiliser le produit même si des alternatives existent.

---

- **UX = stratégie globale** : structure, logique, psychologie.  
- **UI = exécution visuelle** : apparence, interactions, couleurs, typographies, icônes.

## L'importance de l'UX

Une bonne UX permet de :
- Augmenter la satisfaction des utilisateurs.
- Réduire les coûts (moins de refontes après coup).
- Renforcer la crédibilité (produit fiable = confiance).
- Se démarquer de la concurrence (facteur différenciant).

## Personas et Parcours Utilisateur

- **Persona** = archétype fictif d'utilisateur.  
Nom, âge, métier, objectifs, motivations, frustrations.  
Le but est de déclencher l’empathie pour mieux concevoir.  
⚠️ Le persona reste itératif (il évolue avec les données collectées, sondages, analytics...).

- **Parcours utilisateur (User Journey)** = représentation visuelle des étapes d’un utilisateur pour atteindre un objectif.  
Montre ses actions, pensées, émotions à chaque étape (du besoin → satisfaction).  
Il peut y avoir plusieurs parcours par persona.

---

# Recherche Utilisateur

La **UX Research** sert à comprendre les besoins réels et définir ses personas.  
Méthodes principales :

- **Quantitatives (Combien ?)**  
    - Analytics (clics, temps passé, taux de rebond...).
    - Sondages/questionnaires (échelles de Likert, choix multiples).

- **Qualitatives (Pourquoi ? Comment ?)**  
    - Entretiens utilisateurs (semi-directifs, empathie ++).
    - Observation (voir ce que les gens font réellement, pas seulement ce qu’ils disent).

👉 Ces méthodes se combinent. Mais avant de choisir, il faut définir ce qu’on cherche à apprendre :
- Qu’est-ce que je sais déjà ?
- Qu’est-ce que j’ai besoin de savoir ?
- Quelles hypothèses je veux tester ?
- Comment les résultats guident mes décisions ?

Objectifs de recherche = **SMART** (Spécifiques, Mesurables, Actionnables, Pertinents, Temporels).

---

# Analyse & Synthèse

C’est la phase où les données brutes deviennent exploitables.

- **Regrouper les données** : notes, enregistrements, réponses de sondages.
- **Affinity mapping** : post-its → regroupés par thèmes (ex. "navigation compliquée").
- **Codage thématique** : étiqueter les données qualitatives (ex. tag "prix élevé").

### Pain points & Opportunités

- **Pain points** = frustrations rencontrées (ex. formulaire trop long, appli lente).
- **Opportunités** = chaque douleur → solution potentielle (connexion Google, optimisation de perf, etc.).

### Affinage Personas & User Journeys

Les données enrichissent les personas et parcours (on peut ajouter émotions, frustrations réelles...).

### User Stories & Job Stories

- **User Story** (format Agile) :  
"En tant que [utilisateur], je veux [action] afin de [bénéfice]".  
Ex : "En tant que voyageur fréquent, je veux sauvegarder mes destinations pour les retrouver vite."

- **Job Story** (Jobs To Be Done) :  
"Quand [situation], je veux [motivation], afin de [résultat]".  
Ex : "Quand j’ai faim en ville, je veux trouver un resto rapidement afin de gagner du temps."

---

# Architecture de l’Information

C’est l’art d’organiser le contenu pour que l’utilisateur trouve facilement ce qu’il cherche.

- **Hiérarchie** : du général au particulier (ex. vêtements → hommes/femmes → hauts/bas).
- **Taxonomie** : classement avec des tags (ex. chaussures par type, marque, taille).
- **Ontologie** : relations plus complexes (ex. modèle A est une version du modèle B).

### Flowcharts & Sitemaps

- **Flowchart** = visualise étapes d’un parcours (ajout panier → paiement, etc.).
- **Sitemap** = carte hiérarchique de toutes les pages (utile avant dev).

---

# Conception UI

L’UI = apparence + interactions.

### Éléments clés
- Boutons (clairs, explicites).
- Formulaires (simples, feedback erreurs).
- Navigation (visible, cohérente).
- Typographie (lisibilité, hiérarchie visuelle).
- Couleurs (signalétique, hiérarchie, ambiance).

### Méthode CRAP
- **Contraste** (mettre en avant ce qui compte).
- **Répétition** (cohérence, professionnalisme).
- **Alignement** (structure nette).
- **Proximité** (éléments liés = regroupés).

### Cohérence visuelle
- Réduit la charge cognitive.
- Renforce la marque.
- Inspire confiance (évite impression amateur).

### Wireframes & Prototypes
- **Wireframe** = squelette (noir & blanc, se concentre sur disposition/logique).
- **Prototype basse fidélité** = wireframes cliquables pour tester le flux utilisateur.
- **Outils** : papier/crayon, Figma, Sketch, Adobe XD, Miro.

---

# Design Visuel & Branding

C’est la mise en beauté et la cohérence de l’interface.

### Couleurs
- Bleu = confiance, sérieux.  
- Rouge = urgence, énergie.  
- Vert = santé, nature.  
- Jaune = optimisme, créativité.  
- Noir = luxe, élégance.

⚠️ Toujours vérifier contrastes/accessibilité.

### Typographie
- Lisibilité (taille, interlignage, sans-serif pour écran).
- Personnalité (serif = classique, sans-serif = moderne, manuscrite = friendly...).
- Hiérarchie visuelle (titres > sous-titres > texte).

### Icônes & Images
- Icônes = actions/catégories (style cohérent, reconnaissables).
- Images = renforcer l’histoire, qualité ++.

### Style Guide & Design System
- **Guide de style** = règles fixes (polices, couleurs, logos...).
- **Design system** = composants réutilisables (boutons, formulaires...) → cohérence + gain de temps.

### Maquettes & Prototypes haute fidélité
- Maquette = version réaliste avec couleurs, typographies, composants finaux.
- Prototype haute fidélité = interactions réalistes (animations, transitions, feedback visuels).

---

# Tests Utilisateurs & Itérations

Objectif : vérifier si un produit répond aux besoins **dans des conditions réelles**.

### Bénéfices
- Réduire les risques.
- Améliorer l’expérience.
- Aligner les équipes.
- Valider la pertinence.

### Types de tests
- **Usability testing** : tâches à réaliser (modéré / non modéré).
- **A/B testing** : comparer deux versions et voir laquelle convertit mieux.
- **Évaluation heuristique** : experts qui évaluent selon des principes établis.

### Sessions de test
1. Définir les objectifs.  
2. Créer des scénarios réalistes.  
3. Recruter participants (5-8 suffisent pour 80% des problèmes).  
4. Mener le test (penser à voix haute, observer sans guider).  
5. Analyser (qualitatif + quantitatif).

### Collecte & analyse des retours
- Tableau récap (tâche / actions / verbatims / problèmes / sévérité).
- Regrouper les problèmes similaires → patterns.
- Prioriser par sévérité + impact.
- Formuler recommandations concrètes.

---

# Conclusion

L’UX et l’UI ne sont pas que du design "joli" :  
C’est un processus complet (recherche → analyse → conception → tests → itérations) qui vise à **créer une expérience cohérente, efficace et plaisante**.

Un bon produit, c’est un équilibre :  
- utile,  
- utilisable,  
- désirable,  
- accessible.  

C’est là que se joue la différence entre une appli qu’on utilise par obligation… et une qu’on aime vraiment utiliser.
