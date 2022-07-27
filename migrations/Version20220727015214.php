<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220727015214 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE word ADD prenom VARCHAR(255) NOT NULL, ADD cin VARCHAR(55) NOT NULL, ADD adresse_associe VARCHAR(255) NOT NULL, ADD date_de_naissance DATETIME NOT NULL, ADD entreprise VARCHAR(255) NOT NULL, ADD adresse_societe VARCHAR(255) NOT NULL, ADD activite VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE word DROP prenom, DROP cin, DROP adresse_associe, DROP date_de_naissance, DROP entreprise, DROP adresse_societe, DROP activite');
    }
}
