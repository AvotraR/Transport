<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230306214538 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE billet ADD depart_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE billet ADD CONSTRAINT FK_1F034AF6AE02FE4B FOREIGN KEY (depart_id) REFERENCES depart (id)');
        $this->addSql('CREATE INDEX IDX_1F034AF6AE02FE4B ON billet (depart_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE billet DROP FOREIGN KEY FK_1F034AF6AE02FE4B');
        $this->addSql('DROP INDEX IDX_1F034AF6AE02FE4B ON billet');
        $this->addSql('ALTER TABLE billet DROP depart_id');
    }
}
