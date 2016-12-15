-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.5.32 - MySQL Community Server (GPL)
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.1.0.4867
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
-- Copiando dados para a tabela erp.acos: ~147 rows (aproximadamente)
DELETE FROM `acos`;
/*!40000 ALTER TABLE `acos` DISABLE KEYS */;
INSERT INTO `acos` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`, `show`, `order`, `name`, `description`) VALUES
	(1, NULL, NULL, NULL, 'controllers', 1, 454, 0, 0, NULL, NULL),
	(2, 1, NULL, NULL, 'Dashboard', 102, 119, 0, 1, NULL, NULL),
	(5, 1, NULL, NULL, 'Groups', 120, 141, 1, 2, NULL, 'Groups of the system used to set permissions. Each group has its own permissions and users.'),
	(6, 5, NULL, NULL, 'parentNode', 121, 122, 0, 0, NULL, NULL),
	(7, 5, NULL, NULL, 'admin_index', 123, 124, 1, 0, 'List', NULL),
	(8, 5, NULL, NULL, 'admin_view', 125, 126, 1, 0, 'View', NULL),
	(9, 5, NULL, NULL, 'admin_add', 127, 128, 1, 0, 'Add', NULL),
	(10, 5, NULL, NULL, 'admin_edit', 129, 130, 1, 0, 'Edit', NULL),
	(11, 5, NULL, NULL, 'admin_delete', 131, 132, 1, 0, 'Delete', NULL),
	(12, 1, NULL, NULL, 'Pages', 142, 165, 0, 0, NULL, NULL),
	(13, 12, NULL, NULL, 'index', 143, 144, 0, 0, NULL, NULL),
	(14, 12, NULL, NULL, 'about', 145, 146, 0, 0, NULL, NULL),
	(15, 12, NULL, NULL, 'contact', 147, 148, 0, 0, NULL, NULL),
	(16, 1, NULL, NULL, 'Users', 166, 205, 1, 3, NULL, 'Users of the system. Each user must belongs to a group.'),
	(17, 16, NULL, NULL, 'admin_login', 167, 168, 0, 0, NULL, NULL),
	(18, 16, NULL, NULL, 'admin_logout', 169, 170, 0, 0, NULL, NULL),
	(19, 16, NULL, NULL, 'admin_index', 171, 172, 1, 0, 'List', NULL),
	(20, 16, NULL, NULL, 'admin_view', 173, 174, 1, 0, 'View', NULL),
	(21, 16, NULL, NULL, 'admin_add', 175, 176, 1, 0, 'Add', NULL),
	(22, 16, NULL, NULL, 'admin_edit', 177, 178, 1, 0, 'Edit', NULL),
	(23, 16, NULL, NULL, 'admin_delete', 179, 180, 1, 0, 'Delete', NULL),
	(25, 16, NULL, NULL, 'admin_account', 181, 182, 1, 0, 'Account', NULL),
	(27, 12, NULL, NULL, 'language', 157, 158, 0, 0, NULL, NULL),
	(113, 1, NULL, NULL, 'InventorySystem', 218, 381, 0, 0, NULL, NULL),
	(114, 113, NULL, NULL, 'Categories', 219, 234, 1, 9, NULL, NULL),
	(115, 114, NULL, NULL, 'admin_index', 220, 221, 1, 0, 'List', NULL),
	(116, 114, NULL, NULL, 'admin_view', 222, 223, 1, 0, 'View', NULL),
	(117, 114, NULL, NULL, 'admin_add', 224, 225, 1, 0, 'Add', NULL),
	(118, 114, NULL, NULL, 'admin_edit', 226, 227, 1, 0, 'Edit', NULL),
	(119, 114, NULL, NULL, 'admin_delete', 228, 229, 1, 0, 'Delete', NULL),
	(120, 113, NULL, NULL, 'Customers', 235, 252, 1, 8, NULL, NULL),
	(121, 120, NULL, NULL, 'admin_index', 236, 237, 1, 0, 'List', NULL),
	(122, 120, NULL, NULL, 'admin_view', 238, 239, 1, 0, 'View', NULL),
	(123, 120, NULL, NULL, 'admin_add', 240, 241, 1, 0, 'Add', NULL),
	(124, 120, NULL, NULL, 'admin_edit', 242, 243, 1, 0, 'Edit', NULL),
	(125, 120, NULL, NULL, 'admin_delete', 244, 245, 1, 0, 'Delete', NULL),
	(126, 120, NULL, NULL, 'admin_cancel', 246, 247, 0, 0, NULL, NULL),
	(130, 113, NULL, NULL, 'InputsOutputs', 253, 312, 1, 11, 'Inputs and Outputs', NULL),
	(132, 130, NULL, NULL, 'admin_inputs', 254, 255, 1, 0, 'Inputs', NULL),
	(133, 130, NULL, NULL, 'admin_outputs', 256, 257, 1, 0, 'Outputs', NULL),
	(136, 130, NULL, NULL, 'search_all', 258, 259, 0, 0, NULL, NULL),
	(140, 130, NULL, NULL, 'getType', 260, 261, 0, 0, NULL, NULL),
	(141, 130, NULL, NULL, 'getProductValue', 262, 263, 0, 0, NULL, NULL),
	(142, 130, NULL, NULL, 'getInputQuantityTotals', 264, 265, 0, 0, NULL, NULL),
	(143, 130, NULL, NULL, 'getInputValueTotals', 266, 267, 0, 0, NULL, NULL),
	(144, 130, NULL, NULL, 'formatStringToDouble', 268, 269, 0, 0, NULL, NULL),
	(145, 130, NULL, NULL, 'admin_get_product', 270, 271, 0, 0, NULL, NULL),
	(146, 113, NULL, NULL, 'Products', 313, 340, 1, 6, NULL, NULL),
	(147, 146, NULL, NULL, 'admin_index', 314, 315, 1, 0, 'List', NULL),
	(148, 146, NULL, NULL, 'admin_view', 316, 317, 1, 0, 'View', NULL),
	(149, 146, NULL, NULL, 'admin_add', 318, 319, 1, 0, 'Add', NULL),
	(150, 146, NULL, NULL, 'admin_edit', 320, 321, 1, 0, 'Edit', NULL),
	(151, 146, NULL, NULL, 'admin_delete', 322, 323, 1, 0, 'Delete', NULL),
	(152, 146, NULL, NULL, 'admin_cancel', 324, 325, 0, 0, NULL, NULL),
	(153, 113, NULL, NULL, 'Suppliers', 341, 358, 1, 7, NULL, NULL),
	(154, 153, NULL, NULL, 'admin_index', 342, 343, 1, 0, 'List', NULL),
	(155, 153, NULL, NULL, 'admin_view', 344, 345, 1, 0, 'View', NULL),
	(156, 153, NULL, NULL, 'admin_add', 346, 347, 1, 0, 'Add', NULL),
	(157, 153, NULL, NULL, 'admin_edit', 348, 349, 1, 0, 'Edit', NULL),
	(158, 153, NULL, NULL, 'admin_delete', 350, 351, 1, 0, 'Delete', NULL),
	(159, 153, NULL, NULL, 'admin_cancel', 352, 353, 0, 0, NULL, NULL),
	(160, 113, NULL, NULL, 'UnitsMeasures', 359, 374, 1, 10, NULL, NULL),
	(161, 160, NULL, NULL, 'admin_index', 360, 361, 1, 0, 'List', NULL),
	(162, 160, NULL, NULL, 'admin_view', 362, 363, 1, 0, 'View', NULL),
	(163, 160, NULL, NULL, 'admin_add', 364, 365, 1, 0, 'Add', NULL),
	(164, 160, NULL, NULL, 'admin_edit', 366, 367, 1, 0, 'Edit', NULL),
	(165, 160, NULL, NULL, 'admin_delete', 368, 369, 1, 0, 'Delete', NULL),
	(166, 113, NULL, NULL, 'InventorySystemDashboard', 375, 380, 1, 5, 'Dashboard', NULL),
	(167, 166, NULL, NULL, 'admin_index', 376, 377, 1, 0, 'Initial page', NULL),
	(168, 166, NULL, NULL, 'admin_aco_sync', 378, 379, 0, 0, NULL, NULL),
	(169, 130, NULL, NULL, 'getInventoryTotalForReport', 272, 273, 0, 0, NULL, NULL),
	(172, 130, NULL, NULL, 'admin_delete', 274, 275, 0, 0, NULL, NULL),
	(173, 1, NULL, NULL, 'AutomaticJobs', 382, 385, 0, 0, NULL, NULL),
	(174, 173, NULL, NULL, 'call_job_expiration_date', 383, 384, 0, 0, NULL, NULL),
	(175, 130, NULL, NULL, 'admin_cancel', 276, 277, 0, 0, NULL, NULL),
	(176, 1, NULL, NULL, 'Modules', 386, 389, 0, 0, NULL, NULL),
	(178, 176, NULL, NULL, 'admin_subscriptions', 387, 388, 0, 0, NULL, NULL),
	(181, 130, NULL, NULL, 'admin_inventory_report', 278, 279, 1, 0, 'Inventory Report', NULL),
	(182, 130, NULL, NULL, 'admin_best_sellers_report', 280, 281, 1, 0, 'Best Sellers  Report', NULL),
	(183, 130, NULL, NULL, 'search_by_filters_inventory_report', 282, 283, 0, 0, NULL, NULL),
	(184, 130, NULL, NULL, 'search_outputs_by_filters_best_sellers_report', 284, 285, 0, 0, NULL, NULL),
	(185, 130, NULL, NULL, 'admin_inventory_report_pdf', 286, 287, 0, 0, NULL, NULL),
	(186, 130, NULL, NULL, 'admin_best_sellers_report_pdf', 288, 289, 0, 0, NULL, NULL),
	(187, 130, NULL, NULL, 'admin_create_data_inventory_report', 290, 291, 0, 0, NULL, NULL),
	(188, 1, NULL, NULL, 'Plans', 390, 395, 0, 4, NULL, NULL),
	(189, 188, NULL, NULL, 'admin_index', 391, 392, 0, 0, NULL, NULL),
	(192, 1, NULL, NULL, 'Addons', 396, 399, 0, 0, NULL, NULL),
	(193, 192, NULL, NULL, 'admin_get_value', 397, 398, 0, 0, NULL, NULL),
	(196, 130, NULL, NULL, 'search_outputs_by_filters_best_sellers_list', 292, 293, 0, 0, NULL, NULL),
	(197, 130, NULL, NULL, 'get_conditions_by_filters_best_sellers', 294, 295, 0, 0, NULL, NULL),
	(199, 12, NULL, NULL, 'admin_contact', 159, 160, 0, 0, NULL, NULL),
	(200, 16, NULL, NULL, 'change_password', 191, 192, 0, 0, NULL, NULL),
	(201, 16, NULL, NULL, 'forgot_password', 193, 194, 0, 0, NULL, NULL),
	(202, 16, NULL, NULL, 'register', 195, 196, 0, 0, NULL, NULL),
	(203, 16, NULL, NULL, 'send_confirmation', 197, 198, 0, 0, NULL, NULL),
	(204, 16, NULL, NULL, 'verify', 199, 200, 0, 0, NULL, NULL),
	(205, 130, NULL, NULL, 'admin_suppliers_select', 296, 297, 0, 0, NULL, NULL),
	(206, 146, NULL, NULL, 'admin_categories_select', 326, 327, 0, 0, NULL, NULL),
	(208, 130, NULL, NULL, 'admin_suppliers_select_init', 298, 299, 0, 0, NULL, NULL),
	(209, 130, NULL, NULL, 'admin_products_select', 300, 301, 0, 0, NULL, NULL),
	(210, 130, NULL, NULL, 'admin_products_select_init', 302, 303, 0, 0, NULL, NULL),
	(211, 130, NULL, NULL, 'admin_customers_select', 304, 305, 0, 0, NULL, NULL),
	(212, 130, NULL, NULL, 'admin_customers_select_init', 306, 307, 0, 0, NULL, NULL),
	(213, 146, NULL, NULL, 'admin_categories_select_init', 328, 329, 0, 0, NULL, NULL),
	(216, 16, NULL, NULL, 'admin_groups_select', 201, 202, 0, 0, NULL, NULL),
	(217, 16, NULL, NULL, 'admin_groups_select_init', 203, 204, 0, 0, NULL, NULL),
	(218, 130, NULL, NULL, 'admin_perform_inventory', 308, 309, 1, 0, 'Perform Inventory', NULL),
	(219, 130, NULL, NULL, 'calculate_percentage_billed', 310, 311, 0, 0, NULL, NULL),
	(220, 12, NULL, NULL, 'tour', 161, 162, 0, 0, NULL, NULL),
	(221, 114, NULL, NULL, 'admin_download_spreadsheet', 230, 231, 0, 0, NULL, NULL),
	(223, 160, NULL, NULL, 'admin_download_spreadsheet', 370, 371, 0, 0, NULL, NULL),
	(225, 114, NULL, NULL, 'admin_read_excel', 232, 233, 0, 0, NULL, NULL),
	(226, 120, NULL, NULL, 'admin_download_spreadsheet', 248, 249, 0, 0, NULL, NULL),
	(227, 120, NULL, NULL, 'admin_read_excel', 250, 251, 0, 0, NULL, NULL),
	(228, 153, NULL, NULL, 'admin_download_spreadsheet', 354, 355, 0, 0, NULL, NULL),
	(229, 153, NULL, NULL, 'admin_read_excel', 356, 357, 0, 0, NULL, NULL),
	(230, 160, NULL, NULL, 'admin_read_excel', 372, 373, 0, 0, NULL, NULL),
	(231, 12, NULL, NULL, 'prices', 163, 164, 0, 0, NULL, NULL),
	(232, 188, NULL, NULL, 'admin_pay', 393, 394, 1, 0, NULL, NULL),
	(233, 1, NULL, NULL, 'Transactions', 400, 405, 0, 0, NULL, NULL),
	(234, 233, NULL, NULL, 'notification', 401, 402, 0, 0, NULL, NULL),
	(235, 233, NULL, NULL, 'admin_index', 403, 404, 0, 0, NULL, NULL),
	(236, 146, NULL, NULL, 'admin_download_spreadsheet', 330, 331, 0, 0, NULL, NULL),
	(237, 146, NULL, NULL, 'admin_read_excel', 332, 333, 0, 0, NULL, NULL),
	(238, 146, NULL, NULL, 'is_valid_sheet', 334, 335, 0, 0, NULL, NULL),
	(239, 146, NULL, NULL, 'validate_code_column', 336, 337, 0, 0, NULL, NULL),
	(240, 146, NULL, NULL, 'validate_currency_column', 338, 339, 0, 0, NULL, NULL),
	(242, 1, NULL, NULL, 'Headquarters', 406, 453, 0, 0, NULL, NULL),
	(246, 242, NULL, NULL, 'Dashboard', 407, 412, 0, 0, NULL, NULL),
	(251, 246, NULL, NULL, 'hq_aco_sync', 408, 409, 0, 0, NULL, NULL),
	(252, 246, NULL, NULL, 'hq_index', 410, 411, 0, 0, NULL, NULL),
	(253, 242, NULL, NULL, 'Groups', 413, 434, 0, 0, NULL, NULL),
	(260, 242, NULL, NULL, 'Users', 435, 452, 0, 0, NULL, NULL),
	(281, 2, NULL, NULL, 'admin_index', 117, 118, 0, 0, NULL, NULL),
	(283, 253, NULL, NULL, 'hq_add', 424, 425, 0, 0, NULL, NULL),
	(284, 253, NULL, NULL, 'hq_delete', 426, 427, 0, 0, NULL, NULL),
	(285, 253, NULL, NULL, 'hq_edit', 428, 429, 0, 0, NULL, NULL),
	(286, 253, NULL, NULL, 'hq_index', 430, 431, 0, 0, NULL, NULL),
	(287, 253, NULL, NULL, 'hq_view', 432, 433, 0, 0, NULL, NULL),
	(288, 260, NULL, NULL, 'hq_add', 436, 437, 0, 0, NULL, NULL),
	(289, 260, NULL, NULL, 'hq_delete', 438, 439, 0, 0, NULL, NULL),
	(290, 260, NULL, NULL, 'hq_edit', 440, 441, 0, 0, NULL, NULL),
	(291, 260, NULL, NULL, 'hq_groups_select', 442, 443, 0, 0, NULL, NULL),
	(292, 260, NULL, NULL, 'hq_groups_select_init', 444, 445, 0, 0, NULL, NULL),
	(293, 260, NULL, NULL, 'hq_index', 446, 447, 0, 0, NULL, NULL),
	(294, 260, NULL, NULL, 'hq_logout', 448, 449, 0, 0, NULL, NULL),
	(295, 260, NULL, NULL, 'hq_view', 450, 451, 0, 0, NULL, NULL);
/*!40000 ALTER TABLE `acos` ENABLE KEYS */;

-- Copiando dados para a tabela erp.addons: ~4 rows (aproximadamente)
DELETE FROM `addons`;
/*!40000 ALTER TABLE `addons` DISABLE KEYS */;
INSERT INTO `addons` (`id`, `name`, `value`, `discount`, `status`, `created`, `modified`) VALUES
	(1, '+1 User', 9.00, 0, 'Active', '2014-10-09 14:52:04', '2014-10-09 14:52:07'),
	(2, '+5 User', 36.00, 0, 'Active', '2014-10-09 14:52:04', '2014-10-09 14:52:07'),
	(3, '+10 MB Space', 9.00, 0, 'Active', '2014-10-09 14:52:04', '2014-10-09 14:52:07'),
	(4, '+5 User', 39.00, 0, 'Active', '2014-10-09 14:52:04', '2014-10-09 14:52:07');
/*!40000 ALTER TABLE `addons` ENABLE KEYS */;

-- Copiando dados para a tabela erp.aros: ~8 rows (aproximadamente)
DELETE FROM `aros`;
/*!40000 ALTER TABLE `aros` DISABLE KEYS */;
INSERT INTO `aros` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
	(1, NULL, 'Group', 1, NULL, 1, 14),
	(2, 1, 'User', 1, NULL, 2, 3),
	(3, NULL, 'Group', 2, NULL, 15, 106),
	(4, 3, 'User', 2, NULL, 100, 101),
	(5, 3, 'User', 3, NULL, 102, 103),
	(6, NULL, 'Group', 3, NULL, 107, 108),
	(9, 3, 'User', 4, NULL, 104, 105),
	(16, NULL, 'Group', 4, NULL, 109, 110);
/*!40000 ALTER TABLE `aros` ENABLE KEYS */;

-- Copiando dados para a tabela erp.aros_acos: ~194 rows (aproximadamente)
DELETE FROM `aros_acos`;
/*!40000 ALTER TABLE `aros_acos` DISABLE KEYS */;
INSERT INTO `aros_acos` (`id`, `aro_id`, `aco_id`, `_create`, `_read`, `_update`, `_delete`) VALUES
	(1, 1, 1, '1', '1', '1', '1'),
	(2, 1, 2, '1', '1', '1', '1'),
	(3, 1, 5, '1', '1', '1', '1'),
	(4, 1, 16, '1', '1', '1', '1'),
	(2498, 3, 1, '-1', '-1', '-1', '-1'),
	(2500, 3, 7, '-1', '-1', '-1', '-1'),
	(2501, 3, 8, '-1', '-1', '-1', '-1'),
	(2502, 3, 9, '-1', '-1', '-1', '-1'),
	(2503, 3, 10, '-1', '-1', '-1', '-1'),
	(2504, 3, 11, '-1', '-1', '-1', '-1'),
	(2505, 3, 19, '-1', '-1', '-1', '-1'),
	(2506, 3, 20, '-1', '-1', '-1', '-1'),
	(2507, 3, 21, '-1', '-1', '-1', '-1'),
	(2508, 3, 22, '-1', '-1', '-1', '-1'),
	(2509, 3, 23, '-1', '-1', '-1', '-1'),
	(2510, 3, 25, '1', '1', '1', '1'),
	(2511, 3, 189, '1', '1', '1', '1'),
	(2512, 3, 232, '1', '1', '1', '1'),
	(2513, 3, 167, '1', '1', '1', '1'),
	(2514, 3, 147, '1', '1', '1', '1'),
	(2515, 3, 148, '1', '1', '1', '1'),
	(2516, 3, 149, '1', '1', '1', '1'),
	(2517, 3, 150, '1', '1', '1', '1'),
	(2518, 3, 151, '1', '1', '1', '1'),
	(2519, 3, 154, '1', '1', '1', '1'),
	(2520, 3, 155, '1', '1', '1', '1'),
	(2521, 3, 156, '1', '1', '1', '1'),
	(2522, 3, 157, '1', '1', '1', '1'),
	(2523, 3, 158, '1', '1', '1', '1'),
	(2524, 3, 121, '1', '1', '1', '1'),
	(2525, 3, 122, '1', '1', '1', '1'),
	(2526, 3, 123, '1', '1', '1', '1'),
	(2527, 3, 124, '1', '1', '1', '1'),
	(2528, 3, 125, '1', '1', '1', '1'),
	(2529, 3, 115, '1', '1', '1', '1'),
	(2530, 3, 116, '1', '1', '1', '1'),
	(2531, 3, 117, '1', '1', '1', '1'),
	(2532, 3, 118, '1', '1', '1', '1'),
	(2533, 3, 119, '1', '1', '1', '1'),
	(2534, 3, 161, '1', '1', '1', '1'),
	(2535, 3, 162, '1', '1', '1', '1'),
	(2536, 3, 163, '1', '1', '1', '1'),
	(2537, 3, 164, '1', '1', '1', '1'),
	(2538, 3, 165, '1', '1', '1', '1'),
	(2539, 3, 132, '-1', '-1', '-1', '-1'),
	(2540, 3, 133, '-1', '-1', '-1', '-1'),
	(2541, 3, 181, '-1', '-1', '-1', '-1'),
	(2542, 3, 182, '-1', '-1', '-1', '-1'),
	(2543, 3, 218, '-1', '-1', '-1', '-1'),
	(2590, 16, 1, '-1', '-1', '-1', '-1'),
	(2592, 16, 7, '1', '1', '1', '1'),
	(2593, 16, 8, '1', '1', '1', '1'),
	(2594, 16, 9, '1', '1', '1', '1'),
	(2595, 16, 10, '1', '1', '1', '1'),
	(2596, 16, 11, '1', '1', '1', '1'),
	(2597, 16, 19, '1', '1', '1', '1'),
	(2598, 16, 20, '1', '1', '1', '1'),
	(2599, 16, 21, '1', '1', '1', '1'),
	(2600, 16, 22, '1', '1', '1', '1'),
	(2601, 16, 23, '1', '1', '1', '1'),
	(2602, 16, 25, '1', '1', '1', '1'),
	(2603, 16, 189, '1', '1', '1', '1'),
	(2604, 16, 232, '1', '1', '1', '1'),
	(2605, 16, 167, '1', '1', '1', '1'),
	(2606, 16, 147, '1', '1', '1', '1'),
	(2607, 16, 148, '1', '1', '1', '1'),
	(2608, 16, 149, '1', '1', '1', '1'),
	(2609, 16, 150, '1', '1', '1', '1'),
	(2610, 16, 151, '1', '1', '1', '1'),
	(2611, 16, 154, '1', '1', '1', '1'),
	(2612, 16, 155, '1', '1', '1', '1'),
	(2613, 16, 156, '1', '1', '1', '1'),
	(2614, 16, 157, '1', '1', '1', '1'),
	(2615, 16, 158, '1', '1', '1', '1'),
	(2616, 16, 121, '1', '1', '1', '1'),
	(2617, 16, 122, '1', '1', '1', '1'),
	(2618, 16, 123, '1', '1', '1', '1'),
	(2619, 16, 124, '1', '1', '1', '1'),
	(2620, 16, 125, '1', '1', '1', '1'),
	(2621, 16, 115, '1', '1', '1', '1'),
	(2622, 16, 116, '1', '1', '1', '1'),
	(2623, 16, 117, '1', '1', '1', '1'),
	(2624, 16, 118, '1', '1', '1', '1'),
	(2625, 16, 119, '1', '1', '1', '1'),
	(2626, 16, 161, '1', '1', '1', '1'),
	(2627, 16, 162, '1', '1', '1', '1'),
	(2628, 16, 163, '1', '1', '1', '1'),
	(2629, 16, 164, '1', '1', '1', '1'),
	(2630, 16, 165, '1', '1', '1', '1'),
	(2631, 16, 132, '1', '1', '1', '1'),
	(2632, 16, 133, '1', '1', '1', '1'),
	(2633, 16, 181, '1', '1', '1', '1'),
	(2634, 16, 182, '1', '1', '1', '1'),
	(2635, 16, 218, '1', '1', '1', '1'),
	(2737, 6, 1, '-1', '-1', '-1', '-1'),
	(2739, 6, 251, '-1', '-1', '-1', '-1'),
	(2740, 6, 252, '-1', '-1', '-1', '-1'),
	(2741, 6, 6, '-1', '-1', '-1', '-1'),
	(2742, 6, 7, '-1', '-1', '-1', '-1'),
	(2743, 6, 8, '-1', '-1', '-1', '-1'),
	(2744, 6, 9, '-1', '-1', '-1', '-1'),
	(2745, 6, 10, '-1', '-1', '-1', '-1'),
	(2746, 6, 11, '-1', '-1', '-1', '-1'),
	(2747, 6, 17, '-1', '-1', '-1', '-1'),
	(2748, 6, 18, '-1', '-1', '-1', '-1'),
	(2749, 6, 19, '1', '1', '1', '1'),
	(2750, 6, 20, '1', '1', '1', '1'),
	(2751, 6, 21, '1', '1', '1', '1'),
	(2752, 6, 22, '1', '1', '1', '1'),
	(2753, 6, 23, '1', '1', '1', '1'),
	(2754, 6, 25, '1', '1', '1', '1'),
	(2755, 6, 200, '-1', '-1', '-1', '-1'),
	(2756, 6, 201, '-1', '-1', '-1', '-1'),
	(2757, 6, 202, '-1', '-1', '-1', '-1'),
	(2758, 6, 203, '-1', '-1', '-1', '-1'),
	(2759, 6, 204, '-1', '-1', '-1', '-1'),
	(2760, 6, 216, '1', '1', '1', '1'),
	(2761, 6, 217, '1', '1', '1', '1'),
	(2762, 6, 189, '1', '1', '1', '1'),
	(2763, 6, 232, '1', '1', '1', '1'),
	(2764, 6, 167, '1', '1', '1', '1'),
	(2765, 6, 168, '-1', '-1', '-1', '-1'),
	(2766, 6, 147, '1', '1', '1', '1'),
	(2767, 6, 148, '1', '1', '1', '1'),
	(2768, 6, 149, '1', '1', '1', '1'),
	(2769, 6, 150, '1', '1', '1', '1'),
	(2770, 6, 151, '1', '1', '1', '1'),
	(2771, 6, 152, '-1', '-1', '-1', '-1'),
	(2772, 6, 206, '1', '1', '1', '1'),
	(2773, 6, 213, '1', '1', '1', '1'),
	(2774, 6, 236, '-1', '-1', '-1', '-1'),
	(2775, 6, 237, '-1', '-1', '-1', '-1'),
	(2776, 6, 238, '-1', '-1', '-1', '-1'),
	(2777, 6, 239, '-1', '-1', '-1', '-1'),
	(2778, 6, 240, '-1', '-1', '-1', '-1'),
	(2779, 6, 154, '1', '1', '1', '1'),
	(2780, 6, 155, '1', '1', '1', '1'),
	(2781, 6, 156, '1', '1', '1', '1'),
	(2782, 6, 157, '1', '1', '1', '1'),
	(2783, 6, 158, '1', '1', '1', '1'),
	(2784, 6, 159, '-1', '-1', '-1', '-1'),
	(2785, 6, 228, '-1', '-1', '-1', '-1'),
	(2786, 6, 229, '-1', '-1', '-1', '-1'),
	(2787, 6, 121, '1', '1', '1', '1'),
	(2788, 6, 122, '1', '1', '1', '1'),
	(2789, 6, 123, '1', '1', '1', '1'),
	(2790, 6, 124, '1', '1', '1', '1'),
	(2791, 6, 125, '1', '1', '1', '1'),
	(2792, 6, 126, '-1', '-1', '-1', '-1'),
	(2793, 6, 226, '-1', '-1', '-1', '-1'),
	(2794, 6, 227, '-1', '-1', '-1', '-1'),
	(2795, 6, 115, '1', '1', '1', '1'),
	(2796, 6, 116, '1', '1', '1', '1'),
	(2797, 6, 117, '1', '1', '1', '1'),
	(2798, 6, 118, '1', '1', '1', '1'),
	(2799, 6, 119, '1', '1', '1', '1'),
	(2800, 6, 221, '-1', '-1', '-1', '-1'),
	(2801, 6, 225, '-1', '-1', '-1', '-1'),
	(2802, 6, 161, '1', '1', '1', '1'),
	(2803, 6, 162, '1', '1', '1', '1'),
	(2804, 6, 163, '1', '1', '1', '1'),
	(2805, 6, 164, '1', '1', '1', '1'),
	(2806, 6, 165, '1', '1', '1', '1'),
	(2807, 6, 223, '-1', '-1', '-1', '-1'),
	(2808, 6, 230, '-1', '-1', '-1', '-1'),
	(2809, 6, 132, '1', '1', '1', '1'),
	(2810, 6, 133, '1', '1', '1', '1'),
	(2811, 6, 136, '1', '1', '1', '1'),
	(2812, 6, 140, '1', '1', '1', '1'),
	(2813, 6, 141, '1', '1', '1', '1'),
	(2814, 6, 142, '1', '1', '1', '1'),
	(2815, 6, 143, '1', '1', '1', '1'),
	(2816, 6, 144, '1', '1', '1', '1'),
	(2817, 6, 145, '1', '1', '1', '1'),
	(2818, 6, 169, '1', '1', '1', '1'),
	(2819, 6, 172, '-1', '-1', '-1', '-1'),
	(2820, 6, 175, '1', '1', '1', '1'),
	(2821, 6, 181, '1', '1', '1', '1'),
	(2822, 6, 182, '1', '1', '1', '1'),
	(2823, 6, 183, '1', '1', '1', '1'),
	(2824, 6, 184, '1', '1', '1', '1'),
	(2825, 6, 185, '1', '1', '1', '1'),
	(2826, 6, 186, '1', '1', '1', '1'),
	(2827, 6, 187, '1', '1', '1', '1'),
	(2828, 6, 196, '1', '1', '1', '1'),
	(2829, 6, 197, '1', '1', '1', '1'),
	(2830, 6, 205, '1', '1', '1', '1'),
	(2831, 6, 208, '1', '1', '1', '1'),
	(2832, 6, 209, '1', '1', '1', '1'),
	(2833, 6, 210, '1', '1', '1', '1'),
	(2834, 6, 211, '1', '1', '1', '1'),
	(2835, 6, 212, '1', '1', '1', '1'),
	(2836, 6, 218, '1', '1', '1', '1'),
	(2837, 6, 219, '1', '1', '1', '1');
/*!40000 ALTER TABLE `aros_acos` ENABLE KEYS */;

-- Copiando dados para a tabela erp.businesses: ~4 rows (aproximadamente)
DELETE FROM `businesses`;
/*!40000 ALTER TABLE `businesses` DISABLE KEYS */;
INSERT INTO `businesses` (`id`, `plan_id`, `additional_users`, `name`, `status`, `tour`, `created`, `modified`) VALUES
	(1, 3, 0, 'Harvest Sistemas', 'Active', 0, '2014-09-23 04:33:15', '2014-09-23 04:33:15'),
	(2, 1, 0, NULL, '', 0, '2014-10-23 00:00:09', '2014-10-23 00:00:09'),
	(3, 2, 0, NULL, '', 0, '2014-10-23 00:06:45', '2014-10-23 00:06:45'),
	(4, 3, 0, NULL, '', 0, '2014-11-19 17:38:55', '2014-11-19 17:38:55');
/*!40000 ALTER TABLE `businesses` ENABLE KEYS */;

-- Copiando dados para a tabela erp.categories: ~3 rows (aproximadamente)
DELETE FROM `categories`;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `business_id`, `name`, `created`, `modified`) VALUES
	(3, 1, 'Categoria C', '2014-10-23 10:27:52', '2014-10-23 10:27:52'),
	(4, 1, 'Categoria A', '2014-10-23 11:21:16', '2014-10-23 11:21:16'),
	(5, 2, 'a', '2015-01-04 17:06:28', '2015-01-04 17:06:28');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Copiando dados para a tabela erp.categories_products: ~1 rows (aproximadamente)
DELETE FROM `categories_products`;
/*!40000 ALTER TABLE `categories_products` DISABLE KEYS */;
INSERT INTO `categories_products` (`id`, `category_id`, `product_id`) VALUES
	(4, 4, 6);
/*!40000 ALTER TABLE `categories_products` ENABLE KEYS */;

-- Copiando dados para a tabela erp.customers: ~5 rows (aproximadamente)
DELETE FROM `customers`;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` (`id`, `business_id`, `name`, `email`, `is_cnpj`, `cnpj_cpf`, `phone_number`, `phone_number2`, `address`, `site`, `birthday`, `created`, `modified`) VALUES
	(1, 1, 'Cliente a', 'asdf@asdf.com', 0, '08164194000', '', '', '', '', NULL, '2014-10-23 13:54:12', '2014-11-19 15:25:33'),
	(2, 1, 'Renato', 'dev@renato-franca.com', 1, '1234564564564', '', '', '', 'renato-franca.com', '2014-04-04 00:00:00', '2014-10-23 17:33:08', '2014-12-30 21:55:20'),
	(3, 1, 'Cliente novo', '', 2, NULL, '', '', '', '', NULL, '2014-11-24 17:38:20', '2014-11-24 17:38:20'),
	(4, 2, 'Teste', '', 2, NULL, '', '', '', '', NULL, '2015-01-04 17:01:50', '2015-01-04 17:01:50'),
	(5, 2, '123123', '', 2, NULL, '', '', '', '', NULL, '2015-01-04 17:03:07', '2015-01-04 17:03:07');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;

