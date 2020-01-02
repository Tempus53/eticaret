-- MySQL dump 10.13  Distrib 8.0.15, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: p2w
-- ------------------------------------------------------
-- Server version	8.0.15

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `activationcodes`
--

DROP TABLE IF EXISTS `activationcodes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `activationcodes` (
  `gameCode` varchar(12) NOT NULL,
  `activationCode` varchar(100) NOT NULL,
  KEY `fk_ac_gameCode` (`gameCode`),
  CONSTRAINT `fk_ac_gameCode` FOREIGN KEY (`gameCode`) REFERENCES `games` (`gameCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activationcodes`
--

LOCK TABLES `activationcodes` WRITE;
/*!40000 ALTER TABLE `activationcodes` DISABLE KEYS */;
/*!40000 ALTER TABLE `activationcodes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `cart` (
  `username` varchar(20) NOT NULL,
  `gameCode` varchar(12) NOT NULL,
  KEY `fk_username` (`username`),
  KEY `fk_gameCode` (`gameCode`),
  CONSTRAINT `fk_gameCode` FOREIGN KEY (`gameCode`) REFERENCES `games` (`gameCode`),
  CONSTRAINT `fk_username` FOREIGN KEY (`username`) REFERENCES `users` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES ('hermi','ORGFIFA20'),('hermi','PCFIFA19'),('hermi','PCREDDRII'),('hermi','PS4ACUN'),('hermi','PS4MC'),('hermi','PS4BF5'),('hermi','PS4WITCH3GOY'),('hermi','PS4ACROG'),('hermi','ORGBF5'),('severus','ORGFIFA20'),('severus','ORGFIFA20'),('severus','STMACODY'),('severus','ORGBF5');
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `comments` (
  `username` varchar(20) NOT NULL,
  `gameCode` varchar(10) NOT NULL,
  `comment` varchar(300) NOT NULL,
  KEY `fk_com_username` (`username`),
  KEY `fk_com_gameCode` (`gameCode`),
  CONSTRAINT `fk_com_gameCode` FOREIGN KEY (`gameCode`) REFERENCES `games` (`gameCode`),
  CONSTRAINT `fk_com_username` FOREIGN KEY (`username`) REFERENCES `mygames` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES ('severus','PS3OVERW','Mükemmel bir oyun herkese tavsiye ederim'),('severus','PS4GTAV','Efsane oyun'),('Levi','PS4GTAV','Not Bad');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `games`
--

DROP TABLE IF EXISTS `games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `games` (
  `gameCode` varchar(12) NOT NULL,
  `name` varchar(70) NOT NULL,
  `p_code` varchar(5) NOT NULL,
  `price` double NOT NULL,
  `about` text,
  `discount` int(11) DEFAULT NULL,
  PRIMARY KEY (`gameCode`),
  KEY `fk_pCode` (`p_code`),
  CONSTRAINT `fk_pCode` FOREIGN KEY (`p_code`) REFERENCES `platform` (`p_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `games`
--

LOCK TABLES `games` WRITE;
/*!40000 ALTER TABLE `games` DISABLE KEYS */;
INSERT INTO `games` VALUES ('ASD','Yeni oyun','PS4',50,'asdsasdadsadsa',0),('GTAIV','Gran Theft Auto IV','PS3',50,'asdsasdasadsdasdasdasda',0),('ORGBF5','Battlefield 5','ORG',199,'Dünya Savaşı\'nın daha önce hiç görülmemiş bir şekilde tasvir edilmesine rağmen, dizinin köklerine dönmesiyle, Battlefield V ile insanoğlunun en büyük çatışmasına girin. Büyük Büyük Operasyonlar ve kooperatif Kombinasyonu gibi modlarda ekibinizle fiziksel, çok oyunculu bir çok oyunculuğa katılın Tek oyunculu Savaş Hikayeleri\'nde küresel mücadeleye karşı silahlar veya insan dramı tanıklığı. Dünyanın dört bir yanındaki epik ve beklenmedik yerlerde savaşırken, en zengin ve en sürükleyici Battlefield\'ın keyfini çıkarın.',65),('ORGFIFA20','FIFA 20','ORG',279,'Fifa 20 Pc Origin CD Key HEMEN Teslim! Fifa 20 satın alma işleminden sonra origin cd key olarak teslim edilecektir. Türkçe dil seçeneği mevcuttur. Sadece PC üzerinde kullanılabilir. Frostbite destekli, EA SPORTS PC için FIFA 20, Dünya Oyunlarının iki tarafını hayata geçiriyor - profesyonel sahnenin prestijini ve EA SPORTS VOLTA\'daki yepyeni, otantik sokak futbolu deneyimini yaşatıyor. FIFA 20 oyun boyunca yenilikler gerçekleştiriyor, FUTBOL ZEKA, oyun gerçekçiliği için benzeri görülmemiş bir platformun kilidini açan FIFA Ultimate Team, hayalinizdeki kadroyu oluşturmak için daha fazla yol sunar ve EA SPORTS VOLTA, otantik küçük boyutlu futbol formuyla oyunu sokağa döndürür.',30),('ORGSIMS4','Sims 4','ORG',89,'The Sims serisinin dördüncü oyunudur. Önceki oyunlarla aynı konsepte sahiptir ve oyuncular Simleri fiziksel aktivitelerle kontrol edip başkalarıyla iletişim kurdurabilirler. Oyun önceki oyunlar gibi bir kurguya bağlı olmadan ilerler. Oyunun bu sürümünde sim yaratma ve inşa modu ekranları tekrar dizayn edilmiştir. Serinin önceki oyunlarına göre; bu oyunda duygusal bağlar, simlerin kişiliği, sosyal davranışlar daha ön plandadır. The Sims 4 satın al ve seriyi kaçırma.',55),('ORGSWB2','Star Wars Battlefront II','ORG',119,'Yeni çağ, genişletilmiş bir çok oyunculu deneyim ve galaktik ölçekli uzay savaşında bir araya geliyor. Star Wars Battlefront kitlesi tarafından heyecan ile bekleniyor. Battlefront’un devamı olan Battlefront 2’nin ilgisi çok büyük olacak. Savaş alanına farklı yetenekler getiren ikonik kahramanlar oynayın ya da duygusal açıdan çekici tek oyuncunun hikayesindeki kavgaya katılın. Star Wars kahramanının yolculuğu başladı. Star Wars Battlefront 2 satın al ve savaşa sende dahil ol.',0),('ORGSWJFO','Star Wars Jedi Fallen Order','ORG',349,'Star Wars Jedi Fallen Order, Respawn Entertainment tarafından geliştirilen ve Elektronik Arts tarafından yayınlanan ve Yıldız Savaşları evreninde, Bölüm III - Sith\'in İntikamı\'ndan kısa bir süre sonra başlayan konuyu ele alıyor.',50),('PCFIFA19','FIFA 2019','ORG',200,'FIFA 19, bir şampiyonun kalibre deneyimini sahaya dağıtır. Prestijli UEFA Şampiyonlar Ligi tarafından yönetilen FIFA 19, oyuna rakipsiz yollarla her anı kontrol etmenizi sağlayan gelişmiş oyun araçları sunuyor. Sadece Bilgisayar üzerinde kullanılabilir. FIFA 19, The Journey: Champions\'da, sürekli popüler FIFA Ultimate Team\'de yeni bir mod olan Alex Hunter\'ın öyküsüne dramatik bir final sunuyor.',20),('PCJC4','Just Cause 4','STM',200,'Rogue ajanı Rico Rodriguez, çatışma, baskı ve aşırı hava şartlarının bulunduğu büyük bir Güney Amerika dünyası olan Solis\'e gider. Kanatlarını tak, tamamen özelleştirilebilir kancanı donat ve gök gürültüsünü getirmeye hazırlan!',0),('PCMC','Minecraft','PC',59,'Minecraft, küplerle çeşitli tasarımlar yapmanızı sağlayan 3 boyutlu oyundur. Programın ilk sürümleri Markus \'Notch\' Persson tarafından geliştirilmiştir ve Notch\'un kurduğu Mojang şirketi çatısı altında geliştirilmektedir. Oyun; Dwarf Fortress, RollerCoaster Tycoon, Dungeon Keeper ve Infiniminer oyunlarından ilham alınarak geliştirilmiştir. Minecraft Premium satın al ve oyuna hemen başla.',0),('PCNFSPYB','Need For Speed Payback','STM',70,'Fortune Vadisi\'nin yeraltı dünyasında, siz ve mürettebatınız ihanetine bölündüler ve şehrin kumarhanelerini, suçlularını ve polisleri yöneten hain bir kartel olan The House\'u indirmek için intikam aldı. Bu bozuk kumarbaz cennetinde, bahis miktarı yüksek ve kasa sahibi her zaman kazanır. Her zamankinden daha derin performans ve görsel özelleştirme ile benzersiz sürüşler yapın. Epik polis savaşlarındaki sıcaktan biraz kaçtığınızda onları sınırlara kadar itin. Çılgınca soygun misyonlarından yıkıcı otomobil savaşlarına, çene düşen set parça anlarına kadar Need for Speed Payback, koltuğunuzun kenarında, adrenalin enerjisi ile beslenen aksiyon-sürüş fantazinizi sunuyor. Need for Speed Payback satın al ve yarışa hemen başla.',10),('PCREDDRII','Read Dead Redemption II','PC',289,'Blackwater kasabasındaki soygun girişimleri ters giden Artur Morgan ve Van der Linde çetesi kaçmaya başlıyor. Federal ajanlar ve ülkenin en iyi ödül avcılarının takibi altında çete üyeleri hayatta kalabilmek için soyguna, yağmaya ve dövüşmeye devam etmek zorunda.',0),('PCSEA','Sea of Thieves','PC',100,'Sea Of Thieves sadece Windows 10 ve Xbox One üzerinde oynanabilir. Bir korsan efsanesi olun! Deniz Hırsızları\'nın çarpıcı dünyasında izinizi sürmek için sayısız yol var . Sonuna kadar gördüğünüz daha fazla sefer ve macera, itibarınız artar ve sizden önce fırsatlar açılır. ',0),('PS3FIFA20','FIFA 20','PS3',270,'Frostbite destekli, EA SPORTS PC için FIFA 20, Dünya Oyunlarının iki tarafını hayata geçiriyor - profesyonel sahnenin prestijini ve EA SPORTS VOLTA\'daki yepyeni, otantik sokak futbolu deneyimini yaşatıyor. FIFA 20 oyun boyunca yenilikler gerçekleştiriyor, FUTBOL ZEKA, oyun gerçekçiliği için benzeri görülmemiş bir platformun kilidini açan FIFA Ultimate Team, hayalinizdeki kadroyu oluşturmak için daha fazla yol sunar ve EA SPORTS VOLTA, otantik küçük boyutlu futbol formuyla oyunu sokağa döndürür.',20),('PS3GTAV','Grand Theft Auto V','PS3',80,'Yüzlerce farklı karayolu aracına ek olarak uçak, denizaltı ve hatta planör gibi araçlardan faydalanmaya imkan veren yapisi ile GTA 5, “ Açik Dünya “ kavramının gerçekten en yoğun yasandığı oyunlardan birisi olarak da nitelendirilebilmekte. Kişi GTA V tecrübesi süresince ister hikayeyi ve görevleri takip ederek sona ulasmaya çalışacaği gibi, istediginde de Los Santos’un kendisine sunduğu sınırsız olanaklar ile yaşayan bir şehir içerisinde sanal hayatını keyifli ve değişken biçimde sürdürmeye devam edebilir.',0),('PS3OVERW','Overwatch','PS3',99,'Overwatch Satın Al ve savaşlarla dolu bir dünyada, kahramanların savaştığı takıma dayalı bir oyunda kendini bul. Askerler, bilim insanları, maceraperestler ve tuhaf kimseler… Küresel bir krizin yaşandığı bir dünyada kahramanlar, savaştan çıkmış dünyalarına barışı getirme misyonunu üstlenmişlerdir. Overwatch satın al ve hemen battle net hesabına bu benzersiz oyunu ekle !',0),('PS4ACBF','Assassins Creed Black Flag','PS4',30,'Yıl 1715\'tir. Korsanlar Karayipler\'i yönetir ve yolsuzluk, açgözlülük ve zulmün sıradan olduğu kendi yasadışı Cumhuriyetini kurmuşlardır. Bu kanun kaçakları arasında Edward Kenway adlı küstah bir kaptan var.',50),('PS4ACODY','Assassins Creed Odyssey','PS4',320,'Assassin\'s Creed Odyssey\'de kendi kaderine hükmet. Kimsesiz bir garip adamdan yaşayan bir efsane olmaya giden bir yolculuğa çık. Kendi geçmişinin sırlarını keşfederken Antik Yunanistan\'ın kaderini de değiştir. Assassins Creed Odyssey satın al ve maceraya katıl!',0),('PS4ACORG','Assassins Creed Origins','PS4',100,'Antik Mısır\'dayız. Görkemli olduğu kadar entrikalarla dolu bir çağı kapatacak müthiş bir iktidar savaşı yaşanıyor. Suikastçı Kardeşlik Örgütünün köklerine yapacağın bu yolculukta karanlıkta kalmış sırları ve unutulmuş efsaneleri gün yüzüne çıkaracaksın. Nil Nehri boyunca seyahat et, pirametlerin gizemlerini açığa çıkar, tehlikeli antik hizipler ve vahşi yaratıklarla dövüşürken bu muazzam ve öngörülemez toprakları keşfet. Çeşitli görevler ve sürükleyici hikayelerde, en soylularından en alt tabakadan gelenlere kadar bir çok kuvvetli ve unutulmaz karakterle yolun kesişecek. Dövüşmenin yepyeni bir yolunu keşfet. Farklı nitelikteki onlarca nadir silahı ele geçir ve kullan. Karmaşık bir ilerleme mekaniği üzerinde yolunu aç, özgün ve kuvvetli düşmanlar karşısında yeteneklerini göster.',0),('PS4ACROG','Assassins Creed Syndicate','PS4',30,'8. yüzyıl, Kuzey Amerika. Fransız ve Hint Savaşı\'nın karışıklığı ve şiddetinin ortasında Shassin Patrick Cormac, Körfez Kardeşliği\'nin korkusuz genç bir üyesi, sonsuza dek Amerikan kolonilerinin geleceğini şekillendirecek karanlık bir dönüşüme uğradı. Assassin\'s Creed Rogue satın al, heyecan dolu maceraya hemen başla.',40),('PS4ACSYN','Assassins Creed Syndicate','PS4',120,'Londra, 1868. Sanayi Devrimi\'nin kalbinde, kendi yeraltı örgütünüzü yönetin ve ilerleme adına yoksulları sömürenlerle savaşmak için nüfuzunuzu genişletin. Genç ve gözüpek Suikastçı Jacob Frye olarak, becerilerinizi ilerleme hırsıyla ezilenlere yardımcı olmak için kullanın. Londra sokaklarına tekrar adalet getirmek için, fabrikada köle işçi olarak çalıştırılan çocukları kurtarmaktan, düşman teknelerinden değerli malları çalmaya kadar her şeyi yapacaksınız. Assassin\'s Creed Syndicate satın al ve suikaste başla.',0),('PS4ACUN','Assassins Creed Unity','PS4',50,'Assassin’s Creed® Unity, Paris şehrinin en karanlık dönemlerinden biri olan Fransız Devrimi\'nde geçen bir aksiyon/macera oyunu. Bu sefer kendi kahramanınızı kontrol ediyorsunuz. Arno\'nun teçhizatını hem görsel hem de mekanik olarak özelleştirerek karakterinizi sahiplenin. Assassin\'s Creed Unity satın al, maceraya hemen başla.',0),('PS4BF5','Battlefield 5','PS4',199,' Dünya Savaşı\'nın daha önce hiç görülmemiş bir şekilde tasvir edilmesine rağmen, dizinin köklerine dönmesiyle, Battlefield V ile insanoğlunun en büyük çatışmasına girin. Büyük Büyük Operasyonlar ve kooperatif Kombinasyonu gibi modlarda ekibinizle fiziksel, çok oyunculu bir çok oyunculuğa katılın Tek oyunculu Savaş Hikayeleri\'nde küresel mücadeleye karşı silahlar veya insan dramı tanıklığı. Dünyanın dört bir yanındaki epik ve beklenmedik yerlerde savaşırken, en zengin ve en sürükleyici Battlefield\'ın keyfini çıkarın.',0),('PS4FIFA19','FIFA 2019','PS4',200,'FIFA 19, bir şampiyonun kalibre deneyimini sahaya dağıtır. Prestijli UEFA Şampiyonlar Ligi tarafından yönetilen FIFA 19, oyuna rakipsiz yollarla her anı kontrol etmenizi sağlayan gelişmiş oyun araçları sunuyor. Sadece Bilgisayar üzerinde kullanılabilir. FIFA 19, The Journey: Champions\'da, sürekli popüler FIFA Ultimate Team\'de yeni bir mod olan Alex Hunter\'ın öyküsüne dramatik bir final sunuyor.',0),('PS4FORZH4','Forza Horizon 4','PS4',189,'Yarış ve sürüş türünde ilk kez, paylaşımlı bir açık dünyada dinamik mevsimleri deneyimleyin. Güzel manzaraları keşfedin, 450\'nin üzerindeki arabayı toplayın. Dünyanızı gerçek oyuncular doldursun. Günün zamanı, hava durumu ve mevsimler değiştiğinde, bunları oyunu oynayan herkes aynı anda deneyimler.',0),('PS4GTAV','Grand Theft Auto V','PS4',90,'Yüzlerce farklı karayolu aracına ek olarak uçak, denizaltı ve hatta planör gibi araçlardan faydalanmaya imkan veren yapisi ile GTA 5, “ Açik Dünya “ kavramının gerçekten en yoğun yasandığı oyunlardan birisi olarak da nitelendirilebilmekte. Kişi GTA V tecrübesi süresince ister hikayeyi ve görevleri takip ederek sona ulasmaya çalışacaği gibi, istediginde de Los Santos’un kendisine sunduğu sınırsız olanaklar ile yaşayan bir şehir içerisinde sanal hayatını keyifli ve değişken biçimde sürdürmeye devam edebilir.',0),('PS4JC4','Just Cause 4','PS4',200,'Rogue ajanı Rico Rodriguez, çatışma, baskı ve aşırı hava şartlarının bulunduğu büyük bir Güney Amerika dünyası olan Solis\'e gider. Kanatlarını tak, tamamen özelleştirilebilir kancanı donat ve gök gürültüsünü getirmeye hazırlan!',0),('PS4MC','Minecraft Premium','PS4',59,'Minecraft, küplerle çeşitli tasarımlar yapmanızı sağlayan 3 boyutlu oyundur. Programın ilk sürümleri Markus \'Notch\' Persson tarafından geliştirilmiştir ve Notch\'un kurduğu Mojang şirketi çatısı altında geliştirilmektedir. Oyun; Dwarf Fortress, RollerCoaster Tycoon, Dungeon Keeper ve Infiniminer oyunlarından ilham alınarak geliştirilmiştir. Minecraft Premium satın al ve oyuna hemen başla.',0),('PS4NFSPYB','Need For Speed Payback','PS4',70,'Fortune Vadisi\'nin yeraltı dünyasında, siz ve mürettebatınız ihanetine bölündüler ve şehrin kumarhanelerini, suçlularını ve polisleri yöneten hain bir kartel olan The House\'u indirmek için intikam aldı. Bu bozuk kumarbaz cennetinde, bahis miktarı yüksek ve kasa sahibi her zaman kazanır. Her zamankinden daha derin performans ve görsel özelleştirme ile benzersiz sürüşler yapın. Epik polis savaşlarındaki sıcaktan biraz kaçtığınızda onları sınırlara kadar itin. Çılgınca soygun misyonlarından yıkıcı otomobil savaşlarına, çene düşen set parça anlarına kadar Need for Speed Payback, koltuğunuzun kenarında, adrenalin enerjisi ile beslenen aksiyon-sürüş fantazinizi sunuyor. Need for Speed Payback satın al ve yarışa hemen başla.',0),('PS4PES20','PES 2020','PS4',85,'Pro Evolution Soccer yenilenmiş adıyla eFootball PES 2020 olarak geri dönüyor. Yenilenen menü sistemi ile sevilen futbol oyunu daha modern ve göz atması daha kolay hale geldi. Yeni aydınlatma motorunu sayesinde, stadyumlar ve oyuncular her zamankinden daha gerçekçi görünecek. Özelleştirilebilir teknik direktörlüğün yanısıra Maradona gibi efsanevi isimlerde sizleri bekliyor. Unutulmaz Barcelona oyuncusu Andrés Iniesta danışmanlığında geliştirilen oyun futbolseverler için akçırılmayacak bir fırsat.',60),('PS4PS4FIFA20','FIFA 20','PS4',279,'Türkçe dil seçeneği mevcuttur. Sadece PC üzerinde kullanılabilir. Frostbite destekli, EA SPORTS PC için FIFA 20, Dünya Oyunlarının iki tarafını hayata geçiriyor - profesyonel sahnenin prestijini ve EA SPORTS VOLTA\'daki yepyeni, otantik sokak futbolu deneyimini yaşatıyor. FIFA 20 oyun boyunca yenilikler gerçekleştiriyor, FUTBOL ZEKA, oyun gerçekçiliği için benzeri görülmemiş bir platformun kilidini açan FIFA Ultimate Team, hayalinizdeki kadroyu oluşturmak için daha fazla yol sunar ve EA SPORTS VOLTA, otantik küçük boyutlu futbol formuyla oyunu sokağa döndürür.',0),('PS4SEKDT','Sekiro Shadows Die Twice','PS4',180,'Dark Souls serisinin yaratıcıları olan FromSoftware tarafından geliştirilen yepyeni bir macerada intikam yolunda akıllı adımlarla ilerle. İntikamını al. Onurunu geri kazan. Ustaca öldür.',0),('PS4WITCH3GOY','Witcher 3 Wild Hunt Game of The Year','PS4',119,'Game of the Year İçeriği : Witcher 3 Wild Hunt Ana Oyun , Hearts of Stone DLC’si , Blood and Wine DLC’si ve 16 Farklı DLC ve Steam için özel oyun içi menü paketi ve içeriklerir. The Witcher 3 Wild Hunt aktivasyon ve kurulum tamamen Steam üzerinden yapımaktadır. İnternet bağlantısı gerekir. The Witcher 3 Wild Hunt, Red Engine 3 motoruna sahip, Bandai Namco Games ve Warner Bros tarafindan yayınlanmakta olup, CD projekt tarafindan geliştirilmiştir. Yine oyunun esas konusu Geralt\'tir. The Witcher 3 Wild Hunt satın al ve efsane oyuna hemen başla.',0),('PSTRDR2','Read Dead Redemption II','PS4',289,'Blackwater kasabasındaki soygun girişimleri ters giden Artur Morgan ve Van der Linde çetesi kaçmaya başlıyor. Federal ajanlar ve ülkenin en iyi ödül avcılarının takibi altında çete üyeleri hayatta kalabilmek için soyguna, yağmaya ve dövüşmeye devam etmek zorunda.',0),('STMACODY','Assassins Creed Odyssey','STM',320,'Assassin\'s Creed Odyssey\'de kendi kaderine hükmet. Kimsesiz bir garip adamdan yaşayan bir efsane olmaya giden bir yolculuğa çık. Kendi geçmişinin sırlarını keşfederken Antik Yunanistan\'ın kaderini de değiştir. Assassins Creed Odyssey satın al ve maceraya katıl!',70),('STMACORG','Assassins Creed Origins','UPLY',100,'Antik Mısır\'dayız. Görkemli olduğu kadar entrikalarla dolu bir çağı kapatacak müthiş bir iktidar savaşı yaşanıyor. Suikastçı Kardeşlik Örgütünün köklerine yapacağın bu yolculukta karanlıkta kalmış sırları ve unutulmuş efsaneleri gün yüzüne çıkaracaksın. Nil Nehri boyunca seyahat et, pirametlerin gizemlerini açığa çıkar, tehlikeli antik hizipler ve vahşi yaratıklarla dövüşürken bu muazzam ve öngörülemez toprakları keşfet. Çeşitli görevler ve sürükleyici hikayelerde, en soylularından en alt tabakadan gelenlere kadar bir çok kuvvetli ve unutulmaz karakterle yolun kesişecek. Dövüşmenin yepyeni bir yolunu keşfet. Farklı nitelikteki onlarca nadir silahı ele geçir ve kullan. Karmaşık bir ilerleme mekaniği üzerinde yolunu aç, özgün ve kuvvetli düşmanlar karşısında yeteneklerini göster.',0),('STMACSYN','Assassins Creed Syndicate','STM',120,'Londra, 1868. Sanayi Devrimi\'nin kalbinde, kendi yeraltı örgütünüzü yönetin ve ilerleme adına yoksulları sömürenlerle savaşmak için nüfuzunuzu genişletin. Genç ve gözüpek Suikastçı Jacob Frye olarak, becerilerinizi ilerleme hırsıyla ezilenlere yardımcı olmak için kullanın. Londra sokaklarına tekrar adalet getirmek için, fabrikada köle işçi olarak çalıştırılan çocukları kurtarmaktan, düşman teknelerinden değerli malları çalmaya kadar her şeyi yapacaksınız. Assassin\'s Creed Syndicate satın al ve suikaste başla.',0),('STMDARKS3','Dark Souls 3','STM',79,'Ateşler sönüp dünya yıkıma uğrarken daha büyük düşmanlarla ve ortamlarla dolu bir evrene git. Oyuncular, daha hızlı bir oyun ve daha yoğun bir savaş deneyimiyle destansı bir atmosfere girecek. Hem eski hayranlar hem de yeni oyuncular, sürükleyici bir oyuna ve grafiklere boğulacak. Dark Souls 3 satın al, maceraya hemen katıl.',0),('STMFM20','Football Manager 2020','STM',169,'En sevdiğiniz kulüpleri yöneterek başarı hikayenizi zirveye taşıyın. Tüm takımı baştan sona siz yönetin yada yönetecek kişileri belirleyin. Kontrol tamamen sizde!',0),('STMGTAV','Grand Theft Auto V','STM',80,'Yüzlerce farklı karayolu aracına ek olarak uçak, denizaltı ve hatta planör gibi araçlardan faydalanmaya imkan veren yapisi ile GTA 5, “ Açik Dünya “ kavramının gerçekten en yoğun yasandığı oyunlardan birisi olarak da nitelendirilebilmekte. Kişi GTA V tecrübesi süresince ister hikayeyi ve görevleri takip ederek sona ulasmaya çalışacaği gibi, istediginde de Los Santos’un kendisine sunduğu sınırsız olanaklar ile yaşayan bir şehir içerisinde sanal hayatını keyifli ve değişken biçimde sürdürmeye devam edebilir.',0),('STMMBWAR','Mount & Blade Warband','STM',29,'Ardı arkası kesilmeyen savaşlar tarafından parçalanmış bir diyarda, tecrübeli askerlerden oluşan ordunuzu toplayıp mücadeleye girme zamanı geldi. Adamlarınızı savaşa sokun, topraklarınızı genişletin ve Kalradya Tahtı için düşmanlarınıza meydan okuyun! Mount Blade Warband satın al, tarihin tozlu sayfalarına adını yazdır.',0),('STMMIDSOM','Middle Earth Shadow of Mordor','STM',70,'Mordor ile savaşın ve sizi zorlayan ruhun gerçeğini ortaya çıkarın, Güç Yüzüklerinin köklerini keşfedin, efsanenizi yapın ve bu Orta Dünya\'nın yeni kroniginde Sauron\'un kötülüğüyle nihayet karşı karşıya kalın.',0),('STMPES20','PES 2020','STM',85,'Pro Evolution Soccer yenilenmiş adıyla eFootball PES 2020 olarak geri dönüyor. Yenilenen menü sistemi ile sevilen futbol oyunu daha modern ve göz atması daha kolay hale geldi. Yeni aydınlatma motorunu sayesinde, stadyumlar ve oyuncular her zamankinden daha gerçekçi görünecek. Özelleştirilebilir teknik direktörlüğün yanısıra Maradona gibi efsanevi isimlerde sizleri bekliyor. Unutulmaz Barcelona oyuncusu Andrés Iniesta danışmanlığında geliştirilen oyun futbolseverler için akçırılmayacak bir fırsat.',0),('STMRB6SIE','Rainbow Six Siege','STM',79,'Rainbow Six Siege veya Rainbow 6 Siege Ubisoft Montreal tarafından geliştirilen ve Ubisoft tarafından yayımlanan Birinci şahıs nişancı türünde bir video oyunu. Oyun IGN tarafından E3 2014\'ün en iyi oyunu seçilmiştir. Tom Clancy\'s Rainbow Six Siege, oyuncuların bir anti-terörist birimi olan Rainbow takımından değişik \'operatörler\' olarak oynayabileceği Birinci şahıs nişancı türünde bir video oyunudur. Bu operatörlerin değişik uyrukları, ekipmanları, yetenekleri ve işlevleri vardır. Örneğin Twitch adındaki bir operatör düşmanları uzak mesafeden elektrik şoku ile vurabilen bir drone\'a sahip olacakken, Smoke, etkilenen bölgelerde bulunan düşmanlara büyük miktarda hasar verebilen zehirli gazlar yerleştirip patlatabilecek. Sonuç olarak, oyun bizlere \'asimetrik\' bir yapı sunacak. Rainbow Six Siege satın al ve Uplay üzerinden indir, oyna.',80),('STMSOTR','Shadow of The Tomb Raider','STM',210,'Lara Croft’un Tomb Raider olma yolundaki belirleyici anlarını deneyimle. Shadow of the Tomb Raider\'da, Lara ölümcül bir ormanda hayatta kalmak, korkunç mezarların üstesinden gelmek ve hayatının en kara gününden aydınlığa çıkmak zorunda. Dünyayı Maya Kıyametinden kurtarmak için zamanla yarışan Lara bu macerada çelikleşerek Tomb Raider\'a dönüşüyor. Shadow of the Tomb Raider satın al ve savaşa katıl.',35),('UPLYACBF','Assassins Creed Black Flag','UPLY',30,'Yıl 1715\'tir. Korsanlar Karayipler\'i yönetir ve yolsuzluk, açgözlülük ve zulmün sıradan olduğu kendi yasadışı Cumhuriyetini kurmuşlardır. Bu kanun kaçakları arasında Edward Kenway adlı küstah bir kaptan var.',0),('UPLYACROG','Assassins Creed Syndicate','UPLY',30,'8. yüzyıl, Kuzey Amerika. Fransız ve Hint Savaşı\'nın karışıklığı ve şiddetinin ortasında Shassin Patrick Cormac, Körfez Kardeşliği\'nin korkusuz genç bir üyesi, sonsuza dek Amerikan kolonilerinin geleceğini şekillendirecek karanlık bir dönüşüme uğradı. Assassin\'s Creed Rogue satın al, heyecan dolu maceraya hemen başla.',0),('UPLYACUN','Assassins Creed Unity','UPLY',50,'Assassin’s Creed® Unity, Paris şehrinin en karanlık dönemlerinden biri olan Fransız Devrimi\'nde geçen bir aksiyon/macera oyunu. Bu sefer kendi kahramanınızı kontrol ediyorsunuz. Arno\'nun teçhizatını hem görsel hem de mekanik olarak özelleştirerek karakterinizi sahiplenin. Assassin\'s Creed Unity satın al, maceraya hemen başla.',0),('UPLYFORHNR','For Honor','UPLY',69,'For Honor Ubisoft tarafından geliştirilen, üçüncü sahış dövüş ve strateji oyunudur. For Honor PC oyununda ana kurgu üç öğe üzerine kuruludur. Bunlar acımasız Vikingler, ölümcü Şövalyeler ve soğukkanlı Samuraylardır. For Honor savaş sistemi ile oyundaki bütün silahların gücünü elinizde hissedersiniz. For Honor da bulunan Oni, Japon gölge suikastçilerinden ve gerçeküstü efsanelerden esinlenilerek ortaya çıktı. Oni çok iyi katana kullanmasının yanında, hafif zırh ile beraber hızlı ve ustaca dövüşür. Diğer savaşçı olan Warden, kendini halkına adamış uzun boylu ve güçlü bir savaşçıdır. Warden uzun bir kılıç kullanır ve ağır bir zırh ile kaplıdır. Warden aynı zamanda gururlu ve karizmatiktir. Son savaşçı Raider ise ağır, cesur ve acımasızdır. Gladius keskinliği ona bir kişiyi dilimleme imkanı bile verir. Aynı zamanda yuvarlak bir Viking kalkanına sahiptir ve silah olarakta kullanır.',0),('WZOL','Wizard of Legend','PC',20,'Wizard of Legend is a no-nonsense, action-packed take on wizardry that emphasizes precise movements and smart comboing of spells in a rogue-like dungeon crawler that features over a hundred unique spells and relics!',0),('XBONEACBF','Assassins Creed Black Flag','XBONE',30,'Yıl 1715\'tir. Korsanlar Karayipler\'i yönetir ve yolsuzluk, açgözlülük ve zulmün sıradan olduğu kendi yasadışı Cumhuriyetini kurmuşlardır. Bu kanun kaçakları arasında Edward Kenway adlı küstah bir kaptan var.',0),('XBONEACODY','Assassins Creed Odyssey','XBONE',320,'Assassin\'s Creed Odyssey\'de kendi kaderine hükmet. Kimsesiz bir garip adamdan yaşayan bir efsane olmaya giden bir yolculuğa çık. Kendi geçmişinin sırlarını keşfederken Antik Yunanistan\'ın kaderini de değiştir. Assassins Creed Odyssey satın al ve maceraya katıl!',0),('XBONEACORG','Assassins Creed Origins','XBONE',100,'Antik Mısır\'dayız. Görkemli olduğu kadar entrikalarla dolu bir çağı kapatacak müthiş bir iktidar savaşı yaşanıyor. Suikastçı Kardeşlik Örgütünün köklerine yapacağın bu yolculukta karanlıkta kalmış sırları ve unutulmuş efsaneleri gün yüzüne çıkaracaksın. Nil Nehri boyunca seyahat et, pirametlerin gizemlerini açığa çıkar, tehlikeli antik hizipler ve vahşi yaratıklarla dövüşürken bu muazzam ve öngörülemez toprakları keşfet. Çeşitli görevler ve sürükleyici hikayelerde, en soylularından en alt tabakadan gelenlere kadar bir çok kuvvetli ve unutulmaz karakterle yolun kesişecek. Dövüşmenin yepyeni bir yolunu keşfet. Farklı nitelikteki onlarca nadir silahı ele geçir ve kullan. Karmaşık bir ilerleme mekaniği üzerinde yolunu aç, özgün ve kuvvetli düşmanlar karşısında yeteneklerini göster.',30),('XBONEACROG','Assassins Creed Syndicate','XBONE',30,'8. yüzyıl, Kuzey Amerika. Fransız ve Hint Savaşı\'nın karışıklığı ve şiddetinin ortasında Shassin Patrick Cormac, Körfez Kardeşliği\'nin korkusuz genç bir üyesi, sonsuza dek Amerikan kolonilerinin geleceğini şekillendirecek karanlık bir dönüşüme uğradı. Assassin\'s Creed Rogue satın al, heyecan dolu maceraya hemen başla.',0),('XBONEACSYN','Assassins Creed Syndicate','XBONE',120,'Londra, 1868. Sanayi Devrimi\'nin kalbinde, kendi yeraltı örgütünüzü yönetin ve ilerleme adına yoksulları sömürenlerle savaşmak için nüfuzunuzu genişletin. Genç ve gözüpek Suikastçı Jacob Frye olarak, becerilerinizi ilerleme hırsıyla ezilenlere yardımcı olmak için kullanın. Londra sokaklarına tekrar adalet getirmek için, fabrikada köle işçi olarak çalıştırılan çocukları kurtarmaktan, düşman teknelerinden değerli malları çalmaya kadar her şeyi yapacaksınız. Assassin\'s Creed Syndicate satın al ve suikaste başla.',0),('XBONEACUN','Assassins Creed Unity','XBONE',50,'Assassin’s Creed® Unity, Paris şehrinin en karanlık dönemlerinden biri olan Fransız Devrimi\'nde geçen bir aksiyon/macera oyunu. Bu sefer kendi kahramanınızı kontrol ediyorsunuz. Arno\'nun teçhizatını hem görsel hem de mekanik olarak özelleştirerek karakterinizi sahiplenin. Assassin\'s Creed Unity satın al, maceraya hemen başla.',0),('XBONECDW','Call of Duty Modern Warfare','XBONE',220,'Oyuncular, küresel güç dengesini etkileyecek bir kalp atış yarışındaki ölümcül Tier One operatörlerinin rolünü üstlendikleri için bahisler hiç bu kadar yüksek olmamıştı. Her şeyi başlatan stüdyo tarafından geliştirilen Infinity Ward, ikonik Modern Savaş serisini sıfırdan yeniden tasarlayan bir destan sunar.',0),('XBONEDARKS3','Dark Souls 3','XBONE',79,'Ateşler sönüp dünya yıkıma uğrarken daha büyük düşmanlarla ve ortamlarla dolu bir evrene git. Oyuncular, daha hızlı bir oyun ve daha yoğun bir savaş deneyimiyle destansı bir atmosfere girecek. Hem eski hayranlar hem de yeni oyuncular, sürükleyici bir oyuna ve grafiklere boğulacak. Dark Souls 3 satın al, maceraya hemen katıl.',0),('XBONEFIFA19','FIFA 2019','XBONE',200,'FIFA 19, bir şampiyonun kalibre deneyimini sahaya dağıtır. Prestijli UEFA Şampiyonlar Ligi tarafından yönetilen FIFA 19, oyuna rakipsiz yollarla her anı kontrol etmenizi sağlayan gelişmiş oyun araçları sunuyor. Sadece Bilgisayar üzerinde kullanılabilir. FIFA 19, The Journey: Champions\'da, sürekli popüler FIFA Ultimate Team\'de yeni bir mod olan Alex Hunter\'ın öyküsüne dramatik bir final sunuyor.',0),('XBONEFZHOR4','Forza Horizon 4','XBONE',189,'Yarış ve sürüş türünde ilk kez, paylaşımlı bir açık dünyada dinamik mevsimleri deneyimleyin. Güzel manzaraları keşfedin, 450\'nin üzerindeki arabayı toplayın. Dünyanızı gerçek oyuncular doldursun. Günün zamanı, hava durumu ve mevsimler değiştiğinde, bunları oyunu oynayan herkes aynı anda deneyimler.',0),('XBONEJC4','Just Cause 4','XBONE',120,'Rogue ajanı Rico Rodriguez, çatışma, baskı ve aşırı hava şartlarının bulunduğu büyük bir Güney Amerika dünyası olan Solis\'e gider. Kanatlarını tak, tamamen özelleştirilebilir kancanı donat ve gök gürültüsünü getirmeye hazırlan!',45),('XBONEMCP','Minecraft Premium','XBONE',60,'Minecraft, küplerle çeşitli tasarımlar yapmanızı sağlayan 3 boyutlu oyundur. Programın ilk sürümleri Markus \'Notch\' Persson tarafından geliştirilmiştir ve Notch\'un kurduğu Mojang şirketi çatısı altında geliştirilmektedir. Oyun; Dwarf Fortress, RollerCoaster Tycoon, Dungeon Keeper ve Infiniminer oyunlarından ilham alınarak geliştirilmiştir. Minecraft Premium satın al ve oyuna hemen başla.',0),('XBONENFSPYB','Need For Speed Payback','XBONE',70,'Fortune Vadisi\'nin yeraltı dünyasında, siz ve mürettebatınız ihanetine bölündüler ve şehrin kumarhanelerini, suçlularını ve polisleri yöneten hain bir kartel olan The House\'u indirmek için intikam aldı. Bu bozuk kumarbaz cennetinde, bahis miktarı yüksek ve kasa sahibi her zaman kazanır. Her zamankinden daha derin performans ve görsel özelleştirme ile benzersiz sürüşler yapın. Epik polis savaşlarındaki sıcaktan biraz kaçtığınızda onları sınırlara kadar itin. Çılgınca soygun misyonlarından yıkıcı otomobil savaşlarına, çene düşen set parça anlarına kadar Need for Speed Payback, koltuğunuzun kenarında, adrenalin enerjisi ile beslenen aksiyon-sürüş fantazinizi sunuyor. Need for Speed Payback satın al ve yarışa hemen başla.',0),('XBONEPES20','PES 2020','XBONE',85,'Pro Evolution Soccer yenilenmiş adıyla eFootball PES 2020 olarak geri dönüyor. Yenilenen menü sistemi ile sevilen futbol oyunu daha modern ve göz atması daha kolay hale geldi. Yeni aydınlatma motorunu sayesinde, stadyumlar ve oyuncular her zamankinden daha gerçekçi görünecek. Özelleştirilebilir teknik direktörlüğün yanısıra Maradona gibi efsanevi isimlerde sizleri bekliyor. Unutulmaz Barcelona oyuncusu Andrés Iniesta danışmanlığında geliştirilen oyun futbolseverler için akçırılmayacak bir fırsat.',0),('XBONEROTTR','Rise of The Tomb Raider','XBONE',55,'Rise of The Tomb Raider bir önceki oyununa benzer oynanış öğelerini içerisinde barındırıyor. 2013 oyunundaki gibi yine hayatta kalma mücadelesi veren Lara Croft, bu oyunda mezar keşifleri yapıyor. Antik bölgede geçen oyunda yine tuzaklardan kurtulmaya çalışırken bir yandanda esrarengiz şifreleri çözmeye çalışıyorsunuz. Ama eğer sonuca ulasırsanız ölümsüzlüğün sırrını elde edeceksiniz.anız ölümsüzlüğün sırrını elde edeceksiniz.',0),('XBONEWD2','Watch Dogs 2','XBONE',90,'Teknoloji devriminin beşiği San Fransisco Körfez Bölgesinde yaşayan Marcus adında genç ve dahi bir hackersın. Azılı hacker grubu DedSec\'le işbirliği içinde tarihin en büyük hack operasyonunu gerçekleştir; suç baronlarının yurttaşların davranışlarını gözlemek ve kontrol etmek için kullandıkları saldırgan işletim sistemi ctOS 2.0\'ı saf dışı bırak. Watch Dogs 2 satın al, maceraya hemen başla.',0);
/*!40000 ALTER TABLE `games` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `mycart_games`
--

DROP TABLE IF EXISTS `mycart_games`;
/*!50001 DROP VIEW IF EXISTS `mycart_games`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8mb4;
/*!50001 CREATE VIEW `mycart_games` AS SELECT 
 1 AS `gameCode`,
 1 AS `username`,
 1 AS `p_code`,
 1 AS `name`,
 1 AS `price`,
 1 AS `discount`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `mygames`
--

DROP TABLE IF EXISTS `mygames`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `mygames` (
  `gameCode` varchar(12) NOT NULL,
  `username` varchar(20) NOT NULL,
  `gameKey` varchar(100) NOT NULL,
  KEY `fk_my_gameCode` (`gameCode`),
  KEY `fk_my_username` (`username`),
  CONSTRAINT `fk_my_gameCode` FOREIGN KEY (`gameCode`) REFERENCES `games` (`gameCode`),
  CONSTRAINT `fk_my_username` FOREIGN KEY (`username`) REFERENCES `users` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mygames`
--

LOCK TABLES `mygames` WRITE;
/*!40000 ALTER TABLE `mygames` DISABLE KEYS */;
INSERT INTO `mygames` VALUES ('ORGSWB2','hermi','KH5OG-GK5FR-SF687'),('PCMC','Levi','FVNMH-5GH6J-UG4VH'),('ORGFIFA20','Luna','GHTY7-GHNB5-GVXCD5'),('PCMC','LordSidius','VFGHY6-NGHT5-GVNH7'),('ORGBF5','padfoot','AXB5G-NSW34-SXCD4'),('PS3OVERW','severus','KSI45-SXV5B-W3R45'),('PS4ACORG','hermi','SM9OP-2WR45-WE348'),('PS4GTAV','Levi','Q23R4-SZX44-SAXM7'),('PS4MC','Luna','ASWZ3-ASDQ3-CVB5F'),('PS4PS4FIFA20','LordSidius','PLHY6-SZX56-ASZX4'),('PSTRDR2','padfoot','ASZX2-PMN6Y-AZX5T'),('STMFM20','severus','ASB6X-ASRT5-XZVH5'),('STMRB6SIE','hermi','1HK45-ZM30U-ZXC123'),('XBONEACBF','Levi','ZPR4S-QIV64-P074X'),('XBONEACSYN','Luna','ZZ092-LUN4L-SEV3R'),('XBONEFIFA19','LordSidius','123AS-ZXRY5-XBJ7R'),('XBONEJC4','padfoot','AKYI5-SOCP5-ZNBV4'),('XBONENFSPYB','severus','QOI4R-SPZO5-VMFKG'),('STMMIDSOM','hermi','ASVB6-NMGE4-HJUI0'),('PCJC4','Levi','1AZXF-POHRT-XAS56'),('XBONEFIFA19','Luna','0OMN5-SZOT6-XKDS5'),('STMMIDSOM','LordSidius','SKIEO-ASWE2-SZXWR'),('UPLYACUN','padfoot','ZXCVA-24S56-GH4ES'),('STMRB6SIE','severus','H5Y5T-B6O2S-QWE23'),('XBONEACORG','hermi','POGF6-AZX24-OBME5'),('XBONEACUN','Levi','QLFT6-AZX34-QQQ23'),('STMPES20','Luna','LOPT5-AOXL5-OZLSW'),('STMACODY','LordSidius','ORNG4-K2IKZ-ASZ34'),('STMFM20','padfoot','APO4X-KN21S-EM43O'),('PS4GTAV','severus','AP09S-ZI65S-AW024'),('PS4BF5','hermi','QZAW2-ZXUT4-AXBT4'),('PS4ACBF','Levi','QP25X-A22S4-AB3C1'),('PS4FIFA19','Luna','POXN8-MTNR4-SJZ23'),('PS4WITCH3GOY','LordSidius','ZXO5T-ZKDS4-XZP45'),('STMGTAV','padfoot','AZPY6-ALKS4-SOZP4'),('UPLYACBF','severus','AZGF5-SAS24-SAZ4N');
/*!40000 ALTER TABLE `mygames` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `platform`
--

DROP TABLE IF EXISTS `platform`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `platform` (
  `p_code` varchar(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`p_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `platform`
--

LOCK TABLES `platform` WRITE;
/*!40000 ALTER TABLE `platform` DISABLE KEYS */;
INSERT INTO `platform` VALUES ('BNET','Battle Net'),('EPICG','Epic Games'),('ORG','Origin'),('PC','PC'),('PS3','PlayStation3'),('PS4','PlayStation4'),('STM','Steam'),('UPLY','UPlay'),('XB360','XBox'),('XBONE','XBox One');
/*!40000 ALTER TABLE `platform` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rating`
--

DROP TABLE IF EXISTS `rating`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `rating` (
  `username` varchar(20) NOT NULL,
  `gameCode` varchar(10) NOT NULL,
  `rate` int(11) NOT NULL,
  KEY `fk_rat_username` (`username`),
  KEY `fk_rat_gameCode` (`gameCode`),
  CONSTRAINT `fk_rat_gameCode` FOREIGN KEY (`gameCode`) REFERENCES `games` (`gameCode`),
  CONSTRAINT `fk_rat_username` FOREIGN KEY (`username`) REFERENCES `mygames` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rating`
--

LOCK TABLES `rating` WRITE;
/*!40000 ALTER TABLE `rating` DISABLE KEYS */;
INSERT INTO `rating` VALUES ('severus','ORGFIFA20',1),('hermi','ORGFIFA20',5),('Levi','ORGFIFA20',3),('Luna','ORGFIFA20',4),('severus','PS3OVERW',4),('severus','STMRB6SIE',3),('severus','UPLYACBF',5),('severus','PS4GTAV',5),('Levi','PS4GTAV',2),('severus','STMFM20',3);
/*!40000 ALTER TABLE `rating` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `users` (
  `username` varchar(20) NOT NULL,
  `password` varchar(12) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('dumbledore','limonserbeti','Albus Percivle','Dumbledore','albusDumble@gmail.com'),('hermi','aritmansi','Hermione Jean','Granger','hermioneG@gmail.com'),('Levi','korose','Levi','Ackermann','humansbestWeapon@gmail.com'),('LordSidius','darkside','Palpatine','Starkiller','darksideforever@gmail.com'),('Luna','lonellylove','Luna','Lovegood','LunaLove@gmail.com'),('padfoot','bestmarauder','Sirius','Black','siriusB@gmail.com'),('severus','lily53','Severus','Snape','severus53@gmail.com');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `mycart_games`
--

/*!50001 DROP VIEW IF EXISTS `mycart_games`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `mycart_games` AS select `cart`.`gameCode` AS `gameCode`,`cart`.`username` AS `username`,`games`.`p_code` AS `p_code`,`games`.`name` AS `name`,`games`.`price` AS `price`,`games`.`discount` AS `discount` from (`cart` join `games` on((`cart`.`gameCode` = `games`.`gameCode`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-01-02 13:14:21
