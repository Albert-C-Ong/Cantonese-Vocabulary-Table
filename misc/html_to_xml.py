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



def html_to_xml(html_input, category, subcategory, subcategory2, filename):
  
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
          add_xml += "".join(["  <jyutping>", data.replace("<br>", "&lt;br&gt;"), "</jyutping>\n"])
          
        elif num == 2:
          add_xml += "".join(["  <pinyin>", data.replace("<br>", "&lt;br&gt;"), "</pinyin>\n"])
          
        else:
         add_xml += "".join(["  <english>", data[:-1].replace("<br>", "&lt;br&gt;"), "</english>\n"])
      
      add_xml += "</word>\n"
      
      xml_output += add_xml


  write_text_file(filename, xml_output)

html_input1 = """
<tr>
<td>鳥<br>屌</td> <td>diu2</td> <td>diǎo</td> <td>penis, to fuck</td>
</tr>
<tr>
<td>髒話</td> <td>zong1 waa2</td> <td>zāng huà</td> <td>profanity, obscene language</td>
</tr>
"""

html_input2 = """
<tr> 
<td>俗語</td> <td>zuk6 jyu5</td> <td>sú ​yǔ</td> <td>slang, colloquial speech, common saying</td> 
</tr>
<tr> 
<td>溝女</td> <td>kau1 neoi5</td> <td>gōu nǚ</td> <td>to hit on girls, to pick up girls</td> 
</tr>
<tr> 
<td>菜鳥</td> <td>coi3 niu5</td> <td>cài niǎo</td> <td>newbie, novice, beginner</td> 
</tr>
<tr> 
<td>斷捨離</td> <td>dyun3 se2 lei4</td> <td>duàn shě lí</td> <td>to get rid of things that are no longer needed</td> 
</tr> 
"""

html_input3 = """
<tr> 
<td>病</td> <td>beng6</td> <td>bìng</td> <td>to be sick</td> 
</tr> 
<tr> 
<td>痛</td> <td>tung3</td> <td>tòng</td> <td>to hurt, to cause pain</td> 
</tr>
<tr> 
<td>病重</td> <td>beng6 zung6</td> <td>bìng zhòng</td> <td>to be seriously ill</td> 
</tr>
<tr> 
<td>受傷</td> <td>sau6 soeng1</td> <td>shòu shāng</td> <td>to be injured, to be wounded</td> 
</tr> 
<tr> 
<td>整親</td> <td>zing2 can1</td> <td>zhěng qìng</td> <td>to injure, to get hurt</td> 
</tr> 
<tr> 
<td>咳嗽</td> <td>kat1 sau3</td> <td>ké sou</td> <td>to cough</td> 
</tr> 
<tr> 
<td>流血</td> <td>lau4 hyut3</td> <td>liú xuè</td> <td>to bleed</td> 
</tr> 
<tr> 
<td>嘔吐</td> <td>au1 tou2</td> <td>ǒu tù</td> <td>to vomit</td> 
</tr> 
<tr> 
<td>頭痛</td> <td>tau4 tung3</td> <td>tóu tòng</td> <td>to have a headache</td> 
</tr> 
<tr> 
<td>頭暈</td> <td>tau4 wan4</td> <td>tóu yūn</td> <td>to feel dizzy</td> 
</tr> 
<tr> 
<td>發燒</td> <td>faat3 siu1</td> <td>fā shāo</td> <td>to have a fever</td> 
</tr> 
<tr> 
<td>骨折</td> <td>gwat1 zit3</td> <td>gǔ zhé</td> <td>to break a bone</td> 
</tr> 
<tr> 
<td>過敏</td> <td>gwo1 man5</td> <td>guò mǐn</td> <td>to be allergic</td> 
</tr> 
<tr> 
<td>打針</td> <td>daa2 zam1</td> <td>dǎ zhēn</td> <td>to get an injection, to get a shot</td> 
</tr> 
<tr> 
<td>打乞嗤</td> <td>daa2 hat1 ci1</td> <td>dá qǐ chī</td> <td>to sneeze</td> 
</tr> 
"""

