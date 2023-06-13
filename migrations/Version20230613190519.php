<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230613190519 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE place_voiture');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE place_voiture (place_id INT NOT NULL, voiture_id INT NOT NULL, INDEX IDX_DD2E96F4181A8BA (voiture_id), INDEX IDX_DD2E96F4DA6A219 (place_id), PRIMARY KEY(place_id, voiture_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE place_voiture ADD CONSTRAINT FK_DD2E96F4181A8BA FOREIGN KEY (voiture_id) REFERENCES voiture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE place_voiture ADD CONSTRAINT FK_DD2E96F4DA6A219 FOREIGN KEY (place_id) REFERENCES place (id) ON DELETE CASCADE');
    }
}
