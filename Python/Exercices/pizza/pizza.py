from tabulate import tabulate
import sys


def main():
    menu = []
    if len(sys.argv) < 2:
        sys.exit("Too few command-line arguments")
    elif len(sys.argv) > 2:
        sys.exit("Too many command-line arguments")
    else:
        if sys.argv[1].endswith(".csv"):
            try:
                with open(sys.argv[1]) as file:
                    for line in file:
                        line = line.rstrip()
                        menu.append(line.split(","))
                    print(tabulate(menu, tablefmt="grid", headers="firstrow"))
            except FileNotFoundError:
                sys.exit("File does not exist")
        else:
            sys.exit("Not a CSV file")


if __name__ == "__main__":
    main()
