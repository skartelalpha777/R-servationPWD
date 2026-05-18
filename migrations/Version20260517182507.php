<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260517182507 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE representation ADD representation_show_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE representation ADD CONSTRAINT FK_29D5499EC1324B99 FOREIGN KEY (representation_show_id) REFERENCES `show` (id)');
        $this->addSql('CREATE INDEX IDX_29D5499EC1324B99 ON representation (representation_show_id)');
        $this->addSql('ALTER TABLE `show` ADD location_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `show` ADD CONSTRAINT FK_320ED90164D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('CREATE INDEX IDX_320ED90164D218E ON `show` (location_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE representation DROP FOREIGN KEY FK_29D5499EC1324B99');
        $this->addSql('DROP INDEX IDX_29D5499EC1324B99 ON representation');
        $this->addSql('ALTER TABLE representation DROP representation_show_id');
        $this->addSql('ALTER TABLE `show` DROP FOREIGN KEY FK_320ED90164D218E');
        $this->addSql('DROP INDEX IDX_320ED90164D218E ON `show`');
        $this->addSql('ALTER TABLE `show` DROP location_id');
    }
}
