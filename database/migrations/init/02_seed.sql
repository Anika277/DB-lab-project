USE smart_library;
GO

-- Insert categories
INSERT INTO categories (name) VALUES
('Fiction'),
('Non-Fiction'),
('Mystery & Thriller'),
('Romance'),
('Fantasy'),
('Science Fiction'),
('Historical'),
('Poetry'),
('Self-Help & Wellness'),
('Travel & Adventure'),
('Biography'),
('Children''s Books');
GO

-- Insert books
INSERT INTO books (title, author, cover_image, category_id, available_copies) VALUES
('Harry Potter and the Sorcerer Stone', 'J.K. Rowling', 'https://books.google.com/books/content?id=wrOQLV6xB-wC&printsec=frontcover&img=1&zoom=1', 5, 3),
('Harry Potter and the Chamber of Secrets', 'J.K. Rowling', 'https://books.google.com/books/content?id=5iTebBW_-XAC&printsec=frontcover&img=1&zoom=1', 5, 3),
('Atomic Habits', 'James Clear', 'https://books.google.com/books/content?id=XfFvDwAAQBAJ&printsec=frontcover&img=1&zoom=1', 9, 3),
('The Kite Runner', 'Khaled Hosseini', 'https://books.google.com/books/content?id=CFteNgAACAAJ&printsec=frontcover&img=1&zoom=1', 1, 3),
('The Alchemist', 'Paulo Coelho', 'https://books.google.com/books/content?id=FzVjBgAAQBAJ&printsec=frontcover&img=1&zoom=1', 1, 3),
('Dune', 'Frank Herbert', 'https://books.google.com/books/content?id=B5UFEAAAQBAJ&printsec=frontcover&img=1&zoom=1', 6, 3),
('Pride and Prejudice', 'Jane Austen', 'https://books.google.com/books/content?id=J4a6AAAAMAAJ&printsec=frontcover&img=1&zoom=1', 4, 3),
('1984', 'George Orwell', 'https://books.google.com/books/content?id=kotPYEqx7kMC&printsec=frontcover&img=1&zoom=1', 6, 3),
('Gone Girl', 'Gillian Flynn', 'https://books.google.com/books/content?id=btkMMzEBuIAC&printsec=frontcover&img=1&zoom=1', 3, 3),
('Sapiens', 'Yuval Noah Harari', 'https://books.google.com/books/content?id=1EiJAwAAQBAJ&printsec=frontcover&img=1&zoom=1', 2, 3),
('The Hobbit', 'J.R.R. Tolkien', 'https://books.google.com/books/content?id=pD6arNyKyi8C&printsec=frontcover&img=1&zoom=1', 5, 3),
('Becoming', 'Michelle Obama', 'https://books.google.com/books/content?id=4XFvDwAAQBAJ&printsec=frontcover&img=1&zoom=1', 11, 3),
('The Silent Patient', 'Alex Michaelides', 'https://books.google.com/books/content?id=s9ZEDwAAQBAJ&printsec=frontcover&img=1&zoom=1', 3, 3),
('The Book Thief', 'Markus Zusak', 'https://books.google.com/books/content?id=mfNbH80ZRDMC&printsec=frontcover&img=1&zoom=1', 1, 3),
('The Midnight Library', 'Matt Haig', 'https://books.google.com/books/content?id=vOXmDwAAQBAJ&printsec=frontcover&img=1&zoom=1', 1, 3),
('Little Women', 'Louisa May Alcott', 'https://books.google.com/books/content?id=R3NZAAAAYAAJ&printsec=frontcover&img=1&zoom=1', 1, 3),
('To Kill a Mockingbird', 'Harper Lee', 'https://books.google.com/books/content?id=PGR2AwAAQBAJ&printsec=frontcover&img=1&zoom=1', 1, 3),
('The Great Gatsby', 'F. Scott Fitzgerald', 'https://books.google.com/books/content?id=iXn5U2IziiYC&printsec=frontcover&img=1&zoom=1', 1, 3),
('The Hunger Games', 'Suzanne Collins', 'https://books.google.com/books/content?id=sazytgAACAAJ&printsec=frontcover&img=1&zoom=1', 6, 3),
('Brave New World', 'Aldous Huxley', 'https://books.google.com/books/content?id=FeNbAAAAMAAJ&printsec=frontcover&img=1&zoom=1', 6, 3),
('Circe', 'Madeline Miller', 'https://books.google.com/books/content?id=XdZEDwAAQBAJ&printsec=frontcover&img=1&zoom=1', 5, 3),
('Normal People', 'Sally Rooney', 'https://books.google.com/books/content?id=s9hsDwAAQBAJ&printsec=frontcover&img=1&zoom=1', 4, 3);
GO