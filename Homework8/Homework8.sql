
CREATE DATABASE myNotes;
USE myNotes;


CREATE TABLE notes (
    id INT(11) NOT NULL AUTO_INCREMENT,
    title VARCHAR(80) NOT NULL,
    description TEXT NOT NULL,
    PRIMARY KEY (id)
);


INSERT INTO notes (title, description) VALUES
('Homework', 'Homework is due soon'),
('Exams', 'I have to study for my finals'),
('Personal life', 'Workout at least three times a week');


UPDATE notes SET description = 'My first final exam is tommorow' WHERE title = 'Exams';

DELETE FROM notes WHERE title = 'Personal life';

SELECT * FROM notes ORDER BY title DESC;

SELECT * FROM notes ORDER BY id LIMIT 1 OFFSET 1;

SELECT * FROM notes WHERE description REGEXP '[aeiouAEIOU]';
