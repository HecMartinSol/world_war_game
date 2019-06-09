<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190609154028 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE countries_wars (id INT AUTO_INCREMENT NOT NULL, country_id INT NOT NULL, war_id INT NOT NULL, conquerer_id INT NOT NULL, INDEX IDX_DD1FA452F92F3E70 (country_id), INDEX IDX_DD1FA4525B81B612 (war_id), INDEX IDX_DD1FA452BDF32548 (conquerer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE countries_wars ADD CONSTRAINT FK_DD1FA452F92F3E70 FOREIGN KEY (country_id) REFERENCES countries (id)');
        $this->addSql('ALTER TABLE countries_wars ADD CONSTRAINT FK_DD1FA4525B81B612 FOREIGN KEY (war_id) REFERENCES wars (id)');
        $this->addSql('ALTER TABLE countries_wars ADD CONSTRAINT FK_DD1FA452BDF32548 FOREIGN KEY (conquerer_id) REFERENCES countries (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE countries_wars');
    }
}
