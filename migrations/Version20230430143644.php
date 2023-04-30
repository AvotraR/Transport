<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230430143644 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE billet ADD voiture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE billet ADD CONSTRAINT FK_1F034AF6181A8BA FOREIGN KEY (voiture_id) REFERENCES voiture (id)');
        $this->addSql('CREATE INDEX IDX_1F034AF6181A8BA ON billet (voiture_id)');
        $this->addSql('ALTER TABLE voiture ADD billet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810F44973C78 FOREIGN KEY (billet_id) REFERENCES billet (id)');
        $this->addSql('CREATE INDEX IDX_E9E2810F44973C78 ON voiture (billet_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE billet DROP FOREIGN KEY FK_1F034AF6181A8BA');
        $this->addSql('DROP INDEX IDX_1F034AF6181A8BA ON billet');
        $this->addSql('ALTER TABLE billet DROP voiture_id');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810F44973C78');
        $this->addSql('DROP INDEX IDX_E9E2810F44973C78 ON voiture');
        $this->addSql('ALTER TABLE voiture DROP billet_id');
    }
}
