<?php

namespace ProjectSilly\BackendBundle\FilterAction;


use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query;
use Filter\FilterBundle\Service\Filter\Property;
use Filter\FilterBundle\Service\Filter\Action;

class TransportationVouchersAction implements Action
{

    private $name;
    private $branchOffice;
    private $supervisor;
    private $settlement;
    private $privations;
    private $benefit;
    private $benefitOption;

    public function __construct(
        $name = 'employee.name',
        $branchOffice = 'employee.branchOffice',
        $supervisor = 'employee.branchOffice.supervisor',
        $settlement = 'employee.settlement',
        $privations = 'privations',
        $benefit = 'employee.benefit',
        $benefitOption = 'employee.benefitOption'
    ) {
        $this->name = $name;
        $this->branchOffice = $branchOffice;
        $this->supervisor = $supervisor;
        $this->settlement = $settlement;
        $this->privations = $privations;
        $this->benefit = $benefit;
        $this->benefitOption = $benefitOption;
    }

    public function prepare(QueryBuilder $qb, callable $alias, Property $root)
    {

        $qb->select(sprintf('%s AS _id', $alias($this->id)))
            ->addSelect(sprintf('%s AS _name', $alias($this->name)))
            ->addSelect(sprintf('%s AS _balance', $alias($this->balance)))
            ->addSelect(sprintf('%s AS _status', $alias($this->status)))
            ->addSelect(sprintf('MAX(DATE(%s)) AS _date', $alias($this->max)))
            ->addGroupBy('_id')
            ->addGroupBy('_name')
            ->addGroupBy('_status')
            ->addGroupBy('_balance');
    }

    public function execute(Query $query)
    {
        $rows = $query->getArrayResult();

        $result = $rows;

        return $result;
    }
}
