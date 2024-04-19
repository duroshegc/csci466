\T Assign7.txt

-- Oluwasegun Durosinmi
-- z1978798
-- Section 01

-- 1. Select the BabyName database
USE BabyName;

--2. List all of the tables that are present in the database

SHOW tables;

--3. Show all of the names from your birth year. Each name must be shown only once.

SELECT DISTINCT name
    FROM BabyName
    WHERE year = 2002;

--4.  Show all of the columns and their types for each table in the database.
DESCRIBE BabyName;

--5. List how many unique names there are in each location.
SELECT place, COUNT(DISTINCT(name)) AS DistinctNames
FROM BabyName
GROUP BY place;


--6. Show all of the years (once only) where your first name appears. Some people’s names may not be present in the database. If your name is one ofthose, then use ‘Chad’ if you are male, or ‘Stacy’ if you are female. If you don’t feel you fit into one of those, feel free to use ‘Pat’.
SELECT DISTINCT year 
    FROM BabyName
    WHERE name = 'Pat';

--7. Display the most popular male and female names from the year 1984.
SELECT name, COUNT(*) AS PopularNames
FROM BabyName
WHERE year = 1984
GROUP BY name
ORDER BY PopularNames DESC;

--8. Show all the information available about names similar to your name (or the one you adopted from above), sorted in alphabetical order by name,then, within that, by count, and finally, by the year
SELECT * FROM BabyName
WHERE name LIKE 'Pat'
ORDER BY BY name ASC,
COUNT(*) DESC, year;

--9. Show how many unique names there were in the year 1947 .
SELECT COUNT(DISTINCT(name))
    FROM BabyName
    WHERE year = 1947;

--10. Show the number of rows that exist in the table.
SELECT COUNT(*) AS NumRows
FROM BabyName;

--11. Show how many names are in the table for each sex from the year 1971
SELECT gender, COUNT(*) AS NameCount
FROM BabyName 
WHERE year = 1971
GROUP BY gender;

--12. Show a table with a column called “First Letter” that contains one row for each letter a name starts with, and another column named “Frequency”that contains how many unique names begin with each of those letters
SELECT LEFT(name, 1) AS 'First Letter', 
COUNT(DISTINCT name) AS Frequency
FROM BabyName 
GROUP BY left(name, 1)
ORDER BY left(name, 1);

\t

