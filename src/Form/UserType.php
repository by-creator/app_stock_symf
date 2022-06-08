<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Role;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,array('label'=>'NOM', 'attr'=>array('class'=>'form-control form-group','require'=>'require', 'placeholder'=>'Entrer votre nom')))
            ->add('prenom',TextType::class,array('label'=>'PRÉNOM', 'attr'=>array('class'=>'form-control form-group','require'=>'require', 'placeholder'=>'Entrer votre prénom')))
            ->add('email',EmailType::class,array('label'=>'EMAIL', 'attr'=>array('class'=>'form-control form-group','require'=>'require', 'placeholder'=>'Entrer votre email')))
            ->add('password',PasswordType::class,array('label'=>'MOT DE PASSE', 'attr'=>array('class'=>'form-control form-group','require'=>'require', 'placeholder'=>'Entrer votre mot de passe')))
            ->add('role',EntityType::class,array('class'=>Role::class,'label'=>'ROLE', 'attr'=>array('class'=>'form-control form-group','require'=>'require', 'placeholder'=>'Entrer votre role')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
