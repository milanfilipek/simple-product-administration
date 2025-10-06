INSERT INTO `users` (`username`, `email`, `password`, `name`, `role`, `is_active`, `created_at`) VALUES
('janek', 'jan.novak@example.com', '$2a$12$iKZ9xuw2faudxoNJlGeD.uOxMH0rlTeoCa3.1agEb4olURGacB4Iy', 'Jan Novák', 'admin', 1, NOW()),
('petrik', 'petr.svoboda@example.com', '$2a$12$iKZ9xuw2faudxoNJlGeD.uOxMH0rlTeoCa3.1agEb4olURGacB4Iy', 'Petr Svoboda', 'user', 1, NOW()),
('evicka', 'eva.kralova@example.com', '$2a$12$iKZ9xuw2faudxoNJlGeD.uOxMH0rlTeoCa3.1agEb4olURGacB4Iy', 'Eva Králová', 'user', 0, NOW()),
('martas', 'martin.dvorak@example.com', '$2a$12$iKZ9xuw2faudxoNJlGeD.uOxMH0rlTeoCa3.1agEb4olURGacB4Iy', 'Martin Dvořák', 'user', 1, NOW()),
('lucik', 'lucie.prochazkova@example.com', '$2a$12$iKZ9xuw2faudxoNJlGeD.uOxMH0rlTeoCa3.1agEb4olURGacB4Iy', 'Lucie Procházková', 'user', 1, NOW());
