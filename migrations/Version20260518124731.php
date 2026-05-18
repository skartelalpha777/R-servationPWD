<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260518124731 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation ADD total_price DOUBLE PRECISION NOT NULL, ADD quantity INT NOT NULL, ADD representation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495546CE82F4 FOREIGN KEY (representation_id) REFERENCES representation (id)');
        $this->addSql('CREATE INDEX IDX_42C8495546CE82F4 ON reservation (representation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495546CE82F4');
        $this->addSql('DROP INDEX IDX_42C8495546CE82F4 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP total_price, DROP quantity, DROP representation_id');
    }
}
