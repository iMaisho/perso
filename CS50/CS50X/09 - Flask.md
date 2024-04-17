# Flask

La semaine dernière, nous nous sommes penchés sur les sites web, qui sont plutôt statiques. Cette semaine nous allons nous pencher sur les applications web, qui sont plus dynamiques.

Un URL avait tendance à se présenter comme ceci :

**https://www.domain.com/folder/file.html**

Aujourd'hui nous verrons qu'on peut se passer de ces contraintes, en utilisant des paths, ou des routes.

Un input en guise d'URL se présente comme ça :

**?key=value**, séparés par des & si on veut en mettre plusieurs.

Par exemple, google.com/search?q=cats

## MicroFramework

Un framework est conçu pour résoudre des problèmes particuliers beaucoup plus simplement.

Par convention dans Flask, on aura dans notre programme un fichier python **app.py** et un dossier **templates/** qui contiendra nos fichiers HTML, CSS etc..

On aura aussi un fichier **requirements.txt** pour appeller les librairies externes au programme, et un dossier **static/** pour les fichiers CSS et JS, les images etc...

### Les bases :

```python
from flask import Flask, render_template, request

app = Flask(__name__)


@app.route("/")
def index():
    return render_template("index.html")
```

**app.py :** Ce bout de code nous permet, lorsque l'on souhaite utiliser Flask pour héberger son site sur un serveur temporaire en utilisant _run flask_, de faire en sorte que "domain.com/" affiche "domain.com/index.html".

## Comment faire pour rendre cet HTML dynamique ?

```html
<!DOCTYPE html>

<html lang="en">
  <head>
    // Compatibilité mobile
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <title>hello</title>
  </head>
  <body>
    hello, {{ placeholder }}
  </body>
</html>
```

La syntaxe {{ }} nous permet d'intégrer une variable dans notre fichier HTML. Il nous suffit ensuite d'ajouter cette ligne dans le fichier app.py

```python
name = request.args["name"]
return render_template("index.html", placeholder=name)
```

L'idée est que si on ajoute dans l'URL "domain.com/?name=David", la page qui s'affichera dira non plus "Hello world" mais "Hello David"

Cependant, si on visite "domain.com/", on obtient une erreur 400, car le serveur n'a pas réussi à nous fournir une page HTML fonctionnelle. Pour éviter ce cas, on peut tout simplement insérer une valeur par défaut dans le code python :

```python
if "name" in request.args:
    name = request.args["name"]
else:
    name = "world"
```

Mais une façon plus simple d'arriver à ce résultat est d'utiliser la fonction get qui vient avec request.args. Cette fonction prends 2 arguments : le nom de la key que l'on cherche dans l'URL et une valeur en cas d'abscence de cette key ("None" par défaut.)

```python
name = request.args.get("name", "world")
```

Pour que la valeur attendue des placeholders soit plus compréhensive dans le fichier HTML, on viendra souvent leur donner le nom de la variable souhaitée :

```HTML
<body>
    hello, {{ name }}
</body>
```

Ce qui rend le fichier python un peu plus confus :

```python
name = request.args.get("name", "world")
return render_template("index.html", name=name)
```

### Changer l'URL automatiquement

Dans le monde réel, personne n'ajoute son nom dans l'URL pour que le site l'affiche, on va utiliser un formulaire :

```HTML
<form action="/greet"   method="get">
    <input autocomplete="off" autofocus name="name" placeholder="Name" type="text">
    <button type="submit">Greet</button>
</form>
```

Ce formulaire ajoutera automatiquement "/greet?name=David" à l'URL quand on l'aura envoyé. Pour l'instant on a pas implémenté "/greet", donc ça nous renvoie une erreur 404.

On l'implémente dans le fichier app.py :

```python
from flask import Flask, render_template, request

app = Flask(__name__)


@app.route("/")
def index():
    return render_template("index.html")

@app.route("/greet")
def greet():
    name = request.args.get("name", "world")
    return render_template("greet.html", name=name)
```

On crée le fichier "greet.html" dans notre dossier "/templates", et on y met notre version précédente de l'HTML

```HTML
<body>
    hello, {{ name }}
</body>
```

### Eviter la duplication grâce à JINJA

On se retrouve avec deux fichiers HTML quasi-identiques, dont seul le contenu du body change.

On veut éviter ça, car dupliquer un fichier c'est compliqué le fait de faire des changements etc...

Pour faire cela, on va créer un troisième fichier HTML, qu'on appellera "layout.html" par convention.

On va copier le contenu commun à nos pages dans celui-ci et ajouter cette syntaxe à l'endroit qui change, dans notre cas le body :

```HTML
<body>
    {% block body%}{% endblock %}
</body>
```

En gros on crée un placeholder pour un bloc de code, grâce à la syntaxe de JINJA

On va ensuite dans chacunes de nos pages qui veulent utiliser ce layout, on supprime tout leur contenu sauf le bloc qui change, et on ajoute cette syntaxe :

```HTML
{% extends "layout.html" %}

{% block body %}

    CONTENU QUI CHANGE

{% endblock %}
```

### Cacher les valeurs de l'URL

Retrouver ces valeurs dynamiques dans l'URL peut être très pratique, pour envoyer une recherche google à un ami par exemple. Cela permet de conserver les paramètres de recherches, afin que la page que notre ami voit soit la même que celle que l'on a vu.

Cependant, dans le cas des mots de passe, des informations bancaires etc.. Il vaudrait mieux que ces données restent privées.

En changeant la méthode "get" en "post", on résoud ce problème :

```HTML
<form action="/greet"   method="post">
    <input autocomplete="off" autofocus name="name" placeholder="Name" type="text">
    <button type="submit">Greet</button>
</form>
```

Pour ne pas obtenir une erreur 405, il faut autoriser cette méthode dans app.py :

```python
@app.route("/greet", methods=["POST"])
def greet():
    name = request.args.get("name", "world")
    return render_template("greet.html", name=name)
```

La valeur par défaut est ["GET"].

Cependant, vu qu'il n'y a plus la key "name" dans l'URL, request.args retourne "world" dans le contenu HTML.

On doit donc utiliser une autre fonction, request.form

```python
@app.route("/greet", methods=["POST"])
def greet():
    name = request.form.get("name", "world")
    return render_template("greet.html", name=name)
```

### Une seule route pour les deux méthodes

Tout ce qu'on a fait jusqu'ici fonctionne parfaitement, mais c'est un peu dommage d'avoir deux routes. Cela voudrait dire que pour chaque formulaire supplémentaire sur la page il faudrait créer deux routes supplémentaires, c'est plus difficile à lire, à comprendre et à modifier.

On peut donc regrouper nos deux routes comme ceci :

```python
@app.route("/", methods = ["GET", "POST"])
def index():
    if request.method == "POST":
        name = request.form.get("name", "world")
        return render_template("greet.html", name=name)
    return render_template("index.html")
```

En complément, on retire le **action="/greet"** de notre fichier HTML.

### Un petit bug

Dans la fonction get() ci-dessus, on avait ajouté la valeur par défaut "world" au cas où le formulaire serait renvoyé vide. Cependant ce n'est pas le comportement réel de la fonction.

Si le formulaire est renvoyé vide, la valeur de name sera "", un caractère vide. Et donc sur la page suivante on affichera "hello, ".

Pour remédier à ce problème, on peut supprimer la valeur par défaut pour name, et au contraire ajouter cette condition dans notre fichier greet.html :

```HTML
{% extends "layout.html" %}

{% block body %}

    hello
        {% if name %}
            {{ name }}
        {% else %}
            world
        {% endif %}

{% endblock %}
```

### Validation server-side

Bien que notre prototype fonctionne, on a toujours un soucis. Nos vérifications sont effectuées du côté du client, ce qui signifie qu'en inspectant la page et en modifiant l'HTML, on peut bidouiller les résultats.

Ca pourrait nous permettre de changer les résultats possibles d'une liste de choix, de se connecter à un compte sans mot de passe...

Il faut donc résoudre ce problème en effectuant des vérifications du côté du serveur.

Partons de cet exemple de formulaire, pour s'inscrire à une sport donné dans une liste :

```HTML
{% extends "layout.html" %}

{% block body %}
    <h1>Register</h1>
    <form action="/register" method="post">
        <input autocomplete="off" autofocus name="name" placeholder="Name" type="text">
        <select name="sport">
            <option disabled selected value="">Sport</option>
            <option value="Basketball">Basketball</option>
            <option value="Soccer">Soccer</option>
            <option value="Ultimate Frisbee">Ultimate Frisbee</option>
        </select>
        <button type="submit">Register</button>
    </form>
{% endblock %}
```

Pour éviter que quelqu'un ajoute son sport à sa liste, on peut essayer de sortir ce champ de sélection du code HTML.

Pour commencer, on vient créer une liste dans app.py. Elle contiendra nos sports, et on la passe comme argument dans la fonction render_template :

```python
SPORTS = ["Basketball", "Soccer", "Ultimate Frisbee"]

@app.route("/")
def index():
    return render_template("index.html", sports=SPORTS)
```

On vient ensuite modifier notre fichier HTML pour itérer sur les éléments de cette liste :

```HTML
<select name="sport">
    <option disabled selected value="">Sport</option>
    {% for sport in sports %}
        <option value="{{ sport }}">{{ sport }}</option>
    {% endfor %}
</select>
```

Il nous faut enfin vérifier du côté du serveur si la valeur de sport est valide. On peut venir modifier app.py :

```python
@app.route("/register", methods=["POST"])
def register():

    # Validate submission
    if not request.form.get("name") or request.form.get("sport") not in SPORTS:
        return render_template("failure.html")

    # Confirm registration
    return render_template("success.html")
```

### Autres possibilités

On peut utiliser un bouton "radio" pour avoir un aspect de QCM plutôt que de menu déroulant

```HTML
<input name = "sport" type="radio" value ="{{ sport }}"> {{ sport }}
```

On peut utiliser des checkboxs pour permettre de répondre 0, 1 ou plusieurs réponses

```HTML
<input name = "sport" type="checkbox" value ="{{ sport }}"> {{ sport }}
```

Cependant, notre python actuel ne permet de vérifier qu'une valeur, on doit donc modifier notre système de vérification :

```python
@app.route("/register", methods=["POST"])
def register():

    # Validate submission
    if not request.form.get("name")
        return render_template("failure.html")
    for sport in request.form.getlist("sport"):
        if sport not in SPORTS:
            return render_template("failure.html")

    # Confirm registration
    return render_template("success.html")
```

On peut utiliser un dictionnaire pour stocker ces paires nom:sport.

```python
REGISTRANTS = {}

...

REGISTRANTS[name] = sport
```

Même si l'action du bouton est d'envoyer sur la route `register`, on peut utiliser la fonction de Flask `redirect` pour renvoyer sur une autre page, par exemple la liste des personnes enregistrées qu'on aurait créée en HTML dynamique.

```python
    # Confirm registration
    return redirect("/registrants")


@app.route("/registrants")
def registrants():
    return render_template("registrants.html", registrants=REGISTRANTS)
```

Pour l'instant, la liste est stockée dans la RAM, donc elle n'est pas permanente. En cas d'arrêt du serveur, ou d'autre problème, les données seront perdues.

### Utiliser SQL pour stocker les données

SQL est un des rares cas où CS5O continue de nous fournir leur module pour travailler, car ce n'est pas simple de setup un projet avec SQL.

```python
from CS50 import SQL

db = SQL("sqlite:///name.db")
```

La database a été créée avec 3 colonnes, ID, name, sport.

Dans register, on vient inclure le fait de l'ajouter au tableau :

```python
@app.route("/register", methods=["POST"])
def register():

    # Validate submission
    name = request.form.get("name")
    sport = request.form.get("sport")
    if not name or sport not in SPORTS:
        return render_template("failure.html")

    # Remember registrant
        db.execute("INSERT INTO registrants (name, sport) VALUES(?, ?)", name, sport)

    # Confirm registration
    return redirect("/registrants")
```

Pour récupérer les données de la base et les injecter dans notre code HTML sous la forme d'un dictionnaire, on ajoute une ligne de code à registrants:

```python
@app.route("/registrants")
def registrants():
    registrants = db.execute("SELECT * FROM registrants")
    return render_template("registrants.html", registrants=registrants)
```

Chacune des personnes qui seront ajoutées à la base de données aura un ID unique qui lui sera attribuée, ce qui permettra de traiter leurs données sans problème, même si elles ont le même nom par exemple.

Imaginons qu'on souhaite ajouter la fonctionnalité de désinscription :

On ajoute à chaque élément de la liste ce bouton liée à ces fonctions:

```html
<form action="/deregister" method="post">
  <input name="id" type="hidden" value="{{ registrant.id }}" />
  <button type="submit">Deregister</button>
</form>
```

```python
@app.route("/deregister", methods=["POST"])
def deregister():

    # Forget registrant
    id = request.form.get("id")
    if id:
        db.execute("DELETE FROM registrants WHERE id = ?", id)
    return redirect("/registrants")
```

### Cache & Cookies

Quand on se connecte à un site, le navigateur va envoyer une requête "Set Cookies" au serveur, qui nous retourne une key-value pair avec un identifiant unique.
Dépendemment de la date d'expiration de cet identifiant, la prochaine fois qu'on se rend sur ce site notre navigateur va envoyer cette key-value pair dans une requête "Cookies", le serveur va vérifier si elle existe, et si c'est le cas, cela prouve notre "identité numérique", et le serveur nous laisse entrer sans avoir à taper nos identifiants.

Effectivement, il garde en mémoire l'état de notre session précédente sur le site.

Dans Flask, il y a une fonction qui s'appelle `session` qui va nous permettre de configurer ces conditions.

```python
from flask import session
from flask_session import Session

# Permet d'effacer les cookies à la fermeture du navigateur
app.config["SESSION_PERMANENT"] = False
# Permet de conserver le contenu de notre session sur le serveur, et pas dans le cookie
app.config["SESSION_TYPE"] = "filesystem"
# Activer Session
Session(app)
```

Imaginons qu'on setup un formulaire de connexion

session agit comme un dictionnaire (aka. "REGISTRANTS = {}"), sauf qu'au lieu d'avoir un dictionnaire global, il ne fournit à l'utilisateur que les données liées à son compte

```python
@app.route("/login", methods=["GET", "POST"])
def login():
    if request.method == "POST":
        session["name"] = request.form.get("name")
        return redirect("/")
    return render_template("login.html")


@app.route("/logout")
def logout():
    session.clear()
    return redirect("/")
```

## Une approche plus moderne

Plutôt que d'avoir à modifier l'URL, ce qui résulte en l'écran qui recharge une page, une approche plus moderne est d'utiliser AJAX (Asynchronus Javascript And XML). Utiliser Javascript pour obtenir plus de données du serveur.

```html
<!DOCTYPE html>

<html lang="en">
  <head>
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <title>shows</title>
  </head>
  <body>
    <input autocomplete="off" autofocus placeholder="Query" type="search" />

    <ul></ul>

    <script>
      let input = document.querySelector("input");
      input.addEventListener("input", async function () {
        let response = await fetch("/search?q=" + input.value);
        let shows = await response.text();
        document.querySelector("ul").innerHTML = shows;
      });
    </script>
  </body>
</html>
```

Ceci est la version en interne d'une API, on pourrait imaginer aller chercher les réponses sur un autre serveur à l'aide d'une API.

Le plus commun n'est pas de recevoir du HTML comme dans ce cas, où on reçoit des <li></li>, mais plutôt du JSON
