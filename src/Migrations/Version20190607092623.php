<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190607092623 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE wars_battles DROP FOREIGN KEY FK_AA0CD1E444E3088F');
        $this->addSql('ALTER TABLE wars_battles DROP FOREIGN KEY FK_AA0CD1E451C308FD');
        $this->addSql('ALTER TABLE wars_battles DROP FOREIGN KEY FK_AA0CD1E4D36C5D3D');
        $this->addSql('ALTER TABLE wars_battles DROP FOREIGN KEY FK_AA0CD1E4F0F058FB');
        $this->addSql('DROP INDEX IDX_AA0CD1E451C308FD ON wars_battles');
        $this->addSql('DROP INDEX IDX_AA0CD1E444E3088F ON wars_battles');
        $this->addSql('DROP INDEX IDX_AA0CD1E4D36C5D3D ON wars_battles');
        $this->addSql('DROP INDEX IDX_AA0CD1E4F0F058FB ON wars_battles');
        $this->addSql('ALTER TABLE wars_battles ADD war_id INT NOT NULL, ADD country_attacker_id INT NOT NULL, ADD country_defender_id INT NOT NULL, ADD country_winner_id INT NOT NULL, DROP war_id_id, DROP country_attacker_id_id, DROP country_defender_id_id, DROP country_winner_id_id');
        $this->addSql('ALTER TABLE wars_battles ADD CONSTRAINT FK_AA0CD1E45B81B612 FOREIGN KEY (war_id) REFERENCES wars (id)');
        $this->addSql('ALTER TABLE wars_battles ADD CONSTRAINT FK_AA0CD1E4706FE028 FOREIGN KEY (country_attacker_id) REFERENCES countries (id)');
        $this->addSql('ALTER TABLE wars_battles ADD CONSTRAINT FK_AA0CD1E45FA911A4 FOREIGN KEY (country_defender_id) REFERENCES countries (id)');
        $this->addSql('ALTER TABLE wars_battles ADD CONSTRAINT FK_AA0CD1E4E81FD1D8 FOREIGN KEY (country_winner_id) REFERENCES countries (id)');
        $this->addSql('CREATE INDEX IDX_AA0CD1E45B81B612 ON wars_battles (war_id)');
        $this->addSql('CREATE INDEX IDX_AA0CD1E4706FE028 ON wars_battles (country_attacker_id)');
        $this->addSql('CREATE INDEX IDX_AA0CD1E45FA911A4 ON wars_battles (country_defender_id)');
        $this->addSql('CREATE INDEX IDX_AA0CD1E4E81FD1D8 ON wars_battles (country_winner_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE wars_battles DROP FOREIGN KEY FK_AA0CD1E45B81B612');
        $this->addSql('ALTER TABLE wars_battles DROP FOREIGN KEY FK_AA0CD1E4706FE028');
        $this->addSql('ALTER TABLE wars_battles DROP FOREIGN KEY FK_AA0CD1E45FA911A4');
        $this->addSql('ALTER TABLE wars_battles DROP FOREIGN KEY FK_AA0CD1E4E81FD1D8');
        $this->addSql('DROP INDEX IDX_AA0CD1E45B81B612 ON wars_battles');
        $this->addSql('DROP INDEX IDX_AA0CD1E4706FE028 ON wars_battles');
        $this->addSql('DROP INDEX IDX_AA0CD1E45FA911A4 ON wars_battles');
        $this->addSql('DROP INDEX IDX_AA0CD1E4E81FD1D8 ON wars_battles');
        $this->addSql('ALTER TABLE wars_battles ADD war_id_id INT NOT NULL, ADD country_attacker_id_id INT NOT NULL, ADD country_defender_id_id INT NOT NULL, ADD country_winner_id_id INT NOT NULL, DROP war_id, DROP country_attacker_id, DROP country_defender_id, DROP country_winner_id');
        $this->addSql('ALTER TABLE wars_battles ADD CONSTRAINT FK_AA0CD1E444E3088F FOREIGN KEY (country_defender_id_id) REFERENCES countries (id)');
        $this->addSql('ALTER TABLE wars_battles ADD CONSTRAINT FK_AA0CD1E451C308FD FOREIGN KEY (war_id_id) REFERENCES wars (id)');
        $this->addSql('ALTER TABLE wars_battles ADD CONSTRAINT FK_AA0CD1E4D36C5D3D FOREIGN KEY (country_attacker_id_id) REFERENCES countries (id)');
        $this->addSql('ALTER TABLE wars_battles ADD CONSTRAINT FK_AA0CD1E4F0F058FB FOREIGN KEY (country_winner_id_id) REFERENCES countries (id)');
        $this->addSql('CREATE INDEX IDX_AA0CD1E451C308FD ON wars_battles (war_id_id)');
        $this->addSql('CREATE INDEX IDX_AA0CD1E444E3088F ON wars_battles (country_defender_id_id)');
        $this->addSql('CREATE INDEX IDX_AA0CD1E4D36C5D3D ON wars_battles (country_attacker_id_id)');
        $this->addSql('CREATE INDEX IDX_AA0CD1E4F0F058FB ON wars_battles (country_winner_id_id)');
    }
}