html_input4 = """
<tr> 
<td>學</td> <td>hok6</td> <td>xué</td> <td>to learn</td> 
</tr> 
<tr> 
<td>教</td> <td>gaau3</td> <td>jiāo</td> <td>to teach</td> 
</tr> 
<tr> 
<td>學識</td> <td>hok6 sik1</td> <td>xué shí</td> <td>to learn, to acquire knowledge</td> 
</tr> 
<tr> 
<td>學習</td> <td>hok6 zaap6</td> <td>xué xí</td> <td>to learn, to study, to acquire knowledge</td> 
</tr>
<tr> 
<td>上學</td> <td>soeng5 hok6</td> <td>shàng xué</td> <td>to go to school</td> 
</tr> 
<tr> 
<td>返學</td> <td>faan1 hok6</td> <td>fǎn xué</td> <td>to go to school</td> 
</tr> 
<tr> 
<td>放學</td> <td>fong3 hok6</td> <td>fàng xué</td> <td>to end school, to finish class</td> 
</tr> 
<tr> 
<td>教書</td> <td>gaau3 syu1</td> <td>jiāo​ shū</td> <td>to teach (in a school)</td> 
</tr> 
<tr> 
<td>上堂</td> <td>soeng5 tong4</td> <td>shǎng táng</td> <td>to attend class, to have class</td> 
</tr> 
<tr> 
<td>讀書</td> <td>duk6 syu1</td> <td>dú shū</td> <td>to study</td> 
</tr> 
<tr> 
<td>温書<br>溫書</td> <td>wan1 syu1</td> <td>wēn shū</td> <td>to review, to revise, to study</td> 
</tr> 
<tr> 
<td>自學<br></td> <td>zi6 hok6</td> <td>zì xué</td> <td>to study or learn by oneself</td> 
</tr> 
<tr> 
<td>畢業</td> <td>bat1 jip6</td> <td>bì yè</td> <td>to graduate, to finish school</td> 
</tr>
"""

html_input5 = """
<tr> 
<td>叫</td> <td>giu3</td> <td>jiào</td> <td>to call, to be called, to be known as</td> 
</tr> 
<tr> 
<td>見</td> <td>gin3</td> <td>jiàn</td> <td>to see, to meet</td> 
</tr> 
<tr> 
<td>認得</td> <td>jing6 dak1</td> <td>rèn de</td> <td>to recognize</td> 
</tr> 
<tr> 
<td>撞倒</td> <td>zong6 dou2</td> <td>zhuàng dǎo</td> <td>to run into</td> 
</tr> 
<tr> 
<td>會面</td> <td>wui6 min6</td> <td>huì miàn</td> <td>to meet</td> 
</tr> 
<tr> 
<td>見面</td> <td>gin3 min6</td> <td>jiàn miàn</td> <td>to meet, to see each other</td> 
</tr> 
<tr> 
<td>掛住</td> <td>gwaa3 zyu6</td> <td>guà zhù</td> <td>to miss, to keep thinking about</td> 
</tr> 
<tr> 
<td>睇落</td> <td>tai2 lok6</td> <td>dì là</td> <td>to appear, to seem</td> 
</tr> 
<tr> 
<td>參加</td> <td>caam1 gaa1</td> <td>cān jiā</td> <td>to join</td> 
</tr> 
<tr> 
<td>得閒 </td> <td>dak1 haan4</td> <td>dé jiān</td> <td>to be free, to be available</td> 
</tr> 
<tr> 
<td>放鬆</td> <td>fong3 sung1</td> <td>fàng sōng</td> <td>to relax</td> 
</tr> 
<tr> 
<td>歡迎</td> <td>fun1 jing4</td> <td>huān yíng</td> <td>to welcome</td> 
</tr>  
"""

