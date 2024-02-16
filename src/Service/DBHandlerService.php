<?php

namespace App\Service;

use App\Entity\Category;
use App\Entity\Brand;
use App\Entity\Item;
use App\Repository\CategoryRepository;
use App\Repository\BrandRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

class DBHandlerService
{
    private $existingCategories;
    private $existingBrands;

     /**
      * DBHandlerService constructor.
      *
      * @param EntityManagerInterface $entityManager
      * @param CategoryRepository $categoryRepository
      * @param BrandRepository $brandRepository
      * @param LoggerInterface $logger
      */
    public function __construct(
        private EntityManagerInterface $entityManager, 
        private CategoryRepository $categoryRepository,
        private BrandRepository $brandRepository, 
        private LoggerInterface $logger) {

            $this->setup();
    }

    /**
     * Fetch existing categories and brands from categories, brands tables
     * Populates the internal arrays of existingCategories and existingBrands
     * @return void
     */
    private function setup(): void {

        $existingCategories = $this->categoryRepository->findAll();
        $existingBrands = $this->brandRepository->findAll();

        foreach ($existingCategories as $category) {
            $this->existingCategories[$category->getName()] = $category;
        }

        foreach ($existingBrands as $brand) {
            $this->existingBrands[$brand->getName()] = $brand;
        }
    }

    /**
     * Get or create a Category entity based on the given category name
     * 
     * @param string $category
     * @return Category
     */
    public function getItemCategory(string $category): Category {

        if (!isset($this->existingCategories[$category])) {
            $entityCategory = new Category();
            $entityCategory->setName($category);
            $this->entityManager->persist($entityCategory);
            $this->existingCategories[$entityCategory->getName()] = $entityCategory;
        }

        return $this->existingCategories[$category];
    }

    /**
     * Get or create a Brand entity based on the given brand name
     * 
     * @param string $brand
     * @return Brand
     */
    public function getItemBrand(string $brand): Brand {
        
        if (!isset($this->existingBrands[$brand])) {
            $entityBrand = new Brand();
            $entityBrand->setName($brand);
            $this->entityManager->persist($entityBrand);
            $this->existingBrands[$entityBrand->getName()] = $entityBrand;
        }

        return $this->existingBrands[$brand];
    }

    /**
     * Processes categories, brands, items and updates the database.
     *
     * @param object $xml
     * @return void
     */
    public function operateOnProducs(object $xml): void
    {
        $this->entityManager->beginTransaction();
        try {
            foreach ($xml->item as $itemXml) {
                $item = new Item();
                $item->setSku((string) $itemXml->sku);
                $item->setName((string) $itemXml->name);
                $item->setDescription((string) $itemXml->description);
                $item->setShortDesc((string) $itemXml->shortDescription);
                $item->setPrice((float) $itemXml->price);
                $item->setLink((string) $itemXml->link);
                $item->setRating((int) $itemXml->rating);
                $item->setCaffeineType((string) $itemXml->caffeineType);
                $item->setCount((int) $itemXml->count);
                $item->setFlavored((string) $itemXml->flavored);
                $item->setSeasonal((string) $itemXml->seasonal);
                $item->setInStock((string) $itemXml->inStock);
                $item->setFacebook((string) $itemXml->facebook);
                $item->setIsKcup((string) $itemXml->isKcup);
                $item->setImage((string) $itemXml->image);

                $item->setCategory($this->getItemCategory((string) $itemXml->CategoryName));
                $item->setBrand($this->getItemBrand((string) $itemXml->Brand));

                $this->entityManager->persist($item);
            }

            $this->entityManager->flush();
            $this->entityManager->commit();
        } catch (\Exception $e) {
            $this->entityManager->rollback();
            $this->logger->error('Error processing operation on inventory: ' . $e->getMessage());
            throw $e;
        }
    }
    
}