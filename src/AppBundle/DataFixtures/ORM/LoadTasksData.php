<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use AppBundle\Entity\Tasks;

class LoadTweetData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $datas = [
            [
                 'name'        => 'tâche 1',
                 'description' => 'description 1',
                 'status'      => 'closed',
                 'category'    => 'running'
            ],
            [
                'name'        => 'tâche 2',
                'description' => 'description 2',
                'status'      => 'closed',
                'category'  => 'done'
            ],
            [
                'name'        => 'tâche 3',
                'description' => 'description 3',
                'status'      => 'open',
                'category'  => 'bugs'
            ],
            [
                'name'        => 'tâche 4',
                'description' => 'description 4',
                'status'      => 'open',
                'category'  => 'todo'
            ],
            [
                'name'        => 'tâche 5',
                'description' => 'description 5',
                'status'      => 'open',
                'category'  => 'todo'
            ],
        ];

        foreach ($datas as $i => $data) {

            $task = new Tasks();
            $task->setName($data['name']);
            $task->setDescription($data['description']);
            $task->setStatus($data['status']);
            $task->setCategory($data['category']);
            $manager->persist($task);
            $this->addReference('task-'.$i, $task);

        }
        $manager->flush();
    }
    public function getOrder()
    {
        return 10;
    }
}