html_input6 = """
<tr> 
<td>做工</td> <td>zou6 gung1</td> <td>zuò gōng</td> <td>to work</td> 
</tr> 
<tr> 
<td>返工</td> <td>faan1 gung1</td> <td>fǎn gōng</td> <td>to go to work</td> 
</tr> 
<tr> 
<td>放工</td> <td>fong3 gung1</td> <td>fàng gōng</td> <td>to get off work</td> 
</tr> 
<tr> 
<td>落班</td> <td>lok6 baan1</td> <td>luò bān</td> <td>to get off work</td> 
</tr> 
<tr> 
<td>退休</td> <td>teoi3 jau1</td> <td>tuì xiū</td> <td>to retire</td> 
</tr> 
<tr> 
<td>退役</td> <td>teoi3 jik6</td> <td>tuì yì</td> <td>to retire (from military service or a sport)</td> 
</tr> 
<tr> 
<td>賺錢</td> <td>zaan6 cin2</td> <td>zhuàn qián</td> <td>to make money, to earn money</td> 
</tr> 
<tr> 
<td>招聘</td> <td>ziu1 ping3</td> <td>zhāo ​pìn</td> <td>to invite applications for a job, to recruit</td> 
</tr> 
<tr> 
<td>兼職</td> <td>gim1 zik1</td> <td>jiān zhí</td> <td>to hold several jobs at once, to have a part-time job</td> 
</tr> 
<tr> 
<td>開會</td> <td>hoi1 wui6</td> <td>kāi huì</td> <td>to hold a meeting</td> 
</tr> 
"""