-- Copiando dados para a tabela erp.groups: ~4 rows (aproximadamente)
DELETE FROM `groups`;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` (`id`, `business_id`, `name`, `created`, `modified`) VALUES
	(1, 1, 'Admin', '2013-08-24 14:09:01', '2014-06-17 04:24:27'),
	(2, 2, 'Owner Starter', '2014-09-23 20:24:45', '2015-01-04 17:16:33'),
	(3, 3, 'Owner Bronze', '2014-10-30 20:01:38', '2015-01-06 02:39:24'),
	(4, 4, 'Owner Gold', '2015-01-02 17:59:05', '2015-01-05 14:24:04');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;

-- Copiando dados para a tabela erp.inputs_outputs: ~6 rows (aproximadamente)
DELETE FROM `inputs_outputs`;
/*!40000 ALTER TABLE `inputs_outputs` DISABLE KEYS */;
INSERT INTO `inputs_outputs` (`id`, `business_id`, `user_id`, `product_id`, `supplier_id`, `customer_id`, `movimentation_date`, `new_value`, `is_input`, `quantity`, `observation`, `adjustment_date`, `expiration_date`, `created`, `modified`) VALUES
	(1, 1, 1, 1, 1, NULL, '0000-00-00 00:00:00', NULL, 1, 2, '', NULL, '0000-00-00 00:00:00', '2014-10-23 18:24:46', '2014-10-23 18:24:46'),
	(2, 1, 1, 1, 1, NULL, '2014-10-23 00:00:00', NULL, 1, 2, '', NULL, NULL, '2014-10-23 19:21:36', '2014-10-23 19:21:36'),
	(3, 1, 1, 1, NULL, 2, '2014-10-23 00:00:00', 15.95, 0, 2, '', NULL, NULL, '2014-10-23 21:25:52', '2014-10-23 21:25:52'),
	(4, 1, 1, 1, NULL, 1, '2014-10-23 00:00:00', 15.95, 0, 2, '', NULL, NULL, '2014-10-23 21:36:55', '2014-10-23 21:36:55'),
	(5, 1, 1, 1, 1, NULL, '2014-10-27 00:00:00', NULL, 1, 10, '', NULL, NULL, '2014-10-27 16:21:06', '2014-10-27 16:21:06'),
	(6, 1, 1, 2, 1, NULL, '2014-12-30 00:00:00', 1.1111111111111111e20, 1, 2, '', NULL, NULL, '2014-12-30 21:44:44', '2014-12-30 21:44:44');
/*!40000 ALTER TABLE `inputs_outputs` ENABLE KEYS */;

-- Copiando dados para a tabela erp.modules: ~2 rows (aproximadamente)
DELETE FROM `modules`;
/*!40000 ALTER TABLE `modules` DISABLE KEYS */;
INSERT INTO `modules` (`id`, `name`, `description`, `plugin`, `status`, `created`, `modified`) VALUES
	(1, 'Inventory System', '', 'InventorySystem', 'Active', '2014-09-23 09:42:38', '2014-09-23 09:42:38'),
	(2, 'Financial System', '', 'FinancialSystem', 'Inactive', '2014-09-23 09:42:38', '2014-09-23 09:42:38');
/*!40000 ALTER TABLE `modules` ENABLE KEYS */;

-- Copiando dados para a tabela erp.modules_plans: ~2 rows (aproximadamente)
DELETE FROM `modules_plans`;
/*!40000 ALTER TABLE `modules_plans` DISABLE KEYS */;
INSERT INTO `modules_plans` (`id`, `plan_id`, `module_id`, `value`, `status`, `created`, `modified`) VALUES
	(1, 1, 1, 0.00, 'Active', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(2, 1, 2, 0.00, 'Inactive', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `modules_plans` ENABLE KEYS */;

-- Copiando dados para a tabela erp.plans: ~3 rows (aproximadamente)
DELETE FROM `plans`;
/*!40000 ALTER TABLE `plans` DISABLE KEYS */;
INSERT INTO `plans` (`id`, `name`, `price`, `status`, `order`, `created`, `modified`) VALUES
	(1, 'Starter', 0.00, 'Active', 3, '2014-10-07 10:43:39', '2014-10-07 10:43:41'),
	(2, 'Bronze', 39.90, 'Active', 1, '2014-10-07 10:43:39', '2014-10-07 10:43:41'),
	(3, 'Gold', 59.90, 'Active', 2, '2014-10-07 10:43:39', '2014-10-07 10:43:41');
/*!40000 ALTER TABLE `plans` ENABLE KEYS */;

-- Copiando dados para a tabela erp.plans_features: ~10 rows (aproximadamente)
DELETE FROM `plans_features`;
/*!40000 ALTER TABLE `plans_features` DISABLE KEYS */;
INSERT INTO `plans_features` (`id`, `plan_id`, `description`, `order`, `created`, `modified`) VALUES
	(1, 1, 'Inventory System', 1, '2015-01-06 12:41:28', '2015-01-06 12:41:28'),
	(2, 1, 'One user', 2, '2015-01-06 12:41:28', '2015-01-06 12:41:28'),
	(3, 1, 'Limit of 100 records for each module', 3, '2015-01-06 12:41:28', '2015-01-06 12:41:28'),
	(4, 2, 'Inventory System', 1, '2015-01-06 12:41:28', '2015-01-06 12:41:28'),
	(5, 2, 'Reports', 2, '2015-01-06 12:41:28', '2015-01-06 12:41:28'),
	(6, 2, 'One user', 3, '2015-01-06 12:41:28', '2015-01-06 12:41:28'),
	(7, 2, 'Can purchase additional users', 4, '2015-01-06 12:41:28', '2015-01-06 12:41:28'),
	(8, 3, 'All of plan OnneBlue Bronze', 1, '2015-01-06 12:41:28', '2015-01-06 12:41:28'),
	(9, 3, 'Plus an additional user (total of two)', 2, '2015-01-06 12:41:28', '2015-01-06 12:41:28'),
	(10, 3, 'Access control', 3, '2015-01-06 12:41:28', '2015-01-06 12:41:28');
/*!40000 ALTER TABLE `plans_features` ENABLE KEYS */;

-- Copiando dados para a tabela erp.plans_periods: ~6 rows (aproximadamente)
DELETE FROM `plans_periods`;
/*!40000 ALTER TABLE `plans_periods` DISABLE KEYS */;
INSERT INTO `plans_periods` (`id`, `plan_id`, `discount`, `type`, `months`, `status`, `order`, `created`, `modified`) VALUES
	(1, 2, 0.00, 'Monthly', 1, 'Active', 3, '2014-12-16 16:30:01', '2014-12-16 16:30:04'),
	(2, 2, 0.10, 'Semiannual', 6, 'Active', 2, '2014-12-16 16:30:01', '2014-12-16 16:30:04'),
	(3, 2, 0.25, 'Annual', 12, 'Active', 1, '2014-12-16 16:30:01', '2014-12-16 16:30:04'),
	(4, 3, 0.00, 'Monthly', 1, 'Active', 3, '2014-12-16 16:30:01', '2014-12-16 16:30:04'),
	(5, 3, 0.18, 'Semiannual', 6, 'Active', 2, '2014-12-16 16:30:01', '2014-12-16 16:30:04'),
	(6, 3, 0.34, 'Annual', 12, 'Active', 1, '2014-12-16 16:30:01', '2014-12-16 16:30:04');
/*!40000 ALTER TABLE `plans_periods` ENABLE KEYS */;

-- Copiando dados para a tabela erp.products: ~6 rows (aproximadamente)
DELETE FROM `products`;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `business_id`, `units_measure_id`, `code`, `name`, `description`, `purchase_value`, `sell_value`, `minimum_quantity`, `notify_low_stock`, `created`, `modified`) VALUES
	(1, 1, 0, '1', 'Produto A', '', 9.90, 15.95, 2, NULL, '2014-10-23 10:30:28', '2014-10-23 10:30:28'),
	(2, 1, 0, '2', 'Batman: The Dark Knight Returns (Deluxe Edition) [Blu-ray]', '', 9.90, 15.95, 2, NULL, '2014-10-23 10:30:28', '2014-11-18 20:30:38'),
	(4, 1, 0, '54', 'Little Big Planet 3 Launch Edition', '', 0.00, 0.00, 12, NULL, '2014-11-18 21:33:33', '2014-11-18 21:33:33'),
	(5, 1, 0, '987', 'Halo: The Master Chief Collection', '', 0.00, 0.00, 12, NULL, '2014-11-18 21:38:34', '2014-11-18 21:38:34'),
	(6, 1, 0, '1233', 'Grand Theft Auto V', '', 0.00, 0.00, 23, NULL, '2014-11-18 21:38:58', '2014-11-24 18:44:17'),
	(7, 2, 0, '1', 'Haha', '', 1500000.00, 2000000.00, 1, NULL, '2015-01-04 00:30:17', '2015-01-04 00:30:17');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Copiando dados para a tabela erp.suppliers: ~3 rows (aproximadamente)
DELETE FROM `suppliers`;
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
INSERT INTO `suppliers` (`id`, `business_id`, `name`, `email`, `is_cnpj`, `cnpj_cpf`, `phone_number`, `phone_number2`, `address`, `site`, `created`, `modified`) VALUES
	(1, 1, 'Fornecedor 1', 'fornecedor@um.com', 0, '08161419400', '', '', '', '', '2014-10-23 13:51:50', '2014-11-19 15:46:17'),
	(2, 1, 'Haha', '', 1, '', '', '', '', 'https://fornecedor.com', '2014-12-30 22:34:16', '2014-12-30 22:34:16'),
	(3, 2, 'Teste', '', 1, '', '', '', '', '', '2015-01-04 16:48:54', '2015-01-04 16:48:54');
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;

-- Copiando dados para a tabela erp.transactions: ~24 rows (aproximadamente)
DELETE FROM `transactions`;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` (`id`, `business_id`, `user_id`, `plan_id`, `price`, `period`, `url_code`, `transaction_code`, `notification_code`, `status`, `created`, `modified`) VALUES
	(1, 1, 1, 2, 0.00, 'Monthly', '9ABA96E75555FEBBB4279F9BF31FEC83', '', '', 1, '2014-12-03 20:40:08', '2014-12-03 20:40:08'),
	(2, 1, 1, 3, 0.00, 'Annual', 'F2152A82EAEA7FD3341DBF99D60DDFB2', '', '', 1, '2014-12-03 21:51:30', '2014-12-03 21:51:30'),
	(3, 1, 1, 3, 0.00, 'Monthly', 'C12356EFDDDD720994843FA3EAE294AB', '', '', 1, '2014-12-03 21:55:40', '2014-12-03 21:55:40'),
	(4, 1, 1, 3, 0.00, 'Monthly', '046822299C9C01F004DB7FA3947CD2E9', '', '', 1, '2014-12-03 21:55:57', '2014-12-03 21:55:57'),
	(5, 1, 1, 2, 0.00, 'Monthly', 'FDD03B92232367FEE4BFEF84C535276B', '', '', 1, '2014-12-04 15:49:39', '2014-12-04 15:49:39'),
	(6, 1, 1, 2, 0.00, 'Monthly', '40D43288B5B59E7884C3AF9B8BBBE984', '', '', 1, '2014-12-04 16:11:47', '2014-12-04 16:11:47'),
	(7, 1, 1, 2, 0.00, 'Monthly', 'FD985CBF8F8FE59334E8BFB9F972F34A', '', '', 1, '2014-12-04 19:09:33', '2014-12-04 19:09:33'),
	(8, 1, 1, 2, 0.00, 'Annual', '1CCD4124292921B88465CF9EA3AF6306', '', '', 1, '2014-12-04 19:14:03', '2014-12-04 19:14:03'),
	(9, 1, 1, 3, 0.00, 'Monthly', '', '', '', 1, '2014-12-04 21:53:39', '2014-12-04 21:53:39'),
	(10, 1, 1, 3, 0.00, NULL, NULL, NULL, NULL, 1, '2014-12-04 21:54:56', '2014-12-04 21:54:56'),
	(11, 1, 1, 3, NULL, NULL, NULL, NULL, NULL, 1, '2014-12-04 21:55:52', '2014-12-04 21:55:52'),
	(12, 1, 1, 2, NULL, 'Monthly', '1E6C00F87373E3BBB4CF0FA8034F50C6', NULL, NULL, 1, '2014-12-04 21:58:48', '2014-12-04 21:58:59'),
	(13, 1, 1, 3, 40.00, 'Monthly', '5D055CAB0F0F810334CDDFB3A0B32A4A', NULL, NULL, 1, '2014-12-04 22:01:16', '2014-12-04 22:01:26'),
	(14, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 1, '2014-12-05 18:40:59', '2014-12-05 18:40:59'),
	(15, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 1, '2014-12-05 18:41:08', '2014-12-05 18:41:11'),
	(16, 1, 1, 2, NULL, NULL, NULL, NULL, NULL, 1, '2014-12-17 19:29:07', '2014-12-17 19:29:07'),
	(17, 1, 1, 2, NULL, NULL, NULL, NULL, NULL, 1, '2014-12-17 19:30:39', '2014-12-17 19:30:39'),
	(18, 1, 1, 2, 144.00, 'Annual', '51E7C51CFEFE3C64444C1FB65C58F5DA', NULL, NULL, 1, '2014-12-17 19:31:16', '2014-12-17 19:31:16'),
	(19, 1, 1, 2, 96.00, 'Semiannual', 'BFCACC12DFDF0B5BB4717F91D5BA10EA', NULL, NULL, 1, '2014-12-17 19:31:42', '2014-12-17 19:31:42'),
	(20, 1, 1, 2, 20.00, 'Monthly', 'E99A709139391E71144D3F98EADC0DD3', NULL, NULL, 1, '2014-12-17 19:31:54', '2014-12-17 19:31:54'),
	(21, 4, 4, 3, 294.71, 'Semiannual', '5CF32FCD5A5A38E9949DCF9924B79AF9', NULL, NULL, 1, '2015-01-08 02:02:28', '2015-01-08 02:02:28'),
	(22, 4, 4, 3, NULL, NULL, NULL, NULL, NULL, 1, '2015-01-08 02:11:11', '2015-01-08 02:11:11'),
	(23, 4, 4, 3, 294.71, 'Semiannual', 'B749E38CA9A9ABBCC4A3CFB14F7E7D97', NULL, NULL, 1, '2015-01-08 15:32:18', '2015-01-08 15:32:18'),
	(24, 4, 4, 3, 474.41, 'Annual', 'DEA7084C6C6C63BEE4976F9D429D9E99', 'FB6F9130-D322-49A3-80B1-D2BE0150D332', '122869-6E800B800B4B-055409DF9C50-B25023', 1, '2015-01-08 15:41:12', '2015-01-08 15:41:12');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;

