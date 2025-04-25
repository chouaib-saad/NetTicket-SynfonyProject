<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250423082237 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE caissier (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, numero_caisse INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, quantite INT NOT NULL, prix DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE produit_ticket (produit_id INT NOT NULL, ticket_id INT NOT NULL, INDEX IDX_60F26699F347EFB (produit_id), INDEX IDX_60F26699700047D2 (ticket_id), PRIMARY KEY(produit_id, ticket_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE ticket (id INT AUTO_INCREMENT NOT NULL, caissier_id INT DEFAULT NULL, numero_ticket VARCHAR(50) NOT NULL, date DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', montant_total DOUBLE PRECISION NOT NULL, INDEX IDX_97A0ADA3B514973B (caissier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE ticket_produit (ticket_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_2569B575700047D2 (ticket_id), INDEX IDX_2569B575F347EFB (produit_id), PRIMARY KEY(ticket_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE produit_ticket ADD CONSTRAINT FK_60F26699F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE produit_ticket ADD CONSTRAINT FK_60F26699700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3B514973B FOREIGN KEY (caissier_id) REFERENCES caissier (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ticket_produit ADD CONSTRAINT FK_2569B575700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ticket_produit ADD CONSTRAINT FK_2569B575F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE produit_ticket DROP FOREIGN KEY FK_60F26699F347EFB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE produit_ticket DROP FOREIGN KEY FK_60F26699700047D2
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3B514973B
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ticket_produit DROP FOREIGN KEY FK_2569B575700047D2
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ticket_produit DROP FOREIGN KEY FK_2569B575F347EFB
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE caissier
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE produit
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE produit_ticket
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE ticket
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE ticket_produit
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}
