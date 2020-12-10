<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201209175026 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE football_game (id INT AUTO_INCREMENT NOT NULL, organizer INT DEFAULT NULL, venue_id INT DEFAULT NULL, created_by INT DEFAULT NULL, players_per_side INT NOT NULL, name VARCHAR(255) NOT NULL, date DATETIME NOT NULL, description LONGTEXT DEFAULT NULL, private TINYINT(1) DEFAULT \'0\' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_22F2A15999D47173 (organizer), INDEX IDX_22F2A15940A73EBA (venue_id), INDEX IDX_22F2A159DE12AB56 (created_by), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, created_by INT DEFAULT NULL, street VARCHAR(255) NOT NULL, zip_code VARCHAR(10) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(2) NOT NULL, place_id VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_5E9E89CBDA6A219 (place_id), INDEX IDX_5E9E89CBDE12AB56 (created_by), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE venue (id INT AUTO_INCREMENT NOT NULL, location_id INT DEFAULT NULL, created_by INT DEFAULT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_91911B0D64D218E (location_id), INDEX IDX_91911B0DDE12AB56 (created_by), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE football_game ADD CONSTRAINT FK_22F2A15999D47173 FOREIGN KEY (organizer) REFERENCES user (id) ON DELETE RESTRICT');
        $this->addSql('ALTER TABLE football_game ADD CONSTRAINT FK_22F2A15940A73EBA FOREIGN KEY (venue_id) REFERENCES venue (id) ON DELETE RESTRICT');
        $this->addSql('ALTER TABLE football_game ADD CONSTRAINT FK_22F2A159DE12AB56 FOREIGN KEY (created_by) REFERENCES user (id)');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CBDE12AB56 FOREIGN KEY (created_by) REFERENCES user (id)');
        $this->addSql('ALTER TABLE venue ADD CONSTRAINT FK_91911B0D64D218E FOREIGN KEY (location_id) REFERENCES location (id) ON DELETE RESTRICT');
        $this->addSql('ALTER TABLE venue ADD CONSTRAINT FK_91911B0DDE12AB56 FOREIGN KEY (created_by) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE venue DROP FOREIGN KEY FK_91911B0D64D218E');
        $this->addSql('ALTER TABLE football_game DROP FOREIGN KEY FK_22F2A15999D47173');
        $this->addSql('ALTER TABLE football_game DROP FOREIGN KEY FK_22F2A159DE12AB56');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CBDE12AB56');
        $this->addSql('ALTER TABLE venue DROP FOREIGN KEY FK_91911B0DDE12AB56');
        $this->addSql('ALTER TABLE football_game DROP FOREIGN KEY FK_22F2A15940A73EBA');
        $this->addSql('DROP TABLE football_game');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE venue');
    }
}
