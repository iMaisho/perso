def main():

    x = 50

    while x > 0:
        print("Amount Due:", x)
        value = int(input("Insert Coin: "))
        if value == 25:
            x = x-25
        elif value == 10:
            x = x-10
        elif value == 5:
            x = x-5
    print ("Change Owed:" , -x)

main()
