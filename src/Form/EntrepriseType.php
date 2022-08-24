<?php

namespace App\Form;

use App\Entity\Entreprise;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class EntrepriseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                "label"=>"Nom de l'entreprise",
                'attr' => [
                    "placeholder" => "ComptAgency",
                    'class' => "form-control"
                ],
                'constraints' => [
                    new NotBlank([
                        "message" => "Merci de saisir le nom de l'entreprise",
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Ce champ doit contenir au moins {{ limit }} caractères',
                       
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('status', TextType::class, [
                "label"=>"Le statut de l'entreprise",
                'attr' => [
                    "placeholder" => "SARL",
                    'class' => "form-control"
                ],
                'constraints' => [
                    new NotBlank([
                        "message" => "Merci de saisir le statut de l'entreprise",
                    ]),
                    new Length([
                        'min' => 4,
                        'minMessage' => 'Ce champ doit contenir au moins {{ limit }} caractères',
                       
                        'max' => 15,
                    ]),
                ],
            ])
            ->add('siren', NumberType::class, [
                "label"=>"Le numéro de siren de l'entreprise",
                'attr' => [
                    "placeholder" => "890 345 222",
                    'class' => "form-control"
                ],
                'constraints' => [
                    new NotBlank([
                        "message" => "Merci de saisir le numéro de siren de l'entreprise",
                    ]),
                    new Length([
                        'min' => 9,
                        'minMessage' => 'Ce champ doit contenir au moins {{ limit }} caractères',
                       
                        'max' => 9,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Entreprise::class,
        ]);
    }
}
