<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230430110059 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE filtre (id INT AUTO_INCREMENT NOT NULL, heure TIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voiture_billet (voiture_id INT NOT NULL, billet_id INT NOT NULL, INDEX IDX_3CF780EC181A8BA (voiture_id), INDEX IDX_3CF780EC44973C78 (billet_id), PRIMARY KEY(voiture_id, billet_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE voiture_billet ADD CONSTRAINT FK_3CF780EC181A8BA FOREIGN KEY (voiture_id) REFERENCES voiture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voiture_billet ADD CONSTRAINT FK_3CF780EC44973C78 FOREIGN KEY (billet_id) REFERENCES billet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE billet DROP FOREIGN KEY FK_1F034AF6181A8BA');
        $this->addSql('DROP INDEX IDX_1F034AF6181A8BA ON billet');
        $this->addSql('ALTER TABLE billet DROP voiture_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE filtre');
        $this->addSql('DROP TABLE voiture_billet');
        $this->addSql('ALTER TABLE billet ADD voiture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE billet ADD CONSTRAINT FK_1F034AF6181A8BA FOREIGN KEY (voiture_id) REFERENCES voiture (id)');
        $this->addSql('CREATE INDEX IDX_1F034AF6181A8BA ON billet (voiture_id)');
    }
}
