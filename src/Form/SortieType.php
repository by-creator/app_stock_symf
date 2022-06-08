<?php

namespace App\Form;

use App\Entity\Sortie;
use App\Entity\Produit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SortieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateS',DateType::class,array('format' => 'dd-MM-yyyy','label'=>"DATE DE SORTIE", 'attr'=>array('class'=>'form-control form-group','require'=>'require', 'placeholder'=>'Choisissez une date')))
            ->add('produit',EntityType::class,array('class'=>Produit::class,'label'=>'LIBELLE DU PRODUIT', 'attr'=>array('class'=>'form-control form-group','require'=>'require', 'placeholder'=>'Choisissez un produit')))
            ->add('qteS',TextType::class,array('label'=>'QUANTITÉ', 'attr'=>array('class'=>'form-control form-group','require'=>'require', 'placeholder'=>'Entrer la quantité achetée')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sortie::class,
        ]);
    }
}
