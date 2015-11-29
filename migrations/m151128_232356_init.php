<?php

use yii\db\Schema;
use yii\db\Migration;

class m151128_232356_init extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        $this->createTable('{{%challenge}}', [
            'id' => Schema::TYPE_PK,
            'time' => Schema::TYPE_INTEGER . ' NOT NULL',
            'text' => Schema::TYPE_TEXT . ' NOT NULL',
            'hint1' => Schema::TYPE_STRING . '(255) NOT NULL',
            'is_hint1_active' => Schema::TYPE_BOOLEAN . ' NOT NULL DEFAULT 0',
            'hint2' => Schema::TYPE_STRING . '(255) NOT NULL',
            'is_hint2_active' => Schema::TYPE_BOOLEAN . ' NOT NULL DEFAULT 0',
            'answer' => Schema::TYPE_STRING . '(255) NOT NULL',
            'is_answer_activate' => Schema::TYPE_BOOLEAN . ' NOT NULL DEFAULT 0',
            'map_url' => Schema::TYPE_STRING . '(255) NOT NULL',
            'code_count' => Schema::TYPE_INTEGER . ' NOT NULL',
            'code_available' => Schema::TYPE_INTEGER . ' NOT NULL',
            'is_solved' => Schema::TYPE_BOOLEAN . ' NOT NULL DEFAULT 0',
        ], $tableOptions);
        $this->createTable('{{%log}}', [
            'id' => Schema::TYPE_PK,
            'time' => Schema::TYPE_DATE . ' NOT NULL',
            'text' => Schema::TYPE_STRING . '(255) NOT NULL',
            'answer' => Schema::TYPE_STRING . '(255) NOT NULL',
            'challenge_id' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
        $this->addForeignKey('log2challenge','{{%log}}','challenge_id','{{%challenge}}','id');

        $mainText = ' Каннабиноиды — группа терпенфенольных соединений, производных 2-замещённого 5-амилрезорцина. В природе встречаются в растениях семейства коноплёвых (Cannabaceae), являются действующими веществами гашиша и марихуаны.  <img src="img/podarochnyi_sertifikat_drochsalon.jpg"> Растительные каннабиноиды являются С-21 соединениями, имеющими родственную структуру. Психотропный эффект марихуаны достигается благодаря действию дельта-9-тетрагидроканнабинола, способного избирательно связываться с определёнными структурами отделов головного мозга, называемыми каннабиноидными рецепторами. Растительные каннабиноиды также называют фитоканнабиноидами.

В настоящее время каннабиноидами принято называть также синтетические вещества, имеющие родственную растительным каннабиноидам структуру и обладающие аналогичным фармакологическим действием — такие вещества называются классическими каннабиноидами. Также к каннабиноидам относят синтетические вещества, имеющие отличную от растительных структуру (аминоалкилиндолы, эйкозаноиды, 1,5-диарилпиразолы, хинолины, арилсульфонамиды и др.), но обладающие теми же фармакологическими свойствами — такие вещества называют неклассическими каннабиноидами.

Существуют также вещества, которые вырабатываются в организме человека и являются эндогенными лигандами-агонистами каннабиноидных рецепторов, к ним относятся анандамид и родственные ему соединения — производные полиненасыщенных жирных кислот. <img src="img/ekaterinburgmap3.jpg"> Данные соединения необходимы для нормального функционирования головного мозга и отвечают за ряд жизненно важных функций. В связи с тем, что данные соединения имеют эндогенное происхождение, их назвали эндогенными каннабиноидами, или эндоканнабиноидами.';

        $this->insert('{{%challenge}}', [
            'time' => (time() - 10 * 60),
            'text' => $mainText . $mainText . $mainText,
            'hint1' => 'В России, Украине[5] и других странах СНГ производство, продажа, импорт и хранение тетрагидроканнабинола (включая его синтетические лекарственные формы) запрещены законом, а само вещество включено в Список № 1.',
            'hint2' => 'Дронабинол — лекарственное средство, синтетический аналог тетрагидроканнабинола. Выпускается в капсулах, содержащих 2,5 мг тетрагидроканнабинола. С 1980 г. распространяется Национальным онкологическим институтом США как стимулятор аппетита и противорвотное. Отпускается по специальным рецептам для онкобольных, получающих химиотерапию.',
            'answer' => 'ТГК',
            'map_url' => '/img/ekaterinburgmap3.jpg',
            'code_available' => 4,
        ]);

    }

    public function down()
    {
        $this->dropForeignKey('log2challenge','{{%log}}');
        $this->dropTable('{{%log}}');
        $this->dropTable('{{%challenge}}');

    }

}
