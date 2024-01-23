import re
import sys


def main():
    print(convert(input("Hours: ")))


def convert(s):
    if matches := re.search(r"^(1[0-2]|[0-9]):([0-5][0-9]) ([AP]M) to (1[0-2]|[0-9]):([0-5][0-9]) ([AP]M)$", s):
        startHour = int(matches.group(1))
        startMinute = int(matches.group(2))
        startMeridiem = matches.group(3)
        endHour = int(matches.group(4))
        endMinute = int(matches.group(5))
        endMeridiem = matches.group(6)
    elif matches := re.search(r"^(1[0-2]|[0-9]) ([AP]M) to (1[0-2]|[0-9]) ([AP]M)$", s):
        startHour = int(matches.group(1))
        startMinute = 00
        startMeridiem = matches.group(2)
        endHour = int(matches.group(3))
        endMinute = 00
        endMeridiem = matches.group(4)
    else:
        raise ValueError

    if startMeridiem == "AM" and startHour == 12:
        startHour = 00

    if startMeridiem == "PM":
        if startHour <12:
            startHour = startHour +12
        elif startHour == 12:
            pass

    if endMeridiem == "AM" and endHour == 12:
        endHour = 00

    if endMeridiem == "PM":
        if endHour < 12:
            endHour = endHour + 12
        elif endHour == 12:
            pass


    return f"{startHour:02}:{startMinute:02} to {endHour:02}:{endMinute:02}"



...


if __name__ == "__main__":
    main()
