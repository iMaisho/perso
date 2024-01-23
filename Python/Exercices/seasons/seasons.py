from datetime import date
import re
import inflect
import sys


def main():
    userinput = input("Date of birth: ")
    birthdate = convert(userinput)
    alive = delta(birthdate)
    answer = str.capitalize(words(alive))
    print(f"{answer} minutes")


def convert(s):
    try:
        matches = re.search(r"^([0-2][0-9]{3})-(0[1-9]|1[0-2])-([0-2][0-9]|3[0-1])$", s)
        year = int(matches.group(1))
        month = int(matches.group(2))
        days = int(matches.group(3))
        return date(year, month, days)
    except:
        sys.exit("Invalid date")


def delta(d):
    return date.today() - d


def words(s):
    p = inflect.engine()
    return p.number_to_words(int(s.total_seconds() / 60), andword="")


if __name__ == "__main__":
    main()
