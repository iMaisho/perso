#Ask user for a string then get rid of spaces and lowercase it
answer = str.lower(input("Greeting : ")).replace(" ", "")

#Verify that answer is hello or starts with an h, and bill accordingly
if answer[:5] == "hello" :
    print("$0")
elif answer[:1] == "h" :
    print("$20")
else :
    print("$100")
