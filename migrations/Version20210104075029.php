<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210104075029 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE football_game ADD handle BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_22F2A159918020D9 ON football_game (handle)');
        $this->addSql('ALTER TABLE location ADD handle BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5E9E89CB918020D9 ON location (handle)');
        $this->addSql('ALTER TABLE user ADD handle BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649918020D9 ON user (handle)');
        $this->addSql('ALTER TABLE venue ADD handle BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_91911B0D918020D9 ON venue (handle)');
        $this->addSql('ALTER TABLE venue_details ADD handle BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C2EEFC54918020D9 ON venue_details (handle)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_22F2A159918020D9 ON football_game');
        $this->addSql('ALTER TABLE football_game DROP handle');
        $this->addSql('DROP INDEX UNIQ_5E9E89CB918020D9 ON location');
        $this->addSql('ALTER TABLE location DROP handle');
        $this->addSql('DROP INDEX UNIQ_8D93D649918020D9 ON user');
        $this->addSql('ALTER TABLE user DROP handle');
        $this->addSql('DROP INDEX UNIQ_91911B0D918020D9 ON venue');
        $this->addSql('ALTER TABLE venue DROP handle');
        $this->addSql('DROP INDEX UNIQ_C2EEFC54918020D9 ON venue_details');
        $this->addSql('ALTER TABLE venue_details DROP handle');
    }
}