html_input7 = """
<tr> 
<td>嘅</td> <td>ge3</td> <td>gě, kǎi</td> <td>possessive particle</td> 
</tr> 
<tr> 
<td>啲</td> <td>di1</td> <td>dī</td> <td>-er</td> 
</tr> 
<tr> 
<td>咗</td> <td>zo2</td> <td>zuǒ</td> <td>-ed</td> 
</tr> 
<tr> 
<td>同</td> <td>tung4</td> <td>tóng</td> <td>and, with</td> 
</tr> 
<tr> 
<td>緊</td> <td>gan2</td> <td>jǐn</td> <td>-ing</td> 
</tr> 
<tr> 
<td>定</td> <td>ding6</td> <td>dìng</td> <td>or</td> 
</tr> 
<tr> 
<td>咁</td> <td>gam3</td> <td>gān</td> <td>so</td> 
</tr> 
<tr> 
<td>及</td> <td>kap6</td> <td>jí</td> <td>and, with, as well as</td> 
</tr> 
<tr> 
<td>到</td> <td>dou3</td> <td>dào</td> <td>[particle] used to denote completion</td> 
</tr> 
<tr> 
<td>呀</td> <td>aa1</td> <td>ya</td> <td>particle equivalent to 啊 after a vowel</td> 
</tr> 
<tr> 
<td>每</td> <td>mui5</td> <td>měi</td> <td>every</td> 
</tr> 
<tr> 
<td>都</td> <td>dou1</td> <td>dōu</td> <td>also</td> 
</tr> 
<tr> 
<td>添</td> <td>tim1</td> <td>tiān</td> <td>(final particle) even, too, in addition</td> 
</tr> 
<tr> 
<td>啦</td> <td>laa1</td> <td>lǎ</td> <td>Used at end of sentence to indicate change of state/beginning of action</td> 
</tr> 
<tr> 
<td>喎</td> <td>wo3</td> <td>wāi, kuāi</td> <td>Used at end of sentence for emphasis</td> 
</tr> 
<tr> 
<td>啲</td> <td>di1</td> <td>dī</td> <td>some, a few</td> 
</tr> 
<tr> 
<td>咪</td> <td>mai6</td> <td>mī</td> <td>Used with 囉  at end of phrase to spell out something obvious</td> 
</tr> 
<tr> 
<td>囉</td> <td>lo1</td> <td>luō</td> <td>sentence-final particle</td> 
</tr> 
<tr> 
<td>嗯</td> <td>ng6</td> <td>ēn</td> <td>nonverbal interjection<br>eh, okay, yeah, umm</td> 
</tr> 
<tr> 
<td>咦 </td> <td>ji2</td> <td>yí</td> <td>exclamation of surprise</td> 
</tr> 
<tr> 
<td>非</td> <td>fei1</td> <td>fēi</td> <td>not be, is not, not</td> 
</tr> 
<tr> 
<td>吓<br>嚇</td> <td>haa5</td> <td>xià</td> <td>(grammatical sentence particle)<br>for a while, for a moment</td> 
</tr> 
<tr> 
<td>而</td> <td>ji4</td> <td>ér</td> <td>and, and yet, but, neverthress</td> 
</tr> 
<tr> 
<td>將</td> <td>zoeng1</td> <td>jiāng</td> <td>will, going to, almost</td> 
</tr> 
<tr> 
<td>埋</td> <td>maai1</td> <td>mái</td> <td>together, along with, as well, in addition</td> 
</tr> 
<tr> 
<td>咯</td> <td>lo1</td> <td>lo</td> <td>sentence-final particle</td> 
</tr> 
<tr> 
<td>又</td> <td>jau6</td> <td>yòu</td> <td>again, once more, also, in addition, and, too</td> 
</tr>
<tr> 
<td>不過</td> <td>bat1 gwo3</td> <td>bù guò</td> <td>but</td> 
</tr> 
<tr> 
<td>但係</td> <td>daan6 hai6</td> <td>dàn xì</td> <td>but</td> 
</tr> 
<tr> 
<td>唔使</td> <td>m4 sai2</td> <td>wú shǐ</td> <td>do not have, no</td> 
</tr> 
<tr> 
<td>定係</td> <td>ding6 hai6</td> <td>dìng xì</td> <td>or</td> 
</tr> 
<tr> 
<td>或著</td> <td>waak6 ze2</td> <td>huò zhě</td> <td>or, maybe</td> 
</tr> 
<tr> 
<td>每次</td> <td>mui5 ci3</td> <td>měi cì</td> <td>every time</td> 
</tr> 
<tr> 
<td>如果</td> <td>jyu4 gwo2</td> <td>rú guǒ</td> <td>if</td> 
</tr> 
<tr> 
<td>啱啱</td> <td> ngaam1 ngaam1</td> <td>yān yān</td> <td>just now</td> 
</tr> 
<tr> 
<td>例如</td> <td>lai6 jyu4</td> <td>lì rú</td> <td>for example</td> 
</tr> 
<tr> 
<td>等等</td> <td>dang2 dang2</td> <td>děng děng</td> <td>etc, et cetera, and so on</td> 
</tr> 
<tr> 
<td>一係</td> <td>jat1 hai6</td> <td>yī xì</td> <td>either, or</td> 
</tr> 
<tr> 
<td>搵日<br>揾日</td> <td>wan2 jat6</td> <td>wěn rì</td> <td>some day, sometime<br>(lit. to find a day)</td> 
</tr> 
<tr> 
<td>除咗</td> <td>ceoi4 zo2</td> <td>chú zuǒ</td> <td>except, aside from, unless</td> 
</tr> 
<tr> 
<td>即使</td> <td>zik1 si2</td> <td>jí​ shǐ</td> <td>even if, even though</td> 
</tr> 
<tr> 
<td>雖然</td> <td>seoi1 jin4</td> <td>suī​ rán</td> <td>although, even though</td> 
</tr> 
<tr> 
<td>關於<br>関於</td> <td>gwaan1 jyu1</td> <td>guān​ yú</td> <td>about, pertaining to, regarding</td> 
</tr> 
<tr> 
<td>就係</td> <td>zau6 hai6</td> <td>jiù xì</td> <td>it is, exactly, even if</td> 
</tr> 
<tr> 
<td>直至</td> <td>zik6 zi3</td> <td>zhí​ zhì</td> <td>until, up to</td> 
</tr> 
<tr> 
<td>而且</td> <td>ji4 ce2</td> <td>ér qiě</td> <td>furthermore, in addition, moreover</td> 
</tr> 
<tr> 
<td>然後</td> <td>jin4 hau6</td> <td>rán hòu</td> <td>then, after that, afterwards, and</td> 
</tr> 
<tr> 
<td>或者</td> <td>waak6 ze2</td> <td>huò zhě</td> <td>or, possibly ,maybe</td> 
</tr> 
<tr> 
<td>只要</td> <td>zi2 jiu3</td> <td>zhǐ yào</td> <td>as long as, so long as </td> 
</tr> 
<tr> 
<td>以來</td> <td>ji5 loi4</td> <td>yǐ lái</td> <td>since (a previous event)</td> 
</tr> 
<tr> 
<td>作為</td> <td>zok3 wai4</td> <td>zuò wéi</td> <td>as (a role), serving as</td> 
</tr> 
"""

