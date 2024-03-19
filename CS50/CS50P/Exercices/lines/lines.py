import sys


def main():
    numberOfLines = 0

    if len(sys.argv) < 2:
        sys.exit("Too few command-line arguments")
    elif len(sys.argv) > 2:
        sys.exit("Too many command-line arguements")
    elif sys.argv[1].endswith(".py") == False:
        sys.exit("Not a Python file")
    else:
        try:
            with open(sys.argv[1]) as file:
                lines = file.readlines()
                for line in lines:
                    if line.isspace():
                        pass
                    else:
                        line = line.lstrip()
                        if line.startswith("#"):
                            pass
                        else:
                            numberOfLines += 1
                print(f"{numberOfLines}")

        except FileNotFoundError:
            sys.exit("File does not exist")


if __name__ == "__main__":
    main()
