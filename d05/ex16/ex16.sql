SELECT COUNT(*) AS movies
FROM member_history
WHERE date BETWEEN CAST('2006-10-30 00:00:00' AS DATETIME) AND CAST('2007-07-27 23:59:59' AS DATETIME) OR
      (EXTRACT(MONTH FROM date) = 12 AND
       EXTRACT(DAY FROM date) = 24);
