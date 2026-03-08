<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260308181553 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE recaps (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, performance CLOB DEFAULT NULL)');
        $this->addSql('CREATE TABLE todo (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, status INTEGER NOT NULL, createdat DATETIME NOT NULL, updatedai DATETIME NOT NULL, todo_list_id INTEGER NOT NULL, CONSTRAINT FK_5A0EB6A0E8A7DCFA FOREIGN KEY (todo_list_id) REFERENCES todo_list (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_5A0EB6A0E8A7DCFA ON todo (todo_list_id)');
        $this->addSql('CREATE TABLE todo_list (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, createdat DATETIME NOT NULL, updatedai DATETIME NOT NULL, CONSTRAINT FK_1B199E07BF396750 FOREIGN KEY (id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(255) NOT NULL, username VARCHAR(255) DEFAULT NULL, createdat DATETIME NOT NULL, updatedai DATETIME NOT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE recaps');
        $this->addSql('DROP TABLE todo');
        $this->addSql('DROP TABLE todo_list');
        $this->addSql('DROP TABLE user');
    }
}
