import sys
import csv


def main():
    if len(sys.argv) < 3:
        sys.exit("Too few command-line arguments")
    elif len(sys.argv) > 3:
        sys.exit("Too many command-line arguments")
    else:
        if sys.argv[1].endswith(".csv") and sys.argv[2].endswith(".csv"):
            scourgify(sys.argv[1], sys.argv[2])
        else:
            sys.exit("Not a CSV file")


def scourgify(a, b):
    with open(b, "w") as newFile:
        fieldnames = ["first", "last", "house"]
        writer = csv.DictWriter(newFile, fieldnames=fieldnames)
        writer.writerow({"first": "first", "last": "last",  "house": "house"})
    try:
        with open(a) as file:
            reader = csv.DictReader(file)
            for row in reader:
                last, first = row["name"].split(",")
                first = first.strip('" ')
                last = last.strip('" ')
                house = row["house"]
                with open(b, "a") as newFile:
                    writer = csv.DictWriter(newFile, fieldnames=fieldnames)
                    writer.writerow({"first": first, "last": last, "house": house})
    except FileNotFoundError:
        sys.exit(f"Could not open{sys.argv[1]}")


if __name__ == "__main__":
    main()
