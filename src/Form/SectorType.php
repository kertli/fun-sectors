<?php

namespace App\Form;

use App\Entity\Person;
use App\Entity\Sector;
use App\Repository\SectorRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SectorType extends AbstractType
{
    private SectorRepository $sectorRepository;

    public function __construct(SectorRepository $sectorRepository)
    {
        $this->sectorRepository = $sectorRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $rootSectors = $this->sectorRepository->findRootSectors();

        $tree = $this->buildTree($rootSectors);

        $builder
            ->add('name')
            ->add('sectors', EntityType::class, [
                'class' => Sector::class,
                'choices' => $tree,
                'choice_label' => 'label',
                'empty_data' => null,
                'required' => true,
                'multiple' => true,
            ])
            ->add('tos')
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Person::class,
        ]);
    }

    /** @return array<int, Sector> */
    private function buildTree(iterable $sectors, int $depth = 0): array
    {
        $tree = [];

        /** @var Sector $sector */
        foreach ($sectors as $sector) {
            $sector->setLabel(str_repeat('--', $depth) . $sector->getName());

            $tree[$sector->getId()] = $sector;

            if(!$sector->getChildren()->isEmpty()) {
                $tree += $this->buildTree($sector->getChildren(), $depth + 1);
            }
        }

        return $tree;
    }
}
