<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200416154917 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE coches (id INT AUTO_INCREMENT NOT NULL, marca VARCHAR(255) NOT NULL, modelo VARCHAR(255) NOT NULL, observaciones LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reparaciones (id INT AUTO_INCREMENT NOT NULL, coche_id INT NOT NULL, tipo_reparacion VARCHAR(150) NOT NULL, realizacion LONGTEXT NOT NULL, observaciones LONGTEXT DEFAULT NULL, INDEX IDX_60AF46EF4621E56 (coche_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, nombre_completo VARCHAR(100) NOT NULL, dni VARCHAR(9) NOT NULL, correo VARCHAR(100) NOT NULL, contrasenya VARCHAR(15) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario_coches (usuario_id INT NOT NULL, coches_id INT NOT NULL, INDEX IDX_6003A2D3DB38439E (usuario_id), INDEX IDX_6003A2D3658D2BFA (coches_id), PRIMARY KEY(usuario_id, coches_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reparaciones ADD CONSTRAINT FK_60AF46EF4621E56 FOREIGN KEY (coche_id) REFERENCES coches (id)');
        $this->addSql('ALTER TABLE usuario_coches ADD CONSTRAINT FK_6003A2D3DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE usuario_coches ADD CONSTRAINT FK_6003A2D3658D2BFA FOREIGN KEY (coches_id) REFERENCES coches (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE reparaciones DROP FOREIGN KEY FK_60AF46EF4621E56');
        $this->addSql('ALTER TABLE usuario_coches DROP FOREIGN KEY FK_6003A2D3658D2BFA');
        $this->addSql('ALTER TABLE usuario_coches DROP FOREIGN KEY FK_6003A2D3DB38439E');
        $this->addSql('DROP TABLE coches');
        $this->addSql('DROP TABLE reparaciones');
        $this->addSql('DROP TABLE usuario');
        $this->addSql('DROP TABLE usuario_coches');
    }
}
