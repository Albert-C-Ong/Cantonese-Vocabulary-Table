
SELECT * FROM vocabulary
WHERE subcategory2 IS "States" AND length(chinese) > 1
ORDER BY english;

-- (chinese, chinese_variation, jyutping, pinyin, english, category, subcategory, subcategory2, priority)
-- ("", NULL, "", "", "", "", "", NULL, NULL), 
INSERT INTO vocabulary VALUES
  ("", NULL, "", "", "", "", "", NULL, NULL), 
  ("", NULL, "", "", "", "", "", NULL, NULL)
;
