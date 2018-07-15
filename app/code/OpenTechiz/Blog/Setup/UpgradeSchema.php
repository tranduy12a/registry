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
        // if (version_compare($context->getVersion(), '1.1.3') < 0) {
        //     // Get module table
        //     $tableName = $setup->getTable('opentechiz_blog_comment');
        //     // Check if the table already exists
        //     if ($setup->getConnection()->isTableExists($tableName) == true) {
        //         // Declare data
        //         $columns = [
        //             'email' => [
        //                 'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
        //                 'nullable' => false,
        //                 'comment' => 'Email',
        //             ],
        //             'pending' => [
        //                 'type' => \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
        //                 'nullable' => false,
        //                 'comment' => 'Pending',
        //             ],
        //             'deny' => [
        //                 'type' => \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
        //                 'nullable' => false,
        //                 'comment' => 'Deny',
        //             ],
        //         ];
        //         $connection = $setup->getConnection();
        //         foreach ($columns as $name => $definition) {
        //             $connection->addColumn($tableName, $name, $definition);
        //         }
        //     }
        // }

        $table = $installer->getConnection()
            ->newTable($installer->getTable('opentechiz_blog_comment_notification'))
            ->addColumn('noti_id', Table::TYPE_SMALLINT, null, [
               'identity' => true,
               'nullable' => false,
               'primary' => true,
            ], 'Noti ID')
            ->addColumn('content', Table::TYPE_TEXT, 255, ['nullable => false'], 'Notification Content')
            ->addColumn('user_id', Table::TYPE_SMALLINT, null, ['nullable' => false], 'User ID')
            ->addColumn('post_id', Table::TYPE_SMALLINT, null, ['nullable' => false], 'Post ID')
            ->addColumn('creation_time', Table::TYPE_TIMESTAMP, null,
              ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
              'Comment Created At')
            ->setComment('Comment Notification');

        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}