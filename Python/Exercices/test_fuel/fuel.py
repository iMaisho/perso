def main():
    percentage = convert(input("Fraction: "))
    tank_level = gauge(percentage)
    print(tank_level)


def convert(input):
    ints = input.split("/")
    if int(ints[1]) == 0:
        raise ZeroDivisionError
    elif int(ints[0]) > int(ints[1]):
        raise ValueError
    else:
        while True:
            try:
                fraction = float(int(ints[0])/int(ints[1]))*100
            except ValueError:
                raise ValueError
            return fraction


def gauge(result):
    if 100 >= result >= 99:
        return "F"
    elif result <= 1:
        return "E"
    else:
        return str(round(result))+"%"


if __name__ == "__main__" :
    main()
