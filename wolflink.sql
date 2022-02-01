-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2022-02-01 20:37:37
-- 服务器版本： 5.6.50-log
-- PHP 版本： 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `Test`
--

-- --------------------------------------------------------

--
-- 表的结构 `wolflink`
--

CREATE TABLE `wolflink` (
  `ID` int(8) NOT NULL,
  `SJ` datetime NOT NULL,
  `IP` varchar(16) NOT NULL,
  `CL` text NOT NULL,
  `DL` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `wolflink`
--

INSERT INTO `wolflink` (`ID`, `SJ`, `IP`, `CL`, `DL`) VALUES
(1, '2022-02-01 20:27:47', '127.0.0.1', 'https://qm.qq.com/cgi-bin/qm/qr?k=3ME_Jx_70KYBC_5I4GeT71tSwjn91NuL&amp;noverify=0', '1'),
(2, '2022-02-01 20:28:31', '127.0.0.1', '狼介（WOLF4096）狼介（WOLF4096）\r\n狼介（WOLF4096）狼介（WOLF4096）\r\n狼介（WOLF4096）狼介（WOLF4096）\r\n狼介（WOLF4096）狼介（WOLF4096）\r\n狼介（WOLF4096）狼介（WOLF4096）\r\n狼介（WOLF4096）狼介（WOLF4096）\r\n狼介（WOLF4096）狼介（WOLF4096）\r\n狼介（WOLF4096）狼介（WOLF4096）\r\n', '2');

--
-- 转储表的索引
--

--
-- 表的索引 `wolflink`
--
ALTER TABLE `wolflink`
  ADD PRIMARY KEY (`ID`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `wolflink`
--
ALTER TABLE `wolflink`
  MODIFY `ID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
