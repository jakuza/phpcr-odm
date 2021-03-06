<?php

namespace Doctrine\ODM\PHPCR\Id;

use Doctrine\ODM\PHPCR\DocumentManager;
use Doctrine\ODM\PHPCR\Mapping\ClassMetadata;

class RepositoryIdGenerator extends IdGenerator
{
    /**
     * @param object $document
     * @param ClassMetadata $cm
     * @param DocumentManager $dm
     * @return string
     */
    public function generate($document, ClassMetadata $cm, DocumentManager $dm)
    {
        $repository = $dm->getRepository($cm->name);
        if (!($repository instanceof RepositoryIdInterface)) {
            throw new \Exception("Repository does not implement RepositoryIdInterface, could not generate id");
        }

        // TODO: should we have some default implementation (parent path + some md5/object id)?
        $id = $repository->generateId($document);
        if (!$id) {
            throw new \Exception("Repository did not generate an id");
        }
        return $id;
    }
}
