SELECT `title`, `summary` FROM film
WHERE LOCATE('vincent', `summary`) > 0
ORDER BY `id_film`;
