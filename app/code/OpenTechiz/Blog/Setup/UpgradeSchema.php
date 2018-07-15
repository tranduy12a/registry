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



          $tableName = $installer->getTable('opentechiz_blog_comment_notification');
          $installer->getConnection()->addColumn($tableName, 'comment_id', [
              'type' => Table::TYPE_SMALLINT,
              'nullable' => true,
              'comment' => 'Comment ID?'
          ]);
        $installer->endSetup();
    }
}