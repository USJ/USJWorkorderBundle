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

use MDB\WorkorderBundle\Status;

class WorkorderType extends AbstractType
{
    protected $workOrderClass;

    public function __construct($workOrderClass)
    {
        $this->workOrderClass = $workOrderClass;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'text');
        $builder->add('description', 'textarea');
        $builder->add('type', 'choice', array(
                'choices' => array(
                    'CORRECTIVE' => 'CORRECTIVE',
                    'PREVENTIVE' => 'PREVENTIVE',
                    'PREDICTIVE' => 'PREDICTIVE',
                    'INSPECTION' => 'INSPECTION',
                    'BREAKDOWN' => 'BREAKDOWN')
            )
        );
        $builder->add('priority', 'choice', array(
                'choices' => array(
                    1 => 'LOW',
                    2 => 'MEDIUM',
                    3 => 'HIGH'
                )
            )
        );

        $builder->add('status', 'choice', array(
                'choices' => array(
                    'REQUEST' => 'REQUEST'
                )
            ));

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);
        $resolver->setDefaults(array(
            'data_class' => $this->workOrderClass,
        ));

    }

    public function getName()
    {
        return 'mdb_workorder_workorder';
    }
}
