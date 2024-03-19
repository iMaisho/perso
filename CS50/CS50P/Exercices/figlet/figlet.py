from pyfiglet import Figlet
import sys
from random import choice

figlet = Figlet()

if len(sys.argv) == 3 and sys.argv[1] in ["-f", "--font"] :
    try :
        f = Figlet(font = sys.argv[2])
        input = input("Input: ")
        print(f.renderText(input))
    except :
        sys.exit("Invalid usage" )

elif len(sys.argv) == 1 :
    input = input("Input: ")
    f = Figlet(font = choice(figlet.getFonts()))
    print(f.renderText(input))

else :
    sys.exit("Invalid usage" )

