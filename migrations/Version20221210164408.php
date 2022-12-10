<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221210164408 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE inventory (id INT AUTO_INCREMENT NOT NULL, point_vente_id INT NOT NULL, produit_id INT NOT NULL, visite_id INT NOT NULL, date_visite DATE NOT NULL, total INT NOT NULL, in_stock INT NOT NULL, sold INT NOT NULL, INDEX IDX_B12D4A36EFA24D68 (point_vente_id), INDEX IDX_B12D4A36F347EFB (produit_id), INDEX IDX_B12D4A36C1C5DC59 (visite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visite (id INT AUTO_INCREMENT NOT NULL, point_vente_id INT NOT NULL, date_visite DATE NOT NULL, INDEX IDX_B09C8CBBEFA24D68 (point_vente_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE inventory ADD CONSTRAINT FK_B12D4A36EFA24D68 FOREIGN KEY (point_vente_id) REFERENCES point_vente (id)');
        $this->addSql('ALTER TABLE inventory ADD CONSTRAINT FK_B12D4A36F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE inventory ADD CONSTRAINT FK_B12D4A36C1C5DC59 FOREIGN KEY (visite_id) REFERENCES visite (id)');
        $this->addSql('ALTER TABLE visite ADD CONSTRAINT FK_B09C8CBBEFA24D68 FOREIGN KEY (point_vente_id) REFERENCES point_vente (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inventory DROP FOREIGN KEY FK_B12D4A36EFA24D68');
        $this->addSql('ALTER TABLE inventory DROP FOREIGN KEY FK_B12D4A36F347EFB');
        $this->addSql('ALTER TABLE inventory DROP FOREIGN KEY FK_B12D4A36C1C5DC59');
        $this->addSql('ALTER TABLE visite DROP FOREIGN KEY FK_B09C8CBBEFA24D68');
        $this->addSql('DROP TABLE inventory');
        $this->addSql('DROP TABLE visite');
    }
}
