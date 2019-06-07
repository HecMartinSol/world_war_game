<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190607092339 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE wars_battles (id INT AUTO_INCREMENT NOT NULL, war_id_id INT NOT NULL, country_attacker_id_id INT NOT NULL, country_defender_id_id INT NOT NULL, country_winner_id_id INT NOT NULL, points INT NOT NULL, battle_date DATETIME NOT NULL, INDEX IDX_AA0CD1E451C308FD (war_id_id), INDEX IDX_AA0CD1E4D36C5D3D (country_attacker_id_id), INDEX IDX_AA0CD1E444E3088F (country_defender_id_id), INDEX IDX_AA0CD1E4F0F058FB (country_winner_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE wars_battles ADD CONSTRAINT FK_AA0CD1E451C308FD FOREIGN KEY (war_id_id) REFERENCES wars (id)');
        $this->addSql('ALTER TABLE wars_battles ADD CONSTRAINT FK_AA0CD1E4D36C5D3D FOREIGN KEY (country_attacker_id_id) REFERENCES countries (id)');
        $this->addSql('ALTER TABLE wars_battles ADD CONSTRAINT FK_AA0CD1E444E3088F FOREIGN KEY (country_defender_id_id) REFERENCES countries (id)');
        $this->addSql('ALTER TABLE wars_battles ADD CONSTRAINT FK_AA0CD1E4F0F058FB FOREIGN KEY (country_winner_id_id) REFERENCES countries (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE wars_battles');
    }
}
