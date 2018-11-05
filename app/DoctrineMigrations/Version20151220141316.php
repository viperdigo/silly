<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151220141316 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE audit_log (id INT AUTO_INCREMENT NOT NULL, fk_user INT DEFAULT NULL, entity VARCHAR(255) NOT NULL, entity_id VARCHAR(255) NOT NULL, `values` LONGTEXT NOT NULL, user_ip VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_F6E1C0F51AD0877 (fk_user), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parameters (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, type enum(\'ndays\',\'email\',\'day\',\'month\',\'year\',\'value\'), value VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, username_canonical VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, email_canonical VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, locked TINYINT(1) NOT NULL, expired TINYINT(1) NOT NULL, expires_at DATETIME DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', credentials_expired TINYINT(1) NOT NULL, credentials_expire_at DATETIME DEFAULT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1483A5E992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_1483A5E9A0D96FBF (email_canonical), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE audit_log ADD CONSTRAINT FK_F6E1C0F51AD0877 FOREIGN KEY (fk_user) REFERENCES users (id)');

        $this->addSql('INSERT INTO users (id, username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, name) VALUES (1, \'rodrigo\', \'rodrigo\', \'viperdigo@gmail.com\', \'viperdigo@gmail.com\', 1, \'qtmp9oshrf48ck80kgk0gso84w40woo\', \'$2y$13$qtmp9oshrf48ck80kgk0gees6hHCJlQB286aP7crmBPQ0MqdhYyJa\', null, 0, 0, null, null, null, \'a:2:{i:0;s:10:"ROLE_ADMIN";i:1;s:16:"ROLE_SUPER_ADMIN";}\', 0, null, \'Rodrigo Alfieri\')');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE audit_log DROP FOREIGN KEY FK_F6E1C0F51AD0877');
        $this->addSql('DROP TABLE audit_log');
        $this->addSql('DROP TABLE parameters');
        $this->addSql('DROP TABLE users');
    }
}
