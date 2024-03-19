from fpdf import FPDF

def main():
    name = input("Name: ")
    pdf = FPDF()
    pdf.add_page()

    pdf.image("shirtificate.png",30 ,75 ,150)

    pdf.set_font("helvetica", "B", 30)
    pdf.cell(0, 50, "CS50 Shirtificate", align="C")

    pdf.set_font("helvetica", "B", 20)
    pdf.set_text_color(255, 255, 255)
    pdf.cell(-190, 250, f"{name} took CS50", align="C")

    pdf.output("shirtificate.pdf")

if __name__ == "__main__":
    main()
