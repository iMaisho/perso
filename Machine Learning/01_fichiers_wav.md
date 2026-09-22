# Les fichiers WAV et leur chargement avec librosa

## Structure d'un fichier WAV

Un fichier `.wav` (PCM, non compressé) contient deux parties :

1. **Un en-tête** : métadonnées telles que la fréquence d'échantillonnage, le nombre de canaux (mono/stéréo), la profondeur en bits (souvent 16 bits, parfois 24), le format d'encodage.
2. **Les données audio brutes** : un tableau de valeurs (samples), une valeur par échantillon et par canal. Chaque valeur représente l'amplitude du signal à un instant donné.

La profondeur en bits du fichier source (ex. 16 bits = 65536 niveaux d'amplitude possibles) est une caractéristique du fichier sur le disque, indépendante de la façon dont on le manipule ensuite en mémoire.

## Fréquence d'échantillonnage (sample rate)

- En musique/production audio : 44.1 kHz ou 48 kHz, pour couvrir toute la bande audible (~20 kHz) en respectant le théorème de Nyquist (fréquence d'échantillonnage ≥ 2 × fréquence max à capturer).
- En traitement automatique / ML (MIR - Music Information Retrieval) : `librosa.load()` sous-échantillonne par défaut à **22050 Hz**. Ce choix est un compromis :
  - l'information discriminante pour des tâches comme la classification de genre se trouve surtout dans les basses/moyennes fréquences,
  - diviser le sample rate par 2 réduit d'autant la quantité de données à traiter (extraction de features et entraînement plus rapides), sans perte significative de performance pour ce type de tâche.

## `librosa.load()` : le tuple `(y, sr)`

```python
y, sr = librosa.load("chemin/vers/fichier.wav")
```

- `sr` : la fréquence d'échantillonnage (sample rate), en Hz. Exemple : `22050`.
- `y` : le tableau numpy des échantillons audio (waveform temporelle).

### Le tableau `y`

Exemple observé : `<class 'numpy.ndarray'> (661794,) float32`

- **Shape `(661794,)`** : nombre total d'échantillons dans le tableau.
  - Relation avec le temps : `durée (secondes) = shape[0] / sr`
  - Exemple : `661794 / 22050 ≈ 30 secondes` → cohérent avec les extraits de 30 secondes du dataset GTZAN.
- **dtype `float32`** : les valeurs sont normalisées entre **-1.0 et 1.0**, indépendamment du format d'origine du fichier (16 bits, 24 bits...). `librosa` convertit systématiquement en float32 au chargement.
  - Pourquoi float32 et pas un autre type ?
    - `float64` doublerait la mémoire utilisée pour une précision inutile (le bruit de quantification du fichier source, souvent 16 bits, est déjà plus grossier que ce que float32 peut représenter).
    - `float16` serait insuffisant : les traitements à venir (FFT, etc.) accumulent des erreurs d'arrondi qui deviendraient problématiques.
  - float32 est donc le standard de facto en traitement du signal numérique, pas un choix spécifique à cet exercice.

## Point clé à retenir

**Ne pas confondre :**
- la **définition (bit depth) du fichier .wav** sur le disque (propriété du fichier source, ex. 16 bits int),
- et le **dtype du tableau numpy** retourné par `librosa.load()` (propriété du tableau en mémoire après décodage/normalisation, toujours float32 par défaut).

Pour connaître la vraie définition du fichier source, il faut inspecter le fichier lui-même (ex. module `wave` de Python, ou `soundfile.info()`), pas le tableau retourné par `librosa.load`.

## Prochaine étape

Le tableau brut `y` (661794 valeurs par extrait) n'est pas directement exploitable tel quel par un modèle de classification. Prochaine étape : extraction de features (MFCC, spectrogramme, etc.).
