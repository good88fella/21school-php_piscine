SELECT name FROM distrib
WHERE id_distrib REGEXP '42|6[2-9]|71|88|89|90' OR
      (LENGTH(name) - LENGTH(REPLACE(LCASE(name), 'y', ''))) LIKE '2'
LIMIT 2, 5;
