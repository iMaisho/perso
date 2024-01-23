
#Ask user for a string then get rid of spaces and lowercase it
answer = str.lower(input("What is the Answer to the Great Question of Life, the Universe, and Everything? ")).replace(" ", "")

#Verify that answer is 42
match answer :
    case "42" | "forty-two" | "fortytwo":
        print("Yes")
    case _:
        print("No")
