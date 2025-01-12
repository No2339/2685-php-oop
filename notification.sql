CREATE TABLE `notifications` (
   `id` INT NOT NULL AUTO_INCREMENT,
   `user_id` INT NOT NULL,
   `message` TEXT NOT NULL,
   `is_read` TINYINT(1) DEFAULT '0',
   `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
   PRIMARY KEY (`id`),
   KEY `user_id` (`user_id`)
) ENGINE=MyISAM 
AUTO_INCREMENT=34 
DEFAULT CHARSET=utf8mb4 
COLLATE=utf8mb4_0900_ai_ci;