html_input8 = """
<tr> 
<td>係</td> <td>hai6</td> <td>xì</td> <td>yes</td> 
</tr> 
<tr> 
<td>嗱</td> <td>naa1</td> <td>ná</td> <td>here<br>(used when giving something to someone)</td> 
</tr> 
<tr> 
<td>請</td> <td>cing2</td> <td>qǐng</td> <td>please, kindly</td> 
</tr> 
<tr> 
<td>嘛</td> <td>maa3</td> <td>ma</td> <td>signals pause at end of sentence</td> 
</tr> 
<tr> 
<td>唔係</td> <td>m4 hai6</td> <td>wú xì</td> <td>no</td> 
</tr> 
<tr> 
<td>唔使</td> <td>m4 sai2</td> <td>wú shǐ</td> <td>do not</td> 
</tr> 
<tr> 
<td>你好</td> <td>nei5 hou2</td> <td>nǐ hǎo</td> <td>hello</td> 
</tr> 
<tr> 
<td>哈嘍</td> <td>haa1 lau3</td> <td>hā lóu</td> <td>hello (loanword)</td> 
</tr> 
<tr> 
<td>再見</td> <td>zoi3 gin3</td> <td>zài jiàn</td> <td>goodbye</td> 
</tr> 
<tr> 
<td>拜拜</td> <td>baai1 baai3</td> <td>bái bái</td> <td>goodbye</td> 
</tr> 
<tr> 
<td>早晨</td> <td>zou2 san4</td> <td>zǎo chén</td> <td>good morning</td> 
</tr> 
<tr> 
<td>午安</td> <td>ng5 on1</td> <td>wǔ ān</td> <td>good afternoon</td> 
</tr> 
<tr> 
<td>早唞</td> <td>zou2 tau2</td> <td>zǎo dǒu</td> <td>good night</td> 
</tr> 
<tr> 
<td>多謝</td> <td>do1 ze6</td> <td>duō xiè</td> <td>thank you</td> 
</tr> 
<tr> 
<td>唔該</td> <td>m4 goi1</td> <td>wú gāi</td> <td>please, excuse me, thank you</td> 
</tr> 
<tr> 
<td>真係</td> <td>zan1 hai6</td> <td>zhēn xì</td> <td>really</td> 
</tr> 
<tr> 
<td>好運</td> <td>hou2 wan6</td> <td>hǎo​ yùn</td> <td>good luck</td> 
</tr> 
<tr> 
<td>不如</td> <td>bat1 jyu4</td> <td>bù ​rú</td> <td>it's better to..., let's...</td> 
</tr> 
<tr> 
<td>可惜</td> <td>ho2 sik1</td> <td>kě​ xī</td> <td>a shame, too bad, a pity</td> 
</tr> 
<tr> 
<td>請問</td> <td>cing2 man6</td> <td>qǐng​ wèn</td> <td>excuse me, may I ask...?</td> 
</tr> 
<tr> 
<td>對唔住</td> <td>deoi3 m4 zyu6</td> <td>duì bu zhù</td> <td>sorry</td> 
</tr> 
<tr> 
<td>遲啲見</td> <td>ci4 di1 gin3</td> <td>chí dī jiàn</td> <td>see you later</td> 
</tr> 
<tr> 
<td>唔該晒<br>唔該曬</td> <td>m4 goi1 saai3</td> <td>wú gāi​ shài</td> <td>thank you very much</td> 
</tr> 
<tr> 
<td>等一等</td> <td>dang2 jat1 dang2</td> <td>děng​ yī​ děng</td> <td>wait a moment</td> 
</tr> 
<tr> 
<td>歡迎回來</td> <td>fun1 jing4 wui4 lai4</td> <td>huān yíng huí lai</td> <td>welcome back</td> 
</tr> 
<tr> 
<td>早日康復</td> <td>zou2 jat6 hong1 fuk6</td> <td>zǎo ​rì​ kāng​ fù</td> <td>get well soon<br>(lit. soon day healthy return)</td> 
</tr> 
<tr> 
<td>唔好意思</td> <td>m4 hou2 ji3 si3</td> <td>wú hǎo​ yì​ si</td> <td>sorry, excuse me</td> 
</tr> 
"""

