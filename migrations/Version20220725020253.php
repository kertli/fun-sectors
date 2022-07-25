<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220725101053 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE person (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(125) NOT NULL, tos BOOLEAN NOT NULL)');
        $this->addSql('CREATE TABLE person_sector (person_id INTEGER NOT NULL, sector_id INTEGER NOT NULL, PRIMARY KEY(person_id, sector_id))');
        $this->addSql('CREATE INDEX IDX_D706E95E217BBB47 ON person_sector (person_id)');
        $this->addSql('CREATE INDEX IDX_D706E95EDE95C867 ON person_sector (sector_id)');
        $this->addSql('CREATE TABLE sector (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, parent_id INTEGER DEFAULT NULL, name VARCHAR(125) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_4BA3D9E8727ACA70 ON sector (parent_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE person');
        $this->addSql('DROP TABLE person_sector');
        $this->addSql('DROP TABLE sector');
    }
}
