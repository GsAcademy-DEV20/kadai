-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2021-07-02 06:52:53
-- サーバのバージョン： 10.4.19-MariaDB
-- PHP のバージョン: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `gs_kadai_07`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `room_table`
--

CREATE TABLE `room_table` (
  `id` int(12) NOT NULL,
  `item` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `value` int(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `fname` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `indate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `room_table`
--

INSERT INTO `room_table` (`id`, `item`, `value`, `description`, `fname`, `indate`) VALUES
(2, '独習PHP', 3750, '   PHPの本だよ', 'book1.jpg', '2021-07-01 22:49:55'),
(3, 'javascript「超」入門', 2450, ' javascriptの本だよ', 'book2.jpg', '2021-07-01 22:54:18'),
(4, '1冊ですべて身につくHTML ＆ CSSとWebデザイン入門講座', 2237, 'HTMLとCSSの本だよ', 'book3.jpg', '2021-07-01 22:55:31');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `room_table`
--
ALTER TABLE `room_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `room_table`
--
ALTER TABLE `room_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
