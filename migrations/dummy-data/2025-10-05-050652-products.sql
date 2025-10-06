INSERT INTO `products` (`name`, `price`, `sku`, `ean`, `created_at`)
VALUES
('Produkt A', 199, 'SKU001', 1234567890123, NOW()),
('Produkt B', 299, 'SKU002', 1234567890124, NOW()),
('Produkt C', 399, 'SKU003', 1234567890125, NOW());

INSERT INTO `product_properties` (`key`, `value`, `product_id`)
VALUES
('Barva', 'Červená', 1),
('Velikost', 'M', 1),
('Materiál', 'Bavlna', 2),
('Barva', 'Modrá', 3);
