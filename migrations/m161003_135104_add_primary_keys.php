<?php

use yii\db\Migration;

class m161003_135104_add_primary_keys extends Migration
{
    public function up()
    {
        $this->addColumn('tb_source', 'ID', $this->primaryKey());
        $this->addColumn('tb_rel', 'ID', $this->primaryKey());
        try {
            $this->createIndex('i1', 'tb_source', ['MEDREC_ID', 'ICD']);
            $this->createIndex('i1', 'tb_rel', ['MEDREC_ID', 'NDC']);
        } catch (Exception $e) {
            echo "Indexes seem to be created manually";
        }
    }

    public function down()
    {
        $this->dropColumn('tb_source', 'ID');
        $this->dropColumn('tb_rel', 'ID');

        $this->dropIndex('i1', 'tb_source');
        $this->dropIndex('i1', 'tb_rel');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
