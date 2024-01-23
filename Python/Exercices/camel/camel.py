def main():
    name = input("Camel case : ")
    snake_case(name)

def snake_case(n):
    # Séparer le mots en lettres
    n = list(n)
    # Pour chaque majuscule, remplacer par _minuscule
    for i in range(len(n)):
        if n[i].isupper():
            n[i] = str.lower("_" + n[i])
    # Concatener
    n = "".join(n)

    print(n)



main()
