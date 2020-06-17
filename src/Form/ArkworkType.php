<?php

/*
 * This file is part of aakb/kunstdatabasen.
 * (c) 2020 ITK Development
 * This source file is subject to the MIT license.
 */

namespace App\Form;

use App\Entity\Artwork;
use App\Service\TagService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ArtworkType.
 */
class ArkworkType extends AbstractType
{
    /* @var TagService $tagService */
    private $tagService;

    /**
     * ArtworkType constructor.
     *
     * @param \App\Service\TagService $tagService
     */
    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /* @var Artwork $artwork */
        $artwork = $options['data'];

        $classname = \get_class($artwork);

        $builder
            ->add('name', null, [
                'label' => 'item.name',
            ])
            ->add('description', null, [
                'label' => 'item.description',
            ])
            ->add('purchasePrice', null, [
                'label' => 'item.purchase_price',
            ])
            ->add('status', ChoiceType::class, [
                'attr' => [
                    'class' => 'tag-select-edit',
                ],
                'choices' => $this->tagService->getChoices($classname, 'status'),
                'required' => false,
                'label' => 'item.status',
            ])
            ->add('building', ChoiceType::class, [
                'attr' => [
                    'class' => 'tag-select-edit',
                ],
                'choices' => $this->tagService->getChoices($classname, 'building'),
                'required' => false,
                'label' => 'item.building',
            ])
            ->add('organization', ChoiceType::class, [
                'attr' => [
                    'class' => 'tag-select-edit',
                ],
                'choices' => $this->tagService->getChoices($classname, 'organization'),
                'required' => false,
                'label' => 'item.organization',
            ])
            ->add('type', ChoiceType::class, [
                'attr' => [
                    'class' => 'tag-select-edit',
                ],
                'choices' => $this->tagService->getChoices($classname, 'type'),
                'required' => false,
                'label' => 'item.type',
            ])
            ->add('address', ChoiceType::class, [
                'attr' => [
                    'class' => 'tag-select-edit',
                ],
                'choices' => $this->tagService->getChoices($classname, 'address'),
                'required' => false,
                'label' => 'item.address',
            ])
            ->add('location', ChoiceType::class, [
                'attr' => [
                    'class' => 'tag-select-edit',
                ],
                'choices' => $this->tagService->getChoices($classname, 'location'),
                'required' => false,
                'label' => 'item.location',
            ])
            ->add('room', ChoiceType::class, [
                'attr' => [
                    'class' => 'tag-select-edit',
                ],
                'choices' => $this->tagService->getChoices($classname, 'room'),
                'required' => false,
                'label' => 'item.room',
            ])
            ->add('city', ChoiceType::class, [
                'attr' => [
                    'class' => 'tag-select-edit',
                ],
                'choices' => $this->tagService->getChoices($classname, 'city'),
                'required' => false,
                'label' => 'item.city',
            ])
            ->add('postalCode', null, [
                'label' => 'item.postal_code',
            ])
            ->add('publiclyAccessible', null, [
                'label' => 'item.publicly_accessible',
            ])
            ->add('geo', null, [
                'label' => 'item.geo',
            ])
            ->add('comment', null, [
                'label' => 'item.comment',
            ])
            ->add(
                'images',
                CollectionType::class,
                [
                    'entry_type' => ImageType::class,
                    'entry_options' => [
                        'label' => false,
                        'required' => false,
                    ],
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                    'label' => 'item.images',
                ]
            )
            ->add('artist', null, [
                'label' => 'item.artist',
            ])
            ->add('artistGender', ChoiceType::class, [
                'attr' => [
                    'class' => 'tag-select-edit',
                ],
                'choices' => $this->tagService->getChoices($classname, 'artistGender'),
                'required' => false,
                'label' => 'item.artist_gender',
            ])
            ->add('artSerial', null, [
                'label' => 'item.art_serial',
            ])
            ->add('productionYear', null, [
                'label' => 'item.production_year',
            ])
            ->add('assessmentDate', DateTimeType::class, [
                'html5' => true,
                'widget' => 'single_text',
                'required' => false,
                'label' => 'item.assessment_date',
            ])
            ->add('assessmentPrice', null, [
                'label' => 'item.assessment_price',
            ])
            ->add('width', null, [
                'label' => 'item.width',
            ])
            ->add('height', null, [
                'label' => 'item.height',
            ])
            ->add('depth', null, [
                'label' => 'item.depth',
            ])
            ->add('diameter', null, [
                'label' => 'item.diameter',
            ])
            ->add('weight', null, [
                'label' => 'item.weight',
            ]);

        // Allow for new options from the user.
        $builder->get('building')->resetViewTransformers();
        $builder->get('organization')->resetViewTransformers();
        $builder->get('type')->resetViewTransformers();
        $builder->get('address')->resetViewTransformers();
        $builder->get('location')->resetViewTransformers();
        $builder->get('room')->resetViewTransformers();
        $builder->get('city')->resetViewTransformers();
        $builder->get('status')->resetViewTransformers();
        $builder->get('artistGender')->resetViewTransformers();
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Artwork::class,
            ]
        );
    }
}
