<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181127101113 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE label_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE issue_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE role_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_account_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE comment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE faq_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE label (id INT NOT NULL, title VARCHAR(30) NOT NULL, color VARCHAR(7) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE label_issue (label_id INT NOT NULL, issue_id INT NOT NULL, PRIMARY KEY(label_id, issue_id))');
        $this->addSql('CREATE INDEX IDX_80B3953033B92F39 ON label_issue (label_id)');
        $this->addSql('CREATE INDEX IDX_80B395305E7AA58C ON label_issue (issue_id)');
        $this->addSql('CREATE TABLE issue (id INT NOT NULL, author_id INT NOT NULL, title VARCHAR(100) NOT NULL, body TEXT NOT NULL, active BOOLEAN NOT NULL, type BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_12AD233EF675F31B ON issue (author_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, role_id INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, nickname VARCHAR(20) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8D93D649D60322AC ON "user" (role_id)');
        $this->addSql('CREATE TABLE role (id INT NOT NULL, title VARCHAR(100) NOT NULL, admin BOOLEAN NOT NULL, color VARCHAR(7) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE user_account (id INT NOT NULL, issue_id INT DEFAULT NULL, author_id INT NOT NULL, number INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_253B48AE5E7AA58C ON user_account (issue_id)');
        $this->addSql('CREATE INDEX IDX_253B48AEF675F31B ON user_account (author_id)');
        $this->addSql('CREATE TABLE comment (id INT NOT NULL, autor_id INT NOT NULL, issue_id INT NOT NULL, body VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9474526C14D45BBE ON comment (autor_id)');
        $this->addSql('CREATE INDEX IDX_9474526C5E7AA58C ON comment (issue_id)');
        $this->addSql('CREATE TABLE faq (id INT NOT NULL, question VARCHAR(100) NOT NULL, answer TEXT NOT NULL, active BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE label_issue ADD CONSTRAINT FK_80B3953033B92F39 FOREIGN KEY (label_id) REFERENCES label (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE label_issue ADD CONSTRAINT FK_80B395305E7AA58C FOREIGN KEY (issue_id) REFERENCES issue (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE issue ADD CONSTRAINT FK_12AD233EF675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D649D60322AC FOREIGN KEY (role_id) REFERENCES role (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_account ADD CONSTRAINT FK_253B48AE5E7AA58C FOREIGN KEY (issue_id) REFERENCES issue (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_account ADD CONSTRAINT FK_253B48AEF675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C14D45BBE FOREIGN KEY (autor_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C5E7AA58C FOREIGN KEY (issue_id) REFERENCES issue (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE label_issue DROP CONSTRAINT FK_80B3953033B92F39');
        $this->addSql('ALTER TABLE label_issue DROP CONSTRAINT FK_80B395305E7AA58C');
        $this->addSql('ALTER TABLE user_account DROP CONSTRAINT FK_253B48AE5E7AA58C');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526C5E7AA58C');
        $this->addSql('ALTER TABLE issue DROP CONSTRAINT FK_12AD233EF675F31B');
        $this->addSql('ALTER TABLE user_account DROP CONSTRAINT FK_253B48AEF675F31B');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526C14D45BBE');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D649D60322AC');
        $this->addSql('DROP SEQUENCE label_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE issue_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE role_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_account_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE comment_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE faq_id_seq CASCADE');
        $this->addSql('DROP TABLE label');
        $this->addSql('DROP TABLE label_issue');
        $this->addSql('DROP TABLE issue');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE user_account');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE faq');
    }
}
