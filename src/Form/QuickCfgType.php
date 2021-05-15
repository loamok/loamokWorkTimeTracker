<?php

namespace App\Form;

use App\Entity\QuickCfg;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuickCfgType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('langue', TextType::class, [
                'label' => "Langue : ",
                'required' => true,
            ])
            ->add('country', TextType::class, [
                'label' => "Pays : ",
                'required' => true,
            ])
            ->add('timeZone', TextType::class, [
                'label' => "Fuseau horaire : ",
                'required' => true,
            ])
            ->add('applyWinterHours', CheckboxType::class, [
                'label' => "Respecter l'heure d'hiver : ",
                'required' => false,
            ])
            ->add('weeklyWorkDuration', ChoiceType::class, [
                'label' => "Rythme de travail : ",
                'choices' => [
                    "37h/11Jrtt(L-J 8-12/13-17,V 8-12/13-16:30)" => "37h/11Jrtt(L-J 8-12/13-17,V 8-12/13-16:30)",
                    "39h/28Jrtt(L-J 7:30-12/13-17:30,V 7:30-12/13-16:30)" => "39h/28Jrtt(L-J 7:30-12/13-17:30,V 7:30-12/13-16:30)",
                    "35h/0Jrtt(L-V 8-12/13-16)" => "35h/0Jrtt(L-V 8-12/13-16)",
                ],
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => QuickCfg::class,
        ]);
    }
}
