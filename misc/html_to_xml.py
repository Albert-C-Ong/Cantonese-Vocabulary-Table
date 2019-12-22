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
<td>最</td> <td>zeoi3</td> <td>zuì</td> <td>(the) most</td> 
</tr> 
<tr> 
<td>太</td> <td>taai3</td> <td>tài</td> <td>too, very</td> 
</tr> 
<tr> 
<td>仲</td> <td>zung6</td> <td>zhòng</td> <td>still</td> 
</tr> 
<tr> 
<td>未</td> <td>mei6</td> <td>wèi </td> <td>yet</td> 
</tr> 
<tr> 
<td>還</td> <td>waan2</td> <td>hái</td> <td>still, yet</td> 
</tr> 
<tr> 
<td>也</td> <td>jaa5</td> <td>yě</td> <td>also, too</td> 
</tr> 
<tr> 
<td>夠</td> <td>gau3</td> <td>gòu</td> <td>enough</td> 
</tr> 
<tr> 
<td>就</td> <td>zau6</td> <td>jiù</td> <td>then</td> 
</tr> 
<tr> 
<td>再</td> <td>zoi3</td> <td>zài</td> <td>again, once more, another</td> 
</tr> 
<tr> 
<td>從</td> <td>sung4</td> <td>cóng</td> <td>from, by, since, whence, through</td> 
</tr> 
<tr> 
<td>剛</td> <td>gong1</td> <td>gāng</td> <td>just, barely, exactly</td> 
</tr> 
<tr> 
<td>全部</td> <td>cyun4 bou6</td> <td>quán bù</td> <td>all, every</td> 
</tr> 
<tr> 
<td>非常</td> <td>fei1 soeng4</td> <td>fēi cháng</td> <td>very, very much</td> 
</tr> 
<tr> 
<td>之前</td> <td>zi1 cin4</td> <td>zhī qián</td> <td>before</td> 
</tr> 
<tr> 
<td>之後</td> <td>zi1 hau6</td> <td>zhī hòu</td> <td>after</td> 
</tr> 
<tr> 
<td>仲未</td> <td>zung6 mei6</td> <td>zhòng wèi </td> <td>not yet</td> 
</tr> 
<tr> 
<td>通常</td> <td>tung1 soeng4</td> <td>tōng cháng</td> <td>usually, generally</td> 
</tr> 
<tr> 
<td>同埋</td> <td>tung4 maai4</td> <td>tóng mái</td> <td>and, moreover, also</td> 
</tr> 
<tr> 
<td>從來</td> <td>cung4 lai4</td> <td>cóng lái</td> <td>always, never<br>(depending on context)</td> 
</tr> 
<tr> 
<td>從不</td> <td>cong4 bat1</td> <td>cóng bù</td> <td>never</td> 
</tr> 
<tr> 
<td>梗係</td> <td>gang2 hai6</td> <td>gěng xì</td> <td>of course</td> 
</tr> 
<tr> 
<td>當然</td> <td>dong1 jin4</td> <td>dāng rán</td> <td>of course</td> 
</tr> 
<tr> 
<td>梗係</td> <td>gang2 hai6</td> <td>gěng xì</td> <td>must be, definitely</td> 
</tr> 
<tr> 
<td>已經</td> <td>ji5 ging1</td> <td>yǐ jīng</td> <td>already</td> 
</tr> 
<tr> 
<td>大概</td> <td>daai6 koi3</td> <td>dà gài</td> <td>about, approximately, roughly</td> 
</tr> 
<tr> 
<td>其實</td> <td>kei4 sat6</td> <td>qí shí</td> <td>in fact, actually</td> 
</tr> 
<tr> 
<td>完全</td> <td>jyun4 cyun4</td> <td>wán quán</td> <td>completely, totally</td> 
</tr> 
<tr> 
<td>而家</td> <td>ji4 gaa1</td> <td>ér jiā</td> <td>now (spoken)</td> 
</tr> 
<tr> 
<td>現在</td> <td>jin6 zoi6</td> <td>xiàn ​zài</td> <td>not, at present, at the moment<br>(written)</td> 
</tr> 
<tr> 
<td>眼前</td> <td>ngaan5 cin4</td> <td>yǎn​ qián</td> <td>now, at present, before one's eyes</td> 
</tr> 
<tr> 
<td>今晚</td> <td>gam1 maan5</td> <td>jīn wǎn</td> <td>tonight</td> 
</tr> 
<tr> 
<td>每日</td> <td>mui5 jat6</td> <td>měi rì</td> <td>daily, every day</td> 
</tr> 
<tr> 
<td>一齊</td> <td>jat1 cai4</td> <td>yī qí</td> <td>together</td> 
</tr> 
<tr> 
<td>可能</td> <td>ho2 nang4</td> <td>kě néng</td> <td>probably, possibly, might, perhaps</td> 
</tr> 
<tr> 
<td>淨係<br>净係</td> <td>zing6 hai6</td> <td>jìng xì</td> <td>only</td> 
</tr> 
<tr> 
<td>所以</td> <td>so2 ji5</td> <td>suǒ yǐ</td> <td>therefore</td> 
</tr> 
<tr> 
<td>頭先</td> <td>tau4 sin1</td> <td>tóu xiān</td> <td>before, just now, earlier</td> 
</tr> 
<tr> 
<td>一定</td> <td>jat1 ding6</td> <td>yī dìng</td> <td>surely, certainly, must</td> 
</tr> 
<tr> 
<td>就算</td> <td>zau6 syun3</td> <td>jiù suàn</td> <td>even if, given that</td> 
</tr> 
<tr> 
<td>永遠</td> <td>wing5 jyun5</td> <td>yǒng yuǎn</td> <td>forever, always</td> 
</tr> 
<tr> 
<td>未必</td> <td>mei6 bit1</td> <td>wèi bì</td> <td>not necessarily, maybe not</td> 
</tr> 
<tr> 
<td>有時</td> <td>jau5 si4</td> <td>yǒu shí</td> <td>sometimes</td> 
</tr> 
<tr> 
<td>就嚟</td> <td>zau6 lai4</td> <td>jiù lì</td> <td>almost, soon</td> 
</tr> 
<tr> 
<td>平日</td> <td>ping4 jat4</td> <td>píng rì</td> <td>usually, ordinarily<br>(lit. ordinary day)</td> 
</tr> 
<tr> 
<td>平時</td> <td>ping4 si4</td> <td>píng shí</td> <td>normally, usually, ordinarily<br>(lit. ordinary time)</td> 
</tr> 
<tr> 
<td>經常</td> <td>ging1 soeng4</td> <td>jīng cháng</td> <td>often, frequently, regularly</td> 
</tr> 
<tr> 
<td>陣間<br>陣閒</td> <td>zan6 gaan3</td> <td>zhèn jiān</td> <td>soon, later, in a while</td> 
</tr> 
<tr> 
<td>比喻</td> <td>bei2 jyu6</td> <td>bǐ​ yù</td> <td>figuratively</td> 
</tr> 
<tr> 
<td>即刻</td> <td>zik1 hak1</td> <td>jí kè</td> <td>immediately, instantly</td> 
</tr> 
<tr> 
<td>上面</td> <td>soeng5 min6</td> <td>shàng ​miàn</td> <td>above, on top of</td> 
</tr> 
<tr> 
<td>隔離</td> <td>gaak3 lei4</td> <td>gé​ lí</td> <td>next to</td> 
</tr> 
<tr> 
<td>本萊</td> <td>bun2 loi4</td> <td>běn ​lái</td> <td>originally, at first</td> 
</tr> 
<tr> 
<td>順便</td> <td>seon6 bin6</td> <td>shùn​ biàn</td> <td>conveniently, incidentally, in passing</td> 
</tr> 
<tr> 
<td>穩步</td> <td>wan2 bou6</td> <td>wěn bù</td> <td>steadily</td> 
</tr> 
<tr> 
<td>左右</td> <td>zo2 jau6</td> <td>zuǒ yòu</td> <td>about, approximately<br>(lit. left right)</td> 
</tr> 
<tr> 
<td>一直</td> <td>jat1 zik6</td> <td>yī zhí</td> <td>always, all along, constantly</td> 
</tr> 
<tr> 
<td>輕輕</td> <td>heng1 heng1</td> <td>qīng qīng</td> <td>lightly, gently, softly</td> 
</tr> 
<tr> 
<td>首先</td> <td>sau2 sin1</td> <td>shǒu xiān</td> <td>firstly, first of all</td> 
</tr> 
<tr> 
<td>即係</td> <td>zik1 hai6</td> <td>jí xì</td> <td>exactly, precisely the case</td> 
</tr> 
<tr> 
<td>直接</td> <td>zik6 zip3</td> <td>zhí jiē</td> <td>directly</td> 
</tr> 
<tr> 
<td>其中</td> <td>kei4 zung1</td> <td>qí zhōng</td> <td>in, among, therein</td> 
</tr> 
<tr> 
<td>另外</td> <td>ling6 ngoi6</td> <td>lìng wài</td> <td>furthermore, moreover, in addition</td> 
</tr> 
<tr> 
<td>之間<br>之閒</td> <td>zi1 gaan1</td> <td>zhī​ jiān</td> <td>between, among</td> 
</tr> 
<tr> 
<td>馬上</td> <td>maa5 soeng5</td> <td>mǎ​ shàng</td> <td>at once, right away, immediately</td> 
</tr> 
<tr> 
<td>結果</td> <td>git3 gwo2</td> <td>jié guǒ</td> <td>finally, in the end, as a result</td> 
</tr> 
<tr> 
<td>起碼</td> <td>hei2 maa5</td> <td>qǐ​ mǎ</td> <td>at least, at the minimum</td> 
</tr> 
<tr> 
<td>至少</td> <td>zi3 siu2</td> <td>zhì shǎo</td> <td>at least</td> 
</tr>
<tr> 
<td>最多</td> <td>zeoi3 do1</td> <td>zuì duō</td> <td>at most, maximum</td> 
</tr>
<tr> 
<td>最少</td> <td>zeoi3 siu2</td> <td>zuì shǎo</td> <td>at least, minimum</td> 
</tr>
<tr> 
<td>肯定</td> <td>hang2 ding6</td> <td>kěn dìng</td> <td>surely, definitely</td> 
</tr> 
<tr> 
<td>竟然</td> <td>ging2 jin4</td> <td>jìng rán</td> <td>suprisingly, unexpectedly</td> 
</tr>
<tr> 
<td>根本</td> <td>gan1 bun2</td> <td>gēn běn</td> <td>at all, simply, absolutely</td> 
</tr>
<tr> 
<td>特別</td> <td>dak6 bit6</td> <td>tè bié</td> <td>especially, particularly, specially</td> 
</tr>
<tr> 
<td>最後</td> <td>zeoi3 hau6</td> <td>zuì hòu</td> <td>finally, in the end, ulimately</td> 
</tr>
<tr> 
<td>絕對</td> <td>zyut6 deoi3</td> <td>jué duì</td> <td>absolutely, totally, unconditionally</td> 
</tr>
<tr> 
<td>專登</td> <td>zyun1 dang1</td> <td>zhuān dēng</td> <td>on purpose, intentionally, deliberately</td> 
</tr>
<tr> 
<td>如何</td> <td>jyu4 ho4</td> <td>rú hé</td> <td>how (in what manner), how about</td> 
</tr>
<tr> 
<td>按照字面</td> <td>on3 ziu3 zi6 min6</td> <td>àn​ zhào ​zì​ miàn</td> <td>literally<br>(according to the wording)</td> 
</tr> 
"""

category = "adverbs"
subcategory = None

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
    
    if subcategory == None:
      add_xml = "".join(["<word category='", category, "'>\n"])
    else:
      add_xml = "".join(["<word category='", category, "' subcategory='", subcategory,"'>\n"])
    
    
    for num, data in enumerate(line_data):
      
      if num == 0:
        add_xml += "".join(["  <chinese>", data.replace(" ", ""), "</chinese>\n"])
        
      elif num == 1:
        add_xml += "".join(["  <jyutping>", data, "</jyutping>\n"])
        
      elif num == 2:
        add_xml += "".join(["  <pinyin>", data, "</pinyin>\n"])
        
      else:
       add_xml += "".join(["  <english>", data[:-1], "</english>\n"])
    
    add_xml += "</word>\n"
    
    xml_output += add_xml
    
    # ~ print(" ".join(line_data))


write_text_file("xml_output.txt", xml_output)

