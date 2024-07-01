import sys
import pdfplumber

def extract_text_from_pdf(pdf_path):
    text = ""
    with pdfplumber.open(pdf_path) as pdf:
        for page in pdf.pages:
            text += page.extract_text()
    return text

def save_text_to_file(text, filename):
    with open(filename, "w", encoding="utf-8") as file:
        file.write(text)

def main():
    if len(sys.argv) != 3:
        print("Usage: python readpdf.py <PDF_file_path> <output_file_name>")
        return

    pdf_file = sys.argv[1]
    output_file = sys.argv[2]

    extracted_text = extract_text_from_pdf(pdf_file)
    save_text_to_file(extracted_text, output_file)
    print(f"Text extracted from PDF and saved to {output_file}")

if __name__ == "__main__":
    main()
