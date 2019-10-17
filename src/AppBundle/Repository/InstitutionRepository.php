<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Institution;
use Doctrine\ORM\EntityRepository;

/**
 * InstitutionRepository.
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class InstitutionRepository extends EntityRepository {
    /**
     * Do a typeahead-style query and return the results.
     *
     * @param string $q
     * @return Collection|Institution[]
     */
    public function typeaheadQuery($q) {
        $qb = $this->createQueryBuilder('v');
        $qb->where('v.name like :q');
        $qb->setParameter('q', '%' . $q . '%');
        return $qb->getQuery()->execute();
    }
}
