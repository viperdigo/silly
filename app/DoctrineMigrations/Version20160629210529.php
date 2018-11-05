<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160629210529 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE areas ADD polo enum(\'vila maria\',\'santana\',\'freguesia\',\'pirituba\',\'franco da rocha\',\'braganca\',\'socorro\'), ADD `release` enum(\'yes\',\'no\',\'ploy\'), ADD property enum(\'townhall\',\'state\',\'private\',\'others\'), ADD eletric_energy enum(\'yes\',\'no\',\'partial\'), ADD garbage_collection enum(\'yes\',\'no\',\'partial\'), ADD street_lighting enum(\'yes\',\'no\',\'partial\'), ADD type_housing VARCHAR(255) DEFAULT NULL, ADD contact_leadership VARCHAR(255) DEFAULT NULL, ADD social_action TINYINT(1) DEFAULT NULL, ADD estimated_links VARCHAR(255) DEFAULT NULL, ADD accepts_retro enum(\'yes\',\'no\',\'partial\'), ADD sewer enum(\'yes\',\'no\',\'partial\'), ADD comments VARCHAR(255) DEFAULT NULL, CHANGE ugr ugr enum(\'santana\',\'freguesia\',\'pirituba\',\'extremo norte\',\'bragantina\')');
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

        $this->addSql('ALTER TABLE areas DROP polo, DROP `release`, DROP property, DROP eletric_energy, DROP garbage_collection, DROP street_lighting, DROP type_housing, DROP contact_leadership, DROP social_action, DROP estimated_links, DROP accepts_retro, DROP sewer, DROP comments, CHANGE ugr ugr VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE parameters CHANGE type type VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE public_places CHANGE type_public_place type_public_place VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE type_bed type_bed VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE type_ride type_ride VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci');
    }
}
