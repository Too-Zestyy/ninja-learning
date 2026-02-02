CREATE TABLE IF NOT EXISTS `jokes` (
                       `id` int NOT NULL AUTO_INCREMENT,
                       `setup` varchar(1024) NOT NULL,
                       `punchline` varchar(256) NOT NULL,
                       PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci
