def main():
    date = input("Date: ")
    convert(date)


def convert(date):
    months = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
    ]
    try:
        if any(char.isalpha() for char in date):
            if "," in date:
                date = date.replace(",", "")
                date = date.split(" ")
                if int(date[1]) <= 31:
                    for i in range(len(months)):
                        if months[i] == date[0]:
                            i = str(i+1)
                            print(f"{date[2]}-{(i).rjust(2, "0")}-{date[1].rjust(2, "0")}")
                            break
                else:
                    main()
            else:
                main()

        else:
            date = date.replace(" ", "")
            date = date.split("/")
            if int(date[1]) <= 31 and int(date[0]) <= 12:
                print(f"{date[2]}-{date[0].rjust(2, "0")}-{date[1].rjust(2, "0")}")
            else :
                main()
    except:
        main()


main()
