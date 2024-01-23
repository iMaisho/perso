import re
import sys


def main():
    print(validate(input("IPv4 Address: ")))


def validate(ip):
    if matches := re.search(
        r"^(?:([0-9]{1,3})\.)(?:([0-9]{1,3})\.)(?:([0-9]{1,3})\.)([0-9]{1,3})$", ip
    ):
        for i in range(1, 5):
            if int(matches.group(i)) <= 255:
                continue
            else:
                return False
        return True
    else:
        return False


if __name__ == "__main__":
    main()
