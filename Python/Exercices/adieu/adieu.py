import inflect

p = inflect.engine()

list = []

while True :
    try :
        name = input("Name: ")
        list.append(name)

    except EOFError:
            names = p.join(list)
            print(f"Adieu, adieu, to {names}")
            break
