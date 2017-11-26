<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class ProductType extends AbstractType
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {   

        $categories = $this->em->getRepository('AppBundle:Category')->findAll();
        $catsArray = [];

        foreach ($categories as $key => $category) {
            $catsArray[$category->getName()] = $category;
        }


        $builder->add('name')->add('slug')->add('price')
        ->add('category', ChoiceType::class, array(
            'label' => 'Categoría',
            'choices' => $catsArray,
            'mapped' => true,
            'required' => true
        ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Product'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_product';
    }


}
