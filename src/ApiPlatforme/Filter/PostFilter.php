<?php


namespace App\ApiPlatform\Filter;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\AbstractContextAwareFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use Doctrine\ORM\QueryBuilder;

class PostFilter extends AbstractContextAwareFilter
{
    //todo
/*    protected function filterProperty(string $property, $value, QueryBuilder $qb, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null)
    {
        if ($property !== 'date') {
            return;
        }
        $dateParam = $queryNameGenerator->generateParameterName('date');
        $calendrierAlias = $qb->getRootAliases()[0];

        $condition1 = $qb->expr()->andX(
            $qb->expr()->isNotNull($calendrierAlias . '.dateDebut'),
            $qb->expr()->isNotNull($calendrierAlias . '.dateFin'),
            $qb->expr()->between(':' . $dateParam, $calendrierAlias . '.dateDebut', $calendrierAlias . '.dateFin')
        );

        $condition2 = $qb->expr()->andX(
            'DATEDIFF(:' . $dateParam . ' , ' . $calendrierAlias . '.dateDebut) >= 0 ',
            $qb->expr()->isNotNull($calendrierAlias . '.dateDebut'),
            $qb->expr()->isNull($calendrierAlias . '.dateFin')
        );

        $condition3 = $qb->expr()->andX(
            'DATEDIFF(' . $calendrierAlias . '.dateFin, :' . $dateParam . ') >= 0 ',
            $qb->expr()->isNull($calendrierAlias . '.dateDebut'),
            $qb->expr()->isNotNull($calendrierAlias . '.dateFin')
        );
        $condition4 = $qb->expr()->andX(
            $qb->expr()->isNull($calendrierAlias . '.dateDebut'),
            $qb->expr()->isNull($calendrierAlias . '.dateFin')
        );

        $qb->andWhere($qb->expr()->orX(
            $condition1,
            $condition2,
            $condition3,
            $condition4
        ));
        $posDay = (new \DateTime($value))->format('N');
        $qb->andWhere('SUBSTRING_INDEX(SUBSTRING_INDEX(' . $calendrierAlias . ".jours, ';', " . $posDay . "),';', -1)='1'");
        $qb->setParameter($dateParam, $value);
    }

    public function getDescription(string $resourceClass): array
    {
        return [
            'date' => [
                'property' => null,
                'type' => 'DateTimeInterface',
                'required' => false,
                'description' => 'Recupérer les calendriers d\un opérateur pour une date donnée',
            ],
        ];
    }*/
    protected function filterProperty(string $property, $value, QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null)
    {
        // TODO: Implement filterProperty() method.
    }

    public function getDescription(string $resourceClass): array
    {
        // TODO: Implement getDescription() method.
    }
}
