<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastname', TextType::class, [
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
            ->add('firstname', TextType::class, [
                'label'=>'Vôtre prénom',
                'attr' => [
                    "placeholder" => "Dupont",
                    'class' => "form-control"
                ],
                'constraints' => [
                    new NotBlank([
                        "message" => "Merci de saisir vôtre prénom",
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
            ->add('email', EmailType::class, [
                "label" => "Email",
                "attr"  => ["placeholder" => "exemple@exemple.com"]
            ])
            ->add('photo', FileType::class, [
                'label' => 'Votre photo de profil (.jpg .jpeg .png)',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '3024k',
                        'mimeTypes' => [
                            'image/gif',
                            'image/jpeg',
                            'image/jpg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Image non valide',
                    ])
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                "label" => "Accepter les conditions",
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter les conditions générales.',
                    ]),
                ],
            ])
            ->add('password', RepeatedType::class,[

                
                'type'=>PasswordType::class,
               
                'invalid_message'=>'Le mot de passe et la confirmation doit être identique', 
                'label'=>'Confirmez votre mot de passe',
                
                'required'=> true, 
                'first_options'=>[
                'label'=>'Mot de passe',
                'attr'=>[
                    'placeholder'=>'Merci de saisir votre mot de passe.']], 
                'second_options'=>['label'=>'Confirmez votre mot de passe',
                
                'attr'=>[
                    'placeholder'=>'Merci de confirmer votre mot de passe.']
                ]
                
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
