SELECT film.id_genre AS id_genre,
       genre.name AS name_genre,
       film.id_distrib AS id_distrib,
       distrib.name AS name_distrib,
       film.title AS title_film
FROM film
JOIN genre ON film.id_genre = genre.id_genre
LEFT JOIN distrib ON film.id_distrib = distrib.id_distrib
WHERE genre.id_genre BETWEEN '4' AND '8';
