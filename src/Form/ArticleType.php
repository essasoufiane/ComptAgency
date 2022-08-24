<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                "label"=>"Le titre de l'article",
                'attr' => [
                    "placeholder" => "Fiscalité et impots",
                    'class' => "form-control"
                ],
                'constraints' => [
                    new NotBlank([
                        "message" => "Merci de saisir le titre de l'article",
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Ce champ doit contenir au moins {{ limit }} caractères',
                       
                        'max' => 40,
                    ]),
                ],
            ])
            ->add('content', CKEditorType::class, [
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
            'data_class' => Article::class,
        ]);
    }
}
