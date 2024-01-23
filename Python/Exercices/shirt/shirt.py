from PIL import Image, ImageOps
import sys
import os


def main():
    if len(sys.argv) < 3:
        sys.exit("Too few command-line arguments")
    elif len(sys.argv) > 3:
        sys.exit("Too many command-line arguments")
    else:
        if os.path.splitext(sys.argv[1])[1] != os.path.splitext(sys.argv[2])[1]:
            sys.exit("Input and output have different extensions")
        else:
            if (
                os.path.splitext(sys.argv[1])[1] == ".jpg"
                or os.path.splitext(sys.argv[1])[1] == ".jpeg"
                or os.path.splitext(sys.argv[1])[1] == ".png"
            ):
                shirt(sys.argv[1], sys.argv[2])
            else:
                sys.exit("Invalid input")


def shirt(a, b):
    try:
        image = Image.open(a)
        shirt = Image.open("shirt.png")
        size = shirt.size
        image = ImageOps.fit(image, size=size)
        image.paste(shirt, shirt)
        image.save(b)
    except FileNotFoundError:
        sys.exit("Input does not exist")


if __name__ == "__main__":
    main()
