<?php

namespace App\Form;

use App\Entity\Comment;
use App\Entity\Media;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content')
            ->add('status')
            ->add('parentComment', EntityType::class, [
                'class' => Comment::class,
                'choice_label' => 'id',
            ])
            ->add('publisher', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            ->add('media', EntityType::class, [
                'class' => Media::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
