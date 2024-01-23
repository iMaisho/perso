import random


def main():

    tries = 0
    score = 0
    level = get_level()
    for i in range(10):
        x = generate_integer(level)
        y = generate_integer(level)
        while True:

            answer = int(input(f"{x} + {y} = "))

            if answer == x+y:
                tries = 0
                score += 1
                break
            else:
                print("EEE")
                tries += 1

            if tries == 3 :
                print(f"{x} + {y} = ", x + y)
                tries = 0
                break
    print(f"Score: {score}")


def get_level():
    try:
        level = int(input("Level: "))
        if 0 < level <= 3:
            return level
        else:
            raise ValueError
    except ValueError :
        main()


def generate_integer(level):

    if level == 1:
        int = random.randint(0,9)
    elif level == 2:
        int = random.randint(10,99)
    elif level == 3:
        int = random.randint(100,999)
    return int






if __name__ == "__main__":
    main()
