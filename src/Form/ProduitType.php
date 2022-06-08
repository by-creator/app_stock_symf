<?php

namespace App\Form;

use App\Entity\Produit;
use App\Entity\Categorie;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle',TextType::class,array('label'=>'LIBELLE', 'attr'=>array('class'=>'form-control form-group','require'=>'require', 'placeholder'=>'Entrer le nom du produit')))     
            ->add('qte',TextType::class,array('label'=>'QUANTITE', 'attr'=>array('class'=>'form-control form-group','require'=>'require', 'placeholder'=>'Entrer la quantité du produit')))     
            ->add('prix',TextType::class,array('label'=>'PRIX', 'attr'=>array('class'=>'form-control form-group','require'=>'require', 'placeholder'=>'Entrer le prix du produit')))
            ->add('categorie',EntityType::class,array('class'=>Categorie::class,'label'=>'CATÉGORIE', 'attr'=>array('class'=>'form-control form-group','require'=>'require', 'placeholder'=>'Entrer la catégorie')))
            ->add('users',EntityType::class,array('class'=>User::class,'label'=>'UTILISATEUR', 'attr'=>array('class'=>'form-control form-group','require'=>'require', 'placeholder'=>'')))
              ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
