<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260531141026 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artist_type DROP FOREIGN KEY `FK_3060D1B6B7970CF8`');
        $this->addSql('ALTER TABLE artist_type DROP FOREIGN KEY `FK_3060D1B6C54C8C93`');
        $this->addSql('DROP TABLE artist_type');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artist_type (artist_id INT NOT NULL, type_id INT NOT NULL, INDEX IDX_3060D1B6C54C8C93 (type_id), INDEX IDX_3060D1B6B7970CF8 (artist_id), PRIMARY KEY (artist_id, type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE artist_type ADD CONSTRAINT `FK_3060D1B6B7970CF8` FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_type ADD CONSTRAINT `FK_3060D1B6C54C8C93` FOREIGN KEY (type_id) REFERENCES type (id) ON DELETE CASCADE');
    }
}
