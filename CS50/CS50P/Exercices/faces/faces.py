def main():
    #Ask user to write a sentence
    sentence = input("Write anything here, i will convert smileyfaces into emojis : ")
    sentence = convert(sentence)
    print(sentence)

def convert(sentence):
# Create Lists of smileys and emojis
    smiley = [":)", ":("]
    emoji = ["\U0001F642", "\U0001F641"]

# Check for smileys in sentence then replace it by emoji and return sentence
    for i in range(len(smiley)):
        if smiley[i] in sentence:
            sentence = sentence.replace(smiley[i], emoji[i])
    return sentence

main()
