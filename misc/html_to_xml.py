#!/usr/bin/env python
# -*- coding: utf-8 -*- 

"""
Written by Albert"Anferensis"Ong

Converts HTML tables to XML

Revision: 21.12.2019
"""

def write_text_file(file_name, body):
	"""
	A function that will write a given body of text to a 
	given file name. 
	"""
	file_writer = open(file_name, "w")
	file_writer.write(body)
	file_writer.close()
	
	print("Text saved to file: " + file_name)


html_input = """
<tr> 
<td>水星</td> <td>seoi2 sing1</td> <td>xhuǐ xīng</td> <td>Mercury</td> 
</tr> 
<tr> 
<td>金星</td> <td>gam1 sing1</td> <td>jīn xīng</td> <td>Venus</td> 
</tr> 
<tr> 
<td>地球</td> <td>dei6 kau4</td> <td>dì qiú</td> <td>Earth</td> 
</tr> 
<tr> 
<td>火星</td> <td>fo2 sing1</td> <td>huǒ xīng</td> <td>Mars</td> 
</tr> 
<tr> 
<td>木星</td> <td>muk6 sing1</td> <td>mù xīng</td> <td>Jupiter</td> 
</tr> 
<tr> 
<td>土星</td> <td>tou2 sing1</td> <td>tǔ xīng</td> <td>Saturn</td> 
</tr> 
<tr> 
<td>天王星</td> <td>tin1 wong4 sing1</td> <td>tiān wáng xīng</td> <td>Uranus</td> 
</tr> 
<tr> 
<td>海王星</td> <td>hoi2 wong4 sing1</td> <td>hǎi wáng xīng</td> <td>Neptune</td> 
</tr> 
"""

category = "nouns"
subcategory = "astronomy"
subcategory2 = "planets"

xml_output = ""

html_input = html_input.replace("<tr>", "")
html_input = html_input.replace("</tr>", "")


for line in html_input.splitlines():
  
  if line not in ("", " "):
    
    line = line.split("</td> <td>")
    
    line = "|||||".join(line)
    
    
    line = line.replace("<td>", "")
    line = line.replace("</td>", "")
    
    line_data = line.split("|||||")
    
    if subcategory == None and subcategory2 == None:
      add_xml = "".join(["<word category='", category, "'>\n"])
    elif subcategory2 == None:
      add_xml = "".join(["<word category='", category, "' subcategory='", subcategory,"'>\n"])
    else:
      add_xml = "".join(["<word category='", category, "' subcategory='", subcategory, "' subcategory2='", subcategory2, "'>\n"]) 
    
    
    for num, data in enumerate(line_data):
      
      if num == 0:
        add_xml += "".join(["  <chinese>", data.replace(" ", "").replace("<br>", "&lt;br&gt;"), "</chinese>\n"])
        
      elif num == 1:
        add_xml += "".join(["  <jyutping>", data, "</jyutping>\n"])
        
      elif num == 2:
        add_xml += "".join(["  <pinyin>", data, "</pinyin>\n"])
        
      else:
       add_xml += "".join(["  <english>", data[:-1].replace("<br>", "&lt;br&gt;"), "</english>\n"])
    
    add_xml += "</word>\n"
    
    xml_output += add_xml
    
    # ~ print(" ".join(line_data))


write_text_file("xml_output.txt", xml_output)

