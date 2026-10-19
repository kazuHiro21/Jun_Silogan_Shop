-- Silogan default records
-- Insert a default silog shop
INSERT INTO shops (shop_name, owner_name, address, contact_number) VALUES
('Tapsilog Hub', 'Juan dela Cruz', '123 Sampaguita St., Quezon City', '09171234567');

-- Get the shop_id for the inserted shop (assuming first inserted is id=1)
INSERT INTO menu_items (shop_id, item_name, price, category, description) VALUES
(1, 'Tapsilog', 75.00, 'silog', 'Tapa, sinangag, itlog'),
(1, 'Chicksilog', 70.00, 'silog', 'Chicken, sinangag, itlog'),
(1, 'Baconsilog', 70.00, 'silog', 'Bacon, sinangag, itlog'),
(1, 'Hamsilog', 65.00, 'silog', 'Ham, sinangag, itlog'),
(1, 'Longsilog', 65.00, 'silog', 'Longganisa, sinangag, itlog'),
(1, 'Spamsilog', 75.00, 'silog', 'Spam, sinangag, itlog'),
(1, 'Tocilog', 70.00, 'silog', 'Tocino, sinangag, itlog'),
(1, 'Banguslog', 80.00, 'silog', 'Bangus, sinangag, itlog'),
(1, 'Cornsilog', 60.00, 'silog', 'Corned beef, sinangag, itlog'),
(1, 'Liempo Silog', 85.00, 'silog', 'Liempo, sinangag, itlog');
