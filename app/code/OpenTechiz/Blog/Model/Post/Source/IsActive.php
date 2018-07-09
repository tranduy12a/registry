<?php
namespace OpenTechiz\Blog\Model\Post\Source;
class IsActive implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @var \OpenTechiz\Blog\Model\Post
     */
    protected $post;
    /**
     * Constructor
     *
     * @param \OpenTechiz\Blog\Model\Post $post
     */
    public function __construct(\OpenTechiz\Blog\Model\Post $post)
    {
        $this->post = $post;
    }
    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options[] = ['label' => '', 'value' => ''];
        $availableOptions = $this->post->getAvailableStatuses();
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}