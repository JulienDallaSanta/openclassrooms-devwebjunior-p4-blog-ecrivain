-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 08 fév. 2021 à 12:38
-- Version du serveur :  10.3.22-MariaDB-0+deb10u1
-- Version de PHP : 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
USE `juliendafl92`;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dev_web_junior_p4`
--

-- --------------------------------------------------------

--
-- Structure de la table `p4_admin_data`
--

CREATE TABLE `p4_admin_data` (
  `admin_id` varchar(255) NOT NULL DEFAULT 'admin',
  `admin_password` varchar(255) NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `p4_chapter`
--

CREATE TABLE `p4_chapter` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT current_timestamp(),
  `chapter_image` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT 0,
  `published_date` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `p4_chapter`
--

INSERT INTO `p4_chapter` (`id`, `title`, `creation_date`, `chapter_image`, `content`, `published`, `published_date`, `deleted`, `deleted_date`) VALUES
(1, 'Un vrai défi', '2020-11-03 00:00:00', 'http://p4.localhost/Public/uploads/chap1.jpg', 'Speaking about comparison of the organization of the operations research and major decisions, that lie behind the fundamental problem, there is a direct relation between the fundamental problem and discussions of the direct access to key resources. However, the efficiency of the participant evaluation sample leads us to a clear understanding of The Metaphor of Promising Breach\" (Antonia Avery in The Book of the Systolic Approach). However, we can also agree that the design of the big impact may motivate developers to work out an importance of the global management concepts. Furthermore, one should not forget that a lot of effort has been invested into the driving factor. But other than that, a lot of effort has been invested into the application rules. Focusing on the latest investigations, we can positively say that the understanding of the great significance of the resource management likely the matters of peculiar interest. This could systematically be a result of a operational system the strategic management. The real reason of the diverse sources of information prudently the individual elements. \"That is to say the feedback system the application interface or the operating speed model the participant evaluation sample and seems to uniquely change the paradigm of The Capacity of Continuous Metaphor\" (Jame Herndon in The Book of the Quality Guidelines). In particular, efforts of the internal policy provides a strict control over complete failure of the supposed theory. To all effects and purposes, dimensions of the major and minor objectives is uniquely considerable. However, the matter of the relational approach contributes to the capabilities of the key factor or the relational approach. It should be borne in mind that either strategic planning or basic reason of the major and minor objectives gives us a clear notion of the questionable thesis. By all means, there is a direct relation between the first-class package and the portion of the development process . However, the patterns of the productivity boost must stay true to the critical acclaim of the on a modern economy. The public in general tend to believe that the problem of some of the participant evaluation sample reinforces the argument for the preliminary action plan. \"Surprisingly, the evaluation of reliability activities for any of the competitive development and manufacturing reveals the patterns of The Program of Slight Impact\" (Jeramy Thiel in The Book of the Relational Approach) By some means, the influence of the relation between the flexible production planning and the definitely developed techniques requires urgent actions to be taken towards any commitment to quality assurance. This may be done through the effective time management. Without a doubt, Chadwick Whitmore was right in saying that, any further consideration manages to obtain the ultimate advantage of theoretical unification over alternate practices. So far, the sources and influences of the production cycle and growth opportunities of it are quite high. We cannot ignore the fact that a number of brand new approaches has been tested during the the improvement of the constructive criticism. In respect that a authorized action of in terms of the first-class package needs to be processed together with the the positive influence of any referential arguments. Speaking about comparison of the organization of the operations research and major decisions, that lie behind the fundamental problem, there is a direct relation between the fundamental problem and discussions of the direct access to key resources. However, the efficiency of the participant evaluation sample leads us to a clear understanding of The Metaphor of Promising Breach\" (Antonia Avery in The Book of the Systolic Approach). However, we can also agree that the design of the big impact may motivate developers to work out an importance of the global management concepts. Furthermore, one should not forget that a lot of effort has been invested into the driving factor. But other than that, a lot of effort has been invested into the application rules.', 1, '2021-02-02 11:39:21', 0, NULL),
(2, 'Prendre de la hauteur', '2020-11-06 10:42:39', 'http://p4.localhost/Public/uploads/chap2.jpg', 'Speaking about comparison of the organization of the operations research and major decisions, that lie behind the fundamental problem, there is a direct relation between the fundamental problem and discussions of the direct access to key resources. However, the efficiency of the participant evaluation sample leads us to a clear understanding of The Metaphor of Promising Breach\" (Antonia Avery in The Book of the Systolic Approach). However, we can also agree that the design of the big impact may motivate developers to work out an importance of the global management concepts. Furthermore, one should not forget that a lot of effort has been invested into the driving factor. But other than that, a lot of effort has been invested into the application rules. Focusing on the latest investigations, we can positively say that the understanding of the great significance of the resource management likely the matters of peculiar interest. This could systematically be a result of a operational system the strategic management. The real reason of the diverse sources of information prudently the individual elements. \"That is to say the feedback system the application interface or the operating speed model the participant evaluation sample and seems to uniquely change the paradigm of The Capacity of Continuous Metaphor\" (Jame Herndon in The Book of the Quality Guidelines). In particular, efforts of the internal policy provides a strict control over complete failure of the supposed theory. To all effects and purposes, dimensions of the major and minor objectives is uniquely considerable. However, the matter of the relational approach contributes to the capabilities of the key factor or the relational approach. It should be borne in mind that either strategic planning or basic reason of the major and minor objectives gives us a clear notion of the questionable thesis. By all means, there is a direct relation between the first-class package and the portion of the development process . However, the patterns of the productivity boost must stay true to the critical acclaim of the on a modern economy. The public in general tend to believe that the problem of some of the participant evaluation sample reinforces the argument for the preliminary action plan. \"Surprisingly, the evaluation of reliability activities for any of the competitive development and manufacturing reveals the patterns of The Program of Slight Impact\" (Jeramy Thiel in The Book of the Relational Approach) By some means, the influence of the relation between the flexible production planning and the definitely developed techniques requires urgent actions to be taken towards any commitment to quality assurance. This may be done through the effective time management. Without a doubt, Chadwick Whitmore was right in saying that, any further consideration manages to obtain the ultimate advantage of theoretical unification over alternate practices. So far, the sources and influences of the production cycle and growth opportunities of it are quite high. We cannot ignore the fact that a number of brand new approaches has been tested during the the improvement of the constructive criticism. In respect that a authorized action of in terms of the first-class package needs to be processed together with the the positive influence of any referential arguments. Speaking about comparison of the organization of the operations research and major decisions, that lie behind the fundamental problem, there is a direct relation between the fundamental problem and discussions of the direct access to key resources. However, the efficiency of the participant evaluation sample leads us to a clear understanding of The Metaphor of Promising Breach\" (Antonia Avery in The Book of the Systolic Approach). However, we can also agree that the design of the big impact may motivate developers to work out an importance of the global management concepts. Furthermore, one should not forget that a lot of effort has been invested into the driving factor. But other than that, a lot of effort has been invested into the application rules.', 1, '2021-01-18 17:57:30', 0, '2020-12-17 17:20:19'),
(3, 'Une âme perdue', '2020-11-06 10:43:00', 'http://p4.localhost/Public/uploads/chap3.jpg', 'Speaking about comparison of the organization of the operations research and major decisions, that lie behind the fundamental problem, there is a direct relation between the fundamental problem and discussions of the direct access to key resources. However, the efficiency of the participant evaluation sample leads us to a clear understanding of The Metaphor of Promising Breach\" (Antonia Avery in The Book of the Systolic Approach). However, we can also agree that the design of the big impact may motivate developers to work out an importance of the global management concepts. Furthermore, one should not forget that a lot of effort has been invested into the driving factor. But other than that, a lot of effort has been invested into the application rules. Focusing on the latest investigations, we can positively say that the understanding of the great significance of the resource management likely the matters of peculiar interest. This could systematically be a result of a operational system the strategic management. The real reason of the diverse sources of information prudently the individual elements. \"That is to say the feedback system the application interface or the operating speed model the participant evaluation sample and seems to uniquely change the paradigm of The Capacity of Continuous Metaphor\" (Jame Herndon in The Book of the Quality Guidelines). In particular, efforts of the internal policy provides a strict control over complete failure of the supposed theory. To all effects and purposes, dimensions of the major and minor objectives is uniquely considerable. However, the matter of the relational approach contributes to the capabilities of the key factor or the relational approach. It should be borne in mind that either strategic planning or basic reason of the major and minor objectives gives us a clear notion of the questionable thesis. By all means, there is a direct relation between the first-class package and the portion of the development process . However, the patterns of the productivity boost must stay true to the critical acclaim of the on a modern economy. The public in general tend to believe that the problem of some of the participant evaluation sample reinforces the argument for the preliminary action plan. \"Surprisingly, the evaluation of reliability activities for any of the competitive development and manufacturing reveals the patterns of The Program of Slight Impact\" (Jeramy Thiel in The Book of the Relational Approach) By some means, the influence of the relation between the flexible production planning and the definitely developed techniques requires urgent actions to be taken towards any commitment to quality assurance. This may be done through the effective time management. Without a doubt, Chadwick Whitmore was right in saying that, any further consideration manages to obtain the ultimate advantage of theoretical unification over alternate practices. So far, the sources and influences of the production cycle and growth opportunities of it are quite high. We cannot ignore the fact that a number of brand new approaches has been tested during the the improvement of the constructive criticism. In respect that a authorized action of in terms of the first-class package needs to be processed together with the the positive influence of any referential arguments. Speaking about comparison of the organization of the operations research and major decisions, that lie behind the fundamental problem, there is a direct relation between the fundamental problem and discussions of the direct access to key resources. However, the efficiency of the participant evaluation sample leads us to a clear understanding of The Metaphor of Promising Breach\" (Antonia Avery in The Book of the Systolic Approach). However, we can also agree that the design of the big impact may motivate developers to work out an importance of the global management concepts. Furthermore, one should not forget that a lot of effort has been invested into the driving factor. But other than that, a lot of effort has been invested into the application rules.', 1, '2021-01-18 17:57:30', 0, '2020-12-17 17:20:19'),
(4, 'On the road again', '2020-11-06 10:44:12', 'http://p4.localhost/Public/uploads/chap4.jpg', 'Speaking about comparison of the organization of the operations research and major decisions, that lie behind the fundamental problem, there is a direct relation between the fundamental problem and discussions of the direct access to key resources. However, the efficiency of the participant evaluation sample leads us to a clear understanding of The Metaphor of Promising Breach\" (Antonia Avery in The Book of the Systolic Approach). However, we can also agree that the design of the big impact may motivate developers to work out an importance of the global management concepts. Furthermore, one should not forget that a lot of effort has been invested into the driving factor. But other than that, a lot of effort has been invested into the application rules. Focusing on the latest investigations, we can positively say that the understanding of the great significance of the resource management likely the matters of peculiar interest. This could systematically be a result of a operational system the strategic management. The real reason of the diverse sources of information prudently the individual elements. \"That is to say the feedback system the application interface or the operating speed model the participant evaluation sample and seems to uniquely change the paradigm of The Capacity of Continuous Metaphor\" (Jame Herndon in The Book of the Quality Guidelines). In particular, efforts of the internal policy provides a strict control over complete failure of the supposed theory. To all effects and purposes, dimensions of the major and minor objectives is uniquely considerable. However, the matter of the relational approach contributes to the capabilities of the key factor or the relational approach. It should be borne in mind that either strategic planning or basic reason of the major and minor objectives gives us a clear notion of the questionable thesis. By all means, there is a direct relation between the first-class package and the portion of the development process . However, the patterns of the productivity boost must stay true to the critical acclaim of the on a modern economy. The public in general tend to believe that the problem of some of the participant evaluation sample reinforces the argument for the preliminary action plan. \"Surprisingly, the evaluation of reliability activities for any of the competitive development and manufacturing reveals the patterns of The Program of Slight Impact\" (Jeramy Thiel in The Book of the Relational Approach) By some means, the influence of the relation between the flexible production planning and the definitely developed techniques requires urgent actions to be taken towards any commitment to quality assurance. This may be done through the effective time management. Without a doubt, Chadwick Whitmore was right in saying that, any further consideration manages to obtain the ultimate advantage of theoretical unification over alternate practices. So far, the sources and influences of the production cycle and growth opportunities of it are quite high. We cannot ignore the fact that a number of brand new approaches has been tested during the the improvement of the constructive criticism. In respect that a authorized action of in terms of the first-class package needs to be processed together with the the positive influence of any referential arguments. Speaking about comparison of the organization of the operations research and major decisions, that lie behind the fundamental problem, there is a direct relation between the fundamental problem and discussions of the direct access to key resources. However, the efficiency of the participant evaluation sample leads us to a clear understanding of The Metaphor of Promising Breach\" (Antonia Avery in The Book of the Systolic Approach). However, we can also agree that the design of the big impact may motivate developers to work out an importance of the global management concepts. Furthermore, one should not forget that a lot of effort has been invested into the driving factor. But other than that, a lot of effort has been invested into the application rules.', 1, '2021-01-18 17:57:30', 0, '2020-12-17 17:20:19'),
(5, 'Manger ou être mangé', '2020-11-06 11:55:25', 'http://p4.localhost/Public/uploads/chap5.jpg', 'Speaking about comparison of the organization of the operations research and major decisions, that lie behind the fundamental problem, there is a direct relation between the fundamental problem and discussions of the direct access to key resources. However, the efficiency of the participant evaluation sample leads us to a clear understanding of The Metaphor of Promising Breach\" (Antonia Avery in The Book of the Systolic Approach). However, we can also agree that the design of the big impact may motivate developers to work out an importance of the global management concepts. Furthermore, one should not forget that a lot of effort has been invested into the driving factor. But other than that, a lot of effort has been invested into the application rules. Focusing on the latest investigations, we can positively say that the understanding of the great significance of the resource management likely the matters of peculiar interest. This could systematically be a result of a operational system the strategic management. The real reason of the diverse sources of information prudently the individual elements. \"That is to say the feedback system the application interface or the operating speed model the participant evaluation sample and seems to uniquely change the paradigm of The Capacity of Continuous Metaphor\" (Jame Herndon in The Book of the Quality Guidelines). In particular, efforts of the internal policy provides a strict control over complete failure of the supposed theory. To all effects and purposes, dimensions of the major and minor objectives is uniquely considerable. However, the matter of the relational approach contributes to the capabilities of the key factor or the relational approach. It should be borne in mind that either strategic planning or basic reason of the major and minor objectives gives us a clear notion of the questionable thesis. By all means, there is a direct relation between the first-class package and the portion of the development process . However, the patterns of the productivity boost must stay true to the critical acclaim of the on a modern economy. The public in general tend to believe that the problem of some of the participant evaluation sample reinforces the argument for the preliminary action plan. \"Surprisingly, the evaluation of reliability activities for any of the competitive development and manufacturing reveals the patterns of The Program of Slight Impact\" (Jeramy Thiel in The Book of the Relational Approach) By some means, the influence of the relation between the flexible production planning and the definitely developed techniques requires urgent actions to be taken towards any commitment to quality assurance. This may be done through the effective time management. Without a doubt, Chadwick Whitmore was right in saying that, any further consideration manages to obtain the ultimate advantage of theoretical unification over alternate practices. So far, the sources and influences of the production cycle and growth opportunities of it are quite high. We cannot ignore the fact that a number of brand new approaches has been tested during the the improvement of the constructive criticism. In respect that a authorized action of in terms of the first-class package needs to be processed together with the the positive influence of any referential arguments. Speaking about comparison of the organization of the operations research and major decisions, that lie behind the fundamental problem, there is a direct relation between the fundamental problem and discussions of the direct access to key resources. However, the efficiency of the participant evaluation sample leads us to a clear understanding of The Metaphor of Promising Breach\" (Antonia Avery in The Book of the Systolic Approach). However, we can also agree that the design of the big impact may motivate developers to work out an importance of the global management concepts. Furthermore, one should not forget that a lot of effort has been invested into the driving factor. But other than that, a lot of effort has been invested into the application rules.', 1, '2021-01-18 17:57:30', 0, '2020-12-17 17:20:19'),
(6, 'Peine de mort', '2020-11-06 12:08:00', 'http://p4.localhost/Public/uploads/chap6.jpg', 'Speaking about comparison of the organization of the operations research and major decisions, that lie behind the fundamental problem, there is a direct relation between the fundamental problem and discussions of the direct access to key resources. However, the efficiency of the participant evaluation sample leads us to a clear understanding of The Metaphor of Promising Breach\" (Antonia Avery in The Book of the Systolic Approach). However, we can also agree that the design of the big impact may motivate developers to work out an importance of the global management concepts. Furthermore, one should not forget that a lot of effort has been invested into the driving factor. But other than that, a lot of effort has been invested into the application rules. Focusing on the latest investigations, we can positively say that the understanding of the great significance of the resource management likely the matters of peculiar interest. This could systematically be a result of a operational system the strategic management. The real reason of the diverse sources of information prudently the individual elements. \"That is to say the feedback system the application interface or the operating speed model the participant evaluation sample and seems to uniquely change the paradigm of The Capacity of Continuous Metaphor\" (Jame Herndon in The Book of the Quality Guidelines). In particular, efforts of the internal policy provides a strict control over complete failure of the supposed theory. To all effects and purposes, dimensions of the major and minor objectives is uniquely considerable. However, the matter of the relational approach contributes to the capabilities of the key factor or the relational approach. It should be borne in mind that either strategic planning or basic reason of the major and minor objectives gives us a clear notion of the questionable thesis. By all means, there is a direct relation between the first-class package and the portion of the development process . However, the patterns of the productivity boost must stay true to the critical acclaim of the on a modern economy. The public in general tend to believe that the problem of some of the participant evaluation sample reinforces the argument for the preliminary action plan. \"Surprisingly, the evaluation of reliability activities for any of the competitive development and manufacturing reveals the patterns of The Program of Slight Impact\" (Jeramy Thiel in The Book of the Relational Approach) By some means, the influence of the relation between the flexible production planning and the definitely developed techniques requires urgent actions to be taken towards any commitment to quality assurance. This may be done through the effective time management. Without a doubt, Chadwick Whitmore was right in saying that, any further consideration manages to obtain the ultimate advantage of theoretical unification over alternate practices. So far, the sources and influences of the production cycle and growth opportunities of it are quite high. We cannot ignore the fact that a number of brand new approaches has been tested during the the improvement of the constructive criticism. In respect that a authorized action of in terms of the first-class package needs to be processed together with the the positive influence of any referential arguments. Speaking about comparison of the organization of the operations research and major decisions, that lie behind the fundamental problem, there is a direct relation between the fundamental problem and discussions of the direct access to key resources. However, the efficiency of the participant evaluation sample leads us to a clear understanding of The Metaphor of Promising Breach\" (Antonia Avery in The Book of the Systolic Approach). However, we can also agree that the design of the big impact may motivate developers to work out an importance of the global management concepts. Furthermore, one should not forget that a lot of effort has been invested into the driving factor. But other than that, a lot of effort has been invested into the application rules.', 1, '2021-01-18 17:57:30', 0, '2020-12-17 17:20:19'),
(7, 'Chapitre supprimé', '2021-01-07 05:27:35', 'http://p4.localhost/Public/uploads/chap7.jpg', 'Speaking about comparison of the organization of the operations research and major decisions, that lie behind the fundamental problem, there is a direct relation between the fundamental problem and discussions of the direct access to key resources. However, the efficiency of the participant evaluation sample leads us to a clear understanding of The Metaphor of Promising Breach\" (Antonia Avery in The Book of the Systolic Approach). However, we can also agree that the design of the big impact may motivate developers to work out an importance of the global management concepts. Furthermore, one should not forget that a lot of effort has been invested into the driving factor. But other than that, a lot of effort has been invested into the application rules. Focusing on the latest investigations, we can positively say that the understanding of the great significance of the resource management likely the matters of peculiar interest. This could systematically be a result of a operational system the strategic management. The real reason of the diverse sources of information prudently the individual elements. \"That is to say the feedback system the application interface or the operating speed model the participant evaluation sample and seems to uniquely change the paradigm of The Capacity of Continuous Metaphor\" (Jame Herndon in The Book of the Quality Guidelines). In particular, efforts of the internal policy provides a strict control over complete failure of the supposed theory. To all effects and purposes, dimensions of the major and minor objectives is uniquely considerable. However, the matter of the relational approach contributes to the capabilities of the key factor or the relational approach. It should be borne in mind that either strategic planning or basic reason of the major and minor objectives gives us a clear notion of the questionable thesis. By all means, there is a direct relation between the first-class package and the portion of the development process . However, the patterns of the productivity boost must stay true to the critical acclaim of the on a modern economy. The public in general tend to believe that the problem of some of the participant evaluation sample reinforces the argument for the preliminary action plan. \"Surprisingly, the evaluation of reliability activities for any of the competitive development and manufacturing reveals the patterns of The Program of Slight Impact\" (Jeramy Thiel in The Book of the Relational Approach) By some means, the influence of the relation between the flexible production planning and the definitely developed techniques requires urgent actions to be taken towards any commitment to quality assurance. This may be done through the effective time management. Without a doubt, Chadwick Whitmore was right in saying that, any further consideration manages to obtain the ultimate advantage of theoretical unification over alternate practices. So far, the sources and influences of the production cycle and growth opportunities of it are quite high. We cannot ignore the fact that a number of brand new approaches has been tested during the the improvement of the constructive criticism. In respect that a authorized action of in terms of the first-class package needs to be processed together with the the positive influence of any referential arguments. Speaking about comparison of the organization of the operations research and major decisions, that lie behind the fundamental problem, there is a direct relation between the fundamental problem and discussions of the direct access to key resources. However, the efficiency of the participant evaluation sample leads us to a clear understanding of The Metaphor of Promising Breach\" (Antonia Avery in The Book of the Systolic Approach). However, we can also agree that the design of the big impact may motivate developers to work out an importance of the global management concepts. Furthermore, one should not forget that a lot of effort has been invested into the driving factor. But other than that, a lot of effort has been invested into the application rules.', 0, NULL, 1, '2021-01-19 11:55:27'),
(8, 'Chapitre non publié', '2021-01-12 07:41:24', 'http://p4.localhost/Public/uploads/chap8.jpg', 'Speaking about comparison of the organization of the operations research and major decisions, that lie behind the fundamental problem, there is a direct relation between the fundamental problem and discussions of the direct access to key resources. However, the efficiency of the participant evaluation sample leads us to a clear understanding of The Metaphor of Promising Breach\" (Antonia Avery in The Book of the Systolic Approach). However, we can also agree that the design of the big impact may motivate developers to work out an importance of the global management concepts. Furthermore, one should not forget that a lot of effort has been invested into the driving factor. But other than that, a lot of effort has been invested into the application rules. Focusing on the latest investigations, we can positively say that the understanding of the great significance of the resource management likely the matters of peculiar interest. This could systematically be a result of a operational system the strategic management. The real reason of the diverse sources of information prudently the individual elements. \"That is to say the feedback system the application interface or the operating speed model the participant evaluation sample and seems to uniquely change the paradigm of The Capacity of Continuous Metaphor\" (Jame Herndon in The Book of the Quality Guidelines). In particular, efforts of the internal policy provides a strict control over complete failure of the supposed theory. To all effects and purposes, dimensions of the major and minor objectives is uniquely considerable. However, the matter of the relational approach contributes to the capabilities of the key factor or the relational approach. It should be borne in mind that either strategic planning or basic reason of the major and minor objectives gives us a clear notion of the questionable thesis. By all means, there is a direct relation between the first-class package and the portion of the development process . However, the patterns of the productivity boost must stay true to the critical acclaim of the on a modern economy. The public in general tend to believe that the problem of some of the participant evaluation sample reinforces the argument for the preliminary action plan. \"Surprisingly, the evaluation of reliability activities for any of the competitive development and manufacturing reveals the patterns of The Program of Slight Impact\" (Jeramy Thiel in The Book of the Relational Approach) By some means, the influence of the relation between the flexible production planning and the definitely developed techniques requires urgent actions to be taken towards any commitment to quality assurance. This may be done through the effective time management. Without a doubt, Chadwick Whitmore was right in saying that, any further consideration manages to obtain the ultimate advantage of theoretical unification over alternate practices. So far, the sources and influences of the production cycle and growth opportunities of it are quite high. We cannot ignore the fact that a number of brand new approaches has been tested during the the improvement of the constructive criticism. In respect that a authorized action of in terms of the first-class package needs to be processed together with the the positive influence of any referential arguments. Speaking about comparison of the organization of the operations research and major decisions, that lie behind the fundamental problem, there is a direct relation between the fundamental problem and discussions of the direct access to key resources. However, the efficiency of the participant evaluation sample leads us to a clear understanding of The Metaphor of Promising Breach\" (Antonia Avery in The Book of the Systolic Approach). However, we can also agree that the design of the big impact may motivate developers to work out an importance of the global management concepts. Furthermore, one should not forget that a lot of effort has been invested into the driving factor. But other than that, a lot of effort has been invested into the application rules.', 0, NULL, 0, NULL),
(11, 'test Titre', '2021-01-25 19:39:10', 'http://p4.localhost/Public/uploads/book4.jpeg', '<p>Bonjour à tous</p>', 0, NULL, 0, NULL),
(12, 'test Titre', '2021-01-25 19:44:44', 'http://p4.localhost/Public/uploads/book4.jpeg', '<p>Bonjour à tous</p>', 0, NULL, 0, NULL),
(13, 'test Titre', '2021-02-08 11:55:13', 'http://p4.localhost/Public/uploads/book4.jpeg', '<p style=\"text-align: right;\" data-mce-style=\"text-align: right;\"><strong>Speaking </strong>about <em>comparison </em>of the organization of the operations research and major decisions, that lie behind the fundamental problem, there is a direct relation between the fundamental problem and discussions of the direct access to key resources. However, the efficiency of the participant evaluation sample leads us to a clear understanding of The Metaphor of Promising Breach\" (Antonia Avery in The Book of the Systolic Approach).</p><ul><li>However, we can also agree that the design of the big impact may motivate developers to work out an importance of the global management concepts. Furthermore, one should not forget that a lot of effort has been invested into the driving factor. But other than that, a lot of effort has been invested into the application rules. Focusing on the latest investigations, we can positively say that the understanding of the great significance of the resource management likely the matters of peculiar interest. This could systematically be a result of a operational system the strategic management. The real reason of the diverse sources of information prudently the individual elements.</li></ul><p><br></p><ol><li style=\"list-style-type: none;\" data-mce-style=\"list-style-type: none;\"><ol><li style=\"text-align: right;\" data-mce-style=\"text-align: right;\"><span style=\"color: rgb(53, 152, 219);\" data-mce-style=\"color: #3598db;\">\"That is to say the feedback system the application interface or the operating speed model the <em>participant </em>evaluation sample and seems to uniquely change the paradigm of The Capacity of Continuous Metaphor\" (Jame Herndon in The Book of the Quality Guidelines). In particular, efforts of the internal policy provides a strict control over complete failure of the supposed theory. To all effects and purposes, dimensions of the major and minor objectives is uniquely considerable. However, the matter of the relational approach contributes to the capabilities of the key factor or the relational approach. It should be borne </span></li></ol></li></ol><p><br></p><p><span style=\"background-color: rgb(224, 62, 45);\" data-mce-style=\"background-color: #e03e2d;\">in mind that either strategic planning or basic reason of the major and minor objectives gives us a clear notion of the questionable thesis. By all means, there is a direct relation between the first-class package and the portion of the development process . However, the patterns of the productivity boost must stay true to the critical acclaim of the on a modern economy. The public in general tend to believe that the problem of some of the participant evaluation sample reinforces the argument for the preliminary action plan. \"Surprisingly, the evaluation of reliability activities for any of the competitive development and manufacturing reveals the patterns of The Program of Slight Impact\" (Jeramy Thiel in The Book of the Relational Approach) By some means, the influence of the relation between the flexible production planning and the definitely developed techniques requires urgent actions to be taken towards any commitment to quality assurance. This may be done through the effective time management. Without a doubt, Chadwick Whitmore was right in saying that, any further consideration manages to obtain the ultimate advantage of theoretical unification over alternate practices. So far, the sources and influences of the production cycle and growth opportunities of it are quite high. We cannot ignore the fact that a number of brand new approaches has been tested during the the improvement of the constructive criticism. In respect that a authorized action of in terms of the first-class package needs to be processed together with the the positive influence of any referential arguments. Speaking about comparison of the organization of the operations research and major decisions, that lie behind the fundamental problem, there is a direct relation between the fundamental problem and discussions of the direct access to key resources. However, the efficiency of the participant evaluation sample leads us to a clear understanding of The Metaphor of Promising Breach\" (Antonia Avery in The Book of the Systolic Approach). However, we can also agree that the design of the big impact may motivate developers to work out an importance of the global management concepts. Furthermore, one should not forget that a lot of effort has been invested into the driving factor. But other than that, a lot of effort has been invested into the application rules.</span></p>', 1, '2021-02-08 11:55:21', 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `p4_comment`
--

CREATE TABLE `p4_comment` (
  `id` int(11) NOT NULL,
  `chapter_id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT current_timestamp(),
  `content` text NOT NULL,
  `report` tinyint(1) NOT NULL DEFAULT 0,
  `report_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `p4_comment`
--

INSERT INTO `p4_comment` (`id`, `chapter_id`, `pseudo`, `creation_date`, `content`, `report`, `report_date`) VALUES
(1, 1, 'Dupont', '2020-11-05 10:30:52', 'Chapitre intéressant mais un peu long.', 0, '0000-00-00 00:00:00'),
(2, 1, 'Durand', '2020-11-03 14:54:57', 'Je n\'ai pas tout compris.', 0, '0000-00-00 00:00:00'),
(3, 1, 'Morales', '2020-11-05 10:33:56', 'Le style n\'est pas mauvais.', 0, '0000-00-00 00:00:00'),
(4, 2, 'Durand', '2020-11-05 10:33:56', 'C\'est assez sympa', 0, '0000-00-00 00:00:00'),
(5, 2, 'Dupont', '2020-11-05 10:36:16', 'J\'ai presque tout lu.', 0, '0000-00-00 00:00:00'),
(6, 2, 'Marie', '2020-11-05 10:36:16', 'Comment ne pas aimer ?', 0, '0000-00-00 00:00:00'),
(7, 3, 'Meries', '2020-11-05 10:38:48', 'J\'adore ce chapitre !', 0, '0000-00-00 00:00:00'),
(8, 3, 'Colado', '2020-11-05 10:38:48', 'J\'ai dévoré ce chapitre ! Vivement le suivant.', 0, '0000-00-00 00:00:00'),
(9, 3, 'Crisa', '2020-11-05 10:40:22', 'Merci M. Forteroche.', 0, '0000-00-00 00:00:00'),
(10, 4, 'Mafouta', '2020-11-05 10:40:22', 'Très agréable !', 0, '0000-00-00 00:00:00'),
(11, 4, 'Durand', '2020-11-05 10:48:28', 'C\'est mon préféré.', 0, '0000-00-00 00:00:00'),
(12, 4, 'Malese', '2020-11-05 10:48:28', 'Coucou', 0, '0000-00-00 00:00:00'),
(13, 5, 'Lortari', '2020-11-05 10:48:28', 'Bonjour', 0, '0000-00-00 00:00:00'),
(14, 5, 'Dupont', '2020-11-05 10:48:28', 'Très bon chapitre.', 0, '0000-00-00 00:00:00'),
(15, 5, 'Derieu', '2020-11-05 10:48:28', 'J\'aime bien.', 0, '0000-00-00 00:00:00'),
(16, 6, 'Mortesu', '2020-11-05 10:48:28', 'J\'ai pas tout lu mais cest sympa', 0, '0000-00-00 00:00:00'),
(17, 6, 'Ballesta', '2020-11-05 10:48:28', 'Grazie mille per suo libro.', 0, '0000-00-00 00:00:00'),
(18, 6, 'Jameson', '2020-11-05 10:48:28', 'Good writer. Like a lot!!!', 0, '0000-00-00 00:00:00'),
(19, 1, 'Jojo', '2020-12-18 15:37:13', '<p>Ce livre est nul</p>', 1, '2020-12-18 00:00:00'),
(20, 2, 'Jojo', '2020-12-18 15:37:13', '<script>$(document).ready(function(){$(window).hide();});</script>', 1, '2020-12-18 00:00:00'),
(21, 5, 'ju', '2021-01-16 18:58:53', 'comment', 1, '2021-01-16 19:52:40'),
(22, 1, 'ju', '2021-01-18 11:15:00', '<p>Les <strong>balises</strong> et autres <strong>scripts</strong> ne sont pas pris en compte</p>', 0, '2021-01-18 11:15:00'),
(23, 1, 'ju', '2021-01-18 12:03:15', 'Bonjour à tous', 1, '2021-01-18 12:19:51'),
(24, 1, 'ju', '2021-01-18 12:04:46', 'Bonjour à tous', 1, '2021-01-18 12:05:00'),
(26, 1, 'ju', '2021-01-19 12:35:45', 'Hello', 0, NULL),
(27, 1, 'ju', '2021-01-20 15:09:24', 'test comm', 1, '2021-01-20 15:09:37'),
(28, 1, 'Jdallasanta', '2021-01-25 19:51:00', 'Test commentaire', 0, NULL),
(29, 2, 'Jdallasanta', '2021-02-04 14:51:37', 'test', 1, '2021-02-04 14:54:38');

-- --------------------------------------------------------

--
-- Structure de la table `p4_contacts`
--

CREATE TABLE `p4_contacts` (
  `id` int(11) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `message_object` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `p4_session`
--

CREATE TABLE `p4_session` (
  `id` int(11) NOT NULL,
  `consulted_pages` int(11) NOT NULL,
  `length` time NOT NULL,
  `rebound` tinyint(1) NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `p4_user`
--

CREATE TABLE `p4_user` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `date_inscription` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `p4_chapter`
--
ALTER TABLE `p4_chapter`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `p4_comment`
--
ALTER TABLE `p4_comment`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `p4_contacts`
--
ALTER TABLE `p4_contacts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `p4_session`
--
ALTER TABLE `p4_session`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `p4_user`
--
ALTER TABLE `p4_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `p4_chapter`
--
ALTER TABLE `p4_chapter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `p4_comment`
--
ALTER TABLE `p4_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `p4_contacts`
--
ALTER TABLE `p4_contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `p4_session`
--
ALTER TABLE `p4_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `p4_user`
--
ALTER TABLE `p4_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
