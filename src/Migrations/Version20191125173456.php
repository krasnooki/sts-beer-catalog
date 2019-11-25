<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191125173456 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE beer_entity (id INT AUTO_INCREMENT NOT NULL, brewer_id INT NOT NULL, name VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, country_code VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, price_per_litre NUMERIC(10, 0) NOT NULL, INDEX IDX_C6077FB2BCA4F952 (brewer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE brewer_entity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_E4ABCF45E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE beer_entity ADD CONSTRAINT FK_C6077FB2BCA4F952 FOREIGN KEY (brewer_id) REFERENCES brewer_entity (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE beer_entity DROP FOREIGN KEY FK_C6077FB2BCA4F952');
        $this->addSql('DROP TABLE beer_entity');
        $this->addSql('DROP TABLE brewer_entity');
    }
}
