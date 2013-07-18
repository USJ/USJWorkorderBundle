<?php

namespace MDB\WorkorderBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('mdb_workorder', 'array');

        $rootNode
            ->children()
                ->arrayNode('status')
                    ->prototype('scalar')->end()
                ->end()
                ->arrayNode('form')->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('workrequest')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('type')->defaultValue('mdb_workorder_workrequest')->end()
                                ->scalarNode('name')->defaultValue('mdb_workorder_workrequest')->end()
                            ->end()
                        ->end()
                        ->arrayNode('workorder')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('type')->defaultValue('mdb_workorder_workrequest')->end()
                                ->scalarNode('name')->defaultValue('mdb_workorder_workrequest')->end()
                            ->end()
                        ->end()
                        ->arrayNode('workorder_user_comment')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('type')->defaultValue('mdb_workorder_workorder_user_comment')->end()
                                ->scalarNode('name')->defaultValue('mdb_workorder_workorder_user_comment')->end()
                            ->end()
                        ->end()
                        ->arrayNode('action')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('type')->defaultValue('mdb_workorder_action')->end()
                                ->scalarNode('name')->defaultValue('mdb_workorder_action')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('class')->isRequired()
                    ->children()
                        ->arrayNode('model')->isRequired()
                            ->children()
                                ->scalarNode('workorder')->isRequired()->end()
                                ->scalarNode('status')->isRequired()->end()
                                ->scalarNode('user_comment')->isRequired()->end()
                                ->scalarNode('status_comment')->isRequired()->end()
                                ->scalarNode('assign_comment')->isRequired()->end()
                                ->scalarNode('asset_comment')->isRequired()->end()
                                ->scalarNode('due_date_comment')->isRequired()->end()
                                ->scalarNode('type_comment')->isRequired()->end()
                                ->scalarNode('priority_comment')->isRequired()->end()
                            ->end()
                        ->end()
                        // ->arrayNode('search_provider')->isRequired()
                        //     ->children()
                        //         ->scalarNode('workorder')->defaultValue('MDB\WorkorderBundle\Search\WorkorderProvider')->end()
                        //     ->end()
                        // ->end()
                    ->end()
                ->end()
                ->arrayNode('service')->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('manager')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('workorder')->cannotBeEmpty()->defaultValue('mdb_workorder.manager.workorder.default')->end()
                                ->scalarNode('status')->cannotBeEmpty()->defaultValue('mdb_workorder.manager.status.default')->end()
                                ->scalarNode('user_comment')->cannotBeEmpty()->defaultValue('mdb_workorder.manager.user_comment.default')->end()
                                ->scalarNode('status_comment')->cannotBeEmpty()->defaultValue('mdb_workorder.manager.status_comment.default')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
