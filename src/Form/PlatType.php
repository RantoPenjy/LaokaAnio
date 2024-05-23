<?php

namespace App\Form;

use App\Entity\DayType;
use App\Entity\NonViande;
use App\Entity\Plat;
use App\Entity\Viande;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BaseType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;

class PlatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('day_type', EntityType::class, [
                'class' => DayType::class,
                'choice_label' => 'name',
                'choice_value' => 'id',
            ])
            ->add('viandes', EntityType::class, [
                'class' => Viande::class,
                'choice_label' => 'name',
                'choice_value' => 'id',
                'required' => false,
                'multiple' => true,
            ])
            ->add('non_viandes', EntityType::class, [
                'class' => NonViande::class,
                'choice_label' => 'name',
                'choice_value' => 'id',
                'required' => false,
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Plat::class,
        ]);
    }
}
