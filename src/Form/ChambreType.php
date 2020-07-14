<?php

namespace App\Form;

use App\Entity\Batiment;
use App\Entity\Chambre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\Factory\Cache\ChoiceLabel;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChambreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('batiment',EntityType::class,[
                'class'=>Batiment::class,
                'choice_label' => function ($batiment)
                {
                    return $batiment->getNomBatiment()." => ".$batiment->getId();
                }
            ])
            ->add('typeChambre', ChoiceType::class,[ 
                'choices'  => [
                    'Unique' =>'Unique' ,
                    'Double' => 'Double']
                ])
        
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Chambre::class,
        ]);
    }
}
