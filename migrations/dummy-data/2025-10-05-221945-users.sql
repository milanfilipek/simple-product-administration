INSERT INTO `users`
(`username`, `email`, `password`, `first_name`, `last_name`, `phone`, `is_active`, `created_at`)
VALUES
('janek', 'jan.novak@example.com', '$2a$12$iKZ9xuw2faudxoNJlGeD.uOxMH0rlTeoCa3.1agEb4olURGacB4Iy', 'Jan', 'Novák', '777111222', 1, NOW()),
('petrik', 'petr.svoboda@example.com', '$2a$12$iKZ9xuw2faudxoNJlGeD.uOxMH0rlTeoCa3.1agEb4olURGacB4Iy', 'Petr', 'Svoboda', '777111223', 1, NOW()),
('evicka', 'eva.kralova@example.com', '$2a$12$iKZ9xuw2faudxoNJlGeD.uOxMH0rlTeoCa3.1agEb4olURGacB4Iy', 'Eva', 'Králová', '777111224', 0, NOW()),
('martas', 'martin.dvorak@example.com', '$2a$12$iKZ9xuw2faudxoNJlGeD.uOxMH0rlTeoCa3.1agEb4olURGacB4Iy', 'Martin', 'Dvořák', '777111225', 1, NOW()),
('lucik', 'lucie.prochazkova@example.com', '$2a$12$iKZ9xuw2faudxoNJlGeD.uOxMH0rlTeoCa3.1agEb4olURGacB4Iy', 'Lucie', 'Procházková', '777111226', 1, NOW());
