import re
import sys


def main():
    print(count(input("Text: ")))


def count(s):
    number = len(re.findall(r"\bum\b", s, re.IGNORECASE))
    return number


if __name__ == "__main__":
    main()
