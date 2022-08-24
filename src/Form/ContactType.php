<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => [
                    'placeholder' => "exemple@exemple.fr",
                    'class' => "form-control"
                ]
            ])
            ->add('name', TextType::class, [
                'label'=>'Vôtre nom',
                'attr' => [
                    "placeholder" => "Dupont",
                    'class' => "form-control"
                ],
                'constraints' => [
                    new NotBlank([
                        "message" => "Merci de saisir vôtre nom",
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Ce champ doit contenir au moins {{ limit }} caractères',
                       
                        'max' => 40,
                    ]),
                ],
            ])
            ->add('phone', IntegerType::class, [
                'label'=>'Téléphone',
                'attr' => [
                    'placeholder' => "0744332244",
                    'class' => "form-control"
                ],
                'constraints' => [
                    new Length([
                        'min' => 9,
                        'minMessage' => 'Ce champ doit contenir au moins {{ limit }} caractères',
                       
                        'max' => 25,
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