-- Copiando dados para a tabela erp.units_measures: ~4 rows (aproximadamente)
DELETE FROM `units_measures`;
/*!40000 ALTER TABLE `units_measures` DISABLE KEYS */;
INSERT INTO `units_measures` (`id`, `business_id`, `name`, `abbreviation`, `created`, `modified`) VALUES
	(1, 1, 'UN 1', '', '2014-10-23 10:28:08', '2014-10-23 10:28:08'),
	(2, 1, 'UN 2', '', '2014-10-23 10:28:14', '2014-10-23 10:28:14'),
	(3, 1, 'teste', '', '2014-12-30 21:08:11', '2014-12-30 21:08:11'),
	(4, 2, 'a', '', '2015-01-04 17:12:13', '2015-01-04 17:12:13');
/*!40000 ALTER TABLE `units_measures` ENABLE KEYS */;

-- Copiando dados para a tabela erp.users: ~4 rows (aproximadamente)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `group_id`, `business_id`, `first_name`, `last_name`, `email`, `email_token`, `email_token_expires`, `email_confirmed`, `access_attempts`, `last_attempt`, `password`, `created`, `modified`) VALUES
	(1, 1, 1, 'Admin', 'Admin', 'admin@admin.com', '', NULL, 1, 0, '2014-10-30 14:39:42', '520bcdfa3c1cd55799c522660dffc81baead7049', '2013-08-24 14:10:42', '2014-06-17 04:25:42'),
	(2, 2, 2, 'Conta', 'Starter', 'starter@onneblue.com', '8d3d6b9bdfd560204844d4bbde787f3eddcf16b476bcb6ec91afb886fba6ccadc843a6f09a40a41d', '2014-10-23 23:59:44', 1, 0, '2015-01-03 11:07:06', '520bcdfa3c1cd55799c522660dffc81baead7049', '2014-10-23 00:00:09', '2014-10-23 00:00:09'),
	(3, 3, 3, 'Conta', 'Bronze', 'bronze@onneblue.com', NULL, NULL, 1, 0, NULL, '520bcdfa3c1cd55799c522660dffc81baead7049', '2014-11-12 00:06:45', '2014-11-12 00:06:45'),
	(4, 4, 4, 'Conta', 'Gold', 'gold@onneblue.com', '10f73af68c088e07944d8a58e0635d3369e95a9276bcb6ec91afb886fba6ccadc843a6f09a40a41d', '2014-11-20 17:38:51', 1, 0, NULL, '520bcdfa3c1cd55799c522660dffc81baead7049', '2014-11-19 17:38:55', '2014-11-19 17:38:55');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
