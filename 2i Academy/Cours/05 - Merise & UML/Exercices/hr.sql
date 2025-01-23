-- Active: 1734429344986@@127.0.0.1@3306@sql_hr
SELECT * FROM employees AS e RIGHT JOIN offices AS o ON e.office_id = o.office_id;

# Compter le nombre d'employés et de bureaux par ville
SELECT offices.city,
COUNT(*) AS number_of_employees,
COUNT(DISTINCT offices.office_id) as number_of_office
FROM employees RIGHT JOIN offices ON employees.office_id = offices.office_id
GROUP BY offices.city;

# Afficher les bureaux vides
SELECT * FROM offices LEFT JOIN employees ON offices.office_id = employees.office_id
WHERE employees.first_name IS NULL

SELECT