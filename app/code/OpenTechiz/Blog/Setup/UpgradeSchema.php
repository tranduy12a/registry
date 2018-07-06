<?php
namespace OpenTechiz\Blog\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class UpgradeSchema implements  UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup,
                            ModuleContextInterface $context){
        $installer = $setup;
        $installer->startSetup();

        $table = $installer->getConnection()
            ->newTable($installer->getTable('opentechiz_blog_comment'))
            ->addColumn(
                'comment_id',
                Table::TYPE_SMALLINT,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true],
                'Comment ID'
            )
            ->addColumn('content', Table::TYPE_TEXT, '2M', [], 'Comment Content')
            ->addColumn('user_id', Table::TYPE_INTEGER, null , [], 'User ID')
            ->addColumn('post_id', Table::TYPE_INTEGER, null , [], 'Post ID')
            ->addColumn('status', Table::TYPE_SMALLINT, null, ['nullable' => false, 'default' => '1'], 'Does Comment Show?')
            ->addColumn('creation_time', Table::TYPE_DATETIME, null, ['nullable' => false], 'Creation Time')
            ->addColumn('update_time', Table::TYPE_DATETIME, null, ['nullable' => false], 'Update Time')
            ->setComment('OpenTechiz Blog Comment');
        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}