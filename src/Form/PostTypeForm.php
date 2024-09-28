<?php
namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class PostTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        // dd($options);
         /** @var Post|null $article */
         $post = $options['data'] ?? null;
         $isEdit = $post && $post->getId();

        $builder
            ->add('title', TextType::class, [
                'required' => false, 
                'label'   => false,
                'attr' => array(
                    'placeholder' => 'Title'
                    )
                ])
            ->add('content', TextareaType::class, ['required' => true, 'label'   => false,])
            ->add('published', CheckboxType::class, ['required' => false,])
            ->add('summary', TextType::class, [
                'required' => true, 
                'label'   => false,
                'attr' => array( 'placeholder' => 'Summary')
            ])
            ->add('slug', TextType::class, [
                'required' => true, 
                'label'   => false,
                'attr' => array( 'placeholder' => 'Slug')
            ])
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}