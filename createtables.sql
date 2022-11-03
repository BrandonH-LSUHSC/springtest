SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


-- --------------------------------------------------------

--
-- Table structure for table `test_companies`
--

CREATE TABLE `test_companies` (
  `prikey` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `address` varchar(64) NOT NULL,
  `city` varchar(32) NOT NULL,
  `state` char(2) NOT NULL,
  `zip` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `test_employees`
--

CREATE TABLE `test_employees` (
  `prikey` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `address` varchar(64) NOT NULL,
  `city` varchar(32) NOT NULL,
  `state` char(2) NOT NULL,
  `zip` char(5) NOT NULL,
  `company` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `test_companies`
--
ALTER TABLE `test_companies`
  ADD PRIMARY KEY (`prikey`);

--
-- Indexes for table `test_employees`
--
ALTER TABLE `test_employees`
  ADD PRIMARY KEY (`prikey`),
  ADD KEY `company` (`company`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `test_companies`
--
ALTER TABLE `test_companies`
  MODIFY `prikey` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `test_employees`
--
ALTER TABLE `test_employees`
  MODIFY `prikey` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `test_employees`
--
ALTER TABLE `test_employees`
  ADD CONSTRAINT `test_employees_ibfk_1` FOREIGN KEY (`company`) REFERENCES `test_companies` (`prikey`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
