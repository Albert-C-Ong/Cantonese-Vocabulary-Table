
SELECT * FROM vocabulary
WHERE subcategory2 IS "States" AND length(chinese) > 1
ORDER BY english;

/*
with r_SomeTable
as
(
select *
, row_number() over(partition by IDCol order by ValueCol) as rnk
from SomeTable
)
update r_SomeTable
set RANKCol = rnk
*/

SELECT ROW_NUMBER() OVER(ORDER BY english) AS row_num, *
FROM vocabulary
WHERE subcategory2 IS "States" AND length(chinese) > 1;

-- (chinese, chinese_variation, jyutping, pinyin, english, category, subcategory, subcategory2, priority)
-- ("", NULL, "", "", "", "", "", NULL, NULL), 
INSERT INTO vocabulary VALUES
  ("", NULL, "", "", "", "", "", NULL, NULL), 
  ("", NULL, "", "", "", "", "", NULL, NULL), 
  ("", NULL, "", "", "", "", "", NULL, NULL)
;
