<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230331110322 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE billet (id INT AUTO_INCREMENT NOT NULL, destination_id INT DEFAULT NULL, categorie_id INT DEFAULT NULL, depart_id INT DEFAULT NULL, voiture_id INT DEFAULT NULL, date_reservation DATETIME NOT NULL, nom VARCHAR(20) NOT NULL, prenom VARCHAR(20) NOT NULL, telephone INT NOT NULL, cin INT NOT NULL, prix INT NOT NULL, INDEX IDX_1F034AF6816C6140 (destination_id), INDEX IDX_1F034AF6BCF5E72D (categorie_id), INDEX IDX_1F034AF6AE02FE4B (depart_id), INDEX IDX_1F034AF6181A8BA (voiture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, categorie VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE colis (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, cin INT NOT NULL, kilo INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE depart (id INT AUTO_INCREMENT NOT NULL, ville VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE destination (id INT AUTO_INCREMENT NOT NULL, ville VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prix (id INT AUTO_INCREMENT NOT NULL, destination_id INT DEFAULT NULL, categorie_id INT DEFAULT NULL, depart_id INT DEFAULT NULL, prix INT NOT NULL, INDEX IDX_F7EFEA5E816C6140 (destination_id), INDEX IDX_F7EFEA5EBCF5E72D (categorie_id), INDEX IDX_F7EFEA5EAE02FE4B (depart_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, numero VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F55AE19E (numero), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voiture (id INT AUTO_INCREMENT NOT NULL, destination_id INT DEFAULT NULL, categorie_id INT DEFAULT NULL, numero VARCHAR(10) NOT NULL, place LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', nb_place INT NOT NULL, INDEX IDX_E9E2810F816C6140 (destination_id), INDEX IDX_E9E2810FBCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE billet ADD CONSTRAINT FK_1F034AF6816C6140 FOREIGN KEY (destination_id) REFERENCES destination (id)');
        $this->addSql('ALTER TABLE billet ADD CONSTRAINT FK_1F034AF6BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE billet ADD CONSTRAINT FK_1F034AF6AE02FE4B FOREIGN KEY (depart_id) REFERENCES depart (id)');
        $this->addSql('ALTER TABLE billet ADD CONSTRAINT FK_1F034AF6181A8BA FOREIGN KEY (voiture_id) REFERENCES voiture (id)');
        $this->addSql('ALTER TABLE prix ADD CONSTRAINT FK_F7EFEA5E816C6140 FOREIGN KEY (destination_id) REFERENCES destination (id)');
        $this->addSql('ALTER TABLE prix ADD CONSTRAINT FK_F7EFEA5EBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE prix ADD CONSTRAINT FK_F7EFEA5EAE02FE4B FOREIGN KEY (depart_id) REFERENCES depart (id)');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810F816C6140 FOREIGN KEY (destination_id) REFERENCES destination (id)');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810FBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE billet DROP FOREIGN KEY FK_1F034AF6BCF5E72D');
        $this->addSql('ALTER TABLE prix DROP FOREIGN KEY FK_F7EFEA5EBCF5E72D');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810FBCF5E72D');
        $this->addSql('ALTER TABLE billet DROP FOREIGN KEY FK_1F034AF6AE02FE4B');
        $this->addSql('ALTER TABLE prix DROP FOREIGN KEY FK_F7EFEA5EAE02FE4B');
        $this->addSql('ALTER TABLE billet DROP FOREIGN KEY FK_1F034AF6816C6140');
        $this->addSql('ALTER TABLE prix DROP FOREIGN KEY FK_F7EFEA5E816C6140');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810F816C6140');
        $this->addSql('ALTER TABLE billet DROP FOREIGN KEY FK_1F034AF6181A8BA');
        $this->addSql('DROP TABLE billet');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE colis');
        $this->addSql('DROP TABLE depart');
        $this->addSql('DROP TABLE destination');
        $this->addSql('DROP TABLE prix');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE voiture');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
