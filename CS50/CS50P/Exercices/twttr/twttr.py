tweet = input("Input: ")
twt = ""
vowels = ["a", "A", "e", "E", "i", "I", "o", "O", "u", "U"]
for letter in tweet:
    if letter not in vowels:
        twt += letter

print("Output: ", twt)


