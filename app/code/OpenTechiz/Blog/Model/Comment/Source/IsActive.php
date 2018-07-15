<?php
namespace OpenTechiz\Blog\Model\Comment\Source;
class IsActive implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @var \OpenTechiz\Blog\Model\Comment
     */
    protected $comment;
    /**
     * Constructor
     *
     * @param \OpenTechiz\Blog\Model\Comment $comment
     */
    public function __construct(\OpenTechiz\Blog\Model\Comment $comment)
    {
        $this->comment = $comment;
    }
    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options[] = ['label' => '', 'value' => ''];
        $availableOptions = $this->comment->getAvailableStatuses();
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}