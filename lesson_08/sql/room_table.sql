-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2021-07-09 17:30:10
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
-- データベース: `gs_kadai_08`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `room_table`
--

CREATE TABLE `room_table` (
  `id` int(12) NOT NULL,
  `type` int(6) NOT NULL,
  `name` varchar(64) NOT NULL,
  `key_flg` int(1) NOT NULL,
  `psw` varchar(64) DEFAULT NULL,
  `indate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `room_table`
--

INSERT INTO `room_table` (`id`, `type`, `name`, `key_flg`, `psw`, `indate`) VALUES
(7, 1, 'プログラミング勉強会1', 2, 'hogehoge', '2021-07-09 12:39:42'),
(8, 2, 'プログラミング勉強会2', 1, 'hoge', '2021-07-09 12:40:09');

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
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
