<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230430143334 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE voiture_billet');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE voiture_billet (voiture_id INT NOT NULL, billet_id INT NOT NULL, INDEX IDX_3CF780EC44973C78 (billet_id), INDEX IDX_3CF780EC181A8BA (voiture_id), PRIMARY KEY(voiture_id, billet_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE voiture_billet ADD CONSTRAINT FK_3CF780EC181A8BA FOREIGN KEY (voiture_id) REFERENCES voiture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voiture_billet ADD CONSTRAINT FK_3CF780EC44973C78 FOREIGN KEY (billet_id) REFERENCES billet (id) ON DELETE CASCADE');
    }
}
