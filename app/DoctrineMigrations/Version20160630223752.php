<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160630223752 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE materials (id INT AUTO_INCREMENT NOT NULL, type enum(\'link\',\'network\',\'sewer\'), description VARCHAR(255) DEFAULT NULL, code BIGINT DEFAULT NULL, unit VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE material_customers (id INT AUTO_INCREMENT NOT NULL, fk_material INT DEFAULT NULL, fk_customer INT DEFAULT NULL, quantity NUMERIC(2, 1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_5ACD54C14E96364B (fk_material), INDEX IDX_5ACD54C1B311CDD7 (fk_customer), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE material_customers ADD CONSTRAINT FK_5ACD54C14E96364B FOREIGN KEY (fk_material) REFERENCES materials (id)');
        $this->addSql('ALTER TABLE material_customers ADD CONSTRAINT FK_5ACD54C1B311CDD7 FOREIGN KEY (fk_customer) REFERENCES customers (id)');

        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'sewer\',\'CONCRETO ENSACADO\',174260404,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'sewer\',\'TUBO PVC RIGIDO PB JEI  COLETOR ESGOTO  DN 200mm (cm = 588m)\',76134209,\'m\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'sewer\',\'ANEL DE CONCRETO ARMADO PRÉ MOLDADO  PV/ PI 600 X 400mm\',82330645,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'sewer\',\'TAMPÃO FF MODULAR  NORMA SABESP DN 600mm (ESGOTO)\',46416006,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'link\',\'Hidrômetro Comum\',121001210,\'pç\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'link\',\'Hidrômetro Anti Imã\',121001234,\'pç\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'link\',\'Caixa Plástica c/ tampa p/ dispositivo duplo cinza\',136020501,\'pç\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'link\',\'Caixa Plástica c/ tampa p/ dispositivo simples cinza\',136020409,\'pç\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'link\',\'Dispositivo Medição duplo DN20\',136040202,\'pç\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'link\',\'Dispositivo Medição simples DN20\',136030208,\'pç\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'link\',\'Pead 20mm (ligação)\',70480205,\'m\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'link\',\'lacre arame longo p/ caixa UMA 250mm  selagem\',136073876,\'pç\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'link\',\'lacre arame curto p/ caixa UMA 250mm  corte\',136073890,\'pç\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'link\',\'Componentes e acessórios  lacre antifraude (registro) cinza\',136073888,\'pç\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'link\',\'Guarnição\',133666059,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'link\',\'UNIÃO DE PVC P/TUBO PEAD DE 20mm (1/2)\',75570208,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'link\',\'COTOVELO 90 GR FEMEA 3/4 POLX ADAPTADOR DN 32mm UM\',290550142,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'link\',\'REGISTRO MACHO DE LIGA DE COBRE P/ INSTAL PREDIAIS DN 20 (3/4)\',453010192,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'Tubo PVC 100mm (rede)\',70271203,\'m\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'Tubo PVC 75mm (rede)\',70270958,\'m\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'Tê Serviço 75 x DN20mm\',74780785,\'pç\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'Tê Serviço 100 x DN20mm\',74781005,\'pç\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'Colar Tomada PP/PVC p/ tubo PE DE32mm X DN20 (3/4) com registro\',71180321,\'pç\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'União p/ tubo PE NTS 179 DE32mm (união DE 32mm)\',75570324,\'pç\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'Pead 32mm (rede)\',70480321,\'m\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'ABRAÇADEIRA FF P/ REPARO DE TUBULAÇÕES DN 75  150mm (COMP MINIMO)\',40590070,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'COLAR DE TOMADA FF DN 75 X 20 (3/4 POL) P/FF E/OU FIBROCIM CL 20/25\',41000754,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'COLAR DE TOMADA FF DN 100 X 20 (3/4 POL) P/ FF E/OU FIBROCOM CL 20\',41001000,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'REDUÇÃO FF DUCTIL C/ PB JE 2GS 100 X 75mm \',45360261,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'TAMPÃO FF MODULAR  NORMA SABESP C/TAMPA ARTIC (T5) P/VALVULAS COM LAJE  DE CONCRETO\',46401003,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'TÊ FF DUCTIL  C/ BOLSAS JE2GS DN 80 X 80mm\',46600206,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'TÊ FF DUCTIL  C/ BOLSAS JE2GS DN 100 X 80mm\',46600280,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'TÊ FF DUCTIL  C/ BOLSAS JE2GS DN 100 X 100mm\',46600309,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'TÊ FF DUCTIL  C/ BOLSAS JE2GS DN 150 X 100mm\',46600589,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'TUBO FOFO 80mm\',40400086,\'m\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'TUBO FOFO 100mm \',40400104,\'m\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'ADAPTADOR FF P/ LIG PONTA PVC JE A BOLSA FF JC/JE/JE2GS DN 75\',70410070,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'ADAPTADOR FF P/ LIG PONTA PVC JE A BOLSA FF JC/JE/JE2GS DN 100\',70410094,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'CURVA 45 GR FF DUCTIL C/BOLSAS JE 2GS DN 80mm\',42080083,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'CURVA 45 GR FF DUCTIL C/BOLSAS JE 2GS DN 100mm\',42080101,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'CURVA 90 GR FF DUCTIL C/BOLSAS JE 2GS DN 80mm\',42400089,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'CURVA 90 GR FF DUCTIL C/BOLSAS JE 2GS DN 100mm\',42400107,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'LUVA DE CORRER PVC C/ BOLSAS JE DN 050 (DE 60mm)\',73760079,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'LUVA DE CORRER PVC C/ BOLSAS JE DN 075 (DE 85mm)\',73760110,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'LUVA DE CORRER PVC C/ BOLSAS JE DN 100 (DE 110mm)\',73760158,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'LUVA DE CORRER FF DUCTIL  C/ BOLSAS JE 2GS DN 80mm\',43870089,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'LUVA DE CORRER FF DUCTIL  C/ BOLSAS JE 2GS DN 100mm\',43870107,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'LUVA DE CORRER FF DUCTIL  C/ BOLSAS JE 2GS DN 150mm\',43870156,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'TÊ SERVIÇO INTEGRADO DN 050 P/ 32\',74780785,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'TÊ SERVIÇO INTEGRADO DN 075 P/ 32\',74780797,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'TÊ SERVIÇO INTEGRADO DN 100 P/ 32\',74781042,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'TÊ 32mm P/ 32mm\',74860367,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'CAP FF DUCTIL C/ BOLSA JE2GS DN 80MM\',40940081,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'CAP FF DUCTIL C/ BOLSA JE2GS DN 100MM\',40940100,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'COLAR DE TOMADA FF DN 75 X 25 (1 POL) P/ FF E/OU FIBROCOM CL 20/25\',41000778,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'COLAR DE TOMADA FF DN 100 X 25 (1 POL) P/ FF E/OU FIBROCOM CL 20\',41001023,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'TE PVC C/ BOLSAS JE DN 75 X 75 (DE 85 X 85mm)\',75241766,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'TE PVC C/ BOLSAS JE DN 100 X 75 (DE 110 X 85mm)\',75242126,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'TE PVC C/ BOLSAS JE DN 100 X 100 (DE 110 X 110mm)\',75242163,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'CAP FERRO FUNDIDO P/ PVC DN 75MM\',71120075,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'CAP FERRO FUNDIDO P/ PVC DN 100MM\',71120105,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'CURVA 45 GR PVC PB JE DN 75mm\',72471013,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'CURVA 45 GR PVC PB JE DN 100mm\',72471050,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'CURVA 90 GR PVC PB JE DN 75mm\',72670216,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'CURVA 90 GR PVC PB JE DN 100mm\',72670253,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'UNIÃO DE PP P/ TUBO PEAD  DE 32mm (1)  C/ EXTREMIDADE CAPEADA\',75575322,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'VALVULA GAVETA FF C/ BOLSAS JE/CAB/P/FF/ DN 080 \',456900081,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network\',\'VALVULA GAVETA FF C/ BOLSAS JE/CAB/P/FF/ DN 100\',456900100,\'un\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network \',\'TÊ DE SERVIÇO DE 60(PVC) X DE 20(RAMAL PE)  ARTICULADO\',7047800335,\'pç\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network \',\'TÊ DE SERVIÇO DE 60(PVC) X DE 32(RAMAL PE)  ARTICULADO\',7047800347,\'pç\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network \',\'TÊ DE SERVIÇO DE 75(PE) X DE 32(RAMAL PE)  ARTICULADO\',7047800797,\'pç\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network \',\'TÊ DE SERVIÇO DE 100(PE) X DE 32(RAMAL PE)  ARTICULADO\',7047801042,\'pç\',sysdate(),sysdate())');
        $this->addSql('INSERT INTO materials (type, description, code, unit, created_at, updated_at) VALUES (\'network \',\'BICA CORRIDA\',176501710,\'m3\',sysdate(),sysdate())');
        
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE material_customers DROP FOREIGN KEY FK_5ACD54C14E96364B');
        $this->addSql('DROP TABLE materials');
        $this->addSql('DROP TABLE material_customers');
    }
}
