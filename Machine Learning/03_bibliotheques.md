# Les bibliothèques : rôle général en Machine Learning + usage dans ce projet

Ce cours a deux niveaux de lecture pour chaque bibliothèque : **sa place dans l'écosystème ML en général** (pourquoi elle existe, où elle intervient dans un pipeline type), puis **comment on l'utilise concrètement** dans `extract_features.py`.

Un pipeline ML classique ressemble à : **données brutes → prétraitement/feature engineering → entraînement d'un modèle → évaluation → visualisation des résultats**. Chaque bibliothèque ci-dessous se situe à un endroit précis de ce pipeline.

---

## numpy — la fondation numérique de tout l'écosystème

### Rôle général en ML

numpy n'est pas une bibliothèque "de ML" à proprement parler, c'est la **fondation sur laquelle quasiment tout le reste est construit**. Quand tu utiliseras plus tard `pandas` (manipulation de tableaux de données), `scikit-learn` (modèles classiques), ou que tu regarderas sous le capot de `PyTorch`/`TensorFlow`, tu retrouveras systématiquement le même concept central : un **tableau N-dimensionnel** de nombres, sur lequel on applique des opérations mathématiques de façon vectorisée.

**Pourquoi c'est fondamental :** en Python pur, une boucle `for` sur une liste de 10 millions de nombres est lente (l'interpréteur Python traite chaque élément un par un). numpy délègue ces calculs à du code C compilé, optimisé et souvent parallélisé (SIMD, BLAS) — un même calcul peut être 50 à 100x plus rapide. En ML, où on manipule en permanence des millions de valeurs (pixels, échantillons audio, poids de réseaux de neurones...), cette différence de performance n'est pas un détail, c'est ce qui rend le ML praticable.

**Le concept d'axe (`axis`)** que tu as manipulé (`mean(axis=1)`) est une notion que tu retrouveras **partout** en ML, pas juste ici : un tenseur PyTorch/TensorFlow a généralement une dimension "batch" (plusieurs exemples traités en parallèle), une dimension "features", parfois une dimension "temps" ou "canal" (image). Savoir sur quel axe réduire/agréger est une compétence transversale.

