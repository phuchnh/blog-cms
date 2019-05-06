-- MySQL dump 10.16  Distrib 10.1.38-MariaDB, for osx10.10 (x86_64)
--
-- Host: localhost    Database: laravel_ssr
-- ------------------------------------------------------
-- Server version	10.1.38-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `assets`
--

DROP TABLE IF EXISTS `assets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uri` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` int(10) unsigned NOT NULL,
  `created_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `assets_path_index` (`path`),
  KEY `assets_uri_index` (`uri`),
  KEY `assets_name_index` (`name`),
  KEY `assets_mime_index` (`mime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assets`
--

LOCK TABLES `assets` WRITE;
/*!40000 ALTER TABLE `assets` DISABLE KEYS */;
/*!40000 ALTER TABLE `assets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hierarchies`
--

DROP TABLE IF EXISTS `hierarchies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hierarchies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ancestor` bigint(20) unsigned NOT NULL,
  `descendant` bigint(20) unsigned NOT NULL,
  `depth` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `hierarchies_ancestor_foreign` (`ancestor`),
  KEY `hierarchies_descendant_foreign` (`descendant`),
  CONSTRAINT `hierarchies_ancestor_foreign` FOREIGN KEY (`ancestor`) REFERENCES `taxonomies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `hierarchies_descendant_foreign` FOREIGN KEY (`descendant`) REFERENCES `taxonomies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hierarchies`
--

LOCK TABLES `hierarchies` WRITE;
/*!40000 ALTER TABLE `hierarchies` DISABLE KEYS */;
/*!40000 ALTER TABLE `hierarchies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `metas`
--

DROP TABLE IF EXISTS `metas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `metas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `meta_key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `metable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `metable_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `metas_metable_type_metable_id_index` (`metable_type`,`metable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `metas`
--

LOCK TABLES `metas` WRITE;
/*!40000 ALTER TABLE `metas` DISABLE KEYS */;
/*!40000 ALTER TABLE `metas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_03_20_035214_create_posts_table',1),(4,'2019_03_21_140623_create_post_meta_table',1),(5,'2019_03_24_071438_create_taxonomies_table',1),(6,'2019_03_24_071518_create_hierarchies_table',1),(7,'2019_03_24_073112_create_post_taxonomy_table',1),(8,'2019_04_02_110943_create_clients_table',1),(9,'2019_04_09_094654_create_assets_table',1),(10,'2019_04_16_022030_create_post_translations_table',1),(11,'2019_04_16_095547_create_taxonomy_translations_table',1),(12,'2019_04_16_101704_create_options_table',1),(13,'2019_04_19_020935_create_metas_table',1),(14,'2019_05_05_075938_create_search_json_function',1),(15,'2019_05_05_080913_create_search_json_main_function',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `options`
--

DROP TABLE IF EXISTS `options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `options` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `option_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `options`
--

LOCK TABLES `options` WRITE;
/*!40000 ALTER TABLE `options` DISABLE KEYS */;
/*!40000 ALTER TABLE `options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_meta`
--

DROP TABLE IF EXISTS `post_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post_meta` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL,
  `meta_key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `post_meta_post_id_meta_key_unique` (`post_id`,`meta_key`),
  KEY `post_meta_post_id_index` (`post_id`),
  CONSTRAINT `post_meta_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_meta`
--

LOCK TABLES `post_meta` WRITE;
/*!40000 ALTER TABLE `post_meta` DISABLE KEYS */;
/*!40000 ALTER TABLE `post_meta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_taxonomy`
--

DROP TABLE IF EXISTS `post_taxonomy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post_taxonomy` (
  `taxonomy_id` bigint(20) unsigned NOT NULL,
  `post_id` bigint(20) unsigned NOT NULL,
  `order` int(10) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `post_taxonomy_post_id_taxonomy_id_unique` (`post_id`,`taxonomy_id`),
  KEY `post_taxonomy_taxonomy_id_foreign` (`taxonomy_id`),
  CONSTRAINT `post_taxonomy_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `post_taxonomy_taxonomy_id_foreign` FOREIGN KEY (`taxonomy_id`) REFERENCES `taxonomies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_taxonomy`
--

LOCK TABLES `post_taxonomy` WRITE;
/*!40000 ALTER TABLE `post_taxonomy` DISABLE KEYS */;
/*!40000 ALTER TABLE `post_taxonomy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_translations`
--

DROP TABLE IF EXISTS `post_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post_translations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `post_translations_post_id_locale_unique` (`post_id`,`locale`),
  UNIQUE KEY `post_translations_slug_unique` (`slug`),
  KEY `post_translations_locale_index` (`locale`),
  KEY `post_translations_title_index` (`title`),
  CONSTRAINT `post_translations_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_translations`
--

LOCK TABLES `post_translations` WRITE;
/*!40000 ALTER TABLE `post_translations` DISABLE KEYS */;
INSERT INTO `post_translations` VALUES (1,1,'vi','Minus illum et atque harum.','minus-illum-et-atque-harum','Error rem velit qui et in sunt. Repellat nulla ratione quisquam a quod voluptas ut.','Nemo deleniti sunt aut aut dolorem soluta aut. Magni fugiat quaerat autem quia voluptatem. Minima sequi odio assumenda nulla aperiam laborum. Voluptatem ut consequatur aut voluptatem rerum nemo nobis. Nihil officiis praesentium molestias sint hic. Aut quis modi magnam repudiandae repellendus.','2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(2,2,'vi','Quos ad aut provident.','quos-ad-aut-provident','Officia ipsum et ab laborum qui. Vero nemo nisi dolorum ut.','Molestiae iste qui et odit inventore eos rerum. Voluptas asperiores aut id. At accusamus accusantium vero sunt ipsum sunt repellat. Enim architecto delectus ea. Et enim consequatur quisquam quae dolores voluptatibus ut. Nostrum enim alias qui vel quis aut. Rerum quod magni tempore aut ea cupiditate est.','2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(3,3,'vi','Neque et deserunt adipisci hic.','neque-et-deserunt-adipisci-hic','Ratione ipsum hic reprehenderit laboriosam sit. Harum ipsum perferendis maiores corporis.','Eaque aut est et magni sed. Facilis ex soluta voluptates voluptatem. Molestiae repellendus tempora sint cupiditate reprehenderit. Dolorem aut blanditiis omnis qui. Aperiam quis aspernatur quis quae molestiae. Nobis voluptatum officia dolorem ad neque voluptas.','2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(4,4,'vi','Voluptatem voluptas sit eligendi enim.','voluptatem-voluptas-sit-eligendi-enim','Culpa earum sunt eum commodi qui rerum. Natus esse sed voluptatem temporibus dicta.','Magni placeat labore suscipit dolor magnam. Perspiciatis similique suscipit magni rem aut. Omnis aut est quis voluptas. Id est omnis perspiciatis voluptates omnis dolor quasi. Fugit commodi quasi quo amet dolor. Consectetur molestiae dolores dolorum amet dolorum in voluptatum.','2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(5,5,'vi','Delectus eaque fuga inventore aliquid ipsum asperiores quo.','delectus-eaque-fuga-inventore-aliquid-ipsum-asperiores-quo','Mollitia perferendis atque nobis. Corrupti ea rem quia sint ipsam.','Est itaque maxime culpa voluptatem quisquam adipisci consequatur. Doloremque necessitatibus perspiciatis vel. Veritatis rerum voluptatum optio id ipsa in vel. Rem unde dolorem recusandae voluptas cupiditate perferendis facilis. Consectetur odio excepturi quo facere. Laborum adipisci ab ex dolor. Nulla amet impedit qui porro.','2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(6,6,'vi','Est dolores deleniti explicabo.','est-dolores-deleniti-explicabo','Est ea nisi ea in sit quo. Ut temporibus eos laudantium fugit quo assumenda.','Accusamus impedit iste aliquam vitae. Nisi delectus beatae voluptatum exercitationem itaque dolor. Libero dolorum dignissimos deserunt mollitia non saepe rerum nesciunt. Qui voluptatem vel molestiae exercitationem blanditiis voluptatem. Unde ea occaecati quod ea voluptatem.','2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(7,7,'vi','Aliquam quis ut esse vero voluptatem laudantium.','aliquam-quis-ut-esse-vero-voluptatem-laudantium','Qui non in ex quas. Nemo natus sit delectus est. Quae eum nemo inventore minima ut cupiditate.','Sit et reprehenderit veniam molestiae voluptas. Tempora libero provident ullam quam explicabo veritatis tenetur. Dolorum iure suscipit qui ducimus ullam. In neque in molestiae ab et sint eaque. Et suscipit perspiciatis ipsum temporibus. Nihil ad iste quo velit quasi odit in. Doloremque blanditiis ea libero ut. Ut maxime eveniet aliquam minima quasi.','2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(8,8,'vi','Quaerat sed ullam sint ea officia eum.','quaerat-sed-ullam-sint-ea-officia-eum','Earum aperiam architecto beatae. Non qui quos est. Eius dolor error ut et.','Autem beatae sed quia earum. Quidem quia omnis dolorum et. Omnis aspernatur et officiis corporis magnam. Assumenda molestiae accusantium reiciendis nihil cumque. Qui dignissimos eum et sunt porro. Unde perspiciatis dolores officiis. Dolor quibusdam maxime sint pariatur aut. Qui qui dolorem quisquam ea aut consequuntur saepe. Earum suscipit reiciendis deleniti est.','2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(9,9,'vi','Vitae quam quisquam assumenda maiores est.','vitae-quam-quisquam-assumenda-maiores-est','Aliquid delectus porro quia voluptatibus. Eveniet voluptates qui omnis et esse reprehenderit.','Rem dignissimos autem dolores dolores. Aut pariatur et totam explicabo labore est eos. Sapiente quis cum quia et. Maxime necessitatibus velit accusantium mollitia omnis beatae. Hic dolores quos veritatis numquam. Aut exercitationem dolores non laudantium. Est laborum nobis et illum aut.','2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(10,10,'vi','Facilis architecto molestiae tempora eligendi ab commodi.','facilis-architecto-molestiae-tempora-eligendi-ab-commodi','Sapiente dolore ipsum error molestiae. Non veritatis error quia sequi iusto omnis repudiandae.','Excepturi aliquam quis totam facere. Ut accusamus animi aut voluptatum molestiae. Qui ex repudiandae quaerat qui et. Explicabo architecto dolores laudantium minus voluptatum voluptatem adipisci. Soluta dolores sunt et doloribus ipsam. Nisi nam maxime facilis eum soluta alias. Repellendus blanditiis mollitia voluptas molestias. Quis quidem rerum vero.','2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(11,11,'vi','Qui aliquam ex tempora doloribus.','qui-aliquam-ex-tempora-doloribus','A deserunt id nihil. Odit error et saepe et. Quod voluptate consequuntur natus et.','Incidunt nemo itaque enim consequatur ullam atque quos. Iste praesentium ex quo rerum qui alias eveniet. Officia animi omnis quis porro qui aperiam voluptate. Modi ut asperiores perspiciatis tempora deserunt et aspernatur. Quas labore ea rerum quis aut suscipit rem. Nemo sed excepturi quo voluptatibus. Dolorem quae unde rerum culpa.','2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(12,12,'vi','Est sunt at accusamus rerum sequi veritatis.','est-sunt-at-accusamus-rerum-sequi-veritatis','Earum incidunt iure deleniti officiis molestias. Omnis voluptatem fugit placeat voluptatem et ut.','Earum aspernatur alias mollitia repellendus officia ut blanditiis. Corporis rem eum blanditiis molestiae aut est. Doloremque facere ipsa facere dolor id facilis. Mollitia assumenda consequuntur enim qui. Numquam error reiciendis et laboriosam. Laudantium vitae rerum sit temporibus et eligendi sed. Eveniet neque et voluptas exercitationem.','2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(13,13,'vi','Inventore commodi ea sit dolorem.','inventore-commodi-ea-sit-dolorem','Dolorem consequuntur cum fuga et. Qui nam eaque pariatur cumque.','Autem laborum nemo repellendus rerum. Ab est recusandae repudiandae et. Et accusantium et consequatur dolores tempore. Vel unde nulla beatae dolores quod molestias.','2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(14,14,'vi','Esse tempora cum consequuntur in eligendi.','esse-tempora-cum-consequuntur-in-eligendi','Rerum accusantium quas voluptatem rem voluptas perspiciatis et. Voluptas numquam accusamus facilis.','Quia voluptatum aut numquam cum deleniti. Modi sit quas repellendus suscipit quo voluptate. Accusantium architecto magni quisquam. Officia dignissimos autem et. Illum soluta aut architecto eum dicta. Eos commodi tempora et deserunt eos nostrum incidunt. Dicta voluptas quas non ea corrupti vel. Nostrum quo nam et qui cupiditate vero est ipsum.','2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(15,15,'vi','Vel perferendis occaecati corporis in soluta vel.','vel-perferendis-occaecati-corporis-in-soluta-vel','Assumenda quam quo molestiae voluptatibus ipsam. Omnis numquam quia quaerat eligendi.','Est dolore tempora eaque vero officia. Fuga nihil fuga et. Voluptatem error et sed omnis sit voluptatem. Facilis mollitia facere dolores quia. Aut sit quo aut eos et. Dolores doloremque omnis est aut quae. Nostrum quo est explicabo et id tempore.','2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(16,16,'vi','Illo est iusto et velit qui.','illo-est-iusto-et-velit-qui','Eaque eum blanditiis et beatae earum provident. Molestias culpa quis doloremque aut ducimus.','Et dolor qui non accusamus. Et alias ut reprehenderit nam et pariatur. Dignissimos officia facilis tempore beatae ut. Voluptatum veniam eos et molestias sed velit ducimus. Optio reiciendis ipsum impedit. Ab est explicabo omnis voluptatem suscipit. Officia labore voluptas illo incidunt beatae voluptatem est.','2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(17,17,'vi','Dolore enim possimus et vitae voluptatum debitis ut occaecati.','dolore-enim-possimus-et-vitae-voluptatum-debitis-ut-occaecati','Molestiae dolor eaque voluptas dicta. At pariatur impedit omnis ut quos.','Dolor odit aut molestias voluptas ex. Harum voluptatem vel sint eveniet. Nesciunt cum aspernatur suscipit pariatur rerum in. Maxime quis porro nostrum dolorum omnis qui dolorem. Nulla distinctio eos consequatur nisi. Qui dolor labore ut nemo est et. Nostrum quia consequatur sunt ullam nostrum eos autem. Vitae dicta numquam suscipit magni et impedit.','2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(18,18,'vi','Corporis illum placeat quis est molestiae quas voluptatem quasi.','corporis-illum-placeat-quis-est-molestiae-quas-voluptatem-quasi','Aut fuga dolorem eius a. Quaerat distinctio temporibus quos et. Qui sunt sint sunt dicta.','Magnam ut nostrum corporis dolorem sed qui qui. Sunt et accusantium ad et. Cum ab nobis nulla corporis odio est consequuntur dolorum. Quos eos et hic. Quae ea quidem rerum pariatur error non. Qui et velit non qui. Dolores numquam error vero quia non.','2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(19,19,'vi','Magnam et facere quo et autem optio ut.','magnam-et-facere-quo-et-autem-optio-ut','Sint quo autem laboriosam odio est. Aliquam qui neque odio quidem.','Neque voluptatem placeat architecto velit voluptatum deleniti. Id totam repudiandae et vel vel enim. Dolor neque et dolorum ut aut magni. Fugiat est molestias quia ipsam. Tempora et quidem et sint mollitia in. Voluptatem voluptatem beatae voluptas. Velit et omnis sed et eum sint et at. Neque quae totam et velit culpa. Ab totam non esse qui tempora autem.','2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(20,20,'vi','Vitae et at aut sequi molestiae et.','vitae-et-at-aut-sequi-molestiae-et','Autem sed quaerat omnis fugit. Sint quia consequatur repellat. Aut et optio aut.','Autem inventore voluptatibus harum non et. Commodi id voluptatem nihil illum nostrum quo. Sit possimus sed iusto deserunt incidunt eius. Tempora dolorem ut quae adipisci quaerat. Et eveniet qui et est quibusdam in. Corporis itaque voluptatum aut rerum mollitia explicabo. Non deleniti eligendi impedit voluptate sunt blanditiis sunt.','2019-05-06 05:58:57','2019-05-06 05:58:57',NULL);
/*!40000 ALTER TABLE `post_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `publish` tinyint(1) NOT NULL DEFAULT '0',
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'post',
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,0,'post',0,0,'2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(2,0,'post',0,0,'2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(3,0,'post',0,0,'2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(4,0,'post',0,0,'2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(5,0,'post',0,0,'2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(6,0,'post',0,0,'2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(7,0,'post',0,0,'2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(8,0,'post',0,0,'2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(9,0,'post',0,0,'2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(10,0,'post',0,0,'2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(11,0,'post',0,0,'2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(12,0,'post',0,0,'2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(13,0,'post',0,0,'2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(14,0,'post',0,0,'2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(15,0,'post',0,0,'2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(16,0,'post',0,0,'2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(17,0,'post',0,0,'2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(18,0,'post',0,0,'2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(19,0,'post',0,0,'2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(20,0,'post',0,0,'2019-05-06 05:58:57','2019-05-06 05:58:57',NULL);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `taxonomies`
--

DROP TABLE IF EXISTS `taxonomies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `taxonomies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'categories',
  `parent_id` bigint(20) unsigned DEFAULT NULL,
  `lft` bigint(20) unsigned NOT NULL DEFAULT '0',
  `rgt` bigint(20) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `taxonomies_parent_id_foreign` (`parent_id`),
  CONSTRAINT `taxonomies_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `taxonomies` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `taxonomies`
--

LOCK TABLES `taxonomies` WRITE;
/*!40000 ALTER TABLE `taxonomies` DISABLE KEYS */;
/*!40000 ALTER TABLE `taxonomies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `taxonomy_translations`
--

DROP TABLE IF EXISTS `taxonomy_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `taxonomy_translations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `taxonomy_id` bigint(20) unsigned NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `taxonomy_translations_taxonomy_id_locale_unique` (`taxonomy_id`,`locale`),
  UNIQUE KEY `taxonomy_translations_slug_unique` (`slug`),
  KEY `taxonomy_translations_locale_index` (`locale`),
  KEY `taxonomy_translations_title_index` (`title`),
  CONSTRAINT `taxonomy_translations_taxonomy_id_foreign` FOREIGN KEY (`taxonomy_id`) REFERENCES `taxonomies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `taxonomy_translations`
--

LOCK TABLES `taxonomy_translations` WRITE;
/*!40000 ALTER TABLE `taxonomy_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `taxonomy_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Remington Welch','admin@admin.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','admin','o4VXJRpg0ytvOws9vUan5ItCVoy2Dh3y6KouNgSetPDufZAERPkNJsLgWTaG','2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(2,'Jace Cole','william.howell@example.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'t0LbbmQBlF','2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(3,'Ms. Candace Crist','ankunding.cole@example.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'5LUZaT9GEq','2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(4,'Prof. Brady Waelchi DDS','fritsch.joan@example.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'U0qfCstGph','2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(5,'Ms. Jaunita Stracke Sr.','von.buford@example.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'reG7WVox7F','2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(6,'Taurean Gulgowski','upton.letha@example.net','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'KLzHT4FgBa','2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(7,'Mitchell Mertz','glover.elta@example.net','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'m7LPE2Ic3W','2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(8,'Joyce Lynch','tlubowitz@example.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'p516kgZ1f8','2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(9,'Prof. Zion Raynor III','qjast@example.net','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'reRotTEZ21','2019-05-06 05:58:57','2019-05-06 05:58:57',NULL),(10,'Virgil Harvey','merl18@example.net','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'yC3tO0Q9iO','2019-05-06 05:58:57','2019-05-06 05:58:57',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-05-06 20:01:18
