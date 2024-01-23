#Ask user for a string then get rid of spaces and lowercase it
name = str.lower(input("File name : ")).replace(" ", "")

if name.endswith(".gif"):
   print("image/gif")
elif name.endswith(".jpg") or name.endswith(".jpeg"):
    print("image/jpeg")
elif name.endswith(".png"):
    print("image/png")
elif name.endswith(".pdf"):
    print("application/pdf")
elif name.endswith(".txt"):
    print("text/plain")
elif name.endswith(".zip"):
    print("application/zip")
else:
    print("application/octet-stream")

#THIS IS A TEST I'VE MADE TO TRY AND USE LISTS, MY ITERATIONS SOMETIMES MADE IT BETTER SOMETIMES MADE IT WORSE
#I'M LEAVING IT HERE FOR POTENTIAL REVIEW

#fileExtensions = [".gif", ".jpg", ".jpeg", ".png", ".pdf", ".txt", ".zip"]
#mediaTypes = ["image/gif", "image/jpeg", "image/jpeg", "image/png", "application/pdf", "text/plain", "application/zip"]
#isOnTheList = True

#for i in range(len(fileExtensions)):
#    if name.endswith(fileExtensions[i]):
#        name = mediaTypes[i]
#        break
#    else:
#        isOnTheList = False

#if isOnTheList = False:
#   name = "application/octet-stream"
#else:
#    name = name

#print(name)

