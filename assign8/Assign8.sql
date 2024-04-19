\T Assign8.txt
--Oluwasegun Durosinmi
-- z1978798 

--1. List all of the authors’ first and last names in alphabetical order by first name

SELECT AuthorFirst, AuthorLast
FROM Author 
ORDER BY AuthorFirst;


--2. List all of the cities that have a publisher located in them. List each of the appropriate cities only once.

SELECT DISTINCT City
FROM Publisher;

--3. Show how many book titles exist in the database.

SELECT COUNT(DISTINCT Title) AS Book_Titles
FROM Book;

--4. List the names of all of the branches along with the total number of books on hand at each of those branches.


SELECT BranchName, SUM(OnHand) AS TotalBooks 
FROM Branch JOIN Inventory 
ON Branch.BranchNum = Inventory.BranchNum
GROUP BY Branch.BranchNum;
--5. Show the number of employees that work at Henry Books.

SELECT SUM(NumEmployees) AS Total_Employees 
FROM Branch;

--6. List the titles of all of the books written by Stephen King.

SELECT Title FROM Book 
WHERE BookCode IN (
                    SELECT BookCode FROM Wrote WHERE AuthorNum = 
                                (SELECT AuthorNum FROM Author WHERE AuthorFirst = 'Stephen' AND AuthorLast = 'King'));




--7. List the title, type and price for all of the paperback books

SELECT Title, Type, Price
From Book WHERE
Paperback = 'Y';

--8. Show the names of all of the branches that have at least one book with ten or more copies on hand.

SELECT DISTINCT BranchName
FROM Branch
JOIN Inventory ON Branch.BranchNum = Inventory.BranchNum
WHERE OnHand >= 10;


--9. List the title and the full name of the author for each book in reverse alphabetical order by title.

SELECT b.Title, a.AuthorLast, a.AuthorFirst 
FROM Book b JOIN Wrote w ON b.BookCode = w.BookCode 
JOIN Author a ON w.AuthorNum = a.AuthorNum 
ORDER BY b.Title DESC;

--10. List all of publishers by name, along with how many books each of those publishers has published.

SELECT PublisherName, COUNT(*) AS NumBooksPublished 
FROM Publisher JOIN Book ON Publisher.PublisherCode = Book.PublisherCode 
GROUP BY Publisher.PublisherCode;


--11. Show the number of books that cost less than $10.00.

SELECT COUNT(*) AS BooksUnderTen
FROM Book 
WHERE Price < 10.00;

--12. List the last name for all of the authors published by Simon and Schuster.

SELECT DISTINCT AuthorLast
FROM Author
JOIN Wrote ON Author.AuthorNum = Wrote.AuthorNum
JOIN Book ON Wrote.BookCode = Book.BookCode
JOIN Publisher ON Book.PublisherCode = Publisher.PublisherCode
WHERE PublisherName = 'Simon and Schuster';


--13. Show a list with all the types of books and how many books there are for each of them.

SELECT Type, COUNT(*) AS NumBooks
FROM Book
GROUP BY Type;


--14. Show the number of books on hand at the Brentwood Mall location.

SELECT SUM(OnHand) AS Total_Books
FROM Inventory
JOIN Branch ON Inventory.BranchNum = Branch.BranchNum
WHERE BranchLocation = 'Brentwood Mall';


--15. List all of the branch locations along with the number of employees and the number of books on hand at each of those branches.

SELECT BranchLocation, NumEmployees, SUM(OnHand) AS OnHand_Books
FROM Branch
JOIN Inventory ON Branch.BranchNum = Inventory.BranchNum
GROUP BY Branch.BranchNum;


--16. List the titles of all of the books which have a sequence number of one. Use a subquery to do it.

SELECT Title
FROM Book
WHERE BookCode IN (SELECT BookCode FROM Wrote WHERE Sequence = 1);

--17. List all of the publishers whose name begins with “T”.

SELECT PublisherName
FROM Publisher
WHERE PublisherName LIKE 'T%';

--18. List all of the information pertaining to authors that have a double-L in their name (“ll”).

SELECT *
FROM Author
WHERE AuthorLast LIKE '%ll%' OR AuthorFirst LIKE '%ll%';


--19. List all of the book titles that have a book code of 079x, 138x, or 669x.

SELECT Title
FROM Book
WHERE BookCode IN ('079X', '138X', '669X');

--20. Show the titles of all the books, along with their author’s last name and the name of the publisher, sorted in alphabetical order by the publisher’s name.

SELECT B.Title, A.AuthorLast, P.PublisherName
FROM Book B
JOIN Wrote W ON B.BookCode = W.BookCode
JOIN Author A ON W.AuthorNum = A.AuthorNum
JOIN Publisher P ON B.PublisherCode = P.PublisherCode
ORDER BY P.PublisherName ASC;

--21. Do any two of the above items again, accomplishing the task in a different way. (Different SQL for same result.) Make sure to identify which itemsyou are doing again. (10pts)

--Step 3. 
SELECT COUNT(*) AS NumBookTitles 
FROM Book;

--Step 17.

SELECT PublisherName
FROM Publisher
WHERE LEFT(PublisherName, 1) = 'T';


--22. By examining the tables, (you, not the script) determine another type of information that would be of interest to a person that worked at Henry Books.Indicate what you chose and provide the query. (10pts)

-- This query is in charge of providing us with the Most popular Books along side their authors
SELECT b.Title AS BookTitle,
    CONCAT(a.AuthorFirst, ' ', a.AuthorLast) 
AS AuthorName,
    COUNT(i.BookCode) AS TotalStocked
FROM Wrote w JOIN  Book b ON w.BookCode = b.BookCode
JOIN Author a ON w.AuthorNum = a.AuthorNum
JOIN Inventory i ON w.BookCode = i.BookCode
GROUP BY b.Title, AuthorName
ORDER BY TotalStocked DESC LIMIT 1;

\t

