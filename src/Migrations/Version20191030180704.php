<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191030180704 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE balance_operation (id UUID NOT NULL, client_id UUID DEFAULT NULL, amount DOUBLE PRECISION NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D2CB955019EB6921 ON balance_operation (client_id)');
        $this->addSql('COMMENT ON COLUMN balance_operation.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN balance_operation.client_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN balance_operation.amount IS \'(DC2Type:money)\'');
        $this->addSql('ALTER TABLE balance_operation ADD CONSTRAINT FK_D2CB955019EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE balance_operation');
    }
}
