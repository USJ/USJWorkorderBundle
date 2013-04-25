<?php

namespace MDB\WorkorderBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class MDBWorkorderExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        $loader->load('listeners.yml');
        $loader->load('forms.yml');

        $container->setParameter('mdb_workorder.model.workorder.class', $config['class']['model']['workorder']);
        $container->setParameter('mdb_workorder.model.status.class', $config['class']['model']['status']);
        $container->setParameter('mdb_workorder.model.user_comment.class', $config['class']['model']['user_comment']);
        $container->setParameter('mdb_workorder.model.status_comment.class', $config['class']['model']['status_comment']);
        $container->setParameter('mdb_workorder.model.assign_comment.class', $config['class']['model']['assign_comment']);
        $container->setParameter('mdb_workorder.model.asset_comment.class', $config['class']['model']['asset_comment']);
        $container->setParameter('mdb_workorder.model.due_date_comment.class', $config['class']['model']['due_date_comment']);
        $container->setParameter('mdb_workorder.model.type_comment.class', $config['class']['model']['type_comment']);
        $container->setParameter('mdb_workorder.model.priority_comment.class', $config['class']['model']['priority_comment']);

        $container->setParameter('mdb_workorder.search_provider.workorder.class', $config['class']['search_provider']['workorder']);

        $container->setAlias('mdb_workorder.manager.workorder', $config['service']['manager']['workorder']);
        $container->setAlias('mdb_workorder.manager.status', $config['service']['manager']['status']);
        $container->setAlias('mdb_workorder.manager.user_comment', $config['service']['manager']['user_comment']);
        $container->setAlias('mdb_workorder.manager.status_comment', $config['service']['manager']['status_comment']);

        // Form
        $container->setParameter('mdb_workorder.form_type.workrequest.type', $config['form']['workrequest']['type']);
        $container->setParameter('mdb_workorder.form_type.workrequest.name', $config['form']['workrequest']['name']);

        $container->setParameter('mdb_workorder.form_type.workorder.type', $config['form']['workorder']['type']);
        $container->setParameter('mdb_workorder.form_type.workorder.name', $config['form']['workorder']['name']);

        $container->setParameter('mdb_workorder.form_type.workorder.user_comment.type', $config['form']['workorder_user_comment']['type']);
        $container->setParameter('mdb_workorder.form_type.workorder.user_comment.name', $config['form']['workorder_user_comment']['name']);

        $container->setParameter('mdb_workorder.form_type.action.type', $config['form']['action']['type']);
        $container->setParameter('mdb_workorder.form_type.action.name', $config['form']['action']['name']);

    }
}
