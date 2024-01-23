def main():
    tweet = input("Input: ")
    twt = shorten(tweet)
    print("Output:",twt)


def shorten(word):
    twt = ""
    vowels = ["a", "A", "e", "E", "i", "I", "o", "O", "u", "U"]
    for letter in word:
        if letter not in vowels:
            twt += letter
    return twt


if __name__ == "__main__":
    main()
