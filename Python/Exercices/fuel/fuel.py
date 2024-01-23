def main():
    x = tankLevel(input("Fraction: "))
    print(x)

def tankLevel(input):
    ints = input.split("/")

    while True:
        try:
            result = float(int(ints[0])/int(ints[1]))*100
        except (ValueError, ZeroDivisionError):
            pass
        else :
            if 100 >= result >= 99:
                return "F"
            elif result <= 1:
                return "E"
            elif result < 0 or result > 100:
                pass
            else:
                return str(round(result))+"%"

main()