html_input9 = """
<tr> 
<td>點</td> <td>dim2</td> <td>diǎn</td> <td>how</td> 
</tr> 
<tr> 
<td>幾</td> <td>jei2</td> <td>jī</td> <td>which</td> 
</tr> 
<tr> 
<td>邊</td> <td>bin1</td> <td>biān</td> <td>which</td> 
</tr> 
<tr> 
<td>咩</td> <td>me1</td> <td>miē</td> <td>what (informal)</td> 
</tr> 
<tr> 
<td>乜嘢</td> <td>mat1 je5</td> <td>miē yě</td> <td>what</td> 
</tr> 
<tr> 
<td>邊度</td> <td>bin1 dou6</td> <td>biān dù</td> <td>where</td> 
</tr> 
<tr> 
<td>幾時</td> <td>gei2 si4</td> <td>jǐ shí</td> <td>when</td> 
</tr> 
<tr> 
<td>幾多</td> <td>gei2 do1</td> <td>jǐ duō</td> <td>how much</td> 
</tr> 
<tr> 
<td>邊個</td> <td>bin1 go3</td> <td>biān gè</td> <td>who</td> 
</tr> 
<tr> 
<td>點解</td> <td>dim2 gaai2</td> <td>diǎn xiè</td> <td>why</td> 
</tr> 
"""

html_input10 = """
<tr> 
<td>哦</td> <td>o4</td> <td>ó</td> <td>oh</td> 
</tr> 
<tr> 
<td>喔</td> <td>o1</td> <td>wo</td> <td>oh</td> 
</tr> 
<tr> 
<td>啊</td> <td>aa1</td> <td>a</td> <td>ah</td> 
</tr> 
<tr> 
<td>吖</td> <td>aa1</td> <td>ā</td> <td>ah<br>(synonym of 啊)</td> 
</tr> 
<tr> 
<td>呀</td> <td>aa1</td> <td>ya</td> <td>particle equivalent to 啊 after a vowel</td> 
</tr> 
<tr> 
<td>哇</td> <td>waa3</td> <td>wā</td> <td>wow</td> 
</tr> 
<tr> 
<td>喂</td> <td>wai3</td> <td>wèi</td> <td>hey</td> 
</tr> 
<tr> 
<td>哈哈</td> <td>haa1 haa1</td> <td>hā hā</td> <td>ha ha</td> 
</tr> 
"""

def main():
  
  data = [[html_input1, "other", "profanity", None], 
          [html_input2, "other", "slang", None], 
          [html_input3, "verbs", "illness", None], 
          [html_input4, "verbs", "school", None],
          [html_input5, "verbs", "socialization", None],  
          [html_input6, "verbs", "work", None], 
          [html_input7, "other", None, None], 
          [html_input8, "other", "common-phrases", None], 
          [html_input9, "other", "questions", None], 
          [html_input10, "other", "onomatopoeia", None]]
          
  
  for num, inputs in enumerate(data, 1):
    
    filename = "xml_output" + str(num) + ".txt"
    
    html_to_xml(inputs[0], inputs[1], inputs[2], inputs[3], filename)



if __name__ == "__main__":
  main()


