#Ask user to write a sentence
expression = input("Expression : ")

x, y, z = expression.split(" ")

x = float(x)
z = float(z)

match y :
    case "+":
        print(float(x+z))
    case "*":
        print(float(x*z))
    case "/":
        print(float(x/z))
    case "-":
        print(float(x-z))


