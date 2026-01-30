<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260130143340 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__personne AS SELECT id, batiment_id, prenom FROM personne');
        $this->addSql('DROP TABLE personne');
        $this->addSql('CREATE TABLE personne (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, batiment_id INTEGER DEFAULT NULL, prenom VARCHAR(255) NOT NULL, CONSTRAINT FK_FCEC9EFD6F6891B FOREIGN KEY (batiment_id) REFERENCES batiment (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO personne (id, batiment_id, prenom) SELECT id, batiment_id, prenom FROM __temp__personne');
        $this->addSql('DROP TABLE __temp__personne');
        $this->addSql('CREATE INDEX IDX_FCEC9EFD6F6891B ON personne (batiment_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__personne AS SELECT id, batiment_id, prenom FROM personne');
        $this->addSql('DROP TABLE personne');
        $this->addSql('CREATE TABLE personne (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, batiment_id INTEGER NOT NULL, prenom VARCHAR(255) NOT NULL, CONSTRAINT FK_FCEC9EFD6F6891B FOREIGN KEY (batiment_id) REFERENCES batiment (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO personne (id, batiment_id, prenom) SELECT id, batiment_id, prenom FROM __temp__personne');
        $this->addSql('DROP TABLE __temp__personne');
        $this->addSql('CREATE INDEX IDX_FCEC9EFD6F6891B ON personne (batiment_id)');
    }
}
