
SELECT * FROM vocabulary
WHERE subcategory2 IS "States" AND length(chinese) > 1
ORDER BY english;

-- (chinese, chinese_variation, jyutping, pinyin, english, category, subcategory, subcategory2, priority)
-- ("", NULL, "", "", "", "", "", NULL, NULL), 
INSERT INTO vocabulary VALUES
  ("鄉村音樂", NULL, "heong1 cyun1 jam1 ngok6", "xiāng​ cūn​ yīn​ yuè", "country music", "Nouns", "Music", "Genres", NULL), 
  ("饒舌", NULL, "jiu4 sit6", "ráo shé", "rap (music)", "Nouns", "Music", "Genres", NULL), 
  ("搖滾", NULL, "jiu4 gwan2", "yáo​ gǔn", "rock and roll (music)", "Nouns", "Music", "Genres", NULL), 
  ("", NULL, "", "", "", "Nouns", "Music", "Genres", NULL), 
  ("", NULL, "", "", "", "Nouns", "Music", "Genres", NULL), 
  ("", NULL, "", "", "", "Nouns", "Music", "Genres", NULL), 
  ("", NULL, "", "", "", "", "", NULL, NULL), 
  ("", NULL, "", "", "", "", "", NULL, NULL), 
  ("", NULL, "", "", "", "", "", NULL, NULL), 
  ("", NULL, "", "", "", "", "", NULL, NULL), 
  ("", NULL, "", "", "", "", "", NULL, NULL), 
  ("", NULL, "", "", "", "", "", NULL, NULL)
;
