<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230306213753 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE depart DROP FOREIGN KEY FK_1B3EBB08944722F2');
        $this->addSql('DROP INDEX IDX_1B3EBB08944722F2 ON depart');
        $this->addSql('ALTER TABLE depart DROP prix_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE depart ADD prix_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE depart ADD CONSTRAINT FK_1B3EBB08944722F2 FOREIGN KEY (prix_id) REFERENCES prix (id)');
        $this->addSql('CREATE INDEX IDX_1B3EBB08944722F2 ON depart (prix_id)');
    }
}
