<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230430145344 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE billet_voiture (billet_id INT NOT NULL, voiture_id INT NOT NULL, INDEX IDX_20F1257544973C78 (billet_id), INDEX IDX_20F12575181A8BA (voiture_id), PRIMARY KEY(billet_id, voiture_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE billet_voiture ADD CONSTRAINT FK_20F1257544973C78 FOREIGN KEY (billet_id) REFERENCES billet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE billet_voiture ADD CONSTRAINT FK_20F12575181A8BA FOREIGN KEY (voiture_id) REFERENCES voiture (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE billet_voiture');
    }
}
