def main():
    greeting = input("Greeting : ")
    price = value(greeting)
    print(f"${price}")


def value(answer):

    greeting = str.lower(answer).replace(" ", "")
    #Verify that answer is hello or starts with an h, and bill accordingly
    if greeting[:5] == "hello" :
        price = 0
        return price
    elif greeting[:1] == "h" :
        price = 20
        return price
    else :
        price = 100
        return price


if __name__ == "__main__":
    main()