Doc générale : https://numpy.org/doc/stable/
Guide "quickstart" (bonne intro si tu veux creuser au-delà de l'usage minimal) : https://numpy.org/doc/stable/user/quickstart.html

### Usage dans `extract_features.py`

- `np.concatenate((a, b, c))` : colle bout à bout plusieurs tableaux le long d'un axe (par défaut axe 0). Utilisé pour fusionner mean/min/max d'une feature, puis pour fusionner les 4 features entre elles en un seul vecteur plat.
- `.mean(axis=1)`, `.min(axis=1)`, `.max(axis=1)` : réduction sur l'axe temporel des features (`(n_coefficients, n_frames)` → `(n_coefficients,)`), pour obtenir un résumé fixe par morceau indépendamment de sa durée exacte.
  Doc : https://numpy.org/doc/stable/reference/generated/numpy.ndarray.mean.html

---

## librosa — feature engineering spécifique au domaine audio

### Rôle général en ML

Contrairement à numpy (généraliste), librosa est une bibliothèque **spécifique à un domaine** : l'audio et le music information retrieval (MIR). Ce type de bibliothèque "métier" existe pour beaucoup de domaines — `OpenCV`/`Pillow` pour l'image, `spaCy`/`NLTK` pour le texte, `librosa` pour l'audio. Leur rôle commun : transformer une donnée brute peu exploitable directement (un fichier audio, une image, du texte) en une représentation numérique exploitable par un modèle.

En audio ML, il existe deux grandes approches, et librosa sert les deux :

1. **Feature engineering manuel** (ce que fait ce tutoriel) : on extrait des caractéristiques choisies à la main par un expert du domaine (MFCC, chroma...), résumées en un vecteur de taille fixe, puis on entraîne un modèle "classique" (régression logistique, petit réseau dense, random forest...) dessus. Avantage : peu de données nécessaires, rapide à entraîner, interprétable. Inconvénient : on impose nos hypothèses sur ce qui est pertinent, on peut perdre de l'info.
2. **Deep learning de bout en bout** : on donne au modèle une représentation moins travaillée (souvent un Mel Spectrogram complet, traité comme une image) et on laisse un CNN apprendre lui-même quelles caractéristiques extraire. librosa sert alors juste à produire ce spectrogramme, sans réduction mean/min/max. Avantage : peut capturer des patterns qu'un humain n'aurait pas pensé à extraire. Inconvénient : demande beaucoup plus de données et de puissance de calcul.

librosa intervient donc à l'étape de **prétraitement/feature engineering**, avant l'entraînement du modèle — jamais pendant l'entraînement lui-même.

Doc générale : https://librosa.org/doc/latest/index.html
Tutoriel officiel (bonne référence si tu veux voir d'autres features que celles utilisées ici) : https://librosa.org/doc/latest/tutorial.html

### Usage dans `extract_features.py`

- `librosa.load(path)` : décode le fichier audio, le normalise en float32 entre -1 et 1, et le rééchantillonne à 22050 Hz par défaut. Retourne `(y, sr)`.
  Doc : https://librosa.org/doc/latest/generated/librosa.load.html
- `librosa.feature.mfcc(y, sr)` — timbre. https://librosa.org/doc/latest/generated/librosa.feature.mfcc.html
- `librosa.feature.melspectrogram(y, sr)` — énergie par bande Mel. https://librosa.org/doc/latest/generated/librosa.feature.melspectrogram.html
- `librosa.feature.chroma_stft(y, sr)` — contenu harmonique/tonal. https://librosa.org/doc/latest/generated/librosa.feature.chroma_stft.html
- `librosa.feature.tonnetz(y, sr)` — relations d'intervalles musicaux. https://librosa.org/doc/latest/generated/librosa.feature.tonnetz.html

Toutes les fonctions `librosa.feature.*` retournent un tableau `(n_features, n_frames)` — d'où la réduction systématique sur `axis=1` (via numpy) ensuite.

### librosa.display

Sous-module dédié à la visualisation, construit sur matplotlib. Importé dans le script mais pas encore utilisé.

Doc : https://librosa.org/doc/latest/display.html — fonction clé : `librosa.display.specshow()`.

---

## matplotlib — visualisation, transversale à tout le pipeline ML

### Rôle général en ML

matplotlib n'est pas non plus une bibliothèque "de ML" — c'est la bibliothèque de visualisation générique de l'écosystème Python scientifique. Mais elle intervient à **plusieurs étapes distinctes** d'un projet ML, ce qui la rend incontournable :

- **En amont (exploration des données / EDA)** : avant même d'entraîner quoi que ce soit, visualiser tes données pour repérer des problèmes — ex. un histogramme du nombre d'exemples par genre pour vérifier que le dataset est équilibré, ou un spectrogramme pour vérifier visuellement qu'un fichier audio n'est pas corrompu/silencieux.
- **Pendant l'entraînement** : tracer les courbes de loss/accuracy au fil des epochs, pour détecter du surapprentissage (overfitting) ou un taux d'apprentissage mal réglé.
- **En aval (évaluation)** : matrices de confusion, courbes ROC, visualisation d'erreurs de classification.

Ce n'est donc pas un détail annexe : savoir visualiser ses données et les résultats d'un modèle fait partie intégrante du travail ML, pas juste une décoration finale.

Doc : https://matplotlib.org/stable/api/pyplot_summary.html
Galerie d'exemples (utile pour trouver le bon type de graphique) : https://matplotlib.org/stable/gallery/index.html

### Usage dans ce projet

Importée mais pas encore utilisée. Utilisation prévue : visualiser un spectrogramme (via `librosa.display.specshow`), et/ou vérifier l'équilibre des classes du dataset (`labels`) avant l'entraînement.

---

## pathlib — utilitaire général, pas spécifique au ML

### Rôle général en ML

pathlib n'a rien de spécifique au ML — c'est un module standard Python pour manipuler des chemins de fichiers. Mais il devient particulièrement pertinent dès qu'un projet ML implique de **parcourir un dataset organisé en dossiers** (ce qui est très courant : un sous-dossier par classe, comme ici avec un dossier par genre musical). Deux raisons d'y prêter attention en contexte ML :

- **Portabilité/reproductibilité** : un script d'entraînement est souvent partagé, exécuté sur une autre machine ou un autre OS (ex. Linux sur un serveur de calcul/cloud). `pathlib` gère les séparateurs de chemin (`/` vs `\`) automatiquement, contrairement à la concaténation manuelle de strings, qui casse en silence en changeant d'OS.
- **Fiabilité sur de gros volumes** : quand on itère sur des milliers de fichiers (comme les ~1000 fichiers de GTZAN), une erreur de concaténation de chemin (comme le guillemet mal placé qu'on a corrigé) peut planter le script après plusieurs minutes de traitement déjà effectué — un coût bien plus élevé que dans un petit script.

Doc : https://docs.python.org/3/library/pathlib.html

### Usage dans `extract_features.py`

- `Path("...")` : crée un objet chemin.
- `directory / genre` : l'opérateur `/` est surchargé pour joindre des segments de chemin proprement (remplace la concaténation manuelle `directory+"/"+genre`, source d'un bug de guillemet mal placé dans une version précédente du script).
- `.iterdir()` : itère sur les entrées (fichiers/dossiers) d'un dossier, en retournant directement des objets `Path` complets — contrairement à `os.listdir()` qui ne retourne que les noms de fichiers, nécessitant une reconstruction manuelle du chemin complet.

---

## Vue d'ensemble : qui fait quoi dans le pipeline

| Étape du pipeline ML | Bibliothèque impliquée |
|---|---|
| Parcourir le dataset (fichiers/dossiers) | `pathlib` |
| Charger et prétraiter la donnée brute (audio) | `librosa` |
| Calculs numériques sur les features extraites | `numpy` |
| Visualiser données/résultats (EDA, debug, évaluation) | `matplotlib` (+ `librosa.display`) |
| *(à venir)* Entraîner un modèle | une bibliothèque de ML (ex. `PyTorch`, mentionné dans le titre du tutoriel) |
