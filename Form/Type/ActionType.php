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
class ActionType extends AbstractType
{
    protected $workorderClass;

    public function __construct($workorderClass)
    {   
        $this->workorderClass = $workorderClass;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('status', 'choice');
        $builder->add('assignees', 'choice');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);
        $resolver->setDefaults(array(
            'data_class' => $this->workorderClass,
        ));
    }

    public function getName()
    {
        return 'mdb_workorder_action';
    }
}