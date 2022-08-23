<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Messages;
use App\Repository\UserRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessagesAdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('message')
            ->add('recipient', EntityType::class, [
                'class'        => User::class,
                'query_builder' => function(UserRepository $repository) {
                    return $repository->createQueryBuilder('e')
                    ->where('e.roles LIKE :roles')
                    ->setParameter('roles', '%"'.'ROLE_USER'.'"%')
                    ;
                },
                'choice_label' => function ($user) {
                    return 'ID : ' . $user->getId().' Nom : '. $user->getLastname() . ' Prénom : ' . $user->getFirstname();
                },
                'multiple'     => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Messages::class,
        ]);
    }
}
