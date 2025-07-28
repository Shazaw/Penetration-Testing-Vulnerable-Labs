-- This script sets up the database for the Hard Vulnerable Lab.
-- It should be executed by the root MySQL user.

DROP DATABASE IF EXISTS socialgram;
DROP USER IF EXISTS 'socialgram_user'@'localhost';

CREATE DATABASE socialgram;
USE socialgram;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username TEXT,
  password TEXT,
  avatar_path TEXT DEFAULT 'uploads/avatars/default.png',
  full_name TEXT,
  bio TEXT
);

CREATE TABLE posts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  image_path TEXT,
  caption TEXT,
  likes INT,
  FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Insert key users for the challenge
INSERT INTO users (username, password, full_name, bio) VALUES
('webdeveloper', 'ComplexPass2025!', 'Dev Team', 'Building the future of SocialGram.'),
('photo_fanatic', 'pass1', 'Alex Doe', 'Capturing moments, one photo at a time.'),
('travel_bug', 'pass2', 'Beatrice Williams', 'Wanderlust-driven. Exploring the world.'),
('admin426', 'RANDOM_COMPLEX_PASSWORD', 'Admin', 'System Administrator Account.');

-- Insert over 50 fake users to populate the feed
INSERT INTO users (username, password, full_name, bio) VALUES
('carlos_r', 'pass3', 'Carlos Ruiz', 'Architect & Designer'), ('diana_p', 'pass4', 'Diana Prince', 'Doctor & Marathon Runner'),
('ethan_k', 'pass5', 'Ethan Kim', 'Pro Gamer & Streamer'), ('fiona_g', 'pass6', 'Fiona Green', 'Marine Biologist'),
('george_h', 'pass7', 'George Hill', 'Michelin Star Chef'), ('hannah_l', 'pass8', 'Hannah Lee', 'Graphic Designer & Artist'),
('ivan_m', 'pass9', 'Ivan Morozov', 'History Professor'), ('jenna_o', 'pass10', 'Jenna Ortiz', 'Actress & Filmmaker'),
('kyle_b', 'pass11', 'Kyle Brooks', 'Sound Engineer'), ('laura_c', 'pass12', 'Laura Chen', 'Fashion Blogger'),
('mike_n', 'pass13', 'Mike Nakamura', 'Translator & Polyglot'), ('nina_s', 'pass14', 'Nina Sharma', 'Bollywood Choreographer'),
('oscar_t', 'pass15', 'Oscar Torres', 'Graphic Novelist'), ('penny_u', 'pass16', 'Penny Upton', 'Wildlife Veterinarian'),
('quinn_v', 'pass17', 'Quinn Vance', 'Novelist & Poet'), ('ryan_x', 'pass18', 'Ryan Xavier', 'Skate Videographer'),
('sara_y', 'pass19', 'Sara Yilmaz', 'Museum Curator'), ('tina_z', 'pass20', 'Tina Zhang', 'Art Teacher'),
('umar_a', 'pass21', 'Umar Al-Jamil', 'Real Estate Developer'), ('violet_b', 'pass22', 'Violet Beauregard', 'Gallery Assistant'),
('will_c', 'pass23', 'Will Carter', 'Rio Tour Guide'), ('xena_d', 'pass24', 'Xena Daniels', 'Philosopher & Librarian'),
('yara_e', 'pass25', 'Yara El-Masry', 'Archaeologist'), ('zane_f', 'pass26', 'Zane Fitzgerald', 'Physical Therapist'),
('aiden_g', 'pass27', 'Aiden Graves', 'Mountain Guide'), ('brooklyn_h', 'pass28', 'Brooklyn Hayes', 'Hotel Manager'),
('caleb_i', 'pass29', 'Caleb Irons', 'Geologist & Climber'), ('delilah_j', 'pass30', 'Delilah Jones', 'Singer-Songwriter'),
('eli_k', 'pass31', 'Eli Kaplan', 'Craft Brewmaster'), ('faith_l', 'pass32', 'Faith Louis', 'Jazz Musician'),
('gavin_m', 'pass33', 'Gavin Miller', 'Tech Startup Founder'), ('harper_n', 'pass34', 'Harper Nelson', 'Harvard Student'),
('isaac_o', 'pass35', 'Isaac Olsen', 'History Tour Guide'), ('jasmine_p', 'pass36', 'Jasmine Patel', 'Vegas Magician'),
('kai_q', 'pass37', 'Kai Quinn', 'Surf Instructor'), ('lily_r', 'pass38', 'Lily Roberts', 'Pro Volleyball Player'),
('mason_s', 'pass39', 'Mason Scott', 'Rodeo Cowboy'), ('nora_t', 'pass40', 'Nora Thomas', 'Civil Rights Lawyer'),
('owen_u', 'pass41', 'Owen Underwood', 'Ice Hockey Coach'), ('piper_v', 'pass42', 'Piper Vaughn', 'UT Student'),
('quentin_w', 'pass43', 'Quentin Wells', 'Blues Musician'),
('reagan_x', 'pass44', 'Reagan Xavier', 'BBQ Pitmaster'),
('savannah_y', 'pass45', 'Savannah Young', 'Architectural Historian'),
('tristan_z', 'pass46', 'Tristan Zane', 'Mountain Guide'),
('ursula_a', 'pass47', 'Ursula Anderson', 'Balloon Pilot'),
('victor_b', 'pass48', 'Victor Blake', 'Desert Botanist'),
('willow_c', 'pass49', 'Willow Cruz', 'Artist'),
('xavier_d', 'pass50', 'Xavier Diaz', 'Astronomer');

-- Insert many posts to make the feed long
INSERT INTO posts (user_id, image_path, caption, likes) VALUES
(2, 'uploads/posts/post1.jpg', 'Beautiful sunset over the mountains!', 1204),
(3, 'uploads/posts/post2.jpg', 'Exploring the neon-lit streets of Tokyo.', 2345),
(4, 'uploads/posts/post3.jpg', 'A perfect day at the beach. Can''t get enough of this view!', 876),
(5, 'uploads/posts/post1.jpg', 'Another amazing view.', 952),
(6, 'uploads/posts/post2.jpg', 'City lights at night.', 1543),
(7, 'uploads/posts/post3.jpg', 'Relaxing by the sea.', 634),
(8, 'uploads/posts/post1.jpg', 'Mountain adventures await.', 1892),
(9, 'uploads/posts/post2.jpg', 'Urban exploration.', 1123),
(10, 'uploads/posts/post3.jpg', 'Chasing the waves.', 789),
(11, 'uploads/posts/post1.jpg', 'Golden hour.', 2045),
(12, 'uploads/posts/post2.jpg', 'Lost in the city.', 1321),
(13, 'uploads/posts/post3.jpg', 'Ocean breeze.', 999);

-- Create the database user
CREATE USER 'socialgram_user'@'localhost' IDENTIFIED BY 'StrongDBPassword456!';
GRANT ALL PRIVILEGES ON socialgram.* TO 'socialgram_user'@'localhost';
FLUSH PRIVILEGES;
