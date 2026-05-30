<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260526210201 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE representation_reservation ADD reservation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE representation_reservation ADD CONSTRAINT FK_A3F4FD36B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('CREATE INDEX IDX_A3F4FD36B83297E7 ON representation_reservation (reservation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE representation_reservation DROP FOREIGN KEY FK_A3F4FD36B83297E7');
        $this->addSql('DROP INDEX IDX_A3F4FD36B83297E7 ON representation_reservation');
        $this->addSql('ALTER TABLE representation_reservation DROP reservation_id');
    }
}
