SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Databáze: `ol_guided_tour`
--
CREATE DATABASE IF NOT EXISTS `ol_guided_tour` DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;
USE `ol_guided_tour`;

-- --------------------------------------------------------

--
-- Struktura tabulky `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url_mask` varchar(250) COLLATE utf8_czech_ci NOT NULL DEFAULT '' COMMENT 'Mask of URL (where to show)',
  `selector` varchar(250) COLLATE utf8_czech_ci NOT NULL DEFAULT '' COMMENT 'Selector (id, class)',
  `selector_index` int(11) DEFAULT NULL COMMENT 'For non-unique selector insert index',
  `position` enum('left','right','top','bottom') COLLATE utf8_czech_ci DEFAULT NULL COMMENT 'Position: left, right, top (default), bottom',
  `content` varchar(500) COLLATE utf8_czech_ci NOT NULL DEFAULT '' COMMENT 'Content',
  `priority` int(11) NOT NULL DEFAULT '0' COMMENT 'Order (from 1 to N)',
  `active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Active',
  `lastmod_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Last modification',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci COMMENT='Items';

--
-- Vypisuji data pro tabulku `item`
--

INSERT INTO `item` (`id`, `url_mask`, `selector`, `selector_index`, `position`, `content`, `priority`, `active`, `lastmod_at`) VALUES
(1, 'labyrinthManager/global', '#globalMapFrom', NULL, NULL, 'Start your edit job here.', 0, 1, '2017-10-25 12:51:34'),
(2, 'labyrinthManager/global', '#mtitle', NULL, NULL, 'Insert good title', 0, 1, '2017-08-30 12:31:08'),
(3, '*', '.dropdown-menu li', 3, NULL, 'This example shows how to address the first item in the web page menu', 0, 1, '2017-10-25 12:44:28'),
(4, '*', '.btn-mini', 0, 'left', 'The first mini button - NICE!', 1, 1, '2017-10-25 12:49:14'),
(5, 'renderLabyrinth/index', 'button', NULL, NULL, 'This is a button', 0, 1, '2017-08-30 12:04:08'),
(6, 'renderLabyrinth/index', 'a p.style2 strong', NULL, NULL, 'Review served for...', 10, 1, '2017-08-31 07:03:59'),
(7, '*', '.nav li.dropdown', 2, 'bottom', 'another result which is not absolutely fantastic :-(', 2, 1, '2017-10-25 12:42:52'),
(8, 'labyrinthManager/global', '.nav-list li:eq(3) a', NULL, 'right', 'advanced jquery selector BAD example ', 5, 0, '2017-09-07 09:54:22'),
(9, '*', '.btn-mini', 4, NULL, 'The fifth button is indexed as 4', 4, 1, '2017-10-25 12:48:19');
