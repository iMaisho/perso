def main():
    time = input("What time is it ? ")

    time = convert(time)

    if 7 <= time <= 8:
        print("breakfast time")
    elif 12 <= time <= 13:
        print("lunch time")
    elif 18 <= time <= 19:
        print("dinner time")


def convert(time):

    if time.endswith(" a.m."):
        time = time[:-5]
        x, y = time.split(":")
        x = float(x)
        y = float(y)/60
        time = x+y

    elif time.endswith(" p.m."):
        time = time[:-5]
        x, y = time.split(":")
        x = float(x)*2
        y = float(y)/60
        time = x+y

    else :
        x, y = time.split(":")
        x = float(x)
        y = float(y)/60
        time = x+y

    return time

#    x, y = time.split(":")
#   x = float(x)
#    y = float(y)/60
#    time = x+y
#    return time


if __name__ == "__main__":
    main()
