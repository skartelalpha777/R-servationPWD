<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260531142534 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artis_type (id INT AUTO_INCREMENT NOT NULL, artist_id INT DEFAULT NULL, type_id INT DEFAULT NULL, INDEX IDX_AFA1D577B7970CF8 (artist_id), INDEX IDX_AFA1D577C54C8C93 (type_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE artis_type_show (id INT AUTO_INCREMENT NOT NULL, artist_type_id INT DEFAULT NULL, the_show_id INT DEFAULT NULL, INDEX IDX_C4764B1F7203D2A4 (artist_type_id), INDEX IDX_C4764B1F3013D282 (the_show_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE locality (id INT AUTO_INCREMENT NOT NULL, postalcode VARCHAR(60) NOT NULL, locality VARCHAR(60) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE artis_type ADD CONSTRAINT FK_AFA1D577B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id)');
        $this->addSql('ALTER TABLE artis_type ADD CONSTRAINT FK_AFA1D577C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE artis_type_show ADD CONSTRAINT FK_C4764B1F7203D2A4 FOREIGN KEY (artist_type_id) REFERENCES artis_type (id)');
        $this->addSql('ALTER TABLE artis_type_show ADD CONSTRAINT FK_C4764B1F3013D282 FOREIGN KEY (the_show_id) REFERENCES `show` (id)');
        $this->addSql('ALTER TABLE location ADD locality_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB88823A92 FOREIGN KEY (locality_id) REFERENCES locality (id)');
        $this->addSql('CREATE INDEX IDX_5E9E89CB88823A92 ON location (locality_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artis_type DROP FOREIGN KEY FK_AFA1D577B7970CF8');
        $this->addSql('ALTER TABLE artis_type DROP FOREIGN KEY FK_AFA1D577C54C8C93');
        $this->addSql('ALTER TABLE artis_type_show DROP FOREIGN KEY FK_C4764B1F7203D2A4');
        $this->addSql('ALTER TABLE artis_type_show DROP FOREIGN KEY FK_C4764B1F3013D282');
        $this->addSql('DROP TABLE artis_type');
        $this->addSql('DROP TABLE artis_type_show');
        $this->addSql('DROP TABLE locality');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CB88823A92');
        $this->addSql('DROP INDEX IDX_5E9E89CB88823A92 ON location');
        $this->addSql('ALTER TABLE location DROP locality_id');
    }
}
