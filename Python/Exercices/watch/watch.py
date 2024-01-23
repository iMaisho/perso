import re
import sys


def main():
    print(parse(input("HTML: ")))


def parse(s):
    if matches := re.search(r"^.*https?://(?:www\.)?youtube\.com/embed/([^\"]*)\".*$", s):
        return f"https://youtu.be/" + matches.group(1)
    else:
        return None


if __name__ == "__main__":
    main()
