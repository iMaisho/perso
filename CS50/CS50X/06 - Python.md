# Python

## Différences et points communs avec C

- Pas de truncation

- Même problèmes de précision au niveau des divisions

- Pas d'integer overflow

## Notes

En python, on peut ajouter une condition else à la fin d'une for loop, si on a jamais break.

```python
names = ["Carter", "David", "John"]

name = input("Name: ")

for n in names:
    if names == n:
        print("Found")
        break
else:
    print("Not found")
```