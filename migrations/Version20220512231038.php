<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220512231038 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tasks RENAME INDEX developer_id TO IDX_5058659764DD9267');
        $this->addSql('ALTER TABLE tasks RENAME INDEX client_id TO IDX_5058659719EB6921');
        $this->addSql('ALTER TABLE users CHANGE email email VARCHAR(180) NOT NULL, CHANGE bank_acc bank_acc VARCHAR(255) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON users (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tasks RENAME INDEX idx_5058659719eb6921 TO client_id');
        $this->addSql('ALTER TABLE tasks RENAME INDEX idx_5058659764dd9267 TO developer_id');
        $this->addSql('DROP INDEX UNIQ_1483A5E9E7927C74 ON users');
        $this->addSql('ALTER TABLE users CHANGE email email VARCHAR(255) NOT NULL, CHANGE bank_acc bank_acc VARCHAR(20) DEFAULT NULL');
    }
}
