ALTER TABLE `concept`
ADD `file` varchar(255) COLLATE 'latin1_swedish_ci' NOT NULL AFTER `name`;

ALTER TABLE `vendor`
ADD `email` varchar(255) COLLATE 'utf8mb4_unicode_ci' NULL AFTER `phone`,
CHANGE `website` `facebook` varchar(255) COLLATE 'utf8mb4_unicode_ci' NULL AFTER `instagram`,
ADD `price` varchar(255) COLLATE 'utf8mb4_unicode_ci' NULL AFTER `facebook`;

ALTER TABLE `vendor`
CHANGE `category` `concept_id` int(11) NOT NULL AFTER `id`,
ADD FOREIGN KEY (`concept_id`) REFERENCES `concept` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `vendor`
ADD `latitude` double NULL AFTER `address`,
ADD `longitude` double NULL AFTER `latitude`;

CREATE TABLE `user_favorite_vendor` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_id` bigint(20) unsigned NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `created_at` timestamp NULL,
  `updated_at` timestamp NULL,
  FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);