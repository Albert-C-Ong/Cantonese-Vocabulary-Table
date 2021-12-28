
SELECT * FROM vocabulary
WHERE subcategory2 IS "States" AND length(chinese) > 1
ORDER BY english;

-- (chinese, chinese_variation, jyutping, pinyin, english, category, subcategory, subcategory2, priority)
-- ("", NULL, "", "", "", "", "", NULL, NULL), 
INSERT INTO vocabulary VALUES
  ("辣椒粉", NULL, "laat6 ziu1 fan2", "là​ jiāo fén", "chili powder", "Nouns", "Food", "Seasoning", NULL), 
  ("香菜", NULL, "xiang1 cai4", "xiāng cài", "coriander", "Nouns", "Food", "Seasoning", NULL), 
  ("孜然", NULL, "zi1 jin4", "zī rán", "cumin", "Nouns", "Food", "Seasoning", NULL), 
  ("紅甜澆粉", NULL, "hung4 tim4 ziu1 fan2", "hóng​ tián​ jiāo​ fěn", "paprika", "Nouns", "Food", "Seasoning", NULL), 
  ("蒔蘿", NULL, "si4 lo4", "shí luó", "dill", "Nouns", "Food", "Seasoning", NULL), 
  ("", NULL, "", "", "", "Nouns", "Food", "Seasoning", NULL), 
  ("", NULL, "", "", "", "Nouns", "Food", "Seasoning", NULL), 
  ("", NULL, "", "", "", "Nouns", "Food", "Seasoning", NULL), 
  ("", NULL, "", "", "", "Nouns", "Food", "Seasoning", NULL), 
  ("", NULL, "", "", "", "", "", NULL, NULL), 
  ("", NULL, "", "", "", "", "", NULL, NULL)
;
