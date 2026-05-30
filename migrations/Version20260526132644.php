<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260526132644 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE price (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, price NUMERIC(10, 0) NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE representation_reservation (id INT AUTO_INCREMENT NOT NULL, quantity INT NOT NULL, representation_id INT DEFAULT NULL, reservation_id INT DEFAULT NULL, price_id INT DEFAULT NULL, INDEX IDX_A3F4FD3646CE82F4 (representation_id), INDEX IDX_A3F4FD36B83297E7 (reservation_id), INDEX IDX_A3F4FD36D614C7E7 (price_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE representation_reservation ADD CONSTRAINT FK_A3F4FD3646CE82F4 FOREIGN KEY (representation_id) REFERENCES representation (id)');
        $this->addSql('ALTER TABLE representation_reservation ADD CONSTRAINT FK_A3F4FD36B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('ALTER TABLE representation_reservation ADD CONSTRAINT FK_A3F4FD36D614C7E7 FOREIGN KEY (price_id) REFERENCES price (id)');
        $this->addSql('ALTER TABLE representation ADD location_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE representation ADD CONSTRAINT FK_29D5499E64D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('CREATE INDEX IDX_29D5499E64D218E ON representation (location_id)');
        $this->addSql('ALTER TABLE reservation DROP quantity, DROP total_price');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE representation_reservation DROP FOREIGN KEY FK_A3F4FD3646CE82F4');
        $this->addSql('ALTER TABLE representation_reservation DROP FOREIGN KEY FK_A3F4FD36B83297E7');
        $this->addSql('ALTER TABLE representation_reservation DROP FOREIGN KEY FK_A3F4FD36D614C7E7');
        $this->addSql('DROP TABLE price');
        $this->addSql('DROP TABLE representation_reservation');
        $this->addSql('ALTER TABLE representation DROP FOREIGN KEY FK_29D5499E64D218E');
        $this->addSql('DROP INDEX IDX_29D5499E64D218E ON representation');
        $this->addSql('ALTER TABLE representation DROP location_id');
        $this->addSql('ALTER TABLE reservation ADD quantity INT NOT NULL, ADD total_price INT DEFAULT NULL');
    }
}
