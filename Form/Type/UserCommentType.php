<?php
namespace MDB\WorkorderBundle\Form\Type;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\Form\FormViewInterface,
    Symfony\Component\Form\FormInterface,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Form\FormView,
    Symfony\Component\Form\FormEvents,
    Symfony\Component\Form\Event\DataEvent;

/**
*
*/
class UserCommentType extends AbstractType
{
    protected $userCommentClass;

    public function __construct($userCommentClass)
    {
        $this->userCommentClass = $userCommentClass;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('body', 'textarea');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);
        $resolver->setDefaults(array(
            'data_class' => $this->userCommentClass,
        ));

    }

    public function getName()
    {
        return 'mdb_workorder_workorder_user_comment';
    }

}
