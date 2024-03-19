import requests
import sys
import json


response = requests.get("https://api.coindesk.com/v1/bpi/currentprice.json").json()
rate = float(response["bpi"]["USD"]["rate"].replace(",", ""))
if len(sys.argv) == 2:
    try:
        price = float(sys.argv[1])*rate
        print(f"${price:,.4f}")
    except requests.RequestException:
        sys.exit("Did not get a response from the server")
    except ValueError:
        sys.exit("Command-line argument is not a number")
else:
    sys.exit("Missing command-line argument")




