<?php

    namespace AppBundle\Form;


    use AppBundle\Entity\Task;
    use Symfony\Bridge\Doctrine\Form\Type\EntityType;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

    class TaskType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder

                ->add('name', TextType::class)
                ->add('description', TextType::class)
                ->add('status', ChoiceType::class,['choices' => ['opened' => Task::STATUS_OPENED, 'closed' => Task::STATUS_CLOSED]])
                ->add('category', EntityType::class,['class' => 'AppBundle\Entity\Category','choice_label' => 'name']);

            ;
        }

        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults(array(
                'data_class' => 'AppBundle\Entity\Task',
                ''
            ));
        }
    }