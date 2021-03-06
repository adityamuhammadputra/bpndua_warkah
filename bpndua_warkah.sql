-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.11-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for bpndua
CREATE DATABASE IF NOT EXISTS `bpndua` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `bpndua`;

-- Dumping structure for table bpndua.desa
CREATE TABLE IF NOT EXISTS `desa` (
  `id` char(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `kecamatan` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table bpndua.desa: ~425 rows (approximately)
/*!40000 ALTER TABLE `desa` DISABLE KEYS */;
REPLACE INTO `desa` (`id`, `name`, `kecamatan`) VALUES
	('3201010001', 'MALASARI', 'NANGGUNG'),
	('3201010002', 'BANTAR KARET', 'NANGGUNG'),
	('3201010003', 'CISARUA', 'NANGGUNG'),
	('3201010004', 'CURUG BITUNG', 'NANGGUNG'),
	('3201010005', 'NANGGUNG', 'NANGGUNG'),
	('3201010006', 'PANGKAL JAYA', 'NANGGUNG'),
	('3201010007', 'SUKALUYU', 'NANGGUNG'),
	('3201010008', 'HAMBARO', 'NANGGUNG'),
	('3201010009', 'KALONG LIUD', 'NANGGUNG'),
	('3201010010', 'PARAKAN MUNCANG', 'NANGGUNG'),
	('3201010011', 'BATU TULIS', 'NANGGUNG'),
	('3201020001', 'PURASARI', 'LEUWILIANG'),
	('3201020002', 'PURASEDA', 'LEUWILIANG'),
	('3201020003', 'KARYASARI', 'LEUWILIANG'),
	('3201020004', 'PABANGBON', 'LEUWILIANG'),
	('3201020005', 'KARACAK', 'LEUWILIANG'),
	('3201020006', 'BARENGKOK', 'LEUWILIANG'),
	('3201020007', 'CIBEBER II', 'LEUWILIANG'),
	('3201020016', 'CIBEBER I', 'LEUWILIANG'),
	('3201020017', 'LEUWIMEKAR', 'LEUWILIANG'),
	('3201020018', 'LEUWILIANG', 'LEUWILIANG'),
	('3201020019', 'KAREHKEL', 'LEUWILIANG'),
	('3201021001', 'WANGUN JAYA', 'LEUWISADENG'),
	('3201021002', 'SADENGKOLOT', 'LEUWISADENG'),
	('3201021003', 'LEUWISADENG', 'LEUWISADENG'),
	('3201021004', 'SIBANTENG', 'LEUWISADENG'),
	('3201021005', 'BABAKAN SADENG', 'LEUWISADENG'),
	('3201021006', 'SADENG', 'LEUWISADENG'),
	('3201021007', 'KALONG II', 'LEUWISADENG'),
	('3201021008', 'KALONG I', 'LEUWISADENG'),
	('3201030001', 'CIBUNIAN', 'PAMIJAHAN'),
	('3201030002', 'PURWABAKTI', 'PAMIJAHAN'),
	('3201030003', 'CIASMARA', 'PAMIJAHAN'),
	('3201030004', 'CIASIHAN', 'PAMIJAHAN'),
	('3201030005', 'GUNUNG SARI', 'PAMIJAHAN'),
	('3201030008', 'CIBENING', 'PAMIJAHAN'),
	('3201030009', 'GUNUNG PICUNG', 'PAMIJAHAN'),
	('3201030010', 'CIBITUNG KULON', 'PAMIJAHAN'),
	('3201030011', 'CIBITUNG WETAN', 'PAMIJAHAN'),
	('3201030012', 'PAMIJAHAN', 'PAMIJAHAN'),
	('3201030013', 'PASAREAN', 'PAMIJAHAN'),
	('3201030014', 'GUNUNG MENYAN', 'PAMIJAHAN'),
	('3201030015', 'CIMAYANG', 'PAMIJAHAN'),
	('3201040001', 'SITU UDIK', 'CIBUNGBULANG'),
	('3201040002', 'SITU ILIR', 'CIBUNGBULANG'),
	('3201040003', 'CIBATOK 2', 'CIBUNGBULANG'),
	('3201040004', 'CIARUTEN UDIK', 'CIBUNGBULANG'),
	('3201040005', 'CIBATOK 1', 'CIBUNGBULANG'),
	('3201040006', 'SUKAMAJU', 'CIBUNGBULANG'),
	('3201040007', 'CEMPLANG', 'CIBUNGBULANG'),
	('3201040008', 'GALUGA', 'CIBUNGBULANG'),
	('3201040010', 'CIMANGGU 2', 'CIBUNGBULANG'),
	('3201040011', 'CIMANGGU 1', 'CIBUNGBULANG'),
	('3201040012', 'GIRIMULYA', 'CIBUNGBULANG'),
	('3201040013', 'LEUWEUNG KOLOT', 'CIBUNGBULANG'),
	('3201040014', 'CIARUTEN ILIR', 'CIBUNGBULANG'),
	('3201040015', 'CIJUJUNG', 'CIBUNGBULANG'),
	('3201050004', 'CIAMPEA UDIK', 'CIAMPEA'),
	('3201050008', 'CINANGKA', 'CIAMPEA'),
	('3201050009', 'CIBUNTU', 'CIAMPEA'),
	('3201050010', 'CICADAS', 'CIAMPEA'),
	('3201050011', 'TEGAL WARU', 'CIAMPEA'),
	('3201050012', 'BOJONG JENGKOL', 'CIAMPEA'),
	('3201050013', 'CIHIDEUNG UDIK', 'CIAMPEA'),
	('3201050014', 'CIHIDEUNG ILIR', 'CIAMPEA'),
	('3201050015', 'CIBANTENG', 'CIAMPEA'),
	('3201050016', 'BOJONG RANGKAS', 'CIAMPEA'),
	('3201050017', 'CIBADAK', 'CIAMPEA'),
	('3201050019', 'CIAMPEA', 'CIAMPEA'),
	('3201051001', 'TAPOS 1', 'TENJOLAYA'),
	('3201051002', 'GUNUNG MALANG', 'TENJOLAYA'),
	('3201051003', 'TAPOS 2', 'TENJOLAYA'),
	('3201051004', 'SITU DAUN', 'TENJOLAYA'),
	('3201051005', 'CIBITUNG TENGAH', 'TENJOLAYA'),
	('3201051006', 'CINANGNENG', 'TENJOLAYA'),
	('3201051007', 'GUNUNG MULYA', 'TENJOLAYA'),
	('3201060001', 'PURWASARI', 'DRAMAGA'),
	('3201060002', 'PETIR', 'DRAMAGA'),
	('3201060003', 'SUKADAMAI', 'DRAMAGA'),
	('3201060004', 'SUKAWENING', 'DRAMAGA'),
	('3201060005', 'NEGLASARI', 'DRAMAGA'),
	('3201060006', 'SINAR SARI', 'DRAMAGA'),
	('3201060007', 'CIHERANG', 'DRAMAGA'),
	('3201060008', 'DRAMAGA', 'DRAMAGA'),
	('3201060009', 'BABAKAN', 'DRAMAGA'),
	('3201060010', 'CIKARAWANG', 'DRAMAGA'),
	('3201070009', 'KOTA BATU', 'CIOMAS'),
	('3201070010', 'MEKARJAYA', 'CIOMAS'),
	('3201070011', 'PARAKAN', 'CIOMAS'),
	('3201070012', 'CIOMAS', 'CIOMAS'),
	('3201070013', 'PAGELARAN', 'CIOMAS'),
	('3201070014', 'SUKAMAKMUR', 'CIOMAS'),
	('3201070015', 'CIAPUS', 'CIOMAS'),
	('3201070016', 'SUKAHARJA', 'CIOMAS'),
	('3201070017', 'PADASUKA', 'CIOMAS'),
	('3201070018', 'CIOMAS RAHAYU', 'CIOMAS'),
	('3201070019', 'LALADON', 'CIOMAS'),
	('3201071001', 'SUKAJADI', 'TAMANSARI'),
	('3201071002', 'SUKALUYU', 'TAMANSARI'),
	('3201071003', 'SUKAJAYA', 'TAMANSARI'),
	('3201071004', 'SUKARESMI', 'TAMANSARI'),
	('3201071005', 'PASIR EURIH', 'TAMANSARI'),
	('3201071006', 'TAMAN SARI', 'TAMANSARI'),
	('3201071007', 'SUKAMANTRI', 'TAMANSARI'),
	('3201071008', 'SIRNAGALIH', 'TAMANSARI'),
	('3201080010', 'WARUNG MENTENG', 'CIJERUK'),
	('3201080011', 'CIJERUK', 'CIJERUK'),
	('3201080012', 'CIPELANG', 'CIJERUK'),
	('3201080013', 'CIBALUNG', 'CIJERUK'),
	('3201080014', 'CIPICUNG', 'CIJERUK'),
	('3201080015', 'TANJUNG SARI', 'CIJERUK'),
	('3201080016', 'TAJUR HALANG', 'CIJERUK'),
	('3201080017', 'PALASARI', 'CIJERUK'),
	('3201080018', 'SUKAHARJA', 'CIJERUK'),
	('3201081001', 'TUGU JAYA', 'CIGOMBONG'),
	('3201081002', 'CIGOMBONG', 'CIGOMBONG'),
	('3201081003', 'WATES JAYA', 'CIGOMBONG'),
	('3201081004', 'SROGOL', 'CIGOMBONG'),
	('3201081005', 'CIBURUY', 'CIGOMBONG'),
	('3201081006', 'CISALADA', 'CIGOMBONG'),
	('3201081007', 'PASIR JAYA', 'CIGOMBONG'),
	('3201081008', 'CIBURAYUT', 'CIGOMBONG'),
	('3201081009', 'CIADEG', 'CIGOMBONG'),
	('3201090001', 'PASIR BUNCIR', 'CARINGIN'),
	('3201090002', 'CINAGARA', 'CARINGIN'),
	('3201090003', 'TANGKIL', 'CARINGIN'),
	('3201090004', 'PASIR MUNCANG', 'CARINGIN'),
	('3201090005', 'MUARA JAYA', 'CARINGIN'),
	('3201090006', 'CARINGIN', 'CARINGIN'),
	('3201090007', 'LEMAH DUHUR', 'CARINGIN'),
	('3201090008', 'CIMANDE', 'CARINGIN'),
	('3201090009', 'PANCAWATI', 'CARINGIN'),
	('3201090010', 'CIDERUM', 'CARINGIN'),
	('3201090011', 'CIHERANG PONDOK', 'CARINGIN'),
	('3201090012', 'CIMANDE HILIR', 'CARINGIN'),
	('3201100001', 'CILEUNGSI', 'CIAWI'),
	('3201100002', 'CITAPEN', 'CIAWI'),
	('3201100003', 'CIBEDUG', 'CIAWI'),
	('3201100004', 'BOJONG MURNI', 'CIAWI'),
	('3201100005', 'JAMBU LUWUK', 'CIAWI'),
	('3201100006', 'BANJAR SARI', 'CIAWI'),
	('3201100007', 'BANJAR WANGI', 'CIAWI'),
	('3201100008', 'BITUNG SARI', 'CIAWI'),
	('3201100009', 'TELUK PINANG', 'CIAWI'),
	('3201100010', 'BANJAR WARU', 'CIAWI'),
	('3201100011', 'CIAWI', 'CIAWI'),
	('3201100012', 'BENDUNGAN', 'CIAWI'),
	('3201100013', 'PANDANSARI', 'CIAWI'),
	('3201110001', 'CITEKO', 'CISARUA'),
	('3201110002', 'CIBEUREUM', 'CISARUA'),
	('3201110003', 'TUGU SELATAN', 'CISARUA'),
	('3201110004', 'TUGU UTARA', 'CISARUA'),
	('3201110005', 'BATU LAYANG', 'CISARUA'),
	('3201110006', 'CISARUA', 'CISARUA'),
	('3201110007', 'KOPO', 'CISARUA'),
	('3201110008', 'LEUWIMALANG', 'CISARUA'),
	('3201110009', 'JOGJOGAN', 'CISARUA'),
	('3201110010', 'CILEMBER', 'CISARUA'),
	('3201120001', 'SUKARESMI', 'MEGAMENDUNG'),
	('3201120002', 'SUKAGALIH', 'MEGAMENDUNG'),
	('3201120003', 'KUTA', 'MEGAMENDUNG'),
	('3201120004', 'SUKAKARYA', 'MEGAMENDUNG'),
	('3201120005', 'SUKAMANAH', 'MEGAMENDUNG'),
	('3201120006', 'SUKAMAJU', 'MEGAMENDUNG'),
	('3201120007', 'SUKAMAHI', 'MEGAMENDUNG'),
	('3201120008', 'GADOG', 'MEGAMENDUNG'),
	('3201120009', 'CIPAYUNG', 'MEGAMENDUNG'),
	('3201120010', 'CIPAYUNG GIRANG', 'MEGAMENDUNG'),
	('3201120011', 'MEGAMENDUNG', 'MEGAMENDUNG'),
	('3201120012', 'PASIR ANGIN', 'MEGAMENDUNG'),
	('3201130001', 'CIBANON', 'SUKARAJA'),
	('3201130002', 'GUNUNG GEULIS', 'SUKARAJA'),
	('3201130003', 'NAGRAK', 'SUKARAJA'),
	('3201130004', 'SUKATANI', 'SUKARAJA'),
	('3201130005', 'SUKARAJA', 'SUKARAJA'),
	('3201130006', 'CIKEAS', 'SUKARAJA'),
	('3201130007', 'CADAS NGAMPAR', 'SUKARAJA'),
	('3201130008', 'PASIRLAJA', 'SUKARAJA'),
	('3201130009', 'CIJUJUNG', 'SUKARAJA'),
	('3201130010', 'CIMANDALA', 'SUKARAJA'),
	('3201130011', 'PASIR JAMBU', 'SUKARAJA'),
	('3201130012', 'CILEBUT TIMUR', 'SUKARAJA'),
	('3201130013', 'CILEBUT BARAT', 'SUKARAJA'),
	('3201140001', 'CIJAYANTI', 'BABAKAN MADANG'),
	('3201140002', 'BOJONG KONENG', 'BABAKAN MADANG'),
	('3201140003', 'KARANG TENGAH', 'BABAKAN MADANG'),
	('3201140004', 'SUMUR BATU', 'BABAKAN MADANG'),
	('3201140005', 'BABAKAN MADANG', 'BABAKAN MADANG'),
	('3201140006', 'CITARINGGUL', 'BABAKAN MADANG'),
	('3201140007', 'CIPAMBUAN', 'BABAKAN MADANG'),
	('3201140008', 'KADUMANGU', 'BABAKAN MADANG'),
	('3201150001', 'SUKAWANGI', 'SUKAMAKMUR'),
	('3201150002', 'SUKAHARJA', 'SUKAMAKMUR'),
	('3201150003', 'WARGAJAYA', 'SUKAMAKMUR'),
	('3201150004', 'SIRNAJAYA', 'SUKAMAKMUR'),
	('3201150005', 'SUKAMULYA', 'SUKAMAKMUR'),
	('3201150006', 'SUKAMAKMUR', 'SUKAMAKMUR'),
	('3201150007', 'CIBADAK', 'SUKAMAKMUR'),
	('3201150008', 'PABUARAN', 'SUKAMAKMUR'),
	('3201150009', 'SUKADAMAI', 'SUKAMAKMUR'),
	('3201150010', 'SUKARESMI', 'SUKAMAKMUR'),
	('3201160011', 'KARYA MEKAR', 'CARIU'),
	('3201160012', 'BANTAR KUNING', 'CARIU'),
	('3201160013', 'CIKUTAMAHI', 'CARIU'),
	('3201160014', 'CIBATU TIGA', 'CARIU'),
	('3201160015', 'MEKARWANGI', 'CARIU'),
	('3201160016', 'TEGAL PANJANG', 'CARIU'),
	('3201160017', 'CARIU', 'CARIU'),
	('3201160018', 'KUTA MEKAR', 'CARIU'),
	('3201160019', 'SUKAJADI', 'CARIU'),
	('3201160020', 'BABAKAN RADEN', 'CARIU'),
	('3201161001', 'CIBADAK', 'TANJUNGSARI'),
	('3201161002', 'TANJUNG SARI', 'TANJUNGSARI'),
	('3201161003', 'SINARSARI', 'TANJUNGSARI'),
	('3201161004', 'SINARRASA', 'TANJUNGSARI'),
	('3201161005', 'BUANAJAYA', 'TANJUNGSARI'),
	('3201161006', 'ANTAJAYA', 'TANJUNGSARI'),
	('3201161007', 'PASIR TANJUNG', 'TANJUNGSARI'),
	('3201161008', 'TANJUNG RASA', 'TANJUNGSARI'),
	('3201161009', 'SUKARASA', 'TANJUNGSARI'),
	('3201161010', 'SELAWANGI', 'TANJUNGSARI'),
	('3201170001', 'SUKAJAYA', 'JONGGOL'),
	('3201170002', 'SUKANEGARA', 'JONGGOL'),
	('3201170003', 'CIBODAS', 'JONGGOL'),
	('3201170004', 'SINGASARI', 'JONGGOL'),
	('3201170005', 'SINGAJAYA', 'JONGGOL'),
	('3201170006', 'SUKASIRNA', 'JONGGOL'),
	('3201170007', 'BALEKAMBANG', 'JONGGOL'),
	('3201170008', 'BENDUNGAN', 'JONGGOL'),
	('3201170009', 'SIRNAGALIH', 'JONGGOL'),
	('3201170010', 'JONGGOL', 'JONGGOL'),
	('3201170011', 'SUKAMAJU', 'JONGGOL'),
	('3201170012', 'SUKAMANAH', 'JONGGOL'),
	('3201170013', 'WENINGGALIH', 'JONGGOL'),
	('3201170014', 'SUKAGALIH', 'JONGGOL'),
	('3201180010', 'DAYEUH', 'CILEUNGSI'),
	('3201180011', 'MAMPIR', 'CILEUNGSI'),
	('3201180012', 'SETU SARI', 'CILEUNGSI'),
	('3201180013', 'CIPEUCANG', 'CILEUNGSI'),
	('3201180014', 'JATISARI', 'CILEUNGSI'),
	('3201180015', 'GANDOANG', 'CILEUNGSI'),
	('3201180016', 'MEKARSARI', 'CILEUNGSI'),
	('3201180017', 'CILEUNGSI KIDUL', 'CILEUNGSI'),
	('3201180018', 'CILEUNGSI', 'CILEUNGSI'),
	('3201180019', 'LIMUS NUNGGAL', 'CILEUNGSI'),
	('3201180020', 'PASIR ANGIN', 'CILEUNGSI'),
	('3201180021', 'CIPENJO', 'CILEUNGSI'),
	('3201181001', 'LEUWIKARET', 'KELAPA NUNGGAL'),
	('3201181003', 'BANTAR JATI', 'KELAPA NUNGGAL'),
	('3201181004', 'NAMBO', 'KELAPA NUNGGAL'),
	('3201181005', 'KEMBANG KUNING', 'KELAPA NUNGGAL'),
	('3201181006', 'KELAPA NUNGGAL', 'KELAPA NUNGGAL'),
	('3201181007', 'LIGARMUKTI', 'KELAPA NUNGGAL'),
	('3201181008', 'BOJONG', 'KELAPA NUNGGAL'),
	('3201181009', 'CIKAHURIPAN', 'KELAPA NUNGGAL'),
	('3201190001', 'KARANGGAN', 'GUNUNG PUTRI'),
	('3201190002', 'GUNUNG PUTRI', 'GUNUNG PUTRI'),
	('3201190003', 'TLAJUNG UDIK', 'GUNUNG PUTRI'),
	('3201190004', 'BOJONG NANGKA', 'GUNUNG PUTRI'),
	('3201190005', 'CICADAS', 'GUNUNG PUTRI'),
	('3201190006', 'WANAHERANG', 'GUNUNG PUTRI'),
	('3201190007', 'CIKEAS UDIK', 'GUNUNG PUTRI'),
	('3201190008', 'NAGRAK', 'GUNUNG PUTRI'),
	('3201190009', 'CIANGSANA', 'GUNUNG PUTRI'),
	('3201190010', 'BOJONG KULUR', 'GUNUNG PUTRI'),
	('3201200001', 'TANGKIL', 'CITEUREUP'),
	('3201200002', 'HAMBALANG', 'CITEUREUP'),
	('3201200003', 'TAJUR', 'CITEUREUP'),
	('3201200004', 'PASIR MUKTI', 'CITEUREUP'),
	('3201200005', 'SUKAHATI', 'CITEUREUP'),
	('3201200006', 'LEUWINUTUG', 'CITEUREUP'),
	('3201200007', 'SANJA', 'CITEUREUP'),
	('3201200008', 'KARANG ASEM BARAT', 'CITEUREUP'),
	('3201200009', 'KARANG ASEM TIMUR', 'CITEUREUP'),
	('3201200010', 'TARIKOLOT', 'CITEUREUP'),
	('3201200011', 'GUNUNG SARI', 'CITEUREUP'),
	('3201200012', 'CITEUREUP', 'CITEUREUP'),
	('3201200013', 'PUSPANEGARA', 'CITEUREUP'),
	('3201200014', 'PUSPASARI', 'CITEUREUP'),
	('3201210001', 'KARADENAN', 'CIBINONG'),
	('3201210002', 'NANGGEWER', 'CIBINONG'),
	('3201210003', 'NANGGEWER MEKAR', 'CIBINONG'),
	('3201210004', 'CIBINONG', 'CIBINONG'),
	('3201210005', 'PAKANSARI', 'CIBINONG'),
	('3201210006', 'SUKAHATI', 'CIBINONG'),
	('3201210007', 'TENGAH', 'CIBINONG'),
	('3201210008', 'PONDOK RAJEG', 'CIBINONG'),
	('3201210009', 'HARAPAN JAYA', 'CIBINONG'),
	('3201210010', 'PABUARAN', 'CIBINONG'),
	('3201210011', 'CIRIMEKAR', 'CIBINONG'),
	('3201210012', 'CIRIUNG', 'CIBINONG'),
	('3201210013', 'PABUARAN MEKAR', 'CIBINONG'),
	('3201220002', 'CIMANGGIS', 'BOJONG GEDE'),
	('3201220003', 'WARINGIN JAYA', 'BOJONG GEDE'),
	('3201220004', 'KEDUNG WARINGIN', 'BOJONG GEDE'),
	('3201220005', 'BOJONG GEDE', 'BOJONG GEDE'),
	('3201220011', 'SUSUKAN', 'BOJONG GEDE'),
	('3201220012', 'BOJONG BARU', 'BOJONG GEDE'),
	('3201220013', 'RAWA PANJANG', 'BOJONG GEDE'),
	('3201220014', 'PABUARAN', 'BOJONG GEDE'),
	('3201220015', 'RAGAJAYA', 'BOJONG GEDE'),
	('3201221001', 'TONJONG', 'TAJUR HALANG'),
	('3201221002', 'TAJUR HALANG', 'TAJUR HALANG'),
	('3201221003', 'SUKMAJAYA', 'TAJUR HALANG'),
	('3201221004', 'NANGGERANG', 'TAJUR HALANG'),
	('3201221005', 'SASAK PANJANG', 'TAJUR HALANG'),
	('3201221006', 'KALISUREN', 'TAJUR HALANG'),
	('3201221007', 'CITAYAM', 'TAJUR HALANG'),
	('3201230006', 'SEMPLAK BARAT', 'KEMANG'),
	('3201230007', 'ATANG SENJAYA', 'KEMANG'),
	('3201230008', 'PARAKAN JAYA', 'KEMANG'),
	('3201230009', 'BOJONG', 'KEMANG'),
	('3201230010', 'KEMANG', 'KEMANG'),
	('3201230011', 'PABUARAN', 'KEMANG'),
	('3201230013', 'TEGAL', 'KEMANG'),
	('3201230014', 'PONDOK UDIK', 'KEMANG'),
	('3201230015', 'JAMPANG', 'KEMANG'),
	('3201231001', 'MEKARSARI', 'RANCA BUNGUR'),
	('3201231002', 'RANCA BUNGUR', 'RANCA BUNGUR'),
	('3201231003', 'PASIR GAOK', 'RANCA BUNGUR'),
	('3201231004', 'BANTARJAYA', 'RANCA BUNGUR'),
	('3201231005', 'BANTAR SARI', 'RANCA BUNGUR'),
	('3201231006', 'CANDALI', 'RANCA BUNGUR'),
	('3201231007', 'CIMULANG', 'RANCA BUNGUR'),
	('3201240009', 'IWUL', 'PARUNG'),
	('3201240010', 'JABON MEKAR', 'PARUNG'),
	('3201240011', 'PAMAGER SARI', 'PARUNG'),
	('3201240012', 'PARUNG', 'PARUNG'),
	('3201240013', 'WARU', 'PARUNG'),
	('3201240014', 'WARUJAYA', 'PARUNG'),
	('3201240015', 'BOJONG SEMPU', 'PARUNG'),
	('3201240016', 'BOJONG INDAH', 'PARUNG'),
	('3201240017', 'COGREG', 'PARUNG'),
	('3201241001', 'KARIHKIL', 'CISEENG'),
	('3201241002', 'CIBEUTEUNG UDIK', 'CISEENG'),
	('3201241003', 'BABAKAN', 'CISEENG'),
	('3201241004', 'PUTAT NUTUG', 'CISEENG'),
	('3201241005', 'CIBEUTEUNG MUARA', 'CISEENG'),
	('3201241006', 'CIBENTANG', 'CISEENG'),
	('3201241007', 'PARIGI MEKAR', 'CISEENG'),
	('3201241008', 'CISEENG', 'CISEENG'),
	('3201241009', 'CIHOWE', 'CISEENG'),
	('3201241010', 'KURIPAN', 'CISEENG'),
	('3201250001', 'JAMPANG', 'GUNUNG SINDUR'),
	('3201250002', 'CIBADUNG', 'GUNUNG SINDUR'),
	('3201250003', 'CIBINONG', 'GUNUNG SINDUR'),
	('3201250004', 'CIDOKOM', 'GUNUNG SINDUR'),
	('3201250005', 'PADURENAN', 'GUNUNG SINDUR'),
	('3201250007', 'RAWAKALONG', 'GUNUNG SINDUR'),
	('3201250008', 'PENGASINAN', 'GUNUNG SINDUR'),
	('3201250009', 'GUNUNG SINDUR', 'GUNUNG SINDUR'),
	('3201250010', 'PABUARAN', 'GUNUNG SINDUR'),
	('3201260001', 'LEUWIBATU', 'RUMPIN'),
	('3201260002', 'CIDOKOM', 'RUMPIN'),
	('3201260003', 'GOBANG', 'RUMPIN'),
	('3201260004', 'RABAK', 'RUMPIN'),
	('3201260005', 'CIBODAS', 'RUMPIN'),
	('3201260006', 'KAMPUNG SAWAH', 'RUMPIN'),
	('3201260007', 'RUMPIN', 'RUMPIN'),
	('3201260008', 'CIPINANG', 'RUMPIN'),
	('3201260009', 'SUKASARI', 'RUMPIN'),
	('3201260010', 'KERTAJAYA', 'RUMPIN'),
	('3201260011', 'TAMAN SARI', 'RUMPIN'),
	('3201260012', 'SUKAMULYA', 'RUMPIN'),
	('3201260013', 'MEKAR SARI', 'RUMPIN'),
	('3201260014', 'MEKARJAYA', 'RUMPIN'),
	('3201270006', 'SUKARAKSA', 'CIGUDEG'),
	('3201270009', 'SUKAMAJU', 'CIGUDEG'),
	('3201270010', 'CIGUDEG', 'CIGUDEG'),
	('3201270011', 'BANYU RESMI', 'CIGUDEG'),
	('3201270012', 'WARGAJAYA', 'CIGUDEG'),
	('3201270013', 'BUNAR', 'CIGUDEG'),
	('3201270014', 'MEKARJAYA', 'CIGUDEG'),
	('3201270015', 'CINTAMANIK', 'CIGUDEG'),
	('3201270016', 'BANYU WANGI', 'CIGUDEG'),
	('3201270017', 'BANYU ASIH', 'CIGUDEG'),
	('3201270018', 'TEGALEGA', 'CIGUDEG'),
	('3201270019', 'BATU JAJAR', 'CIGUDEG'),
	('3201270020', 'RENGASJAJAR', 'CIGUDEG'),
	('3201270021', 'BANGUNJAYA', 'CIGUDEG'),
	('3201270022', 'ARGAPURA', 'CIGUDEG'),
	('3201271001', 'CISARUA', 'SUKAJAYA'),
	('3201271002', 'KIARASARI', 'SUKAJAYA'),
	('3201271003', 'KIARAPANDAK', 'SUKAJAYA'),
	('3201271004', 'HARKATJAYA', 'SUKAJAYA'),
	('3201271005', 'SUKAJAYA', 'SUKAJAYA'),
	('3201271006', 'SIPAYUNG', 'SUKAJAYA'),
	('3201271007', 'SUKAMULIH', 'SUKAJAYA'),
	('3201271008', 'PASIR MADANG', 'SUKAJAYA'),
	('3201271009', 'CILEUKSA', 'SUKAJAYA'),
	('3201271011', 'JAYARAHARJA', 'SUKAJAYA'),
	('3201280003', 'PANGRADIN', 'JASINGA'),
	('3201280004', 'KALONGSAWAH', 'JASINGA'),
	('3201280005', 'SIPAK', 'JASINGA'),
	('3201280006', 'PAMAGERSARI', 'JASINGA'),
	('3201280007', 'JUGALA JAYA', 'JASINGA'),
	('3201280009', 'TEGAL WANGI', 'JASINGA'),
	('3201280010', 'KOLEANG', 'JASINGA'),
	('3201280011', 'JASINGA', 'JASINGA'),
	('3201280013', 'CIKOPOMAYAK', 'JASINGA'),
	('3201280014', 'NEGLASARI', 'JASINGA'),
	('3201280015', 'BAGOANG', 'JASINGA'),
	('3201280016', 'BARENGKOK', 'JASINGA'),
	('3201280017', 'PANGAUR', 'JASINGA'),
	('3201280018', 'WIRAJAYA', 'JASINGA'),
	('3201290001', 'CIOMAS', 'TENJO'),
	('3201290002', 'TAPOS', 'TENJO'),
	('3201290003', 'BATOK', 'TENJO'),
	('3201290004', 'BABAKAN', 'TENJO'),
	('3201290005', 'BOJONG', 'TENJO'),
	('3201290006', 'SINGABRAJA', 'TENJO'),
	('3201290007', 'TENJO', 'TENJO'),
	('3201290008', 'CILAKU', 'TENJO'),
	('3201290009', 'SINGABANGSA', 'TENJO'),
	('3201300001', 'JAGABAYA', 'PARUNG PANJANG'),
	('3201300002', 'GOROWONG', 'PARUNG PANJANG'),
	('3201300003', 'DAGO', 'PARUNG PANJANG'),
	('3201300004', 'CIKUDA', 'PARUNG PANJANG'),
	('3201300005', 'PINGKU', 'PARUNG PANJANG'),
	('3201300006', 'LUMPANG', 'PARUNG PANJANG'),
	('3201300007', 'GINTUNG CILEJET', 'PARUNG PANJANG'),
	('3201300008', 'JAGABITA', 'PARUNG PANJANG'),
	('3201300009', 'CIBUNAR', 'PARUNG PANJANG'),
	('3201300010', 'PARUNG PANJANG', 'PARUNG PANJANG'),
	('3201300011', 'KABASIRAN', 'PARUNG PANJANG');
/*!40000 ALTER TABLE `desa` ENABLE KEYS */;

-- Dumping structure for table bpndua.districts
CREATE TABLE IF NOT EXISTS `districts` (
  `id` char(7) COLLATE utf8_unicode_ci NOT NULL,
  `regency_id` char(4) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `districts_id_index` (`regency_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table bpndua.districts: ~40 rows (approximately)
/*!40000 ALTER TABLE `districts` DISABLE KEYS */;
REPLACE INTO `districts` (`id`, `regency_id`, `name`) VALUES
	('3201010', '3201', 'NANGGUNG'),
	('3201020', '3201', 'LEUWILIANG'),
	('3201021', '3201', 'LEUWISADENG'),
	('3201030', '3201', 'PAMIJAHAN'),
	('3201040', '3201', 'CIBUNGBULANG'),
	('3201050', '3201', 'CIAMPEA'),
	('3201051', '3201', 'TENJOLAYA'),
	('3201060', '3201', 'DRAMAGA'),
	('3201070', '3201', 'CIOMAS'),
	('3201071', '3201', 'TAMANSARI'),
	('3201080', '3201', 'CIJERUK'),
	('3201081', '3201', 'CIGOMBONG'),
	('3201090', '3201', 'CARINGIN'),
	('3201100', '3201', 'CIAWI'),
	('3201110', '3201', 'CISARUA'),
	('3201120', '3201', 'MEGAMENDUNG'),
	('3201130', '3201', 'SUKARAJA'),
	('3201140', '3201', 'BABAKAN MADANG'),
	('3201150', '3201', 'SUKAMAKMUR'),
	('3201160', '3201', 'CARIU'),
	('3201161', '3201', 'TANJUNGSARI'),
	('3201170', '3201', 'JONGGOL'),
	('3201180', '3201', 'CILEUNGSI'),
	('3201181', '3201', 'KELAPA NUNGGAL'),
	('3201190', '3201', 'GUNUNG PUTRI'),
	('3201200', '3201', 'CITEUREUP'),
	('3201210', '3201', 'CIBINONG'),
	('3201220', '3201', 'BOJONG GEDE'),
	('3201221', '3201', 'TAJUR HALANG'),
	('3201230', '3201', 'KEMANG'),
	('3201231', '3201', 'RANCA BUNGUR'),
	('3201240', '3201', 'PARUNG'),
	('3201241', '3201', 'CISEENG'),
	('3201250', '3201', 'GUNUNG SINDUR'),
	('3201260', '3201', 'RUMPIN'),
	('3201270', '3201', 'CIGUDEG'),
	('3201271', '3201', 'SUKAJAYA'),
	('3201280', '3201', 'JASINGA'),
	('3201290', '3201', 'TENJO'),
	('3201300', '3201', 'PARUNG PANJANG');
/*!40000 ALTER TABLE `districts` ENABLE KEYS */;

-- Dumping structure for table bpndua.master_album
CREATE TABLE IF NOT EXISTS `master_album` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table bpndua.master_album: ~3 rows (approximately)
/*!40000 ALTER TABLE `master_album` DISABLE KEYS */;
REPLACE INTO `master_album` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, '0-100', NULL, NULL),
	(2, '101-200', NULL, NULL),
	(3, '201-300', NULL, NULL);
/*!40000 ALTER TABLE `master_album` ENABLE KEYS */;

-- Dumping structure for table bpndua.master_jenis_hak
CREATE TABLE IF NOT EXISTS `master_jenis_hak` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

-- Dumping data for table bpndua.master_jenis_hak: ~19 rows (approximately)
/*!40000 ALTER TABLE `master_jenis_hak` DISABLE KEYS */;
REPLACE INTO `master_jenis_hak` (`id`, `nama`) VALUES
	(17, 'HB'),
	(18, 'HBG'),
	(19, 'HG'),
	(20, 'HGB'),
	(21, 'HGBG'),
	(22, 'HGGB'),
	(23, 'HGHB'),
	(24, 'HGM'),
	(25, 'HHGB'),
	(26, 'HJGB'),
	(27, 'HJM'),
	(28, 'HM'),
	(30, 'HMJ'),
	(31, 'HMN'),
	(32, 'HNM'),
	(33, 'HT'),
	(34, 'HYGB'),
	(35, 'HYM'),
	(36, 'JHM');
/*!40000 ALTER TABLE `master_jenis_hak` ENABLE KEYS */;

-- Dumping structure for table bpndua.master_jenis_warkah
CREATE TABLE IF NOT EXISTS `master_jenis_warkah` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table bpndua.master_jenis_warkah: ~2 rows (approximately)
/*!40000 ALTER TABLE `master_jenis_warkah` DISABLE KEYS */;
REPLACE INTO `master_jenis_warkah` (`id`, `name`) VALUES
	(1, 'Roya'),
	(2, 'Rutin'),
	(3, 'PTSL');
/*!40000 ALTER TABLE `master_jenis_warkah` ENABLE KEYS */;

-- Dumping structure for table bpndua.master_kegiatan
CREATE TABLE IF NOT EXISTS `master_kegiatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kegiatan` varchar(35) NOT NULL,
  `batas_waktu` varchar(5) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- Dumping data for table bpndua.master_kegiatan: ~25 rows (approximately)
/*!40000 ALTER TABLE `master_kegiatan` DISABLE KEYS */;
REPLACE INTO `master_kegiatan` (`id`, `nama_kegiatan`, `batas_waktu`, `created_at`, `updated_at`) VALUES
	(1, 'Balik Nama', NULL, '2019-11-30 19:03:37', NULL),
	(2, 'Blokir', NULL, '2019-11-30 19:03:37', NULL),
	(3, 'Ganti Blangko', NULL, '2019-11-30 19:03:37', NULL),
	(4, 'Hak Tanggungan', NULL, '2019-11-30 19:03:37', NULL),
	(5, 'Lelang', NULL, '2019-11-30 19:03:37', NULL),
	(6, 'Pembebenan Hak', NULL, '2019-11-30 19:03:37', NULL),
	(7, 'Peralihan Hak', NULL, '2019-11-30 19:03:37', NULL),
	(8, 'Pemisah Hak', NULL, '2019-11-30 19:03:37', NULL),
	(9, 'Permohon Hak', NULL, '2019-11-30 19:03:37', NULL),
	(10, 'Penggabungan Hak', NULL, '2019-11-30 19:03:37', NULL),
	(11, 'Peningkatan Hak', NULL, '2019-11-30 19:03:37', NULL),
	(12, 'Penurunan Hak', NULL, '2019-11-30 19:03:37', NULL),
	(13, 'Pengakuan Hak', NULL, '2019-11-30 19:03:37', NULL),
	(14, 'Pengecekan Sertifikat', NULL, '2019-11-30 19:03:37', NULL),
	(15, 'Roya', NULL, '2019-11-30 19:03:37', NULL),
	(16, 'Revisi', NULL, '2019-11-30 19:03:37', NULL),
	(17, 'Sertifikat Hilang', NULL, '2019-11-30 19:03:37', NULL),
	(18, 'Sertifikat Rusak', NULL, '2019-11-30 19:03:37', NULL),
	(19, 'Roya Cassie', NULL, '2019-11-30 19:03:37', NULL),
	(20, 'Pemecahan Sertifikat', NULL, '2019-11-30 19:03:37', NULL),
	(21, 'SKP', NULL, '2019-11-30 19:03:37', NULL),
	(22, 'SKPT', NULL, '2019-11-30 19:03:37', NULL),
	(23, 'Splitching', NULL, '2019-11-30 19:03:37', NULL),
	(24, 'Warisan', NULL, '2019-11-30 19:03:37', NULL),
	(25, 'SK', NULL, '2019-11-30 19:03:37', NULL);
/*!40000 ALTER TABLE `master_kegiatan` ENABLE KEYS */;

-- Dumping structure for table bpndua.master_pegawai
CREATE TABLE IF NOT EXISTS `master_pegawai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(25) DEFAULT NULL,
  `nama` varchar(50) NOT NULL,
  `unit_kerja` varchar(50) NOT NULL,
  `kegiatan_id` int(2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table bpndua.master_pegawai: ~11 rows (approximately)
/*!40000 ALTER TABLE `master_pegawai` DISABLE KEYS */;
REPLACE INTO `master_pegawai` (`id`, `nip`, `nama`, `unit_kerja`, `kegiatan_id`, `created_at`, `updated_at`) VALUES
	(1, '19660910 198902 2 002', 'SUSIANA', 'PERALIHAN HAK', 1, '2019-11-30 19:10:20', '2019-11-30 12:11:09'),
	(2, '000000000000000', 'ENDANG RUHIAT', 'PENGECEKAN', 14, '2019-11-30 19:10:20', NULL),
	(3, '19610807 198601 1 011', 'H.ANWARUL FATAH, SH', 'SUBSI PENDAFTARAN HAK', 4, '2019-11-30 19:10:20', NULL),
	(4, '000000000000000000', 'RETNO', 'SUBSI PENDAFTARAN HAK', 15, '2019-11-30 19:10:20', NULL),
	(5, '19610218 198303 2 003', 'DEWI PROBOWATI', 'PENINGKATAN HAK', 7, '2019-11-30 19:10:20', NULL),
	(6, '19641121 199103 2 003', 'DIAN TAVERI ISWARINI, SH', 'KEPALA SUBSEKSI PENDAFTARAN HAK TANAH', 1, '2019-11-30 19:10:20', '2019-11-30 12:10:38'),
	(7, '19770907 200212 2 001', 'SITI RAHMAH, SE', 'PERALIHAN HAK', 1, '2019-11-30 19:10:20', '2019-11-30 12:11:00'),
	(8, '19750201 199503 1002', 'HENDI HERMANTO, SH, MH', 'SUBSEKSI PENDAFTARAN HAK TANAH', 1, '2019-11-30 19:10:20', '2019-11-30 12:10:45'),
	(9, '198409162008041002', 'BAMBANG RUDYANSAH', 'PENGOLAH DATA PENDAFTARAN HAK TANAH', 4, '2019-11-30 19:10:20', NULL),
	(10, '0000000000000000000', 'LIA SUMARYATI', 'SUBSI PENDAFTARAN HAK', 11, '2019-11-30 19:10:20', NULL),
	(11, '197702171997032002', 'LENNY FEDRIYANTI, S.SiT, MM.', 'PEMELIHARAAN DATA', 2, '2019-11-30 19:10:20', '2019-11-30 12:10:53');
/*!40000 ALTER TABLE `master_pegawai` ENABLE KEYS */;

-- Dumping structure for table bpndua.master_ruang
CREATE TABLE IF NOT EXISTS `master_ruang` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table bpndua.master_ruang: ~2 rows (approximately)
/*!40000 ALTER TABLE `master_ruang` DISABLE KEYS */;
REPLACE INTO `master_ruang` (`id`, `name`) VALUES
	(1, 'Induk'),
	(2, 'Diklat');
/*!40000 ALTER TABLE `master_ruang` ENABLE KEYS */;

-- Dumping structure for table bpndua.master_tahun
CREATE TABLE IF NOT EXISTS `master_tahun` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table bpndua.master_tahun: ~19 rows (approximately)
/*!40000 ALTER TABLE `master_tahun` DISABLE KEYS */;
REPLACE INTO `master_tahun` (`id`, `name`, `status`) VALUES
	(1, '2000', 0),
	(2, '2001', 0),
	(3, '2002', 0),
	(4, '2004', 0),
	(5, '2005', 0),
	(6, '2006', 0),
	(7, '2007', 0),
	(8, '2008', 0),
	(9, '2009', 0),
	(10, '2010', 1),
	(11, '2011', 1),
	(12, '2012', 1),
	(13, '2013', 1),
	(14, '2014', 1),
	(15, '2015', 1),
	(16, '2016', 1),
	(17, '2017', 1),
	(18, '2018', 1),
	(19, '2019', 1),
	(20, '2020', 1),
	(21, '2021', 1);
/*!40000 ALTER TABLE `master_tahun` ENABLE KEYS */;

-- Dumping structure for table bpndua.master_warkah
CREATE TABLE IF NOT EXISTS `master_warkah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis` int(11) NOT NULL,
  `no_warkah` varchar(50) DEFAULT NULL,
  `tahun` varchar(100) DEFAULT NULL,
  `album` varchar(50) DEFAULT NULL,
  `ruang` varchar(50) DEFAULT NULL,
  `rak` varchar(50) DEFAULT NULL,
  `baris` varchar(50) DEFAULT NULL,
  `desa` varchar(150) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- Dumping data for table bpndua.master_warkah: ~4 rows (approximately)
/*!40000 ALTER TABLE `master_warkah` DISABLE KEYS */;
REPLACE INTO `master_warkah` (`id`, `jenis`, `no_warkah`, `tahun`, `album`, `ruang`, `rak`, `baris`, `desa`, `created_at`, `updated_at`) VALUES
	(10, 1, '1234', '2020', '0-100', 'Induk', '1', '2', 'ANTAJAYA, TANJUNGSARI', '2021-06-15 14:44:25', '2021-06-15 14:44:25'),
	(11, 1, '1234', '2021', '101-200', 'Induk', '4', '4', 'ANTAJAYA, TANJUNGSARI', '2021-06-15 14:44:45', '2021-06-15 14:44:45'),
	(12, 1, '1235', '2021', '0-100', 'Induk', '1', '1', 'ANTAJAYA, TANJUNGSARI', '2021-06-15 14:45:13', '2021-06-15 14:45:13'),
	(13, 1, '1235', '2020', '0-100', 'Induk', '6', '5', 'ANTAJAYA, TANJUNGSARI', '2021-06-15 14:45:37', '2021-06-15 14:45:37');
/*!40000 ALTER TABLE `master_warkah` ENABLE KEYS */;

-- Dumping structure for table bpndua.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bpndua.migrations: ~2 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
REPLACE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table bpndua.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table bpndua.model_has_permissions: ~0 rows (approximately)
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;

-- Dumping structure for table bpndua.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table bpndua.model_has_roles: ~11 rows (approximately)
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
REPLACE INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(5, 'App\\User', 0),
	(6, 'App\\User', 0),
	(7, 'App\\User', 0),
	(5, 'App\\User', 5),
	(6, 'App\\User', 5),
	(5, 'App\\User', 6),
	(6, 'App\\User', 6),
	(5, 'App\\User', 7),
	(6, 'App\\User', 7),
	(5, 'App\\User', 8),
	(6, 'App\\User', 1);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;

-- Dumping structure for table bpndua.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bpndua.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table bpndua.peminjaman
CREATE TABLE IF NOT EXISTS `peminjaman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(60) NOT NULL,
  `nip` varchar(30) DEFAULT NULL,
  `unit_kerja` varchar(50) DEFAULT NULL,
  `kegiatan_id` int(3) DEFAULT NULL,
  `via` varchar(30) DEFAULT NULL,
  `tanggal_pinjam` datetime NOT NULL,
  `tanggal_kembali` datetime DEFAULT NULL,
  `tanggal_jatuh_tempo` datetime DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `old` int(2) DEFAULT NULL,
  `pdf` longtext DEFAULT NULL,
  `created_by` int(2) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table bpndua.peminjaman: ~0 rows (approximately)
/*!40000 ALTER TABLE `peminjaman` DISABLE KEYS */;
/*!40000 ALTER TABLE `peminjaman` ENABLE KEYS */;

-- Dumping structure for table bpndua.peminjaman_detail
CREATE TABLE IF NOT EXISTS `peminjaman_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `peminjaman_id` int(11) NOT NULL,
  `kegiatan_id` int(2) DEFAULT NULL,
  `no_seri` varchar(40) DEFAULT NULL,
  `no_hak` varchar(35) DEFAULT NULL,
  `jenis_hak` varchar(35) DEFAULT NULL,
  `desa` varchar(50) DEFAULT NULL,
  `kecamatan` varchar(50) DEFAULT NULL,
  `no_ht` varchar(35) DEFAULT NULL,
  `no_su` varchar(35) DEFAULT NULL,
  `no_warkah` varchar(35) DEFAULT NULL,
  `tanggal_pinjam` datetime DEFAULT NULL,
  `tanggal_kembali` datetime DEFAULT NULL,
  `tanggal_jatuh_tempo` datetime DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `old` int(2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table bpndua.peminjaman_detail: ~0 rows (approximately)
/*!40000 ALTER TABLE `peminjaman_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `peminjaman_detail` ENABLE KEYS */;

-- Dumping structure for table bpndua.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL DEFAULT 0,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table bpndua.permissions: ~0 rows (approximately)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Dumping structure for table bpndua.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table bpndua.roles: ~3 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
REPLACE INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(5, 'admin', 'web', '2019-07-17 03:38:18', '2019-07-17 03:38:18'),
	(6, 'cs', 'web', '2019-07-17 03:38:47', '2019-12-01 12:23:53'),
	(7, 'validasi', 'web', '2019-07-17 03:39:02', '2019-07-17 03:39:02');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table bpndua.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table bpndua.role_has_permissions: ~0 rows (approximately)
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;

-- Dumping structure for table bpndua.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bpndua.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
REPLACE INTO `users` (`id`, `name`, `jabatan`, `foto`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Adit', 'Arsip', '/upload/foto/foto.jpg', 'adit@gmail.com', NULL, '$2y$10$VqSkoeOcv74FJpMcGFhacOn5uoYKUglGtk2lDL0QwYrTGLROSO/jq', 'RkEPQMoPnxohnrWCSj3SlksT7exfqjmtKv9NTLPrdXSzyJpZxA0GSjwpecOD', '2019-06-29 08:24:20', '2019-12-01 12:26:10'),
	(8, 'Abdurrohman Muthi', 'Budak Arsip', '/upload/foto/abdur.jpg', 'admin@gmail.com', NULL, '$2y$10$OVOtFoq0uAexFUuImoXXHeeYnreJYhpsV87wvxhYyIlo51vg8TY.C', 'Tu7vdIY9bAYqvxgtpi7cHPKOV1RLKCLXvnuzNfIBxi1ZjqrnYA6lb30M4OsC', '2019-07-18 01:46:55', '2019-08-05 17:22:07');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table bpndua.via
CREATE TABLE IF NOT EXISTS `via` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(40) NOT NULL,
  `kegiatan_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table bpndua.via: ~2 rows (approximately)
/*!40000 ALTER TABLE `via` DISABLE KEYS */;
REPLACE INTO `via` (`id`, `nama`, `kegiatan_id`, `created_at`, `updated_at`) VALUES
	(1, 'Dede', 14, '2018-10-07 10:00:46', '0000-00-00 00:00:00'),
	(2, 'Yayat', 6, '2018-10-07 10:00:46', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `via` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
