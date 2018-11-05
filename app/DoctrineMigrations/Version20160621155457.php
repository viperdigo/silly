<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160621155457 extends AbstractMigration {
	/**
	 * @param Schema $schema
	 */
	public function up( Schema $schema ) {
		// this up() migration is auto-generated, please modify it to your needs
		$this->abortIf( $this->connection->getDatabasePlatform()->getName() != 'mysql',
			'Migration can only be executed safely on \'mysql\'.' );

		$this->addSql( 'CREATE TABLE areas (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, ugr enum(\'santana\',\'freguesia\',\'pirituba\',\'extremo norte\',\'bragantina\'), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB' );
		$this->addSql( 'CREATE TABLE customers (id INT AUTO_INCREMENT NOT NULL, fk_public_place INT DEFAULT NULL, rgi INT DEFAULT NULL, codification INT DEFAULT NULL, hydrometer VARCHAR(255) DEFAULT NULL, tl VARCHAR(255) DEFAULT NULL, service_one VARCHAR(255) DEFAULT NULL, service_two VARCHAR(255) DEFAULT NULL, social_tariff VARCHAR(255) DEFAULT NULL, expiration_social_tariff DATETIME DEFAULT NULL, number VARCHAR(255) NOT NULL, complement VARCHAR(255) DEFAULT NULL, zipcode INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, document VARCHAR(255) DEFAULT NULL, social_security VARCHAR(255) DEFAULT NULL, birthday_date DATE DEFAULT NULL, home_phone INT DEFAULT NULL, cell_phone INT DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, water_tank TINYINT(1) NOT NULL, property_relationship enum(\'owner\',\'tenant\'), time_occupation INT DEFAULT NULL, amount_mature INT DEFAULT NULL, amount_children INT DEFAULT NULL, type_economy enum(\'residential\',\'merchant\',\'industrial\',\'public\'), saving_amount INT DEFAULT NULL, branch_activity VARCHAR(255) DEFAULT NULL, date_register DATE DEFAULT NULL, date_link DATE DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_62534E21A46FEED4 (fk_public_place), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB' );
		$this->addSql( 'CREATE TABLE public_places (id INT AUTO_INCREMENT NOT NULL, fk_area INT NOT NULL, type_public_place enum(\'aeroporto\',\'avenida\',\'rua\',\'parque\',\'estrada\',\'jardim\',\'viela\'), public_place VARCHAR(255) NOT NULL, type_bed enum(\'asphalt\',\'land\',\'cemented\',\'blocks\',\'parallelepiped\',\'others\',\'miracema\',\'special\'), type_ride enum(\'asphalt\',\'land\',\'cemented\',\'blocks\',\'parallelepiped\',\'others\',\'miracema\',\'special\'), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_FE5EC3EA5BAAE356 (fk_area), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB' );
		$this->addSql( 'CREATE TABLE services (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB' );
		$this->addSql( 'ALTER TABLE customers ADD CONSTRAINT FK_62534E21A46FEED4 FOREIGN KEY (fk_public_place) REFERENCES public_places (id)' );
		$this->addSql( 'ALTER TABLE public_places ADD CONSTRAINT FK_FE5EC3EA5BAAE356 FOREIGN KEY (fk_area) REFERENCES areas (id)' );
		$this->addSql( 'ALTER TABLE parameters CHANGE type type enum(\'ndays\',\'email\',\'day\',\'month\',\'year\',\'value\')' );

		$this->addSql( 'INSERT INTO services VALUES (1,"Religação/Troca de Hidrômetro",sysdate(),sysdate())' );
		$this->addSql( 'INSERT INTO services VALUES (2,"Instalação de Cavalete e Hidrômetro",sysdate(),sysdate())' );
		$this->addSql( 'INSERT INTO services VALUES (3,"2a Ligação caixa UMA - Chumbada",sysdate(),sysdate())' );
		$this->addSql( 'INSERT INTO services VALUES (4,"Adicional de Hidrômetro",sysdate(),sysdate())' );
		$this->addSql( 'INSERT INTO services VALUES (5,"1a Ligação - Adicional de Cavalete múltiplo",sysdate(),sysdate())' );
		$this->addSql( 'INSERT INTO services VALUES (6,"Consumo zero/trocar hidro",sysdate(),sysdate())' );
		$this->addSql( 'INSERT INTO services VALUES (7,"2a Ligação - Caixa UMA - Mureta",sysdate(),sysdate())' );
		$this->addSql( 'INSERT INTO services VALUES (8,"Adicional de caixa UMA",sysdate(),sysdate())' );
		$this->addSql( 'INSERT INTO services VALUES (9,"1a Ligação - Caixa UMA - Mureta",sysdate(),sysdate())' );
	}

	/**
	 * @param Schema $schema
	 */
	public function down( Schema $schema ) {
		// this down() migration is auto-generated, please modify it to your needs
		$this->abortIf( $this->connection->getDatabasePlatform()->getName() != 'mysql',
			'Migration can only be executed safely on \'mysql\'.' );

		$this->addSql( 'ALTER TABLE public_places DROP FOREIGN KEY FK_FE5EC3EA5BAAE356' );
		$this->addSql( 'ALTER TABLE customers DROP FOREIGN KEY FK_62534E21A46FEED4' );
		$this->addSql( 'DROP TABLE areas' );
		$this->addSql( 'DROP TABLE customers' );
		$this->addSql( 'DROP TABLE public_places' );
		$this->addSql( 'DROP TABLE services' );
		$this->addSql( 'ALTER TABLE parameters CHANGE type type VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci' );

		$this->addSql( 'DELETE FROM services' );
	}
}
