<?php

namespace App\Form;

use App\Entity\Employer;
use App\Entity\Entreprise;
use App\Repository\EntrepriseRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class EmployerType extends AbstractType
{

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options,): void
    {
        // saisir l'utilisateur, faire une vérification rapide de l'existence de l'utilisateur.
        $user = $this->security->getUser();
        if (!$user) {
            throw new \LogicException(
                'Vous devez être authentifier!'
            );
        }
        $builder
            ->add('lastname', TextType::class, [
                "label"=>"Le nom de l'employer",
                'attr' => [
                    "placeholder" => "Dupond",
                    'class' => "form-control"
                ],
                'constraints' => [
                    new NotBlank([
                        "message" => "Merci de saisir nom de l'employer de l'entreprise",
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Ce champ doit contenir au moins {{ limit }} caractères',
                       
                        'max' => 100,
                    ]),
                ],
            ])
            ->add('firstname', TextType::class, [
                "label"=>"Le prénom de l'employer",
                'attr' => [
                    "placeholder" => "Dupond",
                    'class' => "form-control"
                ],
                'constraints' => [
                    new NotBlank([
                        "message" => "Merci de saisir prénom de l'employer de l'entreprise",
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Ce champ doit contenir au moins {{ limit }} caractères',
                       
                        'max' => 100,
                    ]),
                ],
            ])
            ->add('age', IntegerType::class, [
                "label"=>"L'âge de l'employer",
                'attr' => [
                    'placeholder' => "30",
                    'class' => "form-control"
                ],
                'constraints' => [
                    new NotBlank([
                        "message" => "Merci de saisir l'âge de l'employer de l'entreprise",
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Ce champ doit contenir au moins {{ limit }} caractères',
                       
                        'max' => 2,
                    ]),
                ],
            ])
            ->add('entreprise', EntityType::class, [
                'class'        => Entreprise::class,
                'query_builder' => function(EntrepriseRepository $repository) use ($user) {
                    return $repository->createQueryBuilder('e')
                    ->andWhere('e.user = :val')
                    ->setParameter('val', $user)
                    ;
                },
                'choice_label' => function ($entreprise) {
                    return 'ID : ' . $entreprise->getId().' '. $entreprise->getName();
                },
                'multiple'     => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employer::class,
        ]);
    }
}
