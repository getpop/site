<?php
namespace PoP\Site\ModuleProcessors;

interface ModuleProcessorInterface extends \PoP\ConfigurationComponentModel\ModuleProcessors\ModuleProcessorInterface
{
    public function getDataloadMultidomainSources(array $module, array &$props): array;
    public function getDataloadMultidomainQuerySources(array $module, array &$props): array;
    public function queriesExternalDomain(array $module, array &$props): bool;
    public function isMultidomain(array $module, array &$props): bool;
}
