<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180703091814 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE table_event ADD place_id INT NOT NULL');
        $this->addSql('ALTER TABLE table_event ADD CONSTRAINT FK_3752C7DFDA6A219 FOREIGN KEY (place_id) REFERENCES place (id)');
        $this->addSql('CREATE INDEX IDX_3752C7DFDA6A219 ON table_event (place_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE table_event DROP FOREIGN KEY FK_3752C7DFDA6A219');
        $this->addSql('DROP INDEX IDX_3752C7DFDA6A219 ON table_event');
        $this->addSql('ALTER TABLE table_event DROP place_id');
    }
}
