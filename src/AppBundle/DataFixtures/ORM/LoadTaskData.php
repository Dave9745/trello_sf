<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use AppBundle\Entity\Task;

class LoadTaskData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $datas = [
            [
                'name'        => 'tâche 1',
                'description' => 'description 1',
                'status'      => 'closed',
                'category'    => 'category-1'
            ],
            [
                'name'        => 'tâche 2',
                'description' => 'description 2',
                'status'      => 'closed',
                'category'    => 'category-2'
            ],
            [
                'name'        => 'tâche 3',
                'description' => 'description 3',
                'status'      => 'open',
                'category'    => 'category-3'
            ],
            [
                'name'        => 'tâche 4',
                'description' => 'description 4',
                'status'      => 'open',
                'category'    => 'category-0'
            ],
            [
                'name'        => 'tâche 5',
                'description' => 'description 5',
                'status'      => 'open',
                'category'    => 'category-0'
            ],
        ];

        foreach ($datas as $i => $data) {

            $task = new Task();
            $task->setName($data['name']);
            $task->setDescription($data['description']);
            $task->setStatus($data['status']);
            $task->setCategory($this->getReference($data['category']));
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
