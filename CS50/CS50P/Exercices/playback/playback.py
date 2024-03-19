# Ask user to write a sentence
sentence = input("Write anything here, i will slow it down for you... kind : ")

#Isolate words in a list, then concatenate them with ... in between them

words = sentence.split()
slowedSentence = "...".join(words)

print(slowedSentence)
