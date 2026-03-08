<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260308190903 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__todo AS SELECT id, title, status, createdat, updatedai, todo_list_id FROM todo');
        $this->addSql('DROP TABLE todo');
        $this->addSql('CREATE TABLE todo (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, status INTEGER NOT NULL, createdat DATETIME NOT NULL, updatedat DATETIME NOT NULL, todo_list_id INTEGER NOT NULL, CONSTRAINT FK_5A0EB6A0E8A7DCFA FOREIGN KEY (todo_list_id) REFERENCES todo_list (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO todo (id, title, status, createdat, updatedat, todo_list_id) SELECT id, title, status, createdat, updatedai, todo_list_id FROM __temp__todo');
        $this->addSql('DROP TABLE __temp__todo');
        $this->addSql('CREATE INDEX IDX_5A0EB6A0E8A7DCFA ON todo (todo_list_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__todo_list AS SELECT id, title, createdat, updatedai FROM todo_list');
        $this->addSql('DROP TABLE todo_list');
        $this->addSql('CREATE TABLE todo_list (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, createdat DATETIME NOT NULL, updatedat DATETIME NOT NULL, CONSTRAINT FK_1B199E07BF396750 FOREIGN KEY (id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO todo_list (id, title, createdat, updatedat) SELECT id, title, createdat, updatedai FROM __temp__todo_list');
        $this->addSql('DROP TABLE __temp__todo_list');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, email, username, createdat, updatedai FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, createdat DATETIME NOT NULL, updatedat DATETIME NOT NULL)');
        $this->addSql('INSERT INTO user (id, email, username, createdat, updatedat) SELECT id, email, username, createdat, updatedai FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__todo AS SELECT id, title, status, createdat, updatedat, todo_list_id FROM todo');
        $this->addSql('DROP TABLE todo');
        $this->addSql('CREATE TABLE todo (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, status INTEGER NOT NULL, createdat DATETIME NOT NULL, updatedai DATETIME NOT NULL, todo_list_id INTEGER NOT NULL, CONSTRAINT FK_5A0EB6A0E8A7DCFA FOREIGN KEY (todo_list_id) REFERENCES todo_list (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO todo (id, title, status, createdat, updatedai, todo_list_id) SELECT id, title, status, createdat, updatedat, todo_list_id FROM __temp__todo');
        $this->addSql('DROP TABLE __temp__todo');
        $this->addSql('CREATE INDEX IDX_5A0EB6A0E8A7DCFA ON todo (todo_list_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__todo_list AS SELECT id, title, createdat, updatedat FROM todo_list');
        $this->addSql('DROP TABLE todo_list');
        $this->addSql('CREATE TABLE todo_list (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, createdat DATETIME NOT NULL, updatedai DATETIME NOT NULL, CONSTRAINT FK_1B199E07BF396750 FOREIGN KEY (id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO todo_list (id, title, createdat, updatedai) SELECT id, title, createdat, updatedat FROM __temp__todo_list');
        $this->addSql('DROP TABLE __temp__todo_list');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, email, username, createdat, updatedat FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, createdat DATETIME NOT NULL, updatedai DATETIME NOT NULL)');
        $this->addSql('INSERT INTO user (id, email, username, createdat, updatedai) SELECT id, email, username, createdat, updatedat FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
    }
}
