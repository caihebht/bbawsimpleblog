<?php
namespace Pluswerk\Simpleblog\Domain\Repository;

/***
 *
 * This file is part of the "Simple Blog Extension" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2018 Cai He <heica2222@hotmail.de>, bbaw
 *
 ***/

/**
 * The repository for Blogs
 */
class BlogRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    public function findSearchWord($search, $words = array('Tick', 'Trick', 'Track'))
    {
        $query = $this->createQuery();
        $query->matching(
            $query->logicalOr(
                $query->logicalAnd(
                    $query->like('title', '%' . $search . '%'),
                    $query->equals('description', '')
                ),
                $query->logicalAnd(
                    $query->equals('title', 'TYPO3'),
                    $query->like('description', '%ist toll%')
                ),
                $query->in('title', $words)
            )
        );
        return $query->execute();
    }

    /**
     * @param string $search
     * @param int $limit
     */
    public function findSearchForm($search, $limit)
    {
        $query = $this->createQuery();
        $query->matching(
            $query->like('title', '%' . $search . '%')
        );
        /*
         * sortieren und Limit setzen geht nicht
         */
         $query->setOrderings(array('title' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING));

        $limit = (int)$limit;
        if ($limit > 0) {
            $query->setLimit($limit);
        }


        return $query->execute();
    }
}



    /*
     *  letzte SQL Abfrage ausgeben
     */
    /*
    public function initializeObject()
    {
        $this->databaseHandle = $GLOBALS['TYPO3_DB'];
        $this->databaseHandle->explainOutput = 2;
        $this->databaseHandle->store_lastBuiltQuery = TRUE;
        $this->databaseHandle->debugOutput = 2;
    }
    */




