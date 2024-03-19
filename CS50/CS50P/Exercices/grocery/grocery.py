def main():
    list = {
    }

    while True:
        try:
            newItem = str.upper(input())
            if newItem in list:
                list[newItem] += 1
                sorted(list.items(),key=lambda t: t[0])
            else :
                list.setdefault(newItem)
                list[newItem] = 1

        except EOFError:
            for i in sorted(list.keys()):
                print(list[i], i)
            break


main()

