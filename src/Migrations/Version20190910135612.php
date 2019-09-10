<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190910135612 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE brand (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, name_ru VARCHAR(255) DEFAULT NULL, alias VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE content CHANGE parent parent INT NOT NULL, CHANGE sort sort INT NOT NULL, CHANGE show_in_left_menu show_in_left_menu TINYINT(1) NOT NULL, CHANGE sun_uslugi_menu sun_uslugi_menu INT NOT NULL, CHANGE price price VARCHAR(11) NOT NULL, CHANGE rating_value rating_value DOUBLE PRECISION DEFAULT \'4.6\' NOT NULL');
        $this->addSql('ALTER TABLE dob_xml CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE faq CHANGE enable enable TINYINT(1) NOT NULL, CHANGE count_views count_views INT NOT NULL, CHANGE count_like count_like INT NOT NULL, CHANGE count_dislike count_dislike INT NOT NULL');
        $this->addSql('ALTER TABLE naschiraboty CHANGE sort sort INT NOT NULL');
        $this->addSql('ALTER TABLE news CHANGE count_views count_views INT NOT NULL, CHANGE count_like count_like INT NOT NULL, CHANGE count_dislike count_dislike INT NOT NULL, CHANGE data data VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE sales CHANGE sort sort INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE brand');
        $this->addSql('ALTER TABLE content CHANGE parent parent INT DEFAULT 0 NOT NULL, CHANGE sort sort INT DEFAULT 0 NOT NULL, CHANGE show_in_left_menu show_in_left_menu TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE sun_uslugi_menu sun_uslugi_menu INT DEFAULT 0 NOT NULL, CHANGE price price VARCHAR(11) DEFAULT \'0\' NOT NULL COLLATE utf8_general_ci, CHANGE rating_value rating_value DOUBLE PRECISION UNSIGNED DEFAULT \'4.6\' NOT NULL');
        $this->addSql('ALTER TABLE dob_xml CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE faq CHANGE enable enable TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE count_views count_views INT DEFAULT 0 NOT NULL, CHANGE count_like count_like INT DEFAULT 0 NOT NULL, CHANGE count_dislike count_dislike INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE naschiraboty CHANGE sort sort INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE news CHANGE count_views count_views INT DEFAULT 0 NOT NULL, CHANGE count_like count_like INT DEFAULT 0 NOT NULL, CHANGE count_dislike count_dislike INT DEFAULT 0 NOT NULL, CHANGE data data VARCHAR(255) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE sales CHANGE sort sort INT DEFAULT 0 NOT NULL');
    }
}
