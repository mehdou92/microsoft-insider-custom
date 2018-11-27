<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181126215729 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE label_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE issue_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE notation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE comment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE faq_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE label (id INT NOT NULL, title VARCHAR(30) NOT NULL, color VARCHAR(7) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE issue (id INT NOT NULL, title VARCHAR(100) NOT NULL, body TEXT NOT NULL, active BOOLEAN NOT NULL, type BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, nickname VARCHAR(20) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE notation (id INT NOT NULL, number INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE comment (id INT NOT NULL, body VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE faq (id INT NOT NULL, question VARCHAR(100) NOT NULL, answer TEXT NOT NULL, active BOOLEAN NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE label_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE issue_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE notation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE comment_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE faq_id_seq CASCADE');
        $this->addSql('DROP TABLE label');
        $this->addSql('DROP TABLE issue');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE notation');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE faq');
    }
}
