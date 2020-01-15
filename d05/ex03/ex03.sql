INSERT INTO ft_table (`login`, `group`, `creation_date`)
SELECT `last_name`, 'other', `birthdate` FROM user_card
WHERE LENGTH(`last_name`) < 9
AND LOCATE('a', `last_name`) > 0
ORDER BY `last_name`
LIMIT 10;
