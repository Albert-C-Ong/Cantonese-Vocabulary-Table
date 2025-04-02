"""
Written by Albert Ong

Created: 2025.02.12
"""
import sqlite3
import spellchecker
from pathlib import Path
import string 
import re
import os

os.chdir("/var/www/html/Cantonese-Vocabulary-Table/database")
print(os.getcwd())

def check_english_column_for_typos(db_path, table_name):
    spell = spellchecker.SpellChecker()
    
    conn = sqlite3.connect(db_path)
    cursor = conn.cursor()
    
    typos_found = set()
    
    cursor.execute("SELECT English FROM vocabulary WHERE English IS NOT NULL;")
    texts = cursor.fetchall()

    cleaned_texts = []
    for text in texts:
        cleaned_text = str(text)
        cleaned_text = cleaned_text.replace('<br>', ' ')
        cleaned_text = cleaned_text.replace('-', ' ')
        cleaned_text = re.sub(r'[^a-zA-Z0-9 ]+', '', cleaned_text)
        cleaned_text = cleaned_text.translate(str.maketrans('', '', string.punctuation))
        cleaned_texts.append(cleaned_text)

    # print(cleaned_texts)
    
    typos_found = set()
    for text in cleaned_texts:
        # No need to index text[0] here since cleaned_texts contains strings directly
        words = text.split()
        misspelled = spell.unknown(words)
        typos_found.update(misspelled)
    
    conn.close()
    return typos_found

def main():
    db_path = "database.db"
    table_name = "vocabulary"
    
    if not Path(db_path).exists():
        print(f"Database file not found: {db_path}")
        return
    
    try:
        typos = check_english_column_for_typos(db_path, table_name)
        
        if not typos:
            print("No typos found in the English column!")
            return
            
        print("\nPotential typos found in English column:")
        print("Misspelled words:")
        for typo in typos:
            print(typo)
                
    except sqlite3.Error as e:
        print(f"Database error: {e}")
    except Exception as e:
        print(f"Error: {e}")

if __name__ == "__main__":
    main()





