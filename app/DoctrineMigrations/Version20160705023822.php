<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160705023822 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE areas ADD date_liberation DATE DEFAULT NULL, ADD date_social_action DATE DEFAULT NULL, ADD sense_cadastral enum(\'yes\',\'no\',\'partial\'), ADD date_sense_cadastral DATE DEFAULT NULL, ADD sketches enum(\'yes\',\'no\',\'partial\'), ADD date_sketches DATE DEFAULT NULL, ADD design enum(\'yes\',\'no\',\'partial\'), ADD date_design DATE DEFAULT NULL, ADD creating_rgi enum(\'yes\',\'no\',\'partial\'), ADD date_creating_rgi DATE DEFAULT NULL, ADD low_signs enum(\'yes\',\'no\',\'partial\'), ADD date_low_signs DATE DEFAULT NULL, ADD date_prevision_start_project DATE DEFAULT NULL, ADD date_prevision_end_project DATE DEFAULT NULL, ADD filed_documentation enum(\'yes\',\'no\',\'partial\'), CHANGE ugr ugr enum(\'santana\',\'freguesia\',\'pirituba\',\'extremo norte\',\'bragantina\')');
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

        $this->addSql('ALTER TABLE areas DROP date_liberation, DROP date_social_action, DROP sense_cadastral, DROP date_sense_cadastral, DROP sketches, DROP date_sketches, DROP design, DROP date_design, DROP creating_rgi, DROP date_creating_rgi, DROP low_signs, DROP date_low_signs, DROP date_prevision_start_project, DROP date_prevision_end_project, DROP filed_documentation, CHANGE ugr ugr VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE parameters CHANGE type type VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE public_places CHANGE type_public_place type_public_place VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE type_bed type_bed VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE type_ride type_ride VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci');
    }
}
