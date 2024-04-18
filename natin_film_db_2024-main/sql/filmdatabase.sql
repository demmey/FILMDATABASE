

CREATE TABLE `Admins` (
    `Admin_id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `Pass` VARCHAR(255) NOT NULL,
    `Admin_Name` VARCHAR(255) NOT NULL,
    `mail` VARCHAR(255) NOT NULL,
    `Rollen` VARCHAR(255) NOT NULL
);
CREATE TABLE `FilmRatings`(
    `Users_id` INT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE KEY,
    `Film_id` BIGINT NOT NULL,
    `Beoordeling` BIGINT NOT NULL,
    PRIMARY KEY(`Film_id`)
);
CREATE TABLE `FilmRating_Users`(
    `Film_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `User_id` BIGINT NOT NULL
);
CREATE TABLE `rollen`(
    `Admin_id` INT NOT NULL,
    `User_id` INT NOT NULL
);
ALTER TABLE
    `rollen` ADD UNIQUE `rollen_admin_id_unique`(`Admin_id`);
CREATE TABLE `users`(
    `Users_id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `Pass` BIGINT NOT NULL,
    `Users_Name` BIGINT NOT NULL,
    `mail` BIGINT NOT NULL,
    `Rollen` BIGINT NOT NULL
);
CREATE TABLE `Directors`(
    `director_id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `director_name` BIGINT NOT NULL,
    `Date_of_birth` BIGINT NOT NULL,
    `description` BIGINT NOT NULL,
    `Films` BIGINT NOT NULL
);
CREATE TABLE films (
    'film_id' INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    'title' VARCHAR(255) NOT NULL,
    'director' VARCHAR(255) NOT NULL,
    'release_year' INT UNSIGNED NOT NULL,
    'genre' VARCHAR(100) NOT NULL
);

ALTER TABLE
    `FilmRating_Users` ADD CONSTRAINT `filmrating_users_user_id_foreign` FOREIGN KEY(`User_id`) REFERENCES `FilmRatings`(`Users_id`);
ALTER TABLE
    `FILMS` ADD CONSTRAINT `films_director_id_foreign` FOREIGN KEY(`Director_id`) REFERENCES `Directors`(`director_id`);
ALTER TABLE
    `FILMS` ADD CONSTRAINT `films_film_id_foreign` FOREIGN KEY(`film_id`) REFERENCES `FilmRating_Users`(`Film_id`);
ALTER TABLE
    `rollen` ADD CONSTRAINT `rollen_admin_id_foreign` FOREIGN KEY(`Admin_id`) REFERENCES `Admins`(`Admin_id`);
ALTER TABLE
    `FilmRating_Users` ADD CONSTRAINT `filmrating_users_user_id_foreign` FOREIGN KEY(`User_id`) REFERENCES `users`(`Users_id`);
ALTER TABLE
    `rollen` ADD CONSTRAINT `rollen_admin_id_foreign` FOREIGN KEY(`Admin_id`) REFERENCES `users`(`Users_id`);