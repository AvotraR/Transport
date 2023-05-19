<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230501140854 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE filtre');
        $this->addSql('ALTER TABLE billet DROP FOREIGN KEY FK_1F034AF6AE02FE4B');
        $this->addSql('ALTER TABLE billet DROP FOREIGN KEY FK_1F034AF6816C6140');
        $this->addSql('ALTER TABLE billet DROP FOREIGN KEY FK_1F034AF6BCF5E72D');
        $this->addSql('DROP INDEX IDX_1F034AF6AE02FE4B ON billet');
        $this->addSql('DROP INDEX IDX_1F034AF6816C6140 ON billet');
        $this->addSql('DROP INDEX IDX_1F034AF6BCF5E72D ON billet');
        $this->addSql('ALTER TABLE billet DROP destination_id, DROP categorie_id, DROP depart_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE filtre (id INT AUTO_INCREMENT NOT NULL, heure TIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE billet ADD destination_id INT DEFAULT NULL, ADD categorie_id INT DEFAULT NULL, ADD depart_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE billet ADD CONSTRAINT FK_1F034AF6AE02FE4B FOREIGN KEY (depart_id) REFERENCES depart (id)');
        $this->addSql('ALTER TABLE billet ADD CONSTRAINT FK_1F034AF6816C6140 FOREIGN KEY (destination_id) REFERENCES destination (id)');
        $this->addSql('ALTER TABLE billet ADD CONSTRAINT FK_1F034AF6BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_1F034AF6AE02FE4B ON billet (depart_id)');
        $this->addSql('CREATE INDEX IDX_1F034AF6816C6140 ON billet (destination_id)');
        $this->addSql('CREATE INDEX IDX_1F034AF6BCF5E72D ON billet (categorie_id)');
    }
}
