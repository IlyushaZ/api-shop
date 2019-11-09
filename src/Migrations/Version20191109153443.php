<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191109153443 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE cart_item (id UUID NOT NULL, unit_id UUID DEFAULT NULL, client_id UUID DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, is_removed BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F0FE2527F8BD700D ON cart_item (unit_id)');
        $this->addSql('CREATE INDEX IDX_F0FE252719EB6921 ON cart_item (client_id)');
        $this->addSql('COMMENT ON COLUMN cart_item.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN cart_item.unit_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN cart_item.client_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN cart_item.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE unit_operation (id UUID NOT NULL, unit_id UUID DEFAULT NULL, client_id UUID DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7F56AEFF8BD700D ON unit_operation (unit_id)');
        $this->addSql('CREATE INDEX IDX_7F56AEF19EB6921 ON unit_operation (client_id)');
        $this->addSql('COMMENT ON COLUMN unit_operation.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN unit_operation.unit_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN unit_operation.client_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN unit_operation.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE cart_item ADD CONSTRAINT FK_F0FE2527F8BD700D FOREIGN KEY (unit_id) REFERENCES unit_of_product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cart_item ADD CONSTRAINT FK_F0FE252719EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE unit_operation ADD CONSTRAINT FK_7F56AEFF8BD700D FOREIGN KEY (unit_id) REFERENCES unit_of_product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE unit_operation ADD CONSTRAINT FK_7F56AEF19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE cart_item');
        $this->addSql('DROP TABLE unit_operation');
    }
}
