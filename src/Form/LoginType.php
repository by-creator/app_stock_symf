<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('email',EmailType::class,array('label'=>'EMAIL', 'attr'=>array('class'=>'form-control form-group','require'=>'require', 'placeholder'=>'Entrer votre email')))
        ->add('password',PasswordType::class,array('label'=>'MOT DE PASSE', 'attr'=>array('class'=>'form-control form-group','require'=>'require', 'placeholder'=>'Entrer votre mot de passe')))
        ->add('VALIDER', SubmitType::class,array('label'=>'VALIDER', 'attr'=>array('class'=>'btn')))

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
