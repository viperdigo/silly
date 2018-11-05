<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160705014832 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE material_public_places (id INT AUTO_INCREMENT NOT NULL, fk_material INT DEFAULT NULL, fk_customer INT DEFAULT NULL, quantity NUMERIC(10, 2) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_FE50BB7E4E96364B (fk_material), INDEX IDX_FE50BB7EB311CDD7 (fk_customer), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE material_public_places ADD CONSTRAINT FK_FE50BB7E4E96364B FOREIGN KEY (fk_material) REFERENCES materials (id)');
        $this->addSql('ALTER TABLE material_public_places ADD CONSTRAINT FK_FE50BB7EB311CDD7 FOREIGN KEY (fk_customer) REFERENCES public_places (id)');
        $this->addSql('ALTER TABLE areas CHANGE ugr ugr enum(\'santana\',\'freguesia\',\'pirituba\',\'extremo norte\',\'bragantina\')');
        $this->addSql('ALTER TABLE parameters CHANGE type type enum(\'ndays\',\'email\',\'day\',\'month\',\'year\',\'value\')');
        $this->addSql('ALTER TABLE public_places CHANGE type_public_place type_public_place enum(\'aeroporto\',\'avenida\',\'rua\',\'parque\',\'estrada\',\'jardim\',\'viela\',\'travessa\'), CHANGE type_bed type_bed enum(\'asphalt\',\'land\',\'cemented\',\'blocks\',\'parallelepiped\',\'others\',\'miracema\',\'special\'), CHANGE type_ride type_ride enum(\'asphalt\',\'land\',\'cemented\',\'blocks\',\'parallelepiped\',\'others\',\'miracema\',\'special\')');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE material_public_places');
        $this->addSql('ALTER TABLE areas CHANGE ugr ugr VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE parameters CHANGE type type VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE public_places CHANGE type_public_place type_public_place VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE type_bed type_bed VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE type_ride type_ride VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci');
    }
}
