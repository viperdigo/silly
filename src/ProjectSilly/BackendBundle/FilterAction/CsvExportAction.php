<?php

namespace ProjectSilly\BackendBundle\FilterAction;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query;
use Filter\FilterBundle\Service\Filter\Property;
use Filter\FilterBundle\Service\Filter\Action;

class CsvExportAction implements Action
{
    private $fields;
    private $headers;

    public function __construct(array $fields, array $headers)
    {
        $this->fields = $fields;
        $this->headers = $headers;
    }

    public function prepare(QueryBuilder $qb, callable $alias, Property $root)
    {
        $fields = array_map(
            function ($value) use ($alias) {
                return $alias($value);
            },
            $this->fields
        );

        $qb->select($fields);

        $identifier = $root->getMetadata()->getClassMetadata()->getIdentifier();
        foreach ($identifier as $pk) {
            $qb->addGroupBy($alias($pk));
        }
    }

    public function execute(Query $query)
    {
        $stm = $this->buildStatement($query);

        if ($stm->rowCount() <= 0) {
            throw new \Exception(sprintf('No rows (%s) to export.', $stm->rowCount()));
        }

        $filename = $this->createFile($stm);

        $this->output($filename);
    }

    private function buildStatement(Query $query)
    {
        $sql = $query->getSQL();
        $parameters = $query->getParameters();

        $parser = new \Doctrine\ORM\Query\Parser($query);
        $result = $parser->parse();
        $paramMappings = $result->getParameterMappings();

        $params = array();
        $types = array();

        foreach ($parameters as $parameter) {
            $mappings = $paramMappings[$parameter->getName()];

            foreach ($mappings as $position) {
                $params[$position] = $parameter->getValue();
                $types[$position] = $parameter->getType();
            }
        }

        return $query->getEntityManager()->getConnection()->executeQuery($sql, $params, $types);
    }

    private function createFile($stm)
    {
        $filename = sprintf('%s/exported_%s.csv', sys_get_temp_dir(), date('YmdHis'));

        $file = fopen($filename, 'w');

        $data = $stm->fetch();
        if ($this->headers) {
            $headers = $this->headers;
        } else {
            $headers = array_keys($data);
        }

        fputcsv($file, $headers, ';', '"');
        fputcsv($file, $data, ';', '"');

        while ($data = $stm->fetch()) {
            fputcsv($file, $data, ';', '"');
        }

        fclose($file);

        return $filename;
    }

    private function output($filename)
    {
        header('Content-type: text/csv');
        header('Content-disposition: '.sprintf('attachment; filename="%s"', basename($filename)));
        header('Content-length: '.filesize($filename));
        readfile($filename);
        exit;
    }
}
