def main():
    plate = input("Plate: ")
    if is_valid(plate):
        print("Valid")
    else:
        print("Invalid")


def is_valid(sentence):

    conditions = {
        "1" : False,
        "2" : False,
        "3" : False,
        "4" : False,
        "5" : False,
    }

    # “All vanity plates must start with at least two letters.”
    if sentence[0:2].isalpha() :
        conditions["1"] = True
    # “… vanity plates may contain a maximum of 6 characters (letters or numbers) and a minimum of 2 characters.”
    if 2 <= len(sentence) <= 6 :
        conditions["2"] = True

    # “Numbers cannot be used in the middle of a plate; they must come at the end.
    i = 0
    for i in range(len(sentence)):
        if sentence[i].isdigit() == False:
            conditions["3"] = True
        else :
            if i == len(sentence)-1:
                conditions["3"] = True
                break
            else:
                i += 1
                if sentence[i].isdigit() == True:
                    conditions["3"] = True
                    i -= 1
                elif sentence[i].isdigit() == False :
                    conditions ["3"] = False
                    break

    # The first number used cannot be a ‘0’.”
    j = 0
    for j in range (len(sentence)):
        if sentence[j].isdigit() == False:
            conditions["4"] = True
        else :
            if sentence[j] == "0" :
                conditions ["4"] = False
                break
            else:
                conditions["4"] = True
                break

    # “No periods, spaces, or punctuation marks are allowed.”
    if sentence.isalnum():
        conditions["5"] = True


    if all(value for value in conditions.values()):
        return True
    else :
        return False

if __name__ == "__main__":
    main()
