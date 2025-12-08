# Shopify Liquid : Introduction

Guide complet :
https://christhefreelancer.com/shopify-liquid-guide/

## Tags :

`{% %}`
permet d'encapsuler de la logique.

On vient ajouter le nom du tag pour effectuer l'action que l'on souhaite.

- `assign` permet de créer une variable et de lui assigner une valeur

- `for _elem_ in _enum_` + `endfor` permet de loop sur un enumérable

- `if _condition_` + `endif` permet de conditionner l'affichage de l'enfant

- `unless _condition_` + `endunless` permet de conditionner l'affichage de l'enfant à l'inverse de la condition (ex: unless product.available)

- `and` et `or` permettent de chaîner les conditions

- `section _name_` permet d'afficher une section dans notre page

## Filtres :

Vu que Liquid n'est pas un language de programmation, on doit utiliser des filtres pour effectuer des actions sur les variables.
Les filtres sont pipés grâce au symbole `|`

- `plus:` permet de faire une addition (ex : `{% variable = 5 | plus: 5 %}`)

- `split:` permet de séparer une chaine de caractères en précisant la valeur de séparation, et de la convertir en array

- `money` permet de formater un int en prix

## Output :

`{{ }}` permet d'afficher des variables.

On peut ajouter des filtres directement dans les blocs d'output.

## Arrays :

On ne peut pas directement créer de liste en liquid. Pour créer un array, on doit écrire une chaine de caractères contenant nos éléments et générer l'array en la découpant avec une valeur séparatrice.

ex : `{% assign array = "1,2,3,4,5,6" | split: "," %}`

## Objects (Store Data) :

On peut accéder aux données de notre store shopify via le mot clé `collections`

Il s'agit d'un objet global, accessible partout dans notre application.

## JSON Schemas (Theme Data) :

Avant on venait écrire nos options dans le fichier `settings_schema.json` mais apparemment maintenant ça se fait dans l'interface de Shopify

https://help.shopify.com/en/manual/online-store/themes/customizing-themes/theme-editor/theme-settings

En fait pas sûr, bizarrement la doc ne présente que l'edit des valeurs, mais apparemment on peut toujours ajouter des variables customs en éditant le JSON.

Faudrait trouver les différents objects qu'on peut ajouter dans le JSON, mais voilà un exemple :

```json
{
  "id": "color-picker",

  "name": "Colors",
  "settings": [
    {
      "type": "color",
      "id": "link_color",
      "label": "Link Color",
      "default": "#000"
    }
  ]
}
```

Lorsqu'on modifie la valeur de notre variable dans l'interface graphique, ça vient l'écrire dans `settings_data.json`. On peut ensuite venir chercher cette valeur dans nos templates. La clé portera le nom de l'ID définit dans `setting_schema.json`, et sera accessible grâce au global object `settings`

Si on crée une section, elle est générée avec du boilerplate, dont une partie Schema, qui permet de créer des settings propres à cette section via le même process. On pourra accéder à ces variables via l'object global `section.settings`

## Global objects :

- all-products
- pages
- blogs
- articles
- images
- collections
- linklists
- links
- settings

Pour le débug, ça peut être intéressant de directement essayer d'output notre objet, car shopify display `[ObjectType]Drop` et ça nous permet de s'assurer qu'on travaille bien avec le bon type d'objet.
