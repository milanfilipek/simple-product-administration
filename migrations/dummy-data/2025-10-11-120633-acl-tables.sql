INSERT INTO `roles` (`name`) VALUES
('admin'),
('customer');

INSERT INTO `users_roles` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 2),
(3, 2),
(4, 2),
(5, 2);

INSERT INTO `resources` (`name`) VALUES
('Home'),
('User'),
('Product'),
('Admin');

INSERT INTO `permissions` (`role_id`, `resource_id`, `privilege`) VALUES
(1, 1, '*'),
(1, 2, '*'),
(1, 3, '*'),
(1, 4, '*'),
(2, 1, 'view'),
(2, 2, 'view'),
(2, 2, 'edit'),
(2, 3, 'view');
