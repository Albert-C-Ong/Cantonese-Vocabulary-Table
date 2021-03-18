#!/usr/bin/env python
# -*- coding: utf-8 -*- 

"""
Written by Albert"Anferensis"Ong

Created: 2020.12.20
"""

import json
import sys


def write_to_json(filename, word_data):

  filename = "words/" + filename

  if len(word_data) == 5:
    fields = ("chinese", 
              "chinese_variation", 
              "jyutping", 
              "pinyin", 
              "english")
    
  else:
    fields = ("chinese", 
              "jyutping", 
              "pinyin", 
              "english")

  new_word = dict() 

  for index, field in enumerate(fields):
    new_word[field] = str(word_data[index])


  with open(filename) as f:
    
    data = json.load(f)
    data["words"].append(new_word)


  with open(filename, 'w') as f:
    
    json.dump(data, f, indent = 2, ensure_ascii = False)
    
    write_message = "".join(["Wrote ", word_data[0], " to '", filename, "'"])
    print(write_message)
  
  
#=======================================================================


if __name__ == "__main__":
  
  # [chinese, jyutping, pinyin, english, filename]
  # ["", "", "", "", ""],
  
  words = []
  
  for word in words:
    
    filename = word[-1]
    write_to_json(filename, word[:-1])

