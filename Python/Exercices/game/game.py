import random
import sys

def main():
    try:
        level = int(input("Level: "))
        answer = random.randint(1, level)
        verify(answer)
    except ValueError:
        main()

def verify(answer):

    while True:
        guess = int(input("Guess: "))
        if guess == answer:
            sys.exit("Just right!")
        elif guess < answer:
            print("Too small!")
        else:
            print("Too large!")

main()
