<?php

namespace App\Form;

use App\Entity\Chambre;
use App\Entity\Etudiant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('prenom')
            ->add('nom')
            ->add('telephone')
            ->add('date_naissance')
            ->add('email')
            ->add('typeBourse', ChoiceType::class,[ 
                'choices'  => [
                    'Bourse Entiere' =>'Bourse Entiere' ,
                    'Demi Bourse' => 'Demi Bourse']
                ])
            ->add('adresse')
            ->add('chambre',EntityType::class,[
                'class'=> Chambre::class,
                'choice_label'=> function ($chambre)
                {
                    return $chambre->getId();
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
