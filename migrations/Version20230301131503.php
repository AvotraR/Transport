<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230301131503 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE voiture (id INT AUTO_INCREMENT NOT NULL, numero VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categorie ADD voiture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD634181A8BA FOREIGN KEY (voiture_id) REFERENCES voiture (id)');
        $this->addSql('CREATE INDEX IDX_497DD634181A8BA ON categorie (voiture_id)');
        $this->addSql('ALTER TABLE destination ADD voiture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE destination ADD CONSTRAINT FK_3EC63EAA181A8BA FOREIGN KEY (voiture_id) REFERENCES voiture (id)');
        $this->addSql('CREATE INDEX IDX_3EC63EAA181A8BA ON destination (voiture_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD634181A8BA');
        $this->addSql('ALTER TABLE destination DROP FOREIGN KEY FK_3EC63EAA181A8BA');
        $this->addSql('DROP TABLE voiture');
        $this->addSql('DROP INDEX IDX_497DD634181A8BA ON categorie');
        $this->addSql('ALTER TABLE categorie DROP voiture_id');
        $this->addSql('DROP INDEX IDX_3EC63EAA181A8BA ON destination');
        $this->addSql('ALTER TABLE destination DROP voiture_id');
    }
}
