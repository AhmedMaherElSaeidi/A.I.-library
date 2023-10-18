-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.21-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for library
CREATE DATABASE IF NOT EXISTS `library` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `library`;

-- Dumping structure for table library.author
CREATE TABLE IF NOT EXISTS `author` (
  `author_id` int(11) NOT NULL AUTO_INCREMENT,
  `author_name` varchar(50) NOT NULL,
  PRIMARY KEY (`author_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table library.author: ~19 rows (approximately)
INSERT INTO `author` (`author_id`, `author_name`) VALUES
	(1, 'Anthony Hope'),
	(2, 'Charles Edward Pogue'),
	(3, 'George R. R. Martin'),
	(4, 'Lawrence Edward Watkin'),
	(5, 'Stuart Thaman'),
	(6, 'Jonathan Swift'),
	(7, 'Jeanne DuPrau'),
	(8, 'Nazam Anhar'),
	(9, 'T. Hunter'),
	(10, 'Mike Kelley'),
	(11, 'unknown'),
	(12, 'Edna O\'Brien'),
	(13, 'J. K. Rowling'),
	(14, 'Ahmed Morad'),
	(15, 'Sandra Serag'),
	(16, 'Dr. Ahmed Khaled Tawfik'),
	(17, 'Dr. Mohamed Taha'),
	(18, 'Mohamed Sadek'),
	(19, 'Patricia Carter');

-- Dumping structure for table library.book
CREATE TABLE IF NOT EXISTS `book` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_name` varchar(50) NOT NULL,
  `cost` int(11) NOT NULL,
  `book_cover` varchar(100) DEFAULT NULL,
  `book_url` varchar(255) NOT NULL,
  `book_description` varchar(255) NOT NULL,
  `currency` varchar(30) NOT NULL,
  `book_language` varchar(20) NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`book_id`),
  KEY `authorid_fk` (`author_id`),
  KEY `categoryid_fk` (`category_id`),
  CONSTRAINT `authorid_fk` FOREIGN KEY (`author_id`) REFERENCES `author` (`author_id`),
  CONSTRAINT `categoryid_fk` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table library.book: ~46 rows (approximately)
INSERT INTO `book` (`book_id`, `book_name`, `cost`, `book_cover`, `book_url`, `book_description`, `currency`, `book_language`, `author_id`, `category_id`) VALUES
	(1, 'Prisoner of Zenda', 23, '24954-prisoner of zenda.jpg', '#', 'is an adventurous tale of mistaken identity and political intrigue, set in the fictional kingdom of Ruritania, where a British man impersonates the king, leading to a captivating plot filled with romance and suspense.', 'USD', 'en', 1, 1),
	(2, 'Dragon Heart', 15, '2818-dragon heart.jpg', '#', 'is a fantasy novel that delves into the epic journey of a hero, where he forms an unlikely bond with a dragon, exploring themes of courage, friendship, and the battle between good and evil in a magical world filled with mythical creatures.', 'USD', 'en', 2, 1),
	(3, 'Game Of Thrones', 40, '98593-game of thrones.jpg', '#', ' is a renowned epic fantasy series by George R.R. Martin, filled with political intrigue, power struggles, and complex characters vying for control of the Seven Kingdoms of Westeros. It explores themes of ambition, betrayal, and the consequences of wieldi', 'USD', 'en', 3, 1),
	(4, 'Robin Hood', 24, '23885-robin hood.jpg', '#', 'is a legendary outlaw and folk hero who robs from the rich to give to the poor in Sherwood Forest. His story has been told in various forms for centuries, emphasizing themes of justice, rebellion against oppression, and the enduring appeal of a charismati', 'USD', 'en', 4, 1),
	(5, 'The Goblin Wars', 60, '83204-the goblin wars.jpg', '#', 'is a fantasy series that unfolds an epic conflict between different species in a mystical world, focusing on the battles, alliances, and magical elements that shape their destinies. It\'s a thrilling tale of war, camaraderie, and the struggle for survival ', 'USD', 'en', 5, 1),
	(6, 'Gulliver\'s Travels', 25, '8062-gulliver\'s travels.jpg', '#', ' is a satirical masterpiece by Jonathan Swift, following Gulliver\'s outlandish journeys through bizarre lands, cleverly critiquing human foibles and society\'s shortcomings with humor and allegory. It\'s a timeless work that offers both entertainment and so', 'USD', 'en', 6, 1),
	(7, 'City of ember', 35, '31177-The-City-of-Ember.jpg', '#', 'is a captivating young adult novel by Jeanne DuPrau, set in a post-apocalyptic underground city where two teenagers, Lina and Doon, discover a way out and must navigate a world of secrets, danger, and hope. It\'s a tale of resilience, curiosity, and the qu', 'USD', 'en', 7, 1),
	(8, 'Dragon hunter', 65, '87679-dragon hunter.jpg', '#', 'is an exhilarating fantasy novel that follows the adventures of a heroic figure tasked with hunting and taming dragons, exploring themes of bravery, conflict, and the allure of mythical creatures in a richly imagined world.', 'USD', 'en', 8, 1),
	(9, 'Poseidon\'s labor', 24, '95349-poseidon\'s labor.jpg', '#', 'is a mythological tale that delves into one of the twelve labors of the Greek hero Heracles (Hercules), which was set by Poseidon, the god of the sea. It\'s an epic narrative filled with challenges, divine trials, and the quest for redemption in the world ', 'USD', 'en', 9, 1),
	(10, 'Revenge', 44, '21665-revenge.jpg', '#', 'is a compelling thriller that delves into the intricacies of vengeance, examining how one person\'s quest for retribution can lead to a web of suspense, moral dilemmas, and unforeseen consequences. It explores the darker aspects of human nature and the cos', 'USD', 'en', 10, 1),
	(11, 'Art Illumination', 33, '54028-the art of illumination.png', '#', 'is a vibrant book that celebrates the world of art, shedding light on the creative processes, artists\' journeys, and the profound impact of art on culture and society. It\'s a visual and intellectual journey that unveils the power and beauty of artistic ex', 'USD', 'en', 19, 1),
	(12, 'The lonely girl', 33, '69685-lonely girl.jpg', '#', 'is a poignant novel that tells the story of a young woman\'s emotional journey as she grapples with solitude, self-discovery, and the search for human connection. It explores themes of loneliness, identity, and the universal longing for companionship and b', 'USD', 'en', 12, 1),
	(14, 'Prey for me', 54, '83637-prey for me.jpg', '#', 'is a thrilling suspense novel that delves into a chilling game of cat and mouse as a relentless predator stalks their prey. The story keeps readers on the edge of their seats, exploring themes of fear, survival, and the dark secrets that bind the characte', 'USD', 'en', 11, 1),
	(15, 'Greek mythology', 0, '2798-greek mythology.png', '#', 'is a comprehensive guide to the captivating tales of ancient Greece\'s gods, heroes, and legendary creatures. This rich and enduring tradition of storytelling weaves together stories of creation, love, power, and fate, offering profound insights into human', 'USD', 'en', 11, 1),
	(16, 'هاري بوتر وحجر الفيلسوف', 60, '65089-potter1.jpg', 'https://www.alarabimag.com/read/19955-%D9%87%D8%A7%D8%B1%D9%8A-%D8%A8%D9%88%D8%AA%D8%B1-%D9%88%D8%AD%D8%AC%D8%B1-%D8%A7%D9%84%D9%81%D9%8A%D9%84%D8%B3%D9%88%D9%81.html', 'الجزء الأول من سلسلة هاري بوتر للكاتبة جيه. كيه. رولينج. يروي الكتاب قصة هاري بوتر، الفتى الساحر الذي يتعرض للسحر والمغامرة عندما يكتشف أنه ساحر ويبدأ مغامرته في عالم هوجورتس. الكتاب يتناول قصة تعلم هاري بوتر واكتشاف أصوله وأصدقائه ومواجهته لأولى التحديات', 'EGP', 'ar', 13, 1),
	(17, 'هاري بوتر وحجرة الأسرار', 70, '4847-potter2.jpg', 'https://www.alarabimag.com/read/19956-%D9%87%D8%A7%D8%B1%D9%8A-%D8%A8%D9%88%D8%AA%D8%B1-%D9%88%D8%AD%D8%AC%D8%B1%D8%A9-%D8%A7%D9%84%D8%A3%D8%B3%D8%B1%D8%A7%D8%B1.html', 'الجزء الثاني من سلسلة هاري بوتر للكاتبة جيه. كيه. رولينج. يستمر الكتاب في مغامرات هاري بوتر في هوجورتس، حيث يتعين عليه مواجهة أحداث غامضة ومخلوقات سحرية مخيفة. يشهد هاري تطورات جديدة في قصته ويكتشف أسرارًا تتعلق بماضيه وبعالم السحر بشكل عام.', 'EGP', 'ar', 13, 1),
	(18, 'هاري بوتر وسجين أزكابان', 40, '50307-potter3.jpg', 'https://www.alarabimag.com/read/19957-%D9%87%D8%A7%D8%B1%D9%8A-%D8%A8%D9%88%D8%AA%D8%B1-%D9%88%D8%B3%D8%AC%D9%8A%D9%86-%D8%A3%D8%B2%D9%83%D8%A7%D8%A8%D8%A7%D9%86.html', 'الجزء الثالث من سلسلة هاري بوتر للكاتبة جيه. كيه. رولينج. يركز الكتاب على هروب السجين الخطير سيريوس بلاك من سجن أزكابان وتأثيره على حياة هاري بوتر. تتضمن الرواية تفاصيل حول الأحداث الجديدة وتطور الشخصيات، مع استمرار مغامرات هاري في عالم السحر والسحرة.', 'EGP', 'ar', 13, 1),
	(19, 'هاري بوتر وكأس النار', 35, '6971-potter4.jpg', 'https://www.alarabimag.com/read/19958-%D9%87%D8%A7%D8%B1%D9%8A-%D8%A8%D9%88%D8%AA%D8%B1-%D9%88%D9%83%D8%A3%D8%B3-%D8%A7%D9%84%D9%86%D8%A7%D8%B1.html', 'الجزء الرابع من سلسلة هاري بوتر للكاتبة جيه. كيه. رولينج. تدور القصة حول مشاركة هاري في البطولة السحرية المعروفة بكأس النار والتحديات والمخاطر التي تنتظره خلال المسابقة. الكتاب يحتوي على تفاصيل مثيرة حول تطورات القصة ويستمر في رواية مغامرات هاري في عالم ا', 'EGP', 'ar', 13, 1),
	(20, 'هاري بوتر وجماعة العنقاء', 25, '98771-potter5.jpg', 'https://maktbah.net/%D8%B1%D9%88%D8%A7%D9%8A%D8%A9-%D9%87%D8%A7%D8%B1%D9%8A-%D8%A8%D9%88%D8%AA%D8%B1-%D9%88%D8%AC%D9%85%D8%A7%D8%B9%D8%A9-%D8%A7%D9%84%D8%B9%D9%86%D9%82%D8%A7%D8%A1-%D8%AC-%D9%83-%D8%B1%D9%88%D9%84/', 'الجزء الخامس من سلسلة هاري بوتر للكاتبة جيه. كيه. رولينج. تدور الرواية حول مغامرات هاري بوتر وأصدقائه في مواجهة تنظيم سري يُدعى جماعة العنقاء، حيث يتعين عليهم التصدي للظلم والتعبئة ضد الساحر الشرير لورد فولدمورت. الكتاب يركز على مواضيع الصداقة والمقاومة ض', 'EGP', 'ar', 13, 1),
	(21, 'هاري بوتر والأمير الهجين', 75, '50356-potter6.jpg', 'https://www.alarabimag.com/read/19954-%D9%87%D8%A7%D8%B1%D9%8A-%D8%A8%D9%88%D8%AA%D8%B1-%D9%88%D8%A7%D9%84%D8%A3%D9%85%D9%8A%D8%B1-%D8%A7%D9%84%D9%87%D8%AC%D9%8A%D9%86.html', 'الجزء السادس من سلسلة هاري بوتر للكاتبة جيه. كيه. رولينج. يركز الكتاب على رحلة هاري وأصدقائه في التعرف على المزيد عن الماضي والقوى الظلامة التي تهدد عالمهم السحري. تحاول الرواية الكشف عن الأسرار والأحداث الرئيسية التي تؤدي إلى الاستعداد للصراع النهائي.', 'EGP', 'ar', 13, 1),
	(22, 'هاري بوتر ومقدسات الموت', 65, '88127-potter7.jpg', 'https://www.alarabimag.com/read/19959-%D9%87%D8%A7%D8%B1%D9%8A-%D8%A8%D9%88%D8%AA%D8%B1-%D9%88%D9%85%D9%82%D8%AF%D8%B3%D8%A7%D8%AA-%D8%A7%D9%84%D9%85%D9%88%D8%AA.html', 'الجزء السابع والأخير في سلسلة هاري بوتر للكاتبة جيه. كيه. رولينج. يأخذ الكتاب القراء في مغامرة نهائية مثيرة حيث يتعين على هاري وأصدقائه مواجهة لورد فولدمورت والبحث عن مقدسات الموت. الرواية تتعمق في الشجاعة والصداقة والقوى السحرية في عالم هاري بوتر.', 'EGP', 'ar', 13, 1),
	(23, 'هاري بوتر والطفل الملعون', 68, '84119-potter8.jpg', 'https://www.alarabimag.com/read/34986-%D9%87%D8%A7%D8%B1%D9%8A-%D8%A8%D9%88%D8%AA%D8%B1-%D9%88%D8%A7%D9%84%D8%B7%D9%81%D9%84-%D8%A7%D9%84%D9%85%D9%84%D8%B9%D9%88%D9%86.html', 'كتاب مسرحي من تأليف جيه. كيه. رولينج يستكمل قصة هاري بوتر بعد أحداث السلسلة الأصلية. يركز الكتاب على مغامرة هاري كبيراً في حياته حيث يواجه تحديات جديدة ويكتشف أسرارًا جديدة تتعلق بعالم السحر.', 'EGP', 'ar', 13, 1),
	(24, 'فيرتيجو', 40, '29012-morad1.png', 'https://www.rwaiaty.com/?embed=MzI0NA==', 'رواية تدور حول قصة شخص يعاني من دوران وتشوش في الرؤية، والتي تؤدي به إلى سلسلة من الأحداث الغامضة والمثيرة. يكتشف البطل أن هناك أسرارًا مظلمة تتعلق بحياته، ويجد نفسه في سباق مع الزمن لكشف الحقائق واستعادة وضوح رؤيته.', 'EGP', 'ar', 14, 2),
	(25, 'الفيل الازرق', 44, '85771-morad2.jpg', 'https://www.rwaiaty.com/?embed=MzIzOQ==', 'رواية غامضة تحكي قصة طبيب نفسي يُطلب منه مساعدة صديق قديم في حل لغز جريمة قتل غامضة. يكتشف الطبيب أن هناك عوالمًا مظلمة وأسرارًا مدفونة في العقول البشرية، مما يقوده إلى رحلة غموض مشوقة تتخطى الأبعاد النفسية.', 'EGP', 'ar', 14, 2),
	(26, 'تراب الماس', 35, '15368-morad4.png', 'https://foulabook.com/ar/read/%D8%AA%D8%B1%D8%A7%D8%A8-%D8%A7%D9%84%D9%85%D8%A7%D8%B3-pdf', 'رواية تدور حول قصة حب معقدة بين شخصين من طبقات اجتماعية مختلفة. ترتكز القصة على التضحيات والصراعات التي يواجهونها في سبيل الحفاظ على علاقتهم، وكيف تأثير الحب يعبر عندما يجتمع التراب والماس.', 'EGP', 'ar', 14, 2),
	(27, 'رواية أرض الإله', 65, '76537-morad5.jpg', 'https://www.elktob.online/read/260/%d9%83%d8%aa%d8%a7%d8%a8-%d8%a3%d8%b1%d8%b6-%d8%a7%d9%84%d8%a5%d9%84%d9%87-pdf', 'تأخذ القارئ في رحلة ملحمية إلى عالم خيالي مثير مليء بالأساطير والخرافات. تروي القصة مغامرات شخصيات تسعى لاستكشاف وفهم قوى خارقة وأسرار قديمة تكمن في أرض تعيش فيها الآلهة والمخلوقات الغامضة، مما يخلق جوًا من الإثارة والتشويق.', 'EGP', 'ar', 14, 2),
	(28, 'موسم صيد الغزلان', 48, '24636-morad6.jpg', 'https://foulabook.com/ar/read/%D9%85%D9%88%D8%B3%D9%85-%D8%B5%D9%8A%D8%AF-%D8%A7%D9%84%D8%BA%D8%B2%D9%84%D8%A7%D9%86-pdf', 'رواية تتتبع قصة مجموعة من الصيادين ومغامراتهم أثناء موسم الصيد. تسلط الضوء على تجاربهم وتحدياتهم في البرية، وكيف تتغير حياتهم خلال هذا الموسم المثير من الصيد، مما يجمع بين الأدرينالين والطبيعة والصداقة.\r\n\r\n\r\n\r\n\r\n', 'EGP', 'ar', 14, 2),
	(29, 'لوكاندة بير الوطاويط', 48, '85383-morad7.jpg', 'https://www.rwaiaty.com/?embed=MTQ4MzE=', 'كتاب يقدم لمحة فكاهية وساخرة عن الحياة اليومية في البيئة القروية، يستند إلى تجارب ومواقف طريفة تحدث في هذا السياق. يتناول الكتاب مواضيع متنوعة من خلال أسلوب هزلي وساخر، مما يجعله جاذبًا للقراء الباحثين عن الترفيه والضحك.', 'EGP', 'ar', 14, 2),
	(30, '1919', 34, '6895-morad3.jpg', 'https://www.rwaiaty.com/?embed=MzIzOQ==', 'كتاب تاريخي يستعرض أحداث العام 1919 ودورها في تشكيل العالم الحديث. يسلط الضوء على الأحداث الرئيسية والتغيرات الاجتماعية والسياسية التي حدثت في ذلك العام، وكيف أثرت في مسارات التاريخ والتطور العالمي.', 'EGP', 'ar', 14, 2),
	(31, 'ما لا نبوح به', 44, '13893-sandra.jpg', 'https://www.rwaiaty.com/?embed=Njc0OA==', 'رواية تسلط الضوء على الأسرار والأحداث المدفونة في أعماق الشخصيات، حيث تنمو العلاقات وتكتشف الحقائق غير المُفصح عنها. تستكشف الرواية القوى الخفية للإنسان وأهمية التواصل الصادق والتفاهم في تطوير العلاقات.', 'EGP', 'ar', 15, 3),
	(32, 'الى ما لا نهاية', 60, '32451-sandra1.jpg', 'https://www.rwaiaty.com/?embed=NjYwNw==', 'رواية تأخذك في رحلة ممتدة من الحب والمغامرة عبر الزمن، حيث تروي قصة حب عاطفية تتحدى العوائق وتتلاقى مع مفاجآت لا نهائية، مما يرسم صورة جميلة للرومانسية والتفاؤل.', 'EGP', 'ar', 15, 2),
	(33, 'يوتوبيا', 34, '61826-tawfiq1.jpg', 'https://www.rwaiaty.com/?embed=Mzg5OA==', ' هو رواية تقدم رؤية مثيرة لعالم مثالي يسعى البشر إلى بنائه، حيث يسود السلام والعدالة والتناغم. ومع ذلك، تبدأ القصة في تكشف عن جوانب معقدة وأخلاقية في هذا العالم المثالي، مما يثير أسئلة حول الحقيقة والتضحية ومفهوم السعادة.', 'EGP', 'ar', 16, 2),
	(34, 'في ممر الفئران', 65, '82665-tawfiq2.jpg', 'https://www.books-lib.net/read/666/%D9%81%D9%8A-%D9%85%D9%85%D8%B1-%D8%A7%D9%84%D9%81%D8%A6%D8%B1%D8%A7%D9%86', 'هو رواية تأخذك في رحلة إلى عالم معقد من المؤامرات والصراعات الإنسانية. تتناول الرواية قصة شخصيات تتقاطع مصائرها في ممر تعج بالتحديات والقرارات الصعبة، مما يرسم صورة مشوقة للعلاقات الإنسانية والقوى المظلمة والأمل.', 'EGP', 'ar', 16, 2),
	(35, 'رواية الغرفة 207', 19, '60008-tawfiq6.png', 'https://www.rwaiaty.com/?embed=MzkxNw==', 'هي قصة غموض تدور حول أحداث غامضة تحدث في غرفة 207 من فندق فاخر. تتبع القصة جريمة قتل معقدة وتسعى شخصياتها للكشف عن الحقيقة وحل اللغز في جوٍ من التوتر والإثارة.', 'EGP', 'ar', 16, 2),
	(36, 'هادم الأساطير', 46, '61765-tawfiq5.jpg', 'https://www.rwaiaty.com/?embed=MTQ4MzE=', 'هو رواية ملحمية ترصد مغامرة شخصية تهدف إلى تحطيم الأساطير والأفكار السائدة للكشف عن الحقائق الخفية والقوى الخارقة. تأخذ الرواية القراء في رحلة مثيرة لاستكشاف الغموض والقوى الخفية التي تكمن خلف الأساطير.', 'EGP', 'ar', 16, 4),
	(37, 'رواية شآبيب', 64, '5157-tawfiq3.jpg', 'https://www.rwaiaty.com/?embed=Mzk2MA==', 'هي قصة مشوقة تأخذ القارئ في رحلة مثيرة إلى عوالم متشعبة من الألغاز والصراعات الإنسانية. تروي الرواية قصة شخصيات متشابكة في بحثها عن معنى الحياة والإجابات على أسئلة معقدة في سياق قوي ومعبر.', 'EGP', 'ar', 16, 3),
	(38, 'موسوعة الظلام', 35, '96202-tawfiq7.jpg', 'https://www.rwaiaty.com/?embed=Mzk3Mg==', 'هي مصدر شامل يأخذك في رحلة مشوقة إلى عوالم مظلمة وغامضة. تقدم هذه الموسوعة تفاصيل مثيرة حول الجرائم الغامضة، والأساطير، والظواهر الغريبة، مما يثري فضولك ويكشف عن أسرار مخبأة في عمق الظلام.', 'EGP', 'ar', 16, 4),
	(39, 'الخروج عن النص', 33, '79367-taha.png', 'https://www.rwaiaty.com/?embed=NjQwNA==', 'كتاب يبحث في تأثير الأفكار والأفعال الغير تقليدية على الإبداع والتفكير المبتكر، مظهرًا أهمية التمرد الفكري والثقافي.', 'EGP', 'ar', 17, 2),
	(40, 'ذكر شرقى منقرض', 64, '13653-taha3.jpg', 'https://www.rwaiaty.com/?embed=NDI2NjM=', 'واية تعكس حياة شخصية تائهة في الزمن والمكان، حيث يسعى البطل للبحث عن هويته المفقودة في شرق معقد منقرض تدريجيًا.', 'EGP', 'ar', 17, 2),
	(41, 'لأ بطعم الفلامنكو', 47, '12153-taha2.png', 'https://www.rwaiaty.com/?embed=NjQwMA==', 'كتاب يقدم رحلة ساحرة إلى عالم الفلامنكو الإسباني، حيث يجمع بين السفر والموسيقى لاستكشاف ثقافة وتاريخ هذا النوع الفني الرائع.', 'EGP', 'ar', 17, 2),
	(42, 'علاقات خطرة', 77, '69843-taha1.jpg', 'https://www.rwaiaty.com/?embed=NjQwMg==', 'رواية تشتد بها الصراعات الإنسانية والمشكلات الاجتماعية، حيث تتناول قصة مجموعة من الشخصيات وعلاقاتهم المعقدة والخطرة، مما يجسد تأثيراتها على حياتهم ومصائرهم.', 'EGP', 'ar', 17, 2),
	(43, 'بضع ساعات فى يوم ما', 78, '16759-sadek.jpg', 'https://www.rwaiaty.com/?embed=MzE4Ng==', 'كتاب يستعرض الفلسفة والإلهام اللازمين للتفوق والتطوير الشخصي في حياة المرء، حيث يركز على أهمية الاستفادة من الوقت بفعالية لتحقيق الأهداف والتطلعات.', 'EGP', 'ar', 18, 3),
	(44, 'طه الغريب', 75, '31066-tarek5.jpg', 'https://www.rwaiaty.com/?embed=MzE4OA==', ' هو رواية تعكس قصة شخصية تتحدى الصعاب والتحولات الاجتماعية في مجتمع معين، حيث يسعى البطل لتحقيق طموحاته والبحث عن مكانه في عالم يبدو غريبًا بالنسبة له.', 'EGP', 'ar', 18, 3),
	(45, 'أنت فليبدأ العبث', 79, '10998-tarek3.jpg', 'https://kitab-pdf.net/read/?2858', 'هو كتاب يشجع على الإبداع والتفكير الحر، حيث يلهم القرّاء لاستكشاف الفوضى والابتكار في حياتهم، ويدعوهم إلى التحدي لتحقيق أهدافهم بأساليب مختلفة ومبتكرة.', 'EGP', 'ar', 18, 3),
	(46, 'انستا حياة', 35, '54245-tarek2.jpg', 'https://www.rwaiaty.com/?embed=MzE5MA==', 'هو دليل عملي يستكشف كيفية تحسين حياتك الشخصية والاجتماعية من خلال استخدام وسائل التواصل الاجتماعي بشكل أكثر فعالية، مع توجيهات حول كيفية بناء علاقات صحية وتحقيق التواصل الإيجابي عبر منصات التواصل الاجتماعي.', 'EGP', 'ar', 18, 3),
	(47, 'هيبتا', 26, '30480-tarek1.jpg', 'https://www.rwaiaty.com/?embed=MzE4NA==', 'رواية مثيرة تكشف أسرارًا معقدة حول جريمة قتل غامضة، حيث يتواجه البطلان بتحديات نفسية وأخلاقية تجعل القارئ يتساءل عن الحقيقة والعدالة.', 'EGP', 'ar', 18, 3);

-- Dumping structure for table library.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`cart_id`),
  KEY `customer_id_fk` (`user_id`),
  KEY `book_id_fk` (`book_id`),
  CONSTRAINT `book_id_fk` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `customer_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table library.cart: ~2 rows (approximately)
INSERT INTO `cart` (`cart_id`, `book_id`, `user_id`) VALUES
	(68, 1, 72),
	(70, 5, 72);

-- Dumping structure for table library.category
CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(30) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table library.category: ~4 rows (approximately)
INSERT INTO `category` (`category_id`, `category`) VALUES
	(1, 'science_fiction'),
	(2, 'psychology'),
	(3, 'novel'),
	(4, 'horror');

-- Dumping structure for table library.user
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` varchar(20) NOT NULL DEFAULT 'unknown',
  `role` varchar(20) NOT NULL DEFAULT 'user',
  `user_profile` varchar(70) NOT NULL DEFAULT 'null',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table library.user: ~2 rows (approximately)
INSERT INTO `user` (`user_id`, `username`, `password`, `first_name`, `last_name`, `gender`, `role`, `user_profile`) VALUES
	(71, 'ahmed8.sw2021@fci.helwan.edu.eg', '2002', 'Ahmed', 'Maher', 'M', 'admin', '77167-FCIHimage5.jpg'),
	(72, 'marvel@gmail.com', '123', 'AHMED', 'KHALED', 'M', 'user', 'null');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
