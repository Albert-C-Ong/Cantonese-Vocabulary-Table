"""
Written by Albert Ong

Created: 2026.04.07
"""

import requests
from bs4 import BeautifulSoup
import time
import re
from pypinyin import pinyin, Style


def get_wiktionary_data(word):
    url = f"https://en.wiktionary.org/wiki/{word}"
    headers = {'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)'}
    
    try:
        response = requests.get(url, headers=headers)
        if response.status_code != 200:
            return None
    except Exception:
        return None

    soup = BeautifulSoup(response.content, 'html.parser')
    
    traditional = word 
    pinyin_text = ""
    jyutping = ""
    definition = ""

    pinyin_text = " ".join(
        syllable[0] for syllable in pinyin(traditional, style=Style.TONE)
    )

    for li in soup.find_all(["li", "dd"]):
        text = li.get_text()
        if "Jyutping" in text and ":" in text:
            raw_jyutping = text.split(":")[-1].strip()
            jyutping = raw_jyutping.split('(')[0].split('[')[0].strip()

            if " / " in jyutping:
                jyutping = jyutping.split(" / ")[0]

            jyutping = re.sub(r'-\d+$', '', jyutping)

            break

    ol = soup.find("ol")
    if ol:
        first_li = ol.find("li", recursive=False)
        if first_li:
            definition = first_li.get_text().split('\n')[0].strip()

            definition = re.sub(r'\([^()]*\)', '', definition)
            definition = " ".join(definition.split())
            definition = definition.replace("'", "''").replace(";", ",")

    return {
        "traditional": traditional,
        "pinyin": pinyin_text,
        "jyutping": jyutping,
        "english": definition
    }

# --- Generation ---

words_to_scrape = ["你好",
                    "廣東話", 
                    "電腦"]

print("INSERT INTO vocabulary VALUES")

rows = []
for word in words_to_scrape:
    data = get_wiktionary_data(word)
    if data:        
        row = f"('{data['traditional']}', NULL, '{data['jyutping']}', '{data['pinyin']}', '{data['english']}', '', '', NULL, NULL)"
        rows.append(row)
    time.sleep(0.5) 

if rows:
    print(", \n".join(rows) + "\n;")
else:
    print("-- No data found.")


