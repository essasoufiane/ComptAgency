<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Messages;
use App\Repository\UserRepository;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class MessagesAdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('title', TextType::class, [
            'label'=>'Sujet du message',
            'attr' => [
                "placeholder" => "L'objet de vôtre message",
                'class' => "form-control"
            ],
            'constraints' => [
                new NotBlank([
                    "message" => "Merci de saisir l'objet de vôtre message",
                ]),
                new Length([
                    'min' => 6,
                    'minMessage' => 'Ce champ doit contenir au moins {{ limit }} caractères',
                   
                    'max' => 4096,
                ]),
            ],
        ])
        ->add('message', CKEditorType::class, [
            'constraints' => [
                new NotBlank([
                    'message' => 'Merci de saisir votre message',
                ]),
                new Length([
                    'min' => 6,
                    'minMessage' => 'Votre messagee doit contenir au moins {{ limit }} caractères',
                   
                    'max' => 20000,
                ]),
            ],
        ])
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
