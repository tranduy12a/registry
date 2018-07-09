<?php
 
namespace DebugTraceModule\DTrace\Controller\Index;
 
use Magento\Framework\App\Action\Context;
 
class Index extends \Magento\Framework\App\Action\Action
{
    public function __construct(Context $context)
    {
       
        parent::__construct($context);
    }
    
    public function execute()
    {
        echo "string";
        // $debugBackTrace = debug_backtrace(options DEBUG_BACKTRACE_IGNORE_ARGS);
        // foreach($debug_backtrace as $item) {
        //     echo @item['class'] . @item['type'] . @item['function'] . "\n";
        //     echo "<pre>";
        // }die();
        // $this->_registry->register('custom_var', 'HELLO WORLD');
        // $resultPage = $this->_resultPageFactory->create();
        // return $resultPage;
    }
}