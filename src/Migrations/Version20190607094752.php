<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190607094752 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE neighbours ADD country_1_id INT NOT NULL, ADD country_2_id INT NOT NULL, DROP id_country_1, DROP id_country_2');
        $this->addSql('ALTER TABLE neighbours ADD CONSTRAINT FK_59CA8EA377E0D71E FOREIGN KEY (country_1_id) REFERENCES countries (id)');
        $this->addSql('ALTER TABLE neighbours ADD CONSTRAINT FK_59CA8EA3655578F0 FOREIGN KEY (country_2_id) REFERENCES countries (id)');
        $this->addSql('CREATE INDEX IDX_59CA8EA377E0D71E ON neighbours (country_1_id)');
        $this->addSql('CREATE INDEX IDX_59CA8EA3655578F0 ON neighbours (country_2_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE neighbours DROP FOREIGN KEY FK_59CA8EA377E0D71E');
        $this->addSql('ALTER TABLE neighbours DROP FOREIGN KEY FK_59CA8EA3655578F0');
        $this->addSql('DROP INDEX IDX_59CA8EA377E0D71E ON neighbours');
        $this->addSql('DROP INDEX IDX_59CA8EA3655578F0 ON neighbours');
        $this->addSql('ALTER TABLE neighbours ADD id_country_1 INT NOT NULL, ADD id_country_2 INT NOT NULL, DROP country_1_id, DROP country_2_id');
    }
}
