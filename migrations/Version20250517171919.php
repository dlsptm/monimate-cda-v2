<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250517171919 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE "account" (id VARCHAR(255) NOT NULL, created_by_id VARCHAR(255) NOT NULL, updated_by_id VARCHAR(255) NOT NULL, is_admin BOOLEAN NOT NULL, is_shared BOOLEAN NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_7D3656A4B03A8386 ON "account" (created_by_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_7D3656A4896DBBDE ON "account" (updated_by_id)
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN "account".created_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN "account".updated_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE "account_user" (id SERIAL NOT NULL, account_id VARCHAR(255) DEFAULT NULL, member_id VARCHAR(255) NOT NULL, created_by_id VARCHAR(255) NOT NULL, updated_by_id VARCHAR(255) NOT NULL, is_admin BOOLEAN NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_10051E39B6B5FBA ON "account_user" (account_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_10051E37597D3FE ON "account_user" (member_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_10051E3B03A8386 ON "account_user" (created_by_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_10051E3896DBBDE ON "account_user" (updated_by_id)
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN "account_user".created_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN "account_user".updated_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE "category" (id VARCHAR(255) NOT NULL, icon VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE "goal" (id VARCHAR(255) NOT NULL, created_by_id VARCHAR(255) NOT NULL, updated_by_id VARCHAR(255) NOT NULL, amount BIGINT NOT NULL, deadline DATE NOT NULL, title VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_FCDCEB2EB03A8386 ON "goal" (created_by_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_FCDCEB2E896DBBDE ON "goal" (updated_by_id)
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN "goal".created_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN "goal".updated_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE "income" (id VARCHAR(255) NOT NULL, created_by_id VARCHAR(255) NOT NULL, updated_by_id VARCHAR(255) NOT NULL, amount BIGINT NOT NULL, title VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_3FA862D0B03A8386 ON "income" (created_by_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_3FA862D0896DBBDE ON "income" (updated_by_id)
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN "income".created_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN "income".updated_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE "saving" (id VARCHAR(255) NOT NULL, created_by_id VARCHAR(255) NOT NULL, updated_by_id VARCHAR(255) NOT NULL, amount BIGINT NOT NULL, title VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_B9DC3D0CB03A8386 ON "saving" (created_by_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_B9DC3D0C896DBBDE ON "saving" (updated_by_id)
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN "saving".created_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN "saving".updated_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE "transaction" (id VARCHAR(255) NOT NULL, account_id VARCHAR(255) DEFAULT NULL, category_id VARCHAR(255) DEFAULT NULL, created_by_id VARCHAR(255) NOT NULL, updated_by_id VARCHAR(255) NOT NULL, amount BIGINT NOT NULL, location VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_723705D19B6B5FBA ON "transaction" (account_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_723705D112469DE2 ON "transaction" (category_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_723705D1B03A8386 ON "transaction" (created_by_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_723705D1896DBBDE ON "transaction" (updated_by_id)
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN "transaction".created_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN "transaction".updated_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE "user" (id VARCHAR(255) NOT NULL, email VARCHAR(180) NOT NULL, is_active BOOLEAN DEFAULT false NOT NULL, password VARCHAR(255) NOT NULL, roles JSON NOT NULL, username VARCHAR(100) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON "user" (email)
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN "user".created_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN "user".updated_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN messenger_messages.created_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN messenger_messages.available_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN messenger_messages.delivered_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
                BEGIN
                    PERFORM pg_notify('messenger_messages', NEW.queue_name::text);
                    RETURN NEW;
                END;
            $$ LANGUAGE plpgsql;
        SQL);
        $this->addSql(<<<'SQL'
            DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "account" ADD CONSTRAINT FK_7D3656A4B03A8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "account" ADD CONSTRAINT FK_7D3656A4896DBBDE FOREIGN KEY (updated_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "account_user" ADD CONSTRAINT FK_10051E39B6B5FBA FOREIGN KEY (account_id) REFERENCES "account" (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "account_user" ADD CONSTRAINT FK_10051E37597D3FE FOREIGN KEY (member_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "account_user" ADD CONSTRAINT FK_10051E3B03A8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "account_user" ADD CONSTRAINT FK_10051E3896DBBDE FOREIGN KEY (updated_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "goal" ADD CONSTRAINT FK_FCDCEB2EB03A8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "goal" ADD CONSTRAINT FK_FCDCEB2E896DBBDE FOREIGN KEY (updated_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "income" ADD CONSTRAINT FK_3FA862D0B03A8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "income" ADD CONSTRAINT FK_3FA862D0896DBBDE FOREIGN KEY (updated_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "saving" ADD CONSTRAINT FK_B9DC3D0CB03A8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "saving" ADD CONSTRAINT FK_B9DC3D0C896DBBDE FOREIGN KEY (updated_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "transaction" ADD CONSTRAINT FK_723705D19B6B5FBA FOREIGN KEY (account_id) REFERENCES "account" (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "transaction" ADD CONSTRAINT FK_723705D112469DE2 FOREIGN KEY (category_id) REFERENCES "category" (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "transaction" ADD CONSTRAINT FK_723705D1B03A8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "transaction" ADD CONSTRAINT FK_723705D1896DBBDE FOREIGN KEY (updated_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "account" DROP CONSTRAINT FK_7D3656A4B03A8386
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "account" DROP CONSTRAINT FK_7D3656A4896DBBDE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "account_user" DROP CONSTRAINT FK_10051E39B6B5FBA
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "account_user" DROP CONSTRAINT FK_10051E37597D3FE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "account_user" DROP CONSTRAINT FK_10051E3B03A8386
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "account_user" DROP CONSTRAINT FK_10051E3896DBBDE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "goal" DROP CONSTRAINT FK_FCDCEB2EB03A8386
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "goal" DROP CONSTRAINT FK_FCDCEB2E896DBBDE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "income" DROP CONSTRAINT FK_3FA862D0B03A8386
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "income" DROP CONSTRAINT FK_3FA862D0896DBBDE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "saving" DROP CONSTRAINT FK_B9DC3D0CB03A8386
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "saving" DROP CONSTRAINT FK_B9DC3D0C896DBBDE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "transaction" DROP CONSTRAINT FK_723705D19B6B5FBA
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "transaction" DROP CONSTRAINT FK_723705D112469DE2
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "transaction" DROP CONSTRAINT FK_723705D1B03A8386
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "transaction" DROP CONSTRAINT FK_723705D1896DBBDE
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE "account"
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE "account_user"
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE "category"
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE "goal"
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE "income"
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE "saving"
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE "transaction"
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE "user"
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}
