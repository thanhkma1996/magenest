<?php

namespace Mageplaza\HelloWorld\Controller\Adminhtml\Post;
use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;

class Edit extends Action
{
    protected $resultPageFactory;
    protected $coreRegistry;

    /**
     * Edit constructor.
     * @param Action\Context $context
     * @param PageFactory $resultPageFactory
     * @param Registry $registry
     */
    public function __construct(
        Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry
    )
    {
        $this->resultPageFactory=$resultPageFactory;
        $this->coreRegistry=$registry;
        parent::__construct($context);
    }

    public function _initAction()
    {
        $resultPage=$this->resultPageFactory->create();
        $resultPage->setActiveMenu('Mageplaza_HelloWorld::edit');
        $resultPage->getConfig()->getTitle()->set(__('Mageplaza HelloWorld Edit'));
        return $resultPage;
    }


    public function execute()
    {
        $id = $this->getRequest()->getParam('movie_id');

        $model = $this->_objectManager->create('Mageplaza\HelloWorld\Model\Post');
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This movie no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getFormData(true);


        if (!empty($data)) {
            $model->setData($data);
        }

        $this->coreRegistry->register('mageplaza_edit', $model);
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_initAction();
        $resultPage->getConfig()->getTitle()
            ->prepend($model->getId() ? __('Edit Mageplaza ', $model->getData('option_name')) : __('Edit mageplaza'));
//        '%1'
        return $resultPage;
    }

}